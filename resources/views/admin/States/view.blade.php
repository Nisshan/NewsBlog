@extends('adminlte::page')
@section('title', 'View State')

@section('content_header')
    <h1>
        {{__('State Details')}}
    </h1>
    <ol class="breadcrumb">
        <li class="active">{{__('State Details')}}</li>
    </ol>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header bg-blue">
                    <h3 class="box-title">{{$state->name}}</h3>
                </div>
                <div class="box-body">
                    <table class="table table-responsive table-striped">
                        <tr>
                            <td>{{__('State-Name')}}</td>
                            <td>{{$state->name}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Country name')}}</td>
                            <td>{{$state->country->name}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Description')}}</td>
                            <td>{{$state->description}}</td>
                        </tr>
                        <tr>
                            <td>{{__('slug')}}</td>
                            <td>{{$state->slug}}</td>
                        </tr>
                        <tr>
                            <td>{{__('keywords')}}</td>
                            <td>{{$state->keywords}}</td>
                        </tr>
                        <tr>
                            <td>{{__('user id')}}</td>
                            <td>{{$state->user_id}}</td>
                        </tr>
                        <tr>
                            <td>{{__('meta_description')}}</td>
                            <td>{{$state->meta_description}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Created at')}}</td>
                            <td>{{$state->created_at->toFormattedDateString()}}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
