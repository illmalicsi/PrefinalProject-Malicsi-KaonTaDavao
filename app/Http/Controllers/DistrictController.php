<?php

namespace App\Http\Controllers;

use App\Models\District;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::withCount('eateries')
            ->orderBy('name')
            ->get();

        return view('districts.index', compact('districts'));
    }

    public function show(District $district)
    {
        $eateries = $district->eateries()
            ->with(['district', 'features'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->orderBy('name')
            ->get();

        $reviewCount = $district->reviews()->count();

        return view('districts.show', compact(
            'district',
            'eateries',
            'reviewCount'
        ));
    }
}
