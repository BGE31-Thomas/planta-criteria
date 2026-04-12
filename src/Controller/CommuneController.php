<?php
namespace App\Controller;

use App\Repository\CommuneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class CommuneController extends AbstractController
{
    #[Route('/api/communes', name: 'api_communes')]
    public function search(Request $request, CommuneRepository $repo): JsonResponse
    {
        $q = $request->query->get('q', '');

        if (strlen($q) < 2) {
            return new JsonResponse([]);
        }

        $results = $repo->createQueryBuilder('c')
            ->where('LOWER(c.nom) LIKE :q')
            ->setParameter('q', '%' . strtolower($q) . '%')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();

        $data = [];

        foreach ($results as $commune) {
            $data[] = [
                'id' => $commune->getId(),
                'text' => $commune->getNom() . ' (' . $commune->getCodePostal() . ')'
            ];
        }

        return new JsonResponse($data);
    }
}