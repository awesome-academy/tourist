<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TourRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ReviewRepository;

class TourViewController extends Controller
{
    protected $tour;
    protected $catetour;
    protected $review;

    public function __construct(TourRepository $tour, CategoryRepository $catetour, ReviewRepository $review)
    {
        $this->tour = $tour;
        $this->catetour = $catetour;
        $this->review = $review;
    }

    public function index($slug)
    {
        $list_cate = $this->catetour->listCateCity($slug);
        $result = $this->catetour->cateDetail($slug);
        $data = $this->tour->listTourCate($result->id);

        return view('frontend.tour.index', compact('list_cate', 'result', 'data'));
    }

    public function detailTour($slug)
    {
        $data = $this->tour->tourDetail($slug);
        $id = $data[0]->id;
        $total_comment = $this->review->totalComment($id);
        $rate = $this->review->rateStar($id);

        return view('frontend.tour.detail', compact('data', 'total_comment', 'rate'));
    }
}
