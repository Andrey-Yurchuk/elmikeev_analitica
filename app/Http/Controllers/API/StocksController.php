<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\ApiRequest;
use App\Models\Stock;
use Illuminate\Http\JsonResponse;

class StocksController extends ApiBaseController
{
    public function list(ApiRequest $request): JsonResponse
    {
        $params = $request->only(['dateFrom', 'page', 'limit']);

        return $this->fetchAndStoreData(config('api.stocks_endpoint'), $params);
    }

    protected function updateOrCreateModel(array $data): void
    {
        Stock::updateOrCreate(
            ['barcode' => $data['barcode']],
            $data
        );
    }
}
