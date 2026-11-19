@extends('layouts.app')

@section('title', $user->name)

@section('content')
<div class="mb-6 rounded-xl bg-white p-6 shadow">
    <h1 class="text-3xl font-bold">{{ $user->name }}</h1>
    <p class="mt-2 text-gray-600">
        {{ $reviews->count() }} {{ Str::plural('review', $reviews->count()) }} written
    </p>
</div>

<div class="space-y-4">
    @forelse ($reviews as $review)
    <article class="rounded-xl bg-white p-5 shadow">
        <a href="{{ route('eateries.show', $review->eatery) }}"
            class="text-lg font-bold text-orange-600 hover:underline">
            {{ $review->eatery->name }}
        </a>

        <p class="mt-1 text-sm text-gray-500">
            {{ $review->created_at->format('F d, Y') }}
        </p>

        <p class="mt-2 font-semibold">{{ $review->rating }} / 5 ★</p>
        <p class="mt-2">{{ $review->body }}</p>
    </article>
    @empty
    <p class="rounded-lg bg-white p-6 text-gray-600 shadow">
        This reviewer has not written any reviews yet.
    </p>
    @endforelse
</div>
@endsection