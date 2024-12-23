<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\ApiRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;

class OrdersController extends ApiBaseController
{
    public function list(ApiRequest $request): JsonResponse
    {
        $params = $request->only(['dateFrom', 'dateTo', 'page', 'limit']);

        return $this->fetchAndStoreData(config('api.orders_endpoint'), $params);
    }

    protected function updateOrCreateModel(array $data): void
    {
        Order::updateOrCreate(
            ['g_number' => $data['g_number']],
            $data
        );
    }
}
