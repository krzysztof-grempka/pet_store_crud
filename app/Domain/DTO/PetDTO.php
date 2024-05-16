<?php

declare(strict_types=1);

namespace App\Domain\DTO;

 class PetDTO
{
    public int $id;
    public ?PetCategoryDTO $category = null;
    public string $name;
    public array $photoUrls = [];
    public array $tags = [];
    public string $status;

    public function __construct(
        int $id,
        ?PetCategoryDTO $category,
        string $name,
        array $photoUrls,
        array $tags,
        string $status
    ) {
        $this->id = $id;
        $this->category = $category;
        $this->name = $name;
        $this->photoUrls = $photoUrls;
        $this->tags = $tags;
        $this->status = $status;
    }

    public static function transformToDTO(array $pet): PetDTO
    {
        $category = null;
        if (isset($pet['category'])) {
            $category = new PetCategoryDTO(
                $pet['category']['id'],
                $pet['category']['name']
            );
        }

        $tags = [];
        if (isset($pet['tags'])) {
            $tags = array_map(function ($tag) {
                return new PetTagDTO($tag['id'], $tag['name']);}, $pet['tags']);
        }

        return new PetDTO(
            $pet['id'],
            $category,
            $pet['name'] ?? '',
            $pet['photoUrls'] ?? [],
            $tags,
            $pet['status']
        );
    }
}
