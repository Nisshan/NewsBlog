@extends('adminlte::page')
@section('title', 'View '. $category->name )

@section('content_header')
    <h1>
        {{__('lang.Category_Details')}}
    </h1>
    <ol class="breadcrumb">
        <li>{{__('lang.Category_Details')}}</li>
    </ol>
@stop
@section('content')
    @include('flash::message')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header bg-blue">
                    <h3 class="box-title">{{$category->name}}</h3>
                </div>
                <div class="box-body">
                    <table class="table table-responsive table-striped">
                        <tr>
                            <td>{{__('lang.Name')}}</td>
                            <td>{{$category->name}}</td>
                        </tr>
                        <tr>
                            <td>{{__('lang.Description')}}</td>
                            <td>{!! $category->description !!}</td>
                        </tr>

                        <tr>
                            <td>{{__('lang.Slug')}}</td>
                            <td>{{$category->slug}}</td>
                        </tr>
                        <tr>
                            <td>{{__('lang.keywords')}}</td>
                            <td>{{$category->keywords}}</td>
                        </tr>
                        {{--<tr>--}}
                            {{--<td>{{__('user id')}}</td>--}}
                            {{--<td>{{$category->user_id}}</td>--}}
                        {{--</tr>--}}
                        <tr>
                            <td>{{__('lang.Status')}}</td>
                            <td>{{$category->status}}</td>
                        </tr>
                        <tr>
                            <td>{{__('lang.Meta_Description')}}</td>
                            <td>{!! $category->meta_description !!}</td>
                        </tr>
                        {{--<tr>--}}
                            {{--<td>{{__('Created at')}}</td>--}}
                            {{--<td>{{$category->created_at->toFormattedDateString()}}</td>--}}
                        {{--</tr>--}}

                    </table>
                </div>
            </div>
        </div>
    </div>
    @if(count($errors))
        <div class="form-group">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
@stop

