<form action="{{ route('pet.index') }}" method="GET">
    <label for="pet_id">Enter Pet ID:</label>
    <input type="text" name="pet_id" id="pet_id" placeholder="Pet ID">

    <label for="status">Select Status:</label>
    <select name="status" id="status">
        <option value="">{{ '' }}</option>
        @foreach(\App\Domain\Enum\PetStatus::allStatuses() as $status)
            <option value="{{ $status }}">{{ ucfirst($status) }}</option>
        @endforeach
    </select>

    <button type="submit">Filter</button>
</form>
