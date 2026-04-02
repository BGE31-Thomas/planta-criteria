<?php

namespace App\Controller;

use App\Entity\Critere;
use App\Entity\Image;
use App\Form\CritereFormType;
use App\Service\PicturesService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


#[Route('/admin/critere', name: 'app_admin_critere_')]
final class CritereController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('critere/index.html.twig', [
            'controller_name' => 'CritereController',
        ]);
    }

    #[Route('/admin/critere/add/{id}', name: 'add')]
    public function add(
            Request $request,
            EntityManagerInterface $em,
           /*  SluggerInterface $slugger, */
            PicturesService $picturesService,
            int $id
        ): Response
    {
       /*  $this->denyAccessUnlessGranted('ROLE_ADMIN'); */

        $critere = new Critere();

        $critereForm = $this->createForm(CritereFormType::class, $critere);

        $critereForm->handleRequest($request);

        if($critereForm->isSubmitted() AND $critereForm->isValid()){
            $critere->setPlante($em->getReference('App\Entity\Taxref', $id));
            $images = $critereForm->get('images')->getData();

            $em->persist($critere);

            foreach($images as $image){
                $folder = 'criteres';
                $fichier = $picturesService->add($image,$folder,300,300);

                $img = new Image();
                $img->setChemin($fichier);

                $critere->addImage($img);

                $em->persist($img);
            }

            $em->flush();

            $this->addFlash('success','Critère ajouté avec succès');

            return $this->redirectToRoute('app_plant_show', ['id' => $id]);
        }
        return $this->render('critere/add.html.twig', [
            'critereForm' => $critereForm->createView()
        ]);
    }

    #[Route('/edit/{id}/{idPlante}', name: 'edit')]
    public function edit(
        Critere $critere,
        Request $request,
        EntityManagerInterface $em,
        PicturesService $picturesService,
        int $idPlante): Response
    {
        /* $this->denyAccessUnlessGranted('PRODUCT_EDIT',$critere); */

        $critereForm = $this->createForm(CritereFormType::class, $critere);

        $critereForm->handleRequest($request);

        if($critereForm->isSubmitted() AND $critereForm->isValid()){
            $critere->setPlante($em->getReference('App\Entity\Taxref', $idPlante));
            $images = $critereForm->get('images')->getData();

            $em->persist($critere);

            foreach($images as $image){
                $folder = 'criteres';
                $fichier = $picturesService->add($image,$folder,300,300);

                $img = new Image();
                $img->setChemin($fichier);

                $critere->addImage($img);

                $em->persist($img);
            }

            $em->flush();

            $this->addFlash('success','Produit ajouté avec succès');

            return $this->redirectToRoute('app_plant_show', ['id' => $idPlante]);
        }

        return $this->render('critere/edit.html.twig', [
            'critereForm' => $critereForm->createView(),
            'critere' => $critere
        ]);
    }

    #[Route('/delete/{id}/{idPlante}', name: 'delete')]
    public function delete(Critere $critere,EntityManagerInterface $em, int $idPlante): Response
    {
        $this->denyAccessUnlessGranted('PRODUCT_DELETE',$critere,);
        
        $em->remove($critere);
        $em->flush(); 
         return $this->redirectToRoute('app_plant_show', ['id' => $idPlante]);
        
    }

    #[Route('/admin/critere/image/{id}/delete', name: 'delete_image', methods: ['DELETE'])]
    public function deleteImage(
        ?Image $image,
        Request $request,
        EntityManagerInterface $em,
        PicturesService $picturesService
    ): JsonResponse
    {
        if (!$image) {
            return new JsonResponse(['error' => 'Image introuvable'], 404);
        }

        $data = json_decode($request->getContent(), true);

        if (!isset($data['_token'])) {
            return new JsonResponse(['error' => 'Token manquant'], 400);
        }

        if ($this->isCsrfTokenValid('delete'.$image->getId(), $data['_token'])) {

            $nom = $image->getChemin();

            if ($picturesService->delete($nom, 'criteres', 300, 300)) {
                $em->remove($image);
                $em->flush();

                return new JsonResponse(['success' => true], 200);
            }

            return new JsonResponse(['error' => 'Erreur de suppression'], 400);
        }

        return new JsonResponse(['error' => 'Token invalide'], 400);
    }
}
