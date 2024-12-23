<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\ApiService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class ApiBaseController extends Controller
{
    public function __construct(protected ApiService $apiService)
    {
    }

    protected function fetchAndStoreData(string $endpoint, array $params): JsonResponse
    {
        $data = $this->apiService->getData($endpoint, $params);

        try {
            DB::transaction(function () use ($data) {
                foreach ($data['data'] as $itemData) {
                    $this->updateOrCreateModel($itemData);
                }
            });
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json($data);
    }

    protected function updateOrCreateModel(array $data): void
    {
    }
}
