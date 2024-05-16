<?php

declare(strict_types=1);

namespace App\Infrastructure\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class PetService
{
    public const string API_BASE_URL = 'https://petstore.swagger.io/v2/pet';

    public function __construct(
        private readonly string $petStoreApiKey,
    ) {
    }

    public function getClient(): Client
    {
        return new Client([
            'headers' => [
                'Api-Key' => $this->petStoreApiKey
            ]
        ]);
    }

    public function handleException(\Throwable $e): void
    {
        Session::flash('exception', $e->getMessage());
    }
}
