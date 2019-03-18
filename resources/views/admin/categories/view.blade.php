@extends('adminlte::page')
@section('title', 'View Category')

@section('content_header')
    <h1>
        {{__('Category Details')}}
    </h1>
    <ol class="breadcrumb">
        <li class="active">{{__('Category Details')}}</li>
    </ol>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header bg-blue">
                    <h3 class="box-title">{{$category->name}}</h3>
                </div>
                <div class="box-body">
                    <table class="table table-responsive table-striped">
                        <tr>
                            <td>{{__('name')}}</td>
                            <td>{{$category->name}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Description')}}</td>
                            <td>{!! $category->description !!}</td>
                        </tr>

                        <tr>
                            <td>{{__('slug')}}</td>
                            <td>{{$category->slug}}</td>
                        </tr>
                        <tr>
                            <td>{{__('keywords')}}</td>
                            <td>{{$category->keywords}}</td>
                        </tr>
                        <tr>
                            <td>{{__('user id')}}</td>
                            <td>{{$category->user_id}}</td>
                        </tr>
                        <tr>
                            <td>{{__('status')}}</td>
                            <td>{{$category->status}}</td>
                        </tr>
                        <tr>
                            <td>{{__('meta_description')}}</td>
                            <td>{!! $category->meta_description !!}</td>
                        </tr>
                        <tr>
                            <td>{{__('Created at')}}</td>
                            <td>{{$category->created_at->toFormattedDateString()}}</td>
                        </tr>

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
