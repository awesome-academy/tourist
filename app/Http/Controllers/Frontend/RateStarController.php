<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Repositories\ReviewRepository;

class RateStarController extends Controller
{
    protected $review;

    public function __construct(ReviewRepository $review)
    {
        $this->review = $review;
    }

    public function index(CommentRequest $request)
    {
        $request->merge([
            'star' => $request->rating,
        ]);
        $this->review->create($request->all());
        return redirect()->route('homeTourist');
    }
}
