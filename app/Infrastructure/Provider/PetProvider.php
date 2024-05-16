<?php

declare(strict_types=1);

namespace App\Infrastructure\Provider;

use App\Domain\Enum\PetStatus;
use App\Infrastructure\Services\PetService;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

readonly class PetProvider
{
    public function __construct(
        private PetService $petService,
    ) {
    }

    public function findPetById(int $petId): array
    {
        try {
            $response = $this->petService->getClient()->get(PetService::API_BASE_URL . "/$petId");

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException | GuzzleException $e) {
            $this->petService->handleException($e);

            return [];
        }
    }

    public function findPetsByStatus(?string $status = null): array
    {
        try {
            $response = $this->petService->getClient()->get(PetService::API_BASE_URL . "/findByStatus", [
                'query' => ['status' => $status ?? implode(',', PetStatus::allStatuses())],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException | GuzzleException $e) {
            $this->petService->handleException($e);

            return [];
        }
    }
}
