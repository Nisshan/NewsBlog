@extends('adminlte::page')
@section('title', 'View District')

@section('content_header')
    <h1>
        {{__('District Details')}}
    </h1>
    <ol class="breadcrumb">
        <li class="active">{{__('District Details')}}</li>
    </ol>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header bg-blue">
                    <h3 class="box-title">{{$district->name}}</h3>
                </div>
                <div class="box-body">
                    <table class="table table-responsive table-striped">
                        <tr>
                            <td>{{__('name')}}</td>
                            <td>{{$district->name}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Description')}}</td>
                            <td>{!! $district->description !!}</td>
                        </tr>
                        <tr>
                            <td>{{__('State id')}}</td>
                            <td>{{$district->state_id}}</td>
                        </tr>
                        <tr>
                            <td>{{__('slug')}}</td>
                            <td>{{$district->slug}}</td>
                        </tr>
                        <tr>
                            <td>{{__('keywords')}}</td>
                            <td>{{$district->keywords}}</td>
                        </tr>
                        <tr>
                            <td>{{__('user id')}}</td>
                            <td>{{$district->user_id}}</td>
                        </tr>
                        <tr>
                            <td>{{__('meta_description')}}</td>
                            <td>{!! $district->meta_description !!}</td>
                        </tr>
                        <tr>
                            <td>{{__('Created at')}}</td>
                            <td>{{$district->created_at->toFormattedDateString()}}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
