<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Infrastructure\Services\PetService;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Session;

readonly class PetFactory
{
    public function __construct(
        private PetService $petService,
    ) {
    }

    public function deletePetById(int $petId): void
    {
        try {
            $this->petService->getClient()->delete(PetService::API_BASE_URL . "/$petId");
            Session::flash('success_delete', sprintf('Pet Id: %d has been deleted successfully.', $petId));
        } catch (RequestException | GuzzleException $e) {
            $this->petService->handleException($e);
        }
    }

    public function addNewPet(array $data): void
    {
        if (!empty($data['tags'])) {
            $tags = array_map('trim', explode(',', $data['tags']));
            $tagsArray = array_map(function ($tag) {
                return ['name' => $tag];
            }, $tags);
        } else {
            $tagsArray = [];
        }

        $data = [
            'category' => ['name' => $data['category']],
            'status' => $data['status'],
            'name' => $data['name'],
            'tags' => $tagsArray,
        ];

        try {
            $this->petService->getClient()->post(PetService::API_BASE_URL, [
                'json' => $data,
                ]);
        } catch (RequestException | GuzzleException $e) {
            $this->petService->handleException($e);
        }
    }
    public function updatePet(array $data): void
    {
        if (!empty($data['tags'])) {
            $tags = array_map('trim', explode(',', $data['tags']));
            $tagsArray = array_map(function ($tag) {
                return ['name' => $tag];
            }, $tags);
        } else {
            $tagsArray = [];
        }

        $data = [
            'id' => $data['id'],
            'category' => ['name' => $data['category']],
            'status' => $data['status'],
            'name' => $data['name'],
            'tags' => $tagsArray,
        ];

        try {
            $this->petService->getClient()->put(PetService::API_BASE_URL, [
                'json' => $data,
            ]);
        } catch (RequestException | GuzzleException $e) {
            $this->petService->handleException($e);
        }
    }
}
