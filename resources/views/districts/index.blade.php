@extends('layouts.app')

@section('title', 'Districts')

@section('content')
<h1 class="mb-6 text-3xl font-bold">Explore Davao Districts</h1>

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
    @foreach ($districts as $district)
    <a href="{{ route('districts.show', $district) }}"
        class="rounded-xl bg-white p-6 shadow hover:shadow-md">
        <h2 class="text-xl font-bold">{{ $district->name }}</h2>
        <p class="mt-2 text-gray-600">
            {{ $district->eateries_count }} {{ Str::plural('eatery', $district->eateries_count) }}
        </p>
    </a>
    @endforeach
</div>
@endsection