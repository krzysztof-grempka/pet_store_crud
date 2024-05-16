<?php

declare(strict_types=1);

namespace App\UI\Http\Controllers;

use App\Domain\DTO\PetDTO;
use App\Infrastructure\Factory\PetFactory;
use App\Infrastructure\Provider\PetProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

readonly class PetController
{
    public function __construct(
        private PetProvider $petProvider,
        private PetFactory $petFactory,
    ) {
    }

    public function index(Request $request): View
    {
        $petId = $request->query('pet_id');
        $status = $request->query('status');

        $pets = $petId
            ? ($pet = $this->petProvider->findPetById(intval($petId))) ? [PetDTO::transformToDTO($pet)] : []
            : array_map(fn($pet) => PetDTO::transformToDTO($pet),
                $this->petProvider->findPetsByStatus($status)
            );

        return view('pet.index', ['pets' => $pets]);
    }

    public function delete(int $petId): RedirectResponse
    {
        $this->petFactory->deletePetById($petId);

        return redirect()->route('pet.index');
    }

    public function create(): View
    {
        return view('pet.add');
    }

    public function edit(int $id): View|RedirectResponse
    {
        $pet = $this->petProvider->findPetById($id);
        if (!$pet) {
            return redirect()->route('pet.index')->with('exception', 'Pet not  found!');
        }

        return view('pet.edit', compact('pet'));
    }

    public function update(Request $request): RedirectResponse
    {
        $this->petFactory->updatePet($request->validate([
            'id' => 'required|integer',
            'category' => 'nullable|string',
            'name' => 'required|string',
            'status' => 'nullable|string',
            'tags' => 'nullable|string',
        ]));

        return redirect()->route('pet.index')->with('success', 'Pet updated successfully!');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->petFactory->addNewPet($request->validate([
            'category' => 'required|string',
            'name' => 'required|string',
            'status' => 'required|string',
            'tags' => 'nullable|string',
        ]));

        return redirect()->route('pet.index')->with('success', 'Pet created successfully!');
    }
}
