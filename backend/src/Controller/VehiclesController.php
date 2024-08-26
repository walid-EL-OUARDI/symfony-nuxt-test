<?php

namespace App\Controller;

use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class VehiclesController extends AbstractController
{
    #[Route('api/getVehicles', name: 'app_get_vehicles')]
    public function getvehicles(Request $request, VehicleRepository $vehicleRepository): Response
    {
        try {

            $filters = [
                'brand' => $request->query->get('brand'),
                'model' => $request->query->get('model'),
                'energy' => $request->query->get('energy'),
                'minPrice' => $request->query->get('minPrice'),
                'maxPrice' => $request->query->get('maxPrice')
            ];

            $order = $request->query->get('order', 'ASC');
            $sort = $request->query->get('sort');
            $page = max(1, $request->query->getInt('page', 1));
            $limit = $request->query->getInt('limit', 12);

            $vehicles = $vehicleRepository->findByFilters($filters, $sort, $order, $page, $limit);
            $totalItems = $vehicles->count();

            return $this->json([
                'totalItems' => $totalItems,
                'totalPages' => ceil($totalItems / $limit),
                'currentPage' => $page,
                'itemsPerPage' => $limit,
                'vehicles' => $vehicles,
            ], JsonResponse::HTTP_OK, [], ['groups' => 'vehicles.index']);
        } catch (\Throwable $e) {
            return $this->json([
                'error' => $e->getMessage(),
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR,);
        }
    }
}
