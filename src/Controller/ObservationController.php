<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Observation;
use App\Entity\ObservationCritere;
use App\Entity\Statut;
use App\Entity\Taxref;
use App\Form\ObservationFormType;
use App\Service\PicturesService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/observation', name: 'app_observation_')]
final class ObservationController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('source/index.html.twig', [
            'controller_name' => 'SourceController',
        ]);
    }

    #[Route('/add/{idPlante}', name: 'add')]
    public function new(Request $request, EntityManagerInterface $em, int $idPlante,PicturesService $picturesService): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $observation = new Observation();

        $plante = $em->getRepository(Taxref::class)->find($idPlante);

        $criteres = $plante->getCriteres();

        foreach ($criteres as $critere) {
            $oc = new ObservationCritere();
            $oc->setCritere($critere);
            $oc->setStatut(
                $em->getRepository(Statut::class)
                    ->findOneBy(['libelle' => 'Non vérifié'])
            );

            $observation->addObservationsCritere($oc);
        }

        $observationForm = $this->createForm(
            ObservationFormType::class,
            $observation
        );

        $observationForm->handleRequest($request);

        if ($observationForm->isSubmitted() && $observationForm->isValid()) {

            foreach ($observationForm->get('observationsCritere') as $observationCritereForm) {

                /** @var ObservationCritere $observationCritere */
                $observationCritere = $observationCritereForm->getData();

                $uploadedFiles = $observationCritereForm
                    ->get('images')
                    ->getData();

                foreach ($uploadedFiles as $uploadedFile) {

                    $filename = $picturesService->add(
                        $uploadedFile,
                        '/observations'
                    );

                    $image = new Image();
                    $image->setChemin($filename);

                    $observationCritere->addImage($image);
                }
            }

            $em->persist($observation);
            $em->flush();

            $redirectUrl = $request->query->get('redirect');

            if ($redirectUrl) {
                return $this->redirect($redirectUrl);
            }

            return $this->redirectToRoute('app_plantes');
        }

        return $this->render('observation/add.html.twig', [
            'observationForm' => $observationForm,
        ]);
    }

    
}
