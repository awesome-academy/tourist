@extends('backend.layouts.master')

@section('title', __('label.news'))

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

<div class="col-xs-12 col-sm-9 content">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span
                                class="fa fa-angle-double-left" data-toggle="offcanvas"
                                title="{{ __('Maximize Panel') }}"></span></a>{{ __('label.add') }}</h3>
                </div>
            </div>
        </div>
        <form action="{{ route('news.store') }}" enctype="multipart/form-data" method="POST">
            {{ csrf_field() }}
            <div class="panel-body">
                <div class="content-row">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class=" col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">{{ __('label.name') }}</label>
                                        <div class="col-md-6">
                                            <input type="text" placeholder="{{ __('label.enter_title') }}" id="name"
                                                class="form-control" name="name">
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">{{ __('label.parent_cate') }}</label>
                                        <div class="col-md-3">
                                            <select name="cate_id" class="selecter_1">
                                                <option value="">{{ __('label.choose_parent') }}</option>}
                                                @foreach ($data_cate as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">{{ __('label.status') }}</label>
                                        <div class="col-md-3">
                                            <select name="status" class="selecter_1">
                                                <option value="">{{ __('label.choose_status') }}</option>
                                                <option value="1">{{ __('label.status_open') }}</option>
                                                <option value="0">{{ __('label.status_close') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">{{ __('label.desciption') }}</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control"
                                                placeholder="{{ __('label.enter_description') }}" rows="5" cols="30"
                                                id="description" name="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">{{ __('label.content') }}</label>
                                        <div class="col-md-12">
                                            <textarea class="form-control" rows="10" cols="30" id="editor1"
                                                name="content" placeholder="{{ __('label.enter_content') }}"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-1 control-label">{{ __('label.image') }}</label>
                                        <div class="col-md-4">
                                            <div class="thumbnail">
                                                <img class="img-rounded" id="preview"
                                                    src="{{ asset(config('app.image_url') . 'no-image.png') }}"
                                                    class="image">
                                                <div class="caption text-center">
                                                    <div class="form-group">
                                                        <input type="file" id="image" name="image"
                                                            onchange="encodeImageFileAsURL(this)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="submit" value="{{ __('label.save') }}" name="save"
                                            class="btn btn-success">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- panel body -->
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('assets/js/index.js') }}"></script>
@endpush
