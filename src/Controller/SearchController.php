<?php

namespace App\Controller;

use App\Repository\TaxrefRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Knp\Snappy\Pdf;


final class SearchController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('search/index.html.twig');
    }

    #[Route('/plant/{id}', name: 'app_plant_show')]
    public function show(int $id, TaxrefRepository $repo): Response
    {
        $taxref = $repo->find($id);

        if (!$taxref) {
            throw $this->createNotFoundException();
        }

        if ($taxref->getCdNom() !== $taxref->getCdRef()) {
            return $this->redirectToRoute('app_plant_show', [
                'id' => $taxref->getCdRef()
            ]);
        }

        $synonymes = $repo->findBy(['cd_ref' => $taxref->getCdNom()]);

        $criteres = $taxref->getCriteres()->toArray();

        usort($criteres, function($a, $b) {
            $sourceA = $a->getSource() ? $a->getSource()->getTitre() : '';
            $sourceB = $b->getSource() ? $b->getSource()->getTitre() : '';
            return strcmp($sourceA, $sourceB);
        });

        return $this->render('plante.html.twig', [
            'plant' => $taxref,
            'synonymes' => $synonymes,
            'criteres' => $criteres 
        ]);
    }

    #[Route('/export/pdf/{id}', name: 'app_export_pdf')]
    public function exportPdf(Pdf $knpSnappyPdf, int $id, TaxrefRepository $repo): Response
    {
        $plant = $repo->find($id);
        $nom = $plant->getNomCompletHtml();
        $criteres = $plant->getCriteres()->toArray();
        $synonymes = $repo->findBy(['cd_ref' => $plant->getCdNom()]);

        $html = $this->renderView('export.html.twig', [
            'plant' => $plant,
            'criteres' => $criteres,
            'synonymes' => $synonymes,
        ]);

        $pdf = $knpSnappyPdf->getOutputFromHtml($html, [
            'enable-local-file-access' => true,
        ]);

        return new Response(
            $pdf,
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $nom . '.pdf"'
            ]
        );
    }

    #[Route('/search', name: 'app_search')]
    public function search(Request $request, TaxrefRepository $repo): JsonResponse
    {
        $q = $request->query->get('q');

        $results = $repo->createQueryBuilder('t')
            ->where('t.nom_complet_html LIKE :q')
            ->setParameter('q', "%$q%")
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();

        $data = [];

        foreach ($results as $taxref) {
            $data[] = [
                'id' => $taxref->getCdNom(),
                'label' => $taxref->getNomCompletHtml(),
            ];
        }

        return $this->json($data);
    }
}
