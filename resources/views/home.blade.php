@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="space-y-10">

    <section class="text-center py-10">
        <h1 class="text-4xl font-bold text-gray-900">
            Kaon Ta, Davao!
        </h1>

        <p class="mt-3 text-lg text-gray-600">
            Discover local carinderias and eateries around Davao City.
        </p>

        <a href="{{ route('eateries.index') }}"
            class="inline-block mt-6 rounded-lg bg-orange-600 px-6 py-3 font-semibold text-white hover:bg-orange-700">
            Explore Eateries
        </a>
    </section>

    <section>
        <h2 class="mb-5 text-2xl font-bold text-gray-900">
            Kaon Ta Statistics
        </h2>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div class="rounded-lg bg-white p-6 shadow">
                <p class="text-sm text-gray-500">Total Eateries</p>
                <p class="mt-2 text-3xl font-bold text-orange-600">
                    {{ $eateryCount }}
                </p>
            </div>

            <div class="rounded-lg bg-white p-6 shadow">
                <p class="text-sm text-gray-500">Districts Covered</p>
                <p class="mt-2 text-3xl font-bold text-orange-600">
                    {{ $districtCount }}
                </p>
            </div>

            <div class="rounded-lg bg-white p-6 shadow">
                <p class="text-sm text-gray-500">Reviews Submitted</p>
                <p class="mt-2 text-3xl font-bold text-orange-600">
                    {{ $reviewCount }}
                </p>
            </div>
        </div>
    </section>

    <section>
        <div class="mb-5 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-900">
                Top Rated Eateries
            </h2>

            <a href="{{ route('eateries.index') }}"
                class="text-sm font-semibold text-orange-600 hover:text-orange-700">
                View All
            </a>
        </div>

        @if ($topRatedEateries->isNotEmpty())
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($topRatedEateries as $eatery)
            <x-eatery-card :eatery="$eatery" />
            @endforeach
        </div>
        @else
        <p class="rounded-lg bg-white p-6 text-gray-600 shadow">
            No rated eateries available yet.
        </p>
        @endif
    </section>

</div>
@endsection