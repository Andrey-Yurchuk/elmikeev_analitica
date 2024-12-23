<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\ApiRequest;
use App\Models\Sale;
use Illuminate\Http\JsonResponse;

class SalesController extends ApiBaseController
{
    public function list(ApiRequest $request): JsonResponse
    {
        $params = $request->only(['dateFrom', 'dateTo', 'page', 'limit']);

        return $this->fetchAndStoreData(config('api.sales_endpoint'), $params);
    }

    protected function updateOrCreateModel(array $data): void
    {
        Sale::updateOrCreate(
            ['sale_id' => $data['sale_id']],
            $data
        );
    }
}
