@extends('layouts.app')

@section('title', 'Eateries')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-bold">Explore Eateries</h1>
        <p class="mt-2 text-gray-600">Find your next favorite carinderia in Davao.</p>
    </div>

    <form method="GET" action="{{ route('eateries.index') }}"
        class="grid grid-cols-1 gap-4 rounded-xl bg-white p-5 shadow sm:grid-cols-3">
        <input type="text" name="q" value="{{ request('q') }}"
            placeholder="Search name or specialty..."
            class="rounded-lg border-gray-300">

        <select name="district" class="rounded-lg border-gray-300">
            <option value="">All districts</option>
            @foreach ($districts as $district)
            <option value="{{ $district->id }}" @selected(request('district')==$district->id)>
                {{ $district->name }}
            </option>
            @endforeach
        </select>

        <select name="feature" class="rounded-lg border-gray-300">
            <option value="">All features</option>
            @foreach ($features as $feature)
            <option value="{{ $feature->name }}" @selected(request('feature')==$feature->name)>
                {{ $feature->name }}
            </option>
            @endforeach
        </select>

        <div class="flex gap-2 sm:col-span-3">
            <button class="rounded-lg bg-orange-600 px-5 py-2 font-semibold text-white">
                Apply Filters
            </button>
            <a href="{{ route('eateries.index') }}"
                class="rounded-lg bg-gray-200 px-5 py-2 font-semibold text-gray-700">
                Clear
            </a>
        </div>
    </form>

    @if ($eateries->isNotEmpty())
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($eateries as $eatery)
        <x-eatery-card :eatery="$eatery" />
        @endforeach
    </div>

    <div>{{ $eateries->links() }}</div>
    @else
    <p class="rounded-lg bg-white p-6 text-gray-600 shadow">
        No eateries match your filters.
    </p>
    @endif
</div>
@endsection