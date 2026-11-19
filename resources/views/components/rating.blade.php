@props(['rating' => null, 'count' => 0])

@if ($count > 0)
<span class="font-semibold text-amber-600">
    {{ number_format((float) $rating, 1) }} ★
</span>
<span class="text-sm text-gray-500">
    ({{ $count }} {{ Str::plural('review', $count) }})
</span>
@else
<span class="text-sm text-gray-500">No reviews yet</span>
@endif