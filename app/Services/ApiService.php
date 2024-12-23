<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;

class ApiService
{
    public function __construct(protected Client $client)
    {
    }

    public function getData(string $endpoint, array $params): ?array
    {
        $url = config('api.protocol') . config('api.host') . ':' . config('api.port') . $endpoint;
        $queryParams = $this->queryParams($params);

        try {
            $response = $this->sendRequest($url, $queryParams);
            return $this->processResponse($response);
        } catch (Exception $e) {
            throw new RuntimeException("Error when requesting data: " . $e->getMessage());
        }
    }

    private function queryParams(array $params): array
    {
        $params['key'] = config('app.api_key');
        $params['limit'] = $params['limit'] ?? 500;
        $params['page'] = $params['page'] ?? 1;

        return $params;
    }

    private function sendRequest(string $url, array $queryParams): ?ResponseInterface
    {
        try {
            $response = $this->client->request(config('api.method_get'), $url, [
                'query' => $queryParams
            ]);
            if ($response->getStatusCode() === config('http_ok')) {
                return $response;
            }
        } catch (GuzzleException $e) {
            throw new RuntimeException("HTTP request error: " . $e->getMessage());
        }

        return null;
    }

    /**
     * @throws \JsonException
     */
    private function processResponse($response): array
    {
        if ($response === null) {
            throw new RuntimeException("Response is NULL");
        }

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }
}
