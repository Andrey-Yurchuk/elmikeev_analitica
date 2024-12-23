<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\ApiRequest;
use App\Models\Income;
use Illuminate\Http\JsonResponse;

class IncomesController extends ApiBaseController
{
    public function list(ApiRequest $request): JsonResponse
    {
        $params = $request->only(['dateFrom', 'dateTo', 'page', 'limit']);

        return $this->fetchAndStoreData(config('api.incomes_endpoint'), $params);
    }

    protected function updateOrCreateModel(array $data): void
    {
        Income::updateOrCreate(
            ['income_id' => $data['income_id']],
            $data
        );
    }
}
