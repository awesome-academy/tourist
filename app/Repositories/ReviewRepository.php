<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Models\Tour;
use App\Models\Review;
use App\Models\User;

class ReviewRepository extends EloquentRepository
{
    public function model()
    {
        return \App\Models\Review::class;
    }

    public function listReview()
    {
        $reviews = Review::with('tour', 'user')->orderBy('name', 'ASC')->get();

        return $reviews;
    }

    public function findReview($id)
    {
        $data = Tour::with('tour', 'review')->find($id);
        if (empty($data)) {
            return false;
        } else {
            return $data;
        }
    }

    public function totalComment($id)
    {
        $data = Review::with('tour', 'user')->where('tour_id', $id)->count();
        if (empty($data)) {
            return false;
        } else {
            return $data;
        }
    }

    public function rateStar($id)
    {
        $data_rate = Review::with('tour', 'user')->where('tour_id', $id)->sum('star');
        $rate = $data_rate/5;

        if (empty($rate)) {
            return false;
        } else {
            return $rate;
        }
    }
}
