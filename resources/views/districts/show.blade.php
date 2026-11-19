@extends('layouts.app')

@section('title', $district->name)

@section('content')
<h1 class="text-3xl font-bold">{{ $district->name }}</h1>

<p class="my-3 text-gray-600">
    {{ $reviewCount }} {{ Str::plural('review', $reviewCount) }} in {{ $district->name }}
</p>

@if ($eateries->isNotEmpty())
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
    @foreach ($eateries as $eatery)
    <x-eatery-card :eatery="$eatery" />
    @endforeach
</div>
@else
<p class="mt-5 rounded-lg bg-white p-6 text-gray-600 shadow">
    No eateries listed in this district yet.
</p>
@endif
@endsection