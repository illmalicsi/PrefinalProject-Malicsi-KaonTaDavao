<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEateryRequest;
use App\Http\Requests\UpdateEateryRequest;
use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EateryController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
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

        return view('eateries.index', compact('eateries', 'districts', 'features'));
    }

    public function create()
    {
        $districts = District::orderBy('name')->get();
        $features = Feature::orderBy('name')->get();

        return view('eateries.create', compact('districts', 'features'));
    }

    public function store(StoreEateryRequest $request)
    {
        $data = $request->validated();

        $eatery = DB::transaction(function () use ($data) {
            $eatery = Eatery::create([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'district_id' => $data['district_id'],
                'address' => $data['address'],
                'price_range' => $data['price_range'],
                'specialty' => $data['specialty'] ?? null,
                'is_open' => $data['is_open'],
            ]);

            $eatery->permit()->create([
                'permit_no' => $data['permit_no'],
                'expires_on' => $data['expires_on'],
            ]);

            $eatery->features()->sync($data['features']);

            return $eatery;
        });

        return redirect()
            ->route('eateries.show', $eatery)
            ->with('success', 'Eatery added.');
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

        $reviewers = User::orderBy('name')->get();

        return view('eateries.show', compact('eatery', 'reviewers'));
    }

    public function edit(Eatery $eatery)
    {
        $eatery->load(['features', 'permit']);

        $districts = District::orderBy('name')->get();
        $features = Feature::orderBy('name')->get();

        return view('eateries.edit', compact('eatery', 'districts', 'features'));
    }

    public function update(UpdateEateryRequest $request, Eatery $eatery)
    {
        $data = $request->validated();

        DB::transaction(function () use ($data, $eatery) {
            $eatery->update([
                'name' => $data['name'],
                'slug' => Str::slug($data['name']),
                'district_id' => $data['district_id'],
                'address' => $data['address'],
                'price_range' => $data['price_range'],
                'specialty' => $data['specialty'] ?? null,
                'is_open' => $data['is_open'],
            ]);

            $eatery->permit()->updateOrCreate(
                ['eatery_id' => $eatery->id],
                [
                    'permit_no' => $data['permit_no'],
                    'expires_on' => $data['expires_on'],
                ]
            );

            $eatery->features()->sync($data['features']);
        });

        return redirect()
            ->route('eateries.show', $eatery)
            ->with('success', 'Eatery updated.');
    }

    public function destroy(Eatery $eatery)
    {
        DB::transaction(function () use ($eatery) {
            $eatery->reviews()->delete();
            $eatery->dishes()->delete();
            $eatery->permit()->delete();
            $eatery->features()->detach();
            $eatery->delete();
        });

        return redirect()
            ->route('eateries.index')
            ->with('success', 'Eatery deleted.');
    }
}
