<?php

namespace App\Controller;

use App\Repository\TaxrefRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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

        // 🔁 Si synonyme → aller vers le nom valide
        if ($taxref->getCdNom() !== $taxref->getCdRef()) {
            return $this->redirectToRoute('app_plant_show', [
                'id' => $taxref->getCdRef()
            ]);
        }

        $synonymes = $repo->findBy(['cd_ref' => $taxref->getCdNom()]);

        return $this->render('plante.html.twig', [
            'plant' => $taxref,
            'synonymes' => $synonymes
        ]);
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
