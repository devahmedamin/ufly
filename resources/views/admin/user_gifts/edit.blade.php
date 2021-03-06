@extends('admin.layout.app')
@section('title')
    @lang('common.edit') @lang('common.user_gift')
@endsection
@section('css')
@endsection
@section('styles')
@endsection
@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-md-12">
                        <h2>@lang('common.user_gifts')</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('/admin')}}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/user_gifts')}}">@lang('common.user_gifts')</a></li>
                            <li class="breadcrumb-item active">@lang('common.edit') @lang('common.user_gift')</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>@lang('common.edit') @lang('common.user_gift')</h2>
                        </div>
                        <div class="body">
                            <form action="{{url(app()->getLocale()."/admin/user_gifts/$user_gift->id")}}" id="basic-form" method="post"
                                  data-reset="false" class="ajax_form form-horizontal" enctype="multipart/form-data" novalidate>
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <br>
                                <div class="form-body offset-2">
                                    <div class="form-group row">
                                        <label for="gift_id" class="col-md-3 col-form-label">
                                            @lang('common.gift')
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <select name="gift_id" id="gift_id">
                                                <option selected value="">@lang('common.select')</option>
                                                @foreach($gifts as $gift)
                                                    <option value="{{$gift->id}}"
                                                        {{$user_gift->gift_id == $gift->id ? 'selected' : ''}}>
                                                        {{$gift->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="user_id" class="col-md-3 col-form-label">@lang('common.user')
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <select class="user_id form-control" id="user_id" name="user_id"
                                                    required>
                                                <option value="{{$user_gift->user_id}}"
                                                        selected>{{@$user_gift->user_name}}</option>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>

                                    <button type="submit" class="submit_btn btn btn-primary">
                                        <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                                        @lang('common.save')
                                    </button>
                                    <a href="{{url('/admin/user_gifts')}}" id="cancel_btn" class="btn btn-secondary">
                                        @lang('common.cancel')
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('js')

@endsection
@section('scripts')
    <script>

        $(document).ready(function () {
            $('#user_id').select2({
                dir: '{{LaravelLocalization::getCurrentLocaleDirection()}}',
                placeholder: "@lang('common.select')",
                minimumInputLength: 3,
                ajax: {
                    url: '{{url('admin/get_user')}}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: $.trim(params.term),
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true,
                }
            });
        });


    </script>

@endsection
