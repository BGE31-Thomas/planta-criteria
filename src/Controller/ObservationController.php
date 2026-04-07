<?php

namespace App\Controller;

use App\Entity\Observation;
use App\Entity\ObservationCritere;
use App\Entity\Taxref;
use App\Form\ObservationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/observation', name: 'app_admin_observation_')]
final class ObservationController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('source/index.html.twig', [
            'controller_name' => 'SourceController',
        ]);
    }

    #[Route('/add/{idPlante}', name: 'add')]
    public function new(Request $request, EntityManagerInterface $em, int $idPlante): Response
    {
        $observation = new Observation();
        
        $plante = $em->getRepository(Taxref::class)->find($idPlante);

        // Accès forcé aux collections
        $criteres = $plante->getCriteres();

       
        foreach ($criteres as $critere) {
            $oc = new ObservationCritere();
            $oc->setCritere($critere);
            $oc->setValeur(false);
            
            $observation->addObservationsCritere($oc);
        }

        $observationForm = $this->createForm(ObservationFormType::class, $observation);
        $observationForm->handleRequest($request);

        if ($observationForm->isSubmitted() && $observationForm->isValid()) {
            $em->persist($observation);
            $em->flush();

            $redirectUrl = $request->query->get('redirect');

            if ($redirectUrl) {
                return $this->redirect($redirectUrl);
            }

            return $this->redirectToRoute('app_home');
        }

        return $this->render('observation/add.html.twig', [
            'observationForm' => $observationForm,
        ]);
    }
}
