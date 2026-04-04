<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Source;
use App\Form\SourceFormType;

#[Route('/admin/source', name: 'app_admin_source_')]
final class SourceController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('source/index.html.twig', [
            'controller_name' => 'SourceController',
        ]);
    }

    #[Route('/add/{idCritere}', name: 'add')]
    public function new(Request $request, EntityManagerInterface $em,int $idCritere): Response
    {
        $source = new Source();
        $sourceForm = $this->createForm(SourceFormType::class, $source);

        $sourceForm->handleRequest($request);

        if ($sourceForm->isSubmitted() && $sourceForm->isValid()) {
            $em->persist($source);
            $em->flush();

            return $this->redirectToRoute('app_admin_critere_edit', ['id' => $idCritere]);
        }

        return $this->render('source/add.html.twig', [
            'sourceForm' => $sourceForm,
        ]);
    }

    
}

