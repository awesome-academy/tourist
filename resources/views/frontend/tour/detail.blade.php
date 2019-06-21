@extends('frontend.layouts.master')

@section('title', __('label.tour') )

@section('content')
@if (count($errors) > 0)
<div class="alert alert-danger">
    @foreach ($errors->all() as $err)
    {{ $err }}<br>
    @endforeach
</div>
@endif
@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
<div class="container">
    <div class="tour_detail">
        <div class="row">
            <div class="col-xs-12 col-sm-9 col-md-9">
                <div class="row">
                    <div class="detail">
                        @foreach ($data as $item)
                        <div class="col-xs-12 col-sm-5 col-md-5">
                            <img src="{{ asset($item->media->link_url) }}" alt="">
                        </div>
                        <div class="col-xs-12 col-sm-7 col-md-7">
                            <div class="box_detail">
                                <h3>{{ $item->name }}</h3>
                                <div class="detail_con">
                                    <p><span class="date">{{ __('label.time') }}</span>{{ $item->typeTour->time }}</p>
                                    <p><span class="car">{{ __('label.vehicle') }}</span>{{ $item->vehicle }}</p>
                                    <p><span
                                            class="start">{{ __('label.starting_point') }}</span>{{ $item->starting_point }}
                                    </p>
                                    <p><span class="end">{{ __('label.destination') }}</span>{{ $item->destination }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <table class="table table-bordered table-customize table-responsive">
                                <thead>
                                    <tr>
                                        <th>{{ __('label.start_day') }}</th>
                                        <th>{{ __('label.tour_code') }}</th>
                                        <th>{{ __('label.total') }}</th>
                                        <th>{{ __('label.baby_price') }}</th>
                                        <th>{{ __('label.child_price') }}</th>
                                        <th>{{ __('label.adult_price') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> <span
                                                class="tb_date">{{ date('d/m/Y', strtotime($item->typeTour->start_day)) }}</span>
                                        </td>
                                        <td><span class="tb_date">{{ $item->typeTour->tour_code }}</span></td>
                                        <td><span class="tb_prie">{{ number_format($item->total, 0, '.', '.') }}</span>
                                        </td>
                                        <td><span
                                                class="tb_prie">{{ number_format($item->typeTour->baby_price, 0, '.', '.') }}</span>
                                        </td>
                                        <td><span
                                                class="tb_prie">{{ number_format($item->typeTour->child_price, 0, '.', '.') }}</span>
                                        </td>
                                        <td><span
                                                class="tb_prie">{{ number_format($item->typeTour->adult_price, 0, '.', '.') }}</span>
                                        </td>
                                        <td><a href="{{ route('book', $item->slug) }}"><span
                                                    class="tb_book">{{ __('Book tour') }}</span></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-xs-12">
                            <div class="title_detail">
                                <h3>{{ __('label.schedule_detail') }}</h3>
                            </div>
                            {!! $item->schedule !!}
                        </div>
                        <div class="col-sm-12">
                            <div class="tour-block-header">
                                <i class="fa fa-commenting" aria-hidden="true"></i> {{ __('label.frontend.customer_review') }}
                            </div>
                            <div class="tour-block-content">
                                <div class="review-total">
                                    <span class="review-star">
                                        @if ($rate >= 0 && $rate <= 1 )
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <p class="rate">{{ __('1/5 Đánh giá quá tệ') }}</p>
                                        @elseif ($rate >= 1  && $rate <= 2)
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <p class="rate">{{ __('2/5 Đánh giá tệ') }}</p>
                                        @elseif ($rate >= 2 && $rate <= 3)
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <p class="rate">{{ __('3/5 Đánh giá chấp nhận được') }}</p>
                                        @elseif ($rate >= 3 && $rate <= 4)
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <p class="rate">{{ __('4/5 Đánh giá tốt') }}</p>
                                        @elseif($rate >= 4 )
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <p class="rate">{{ __('5/5 Đánh giá tuyệt vời') }}</p>
                                        @endif
                                    </span>
                                    <span class="review-counter">({{ $total_comment }} khách hàng đã đánh giá)</span>
                                </div>
                            </div>
                            @if (Auth::check())
                            <form action="{{ route('comment', $item->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="tour_id" value="{{ $item->id }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <div class="form-group">
                                    <label for="usr">{{ __('label.frontend.name') }}</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="usr">{{ __('label.booktour.email') }}</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="comment">{{ __('label.frontend.comment') }}</label>
                                    <textarea class="form-control" rows="5" id="content" name="content"></textarea>
                                </div>
                                <div class="form-group required">
                                    <label for="usr">{{ __('label.frontend.star_rate') }}</label>
                                    <div class="lead evaluation">
                                        <span id="colorstar" class="starrr ratable">
                                        </span>
                                        <span id="meaning"></span>
                                        <input type="hidden" name="rating" id="count">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info"
                                        id="saveReview">{{ __('label.frontend.save_review') }}</button>
                                </div>
                            </form>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('assets/js/review.js') }}"></script>
@endpush
