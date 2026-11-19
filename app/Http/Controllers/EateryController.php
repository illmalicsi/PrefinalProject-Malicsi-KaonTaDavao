<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use Illuminate\Http\Request;

class EateryController extends Controller
{
    public function index(Request $request)
    {
        $query = Eatery::with(['district', 'features'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews');

        if ($request->filled('q')) {
            $search = $request->q;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('specialty', 'like', "%{$search}%");
            });
        }

        if ($request->filled('district')) {
            $query->where('district_id', $request->district);
        }

        if ($request->filled('feature')) {
            $query->whereHas('features', function ($q) use ($request) {
                $q->where('name', $request->feature);
            });
        }

        $eateries = $query->orderBy('name')
            ->paginate(6)
            ->withQueryString();

        $districts = District::orderBy('name')->get();
        $features = Feature::orderBy('name')->get();

        return view('eateries.index', compact(
            'eateries',
            'districts',
            'features'
        ));
    }

    public function create()
    {
        $districts = District::orderBy('name')->get();
        $features = Feature::orderBy('name')->get();

        return view('eateries.create', compact('districts', 'features'));
    }

    public function store(Request $request)
    {
        abort(501, 'Eatery creation will be implemented with Form Requests in Phase 4.');
    }

    public function show(Eatery $eatery)
    {
        $eatery->load([
            'district',
            'features',
            'permit',
            'dishes',
            'reviews' => function ($query) {
                $query->with('user')->latest();
            },
        ]);

        $reviewers = \App\Models\User::orderBy('name')->get();

        return view('eateries.show', compact('eatery', 'reviewers'));
    }

    public function edit(Eatery $eatery)
    {
        $eatery->load(['features', 'permit']);

        $districts = District::orderBy('name')->get();
        $features = Feature::orderBy('name')->get();

        return view('eateries.edit', compact(
            'eatery',
            'districts',
            'features'
        ));
    }

    public function update(Request $request, Eatery $eatery)
    {
        abort(501, 'Eatery updating will be implemented with Form Requests in Phase 4.');
    }

    public function destroy(Eatery $eatery)
    {
        abort(501, 'Eatery deletion will be implemented in Phase 4.');
    }
}
