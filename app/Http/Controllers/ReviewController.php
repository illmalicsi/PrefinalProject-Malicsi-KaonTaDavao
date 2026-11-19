<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Eatery;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Eatery $eatery)
    {
        abort(501, 'Review submission will be implemented with Form Requests in Phase 4.');
    }

    public function destroy(Review $review)
    {
        abort(501, 'Review deletion will be implemented in Phase 4.');
    }
}
