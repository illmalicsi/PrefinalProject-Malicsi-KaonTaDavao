@php
$editing = isset($eatery);
@endphp

@if ($errors->any())
<div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-700">
    <p class="font-semibold">Please correct the following errors:</p>
    <ul class="mt-2 list-inside list-disc">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="space-y-5">
    <div>
        <label for="name" class="mb-1 block font-medium">Eatery Name</label>
        <input id="name" name="name" type="text" value="{{ old('name', $eatery->name ?? '') }}"
            class="w-full rounded-lg border-gray-300" required>
        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="district_id" class="mb-1 block font-medium">District</label>
        <select id="district_id" name="district_id" class="w-full rounded-lg border-gray-300" required>
            <option value="">Choose a district</option>
            @foreach ($districts as $district)
            <option value="{{ $district->id }}" @selected(old('district_id', $eatery->district_id ?? '') == $district->id)>
                {{ $district->name }}
            </option>
            @endforeach
        </select>
        @error('district_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="address" class="mb-1 block font-medium">Address</label>
        <input id="address" name="address" type="text" value="{{ old('address', $eatery->address ?? '') }}"
            class="w-full rounded-lg border-gray-300" required>
        @error('address') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="price_range" class="mb-1 block font-medium">Price Range</label>
        <select id="price_range" name="price_range" class="w-full rounded-lg border-gray-300" required>
            <option value="">Choose a price range</option>
            <option value="budget" @selected(old('price_range', $eatery->price_range ?? '') === 'budget')>₱ Budget</option>
            <option value="mid" @selected(old('price_range', $eatery->price_range ?? '') === 'mid')>₱₱ Mid-range</option>
            <option value="splurge" @selected(old('price_range', $eatery->price_range ?? '') === 'splurge')>₱₱₱ Splurge</option>
        </select>
        @error('price_range') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="specialty" class="mb-1 block font-medium">Specialty</label>
        <input id="specialty" name="specialty" type="text" value="{{ old('specialty', $eatery->specialty ?? '') }}"
            class="w-full rounded-lg border-gray-300">
        @error('specialty') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="mb-1 block font-medium">Features</label>
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
            @foreach ($features as $feature)
            <label class="flex items-center gap-2">
                <input type="checkbox" name="features[]" value="{{ $feature->id }}"
                    @checked(in_array($feature->id, old('features', $editing ? $eatery->features->pluck('id')->all() : [])))>
                {{ $feature->name }}
            </label>
            @endforeach
        </div>
        @error('features') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        @error('features.*') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="flex items-center gap-2">
            <input type="checkbox" name="is_open" value="1" @checked(old('is_open', $eatery->is_open ?? true))>
            Currently open
        </label>
        @error('is_open') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <hr>

    <h3 class="text-lg font-bold">Business Permit</h3>

    <div>
        <label for="permit_no" class="mb-1 block font-medium">Permit Number</label>
        <input id="permit_no" name="permit_no" type="text"
            value="{{ old('permit_no', $eatery->permit->permit_no ?? '') }}"
            class="w-full rounded-lg border-gray-300" required>
        @error('permit_no') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="expires_on" class="mb-1 block font-medium">Permit Expiration Date</label>
        <input id="expires_on" name="expires_on" type="date"
            value="{{ old('expires_on', isset($eatery) ? $eatery->permit?->expires_on?->format('Y-m-d') : '') }}"
            class="w-full rounded-lg border-gray-300" required>
        @error('expires_on') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>
</div>

<div class="mt-8 flex gap-3">
    <button type="submit" class="rounded-lg bg-orange-600 px-6 py-3 font-semibold text-white hover:bg-orange-700">
        {{ $editing ? 'Update Eatery' : 'Add Eatery' }}
    </button>

    <a href="{{ route('eateries.index') }}" class="rounded-lg bg-gray-200 px-6 py-3 font-semibold text-gray-700">
        Cancel
    </a>
</div>