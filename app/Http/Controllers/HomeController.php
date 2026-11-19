<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Eatery;
use App\Models\Review;

class HomeController extends Controller
{
    public function __invoke()
    {
        $eateryCount = Eatery::count();

        $districtCount = District::count();

        $reviewCount = Review::count();

        $topRatedEateries = Eatery::with(['district', 'features'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->whereHas('reviews')
            ->orderByDesc('reviews_avg_rating')
            ->take(3)
            ->get();

        return view('home', compact(
            'eateryCount',
            'districtCount',
            'reviewCount',
            'topRatedEateries'
        ));
    }
}
