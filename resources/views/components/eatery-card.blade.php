@props(['eatery'])

<div class="flex h-full flex-col rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">
    <div class="flex items-start justify-between gap-3">
        <h3 class="text-lg font-bold text-gray-900">
            <a href="{{ route('eateries.show', $eatery) }}" class="hover:text-orange-600">
                {{ $eatery->name }}
            </a>
        </h3>

        @unless ($eatery->is_open)
        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
            Closed
        </span>
        @endunless
    </div>

    <p class="mt-2 text-sm text-gray-500">
        <a href="{{ route('districts.show', $eatery->district) }}" class="hover:text-orange-600">
            {{ $eatery->district->name }}
        </a>
    </p>

    <p class="mt-3 text-sm text-gray-700">
        {{ $eatery->specialty ?? 'Local Filipino favorites' }}
    </p>

    <p class="mt-2 text-sm font-semibold text-orange-700">
        @switch($eatery->price_range)
        @case('budget') ₱ @break
        @case('mid') ₱₱ @break
        @case('splurge') ₱₱₱ @break
        @default N/A
        @endswitch
    </p>

    <div class="mt-3 flex flex-wrap gap-2">
        @foreach ($eatery->features as $feature)
        <a href="{{ route('eateries.index', ['feature' => $feature->name]) }}"
            class="rounded-full bg-orange-50 px-3 py-1 text-xs text-orange-700 hover:bg-orange-100">
            {{ $feature->name }}
        </a>
        @endforeach
    </div>

    <div class="mt-auto pt-4">
        <x-rating
            :rating="$eatery->reviews_avg_rating"
            :count="$eatery->reviews_count ?? 0" />
    </div>
</div>