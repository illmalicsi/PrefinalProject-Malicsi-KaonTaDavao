@extends('layouts.app')

@section('title', $eatery->name)

@section('content')
<div class="space-y-8">
    <div class="rounded-xl bg-white p-6 shadow">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold">{{ $eatery->name }}</h1>
                <p class="mt-2 text-gray-600">{{ $eatery->address }}</p>
                <p class="mt-1 text-gray-600">
                    District:
                    <a class="text-orange-600 hover:underline"
                        href="{{ route('districts.show', $eatery->district) }}">
                        {{ $eatery->district->name }}
                    </a>
                </p>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('eateries.edit', $eatery) }}"
                    class="rounded-lg bg-orange-600 px-4 py-2 text-white">Edit</a>

                <form method="POST" action="{{ route('eateries.destroy', $eatery) }}"
                    onsubmit="return confirm('Delete this eatery?')">
                    @csrf
                    @method('DELETE')
                    <button class="rounded-lg bg-red-600 px-4 py-2 text-white">Delete</button>
                </form>
            </div>
        </div>

        <div class="mt-6 space-y-3">
            <p><strong>Specialty:</strong> {{ $eatery->specialty ?? 'Not specified' }}</p>
            <p><strong>Price range:</strong> {{ $eatery->price_range }}</p>
            <p><strong>Status:</strong> {{ $eatery->is_open ? 'Open' : 'Closed' }}</p>

            <div>
                <strong>Features:</strong>
                <div class="mt-2 flex flex-wrap gap-2">
                    @foreach ($eatery->features as $feature)
                    <span class="rounded-full bg-orange-50 px-3 py-1 text-sm text-orange-700">
                        {{ $feature->name }}
                    </span>
                    @endforeach
                </div>
            </div>

            @if ($eatery->permit)
            <div class="border-t pt-4">
                <p><strong>Permit number:</strong> {{ $eatery->permit->permit_no }}</p>
                <p><strong>Expires on:</strong> {{ $eatery->permit->expires_on->format('F d, Y') }}</p>

                @if ($eatery->permit->expires_on->isPast())
                <p class="mt-1 font-semibold text-red-600">Permit expired</p>
                @endif
            </div>
            @endif
        </div>
    </div>

    <section>
        <h2 class="mb-4 text-2xl font-bold">Dishes</h2>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($eatery->dishes as $dish)
            <div class="rounded-xl bg-white p-5 shadow">
                <div class="flex justify-between gap-3">
                    <h3 class="font-bold">{{ $dish->name }}</h3>
                    @if ($dish->is_bestseller)
                    <span class="text-sm font-semibold text-orange-600">Bestseller</span>
                    @endif
                </div>
                <p class="mt-2 text-gray-600">₱{{ number_format($dish->price, 2) }}</p>
            </div>
            @empty
            <p class="text-gray-500">No dishes listed yet.</p>
            @endforelse
        </div>
    </section>

    <section>
        <h2 class="mb-4 text-2xl font-bold">Reviews</h2>

        <div class="space-y-4">
            @forelse ($eatery->reviews as $review)
            <article class="rounded-xl bg-white p-5 shadow">
                <div class="flex flex-wrap justify-between gap-2">
                    <div>
                        <a href="{{ route('reviewers.show', $review->user) }}"
                            class="font-semibold text-orange-600 hover:underline">
                            {{ $review->user->name }}
                        </a>
                        <p class="text-sm text-gray-500">
                            {{ $review->created_at->format('F d, Y') }}
                        </p>
                    </div>

                    <x-rating :rating="$review->rating" :count="1" />
                </div>

                <p class="mt-3">{{ $review->body }}</p>

                <form method="POST" action="{{ route('reviews.destroy', $review) }}"
                    class="mt-3" onsubmit="return confirm('Delete this review?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-sm font-semibold text-red-600 hover:underline">
                        Delete Review
                    </button>
                </form>
            </article>
            @empty
            <p class="rounded-lg bg-white p-5 text-gray-500 shadow">No reviews yet.</p>
            @endforelse
        </div>
    </section>

    <section class="rounded-xl bg-white p-6 shadow">
        <h2 class="mb-4 text-2xl font-bold">Write a Review</h2>

        @if ($eatery->is_open)
        @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-50 p-4 text-red-700">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('eateries.reviews.store', $eatery) }}"
            class="space-y-4">
            @csrf

            <div>
                <label for="user_id" class="mb-1 block font-medium">Reviewer</label>
                <select id="user_id" name="user_id" class="w-full rounded-lg border-gray-300" required>
                    <option value="">Choose your name</option>
                    @foreach ($reviewers as $reviewer)
                    <option value="{{ $reviewer->id }}" @selected(old('user_id')==$reviewer->id)>
                        {{ $reviewer->name }}
                    </option>
                    @endforeach
                </select>
                @error('user_id') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="rating" class="mb-1 block font-medium">Rating</label>
                <select id="rating" name="rating" class="w-full rounded-lg border-gray-300" required>
                    <option value="">Choose a rating</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" @selected(old('rating')==$i)>
                        {{ $i }} star{{ $i > 1 ? 's' : '' }}
                        </option>
                        @endfor
                </select>
                @error('rating') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="body" class="mb-1 block font-medium">Your Review</label>
                <textarea id="body" name="body" rows="4"
                    class="w-full rounded-lg border-gray-300" required>{{ old('body') }}</textarea>
                @error('body') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <button class="rounded-lg bg-orange-600 px-6 py-3 font-semibold text-white">
                Submit Review
            </button>
        </form>
        @else
        <p>This eatery is closed. Reviews are paused.</p>
        @endif
    </section>
</div>
@endsection