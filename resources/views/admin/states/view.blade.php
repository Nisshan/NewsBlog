@extends('adminlte::page')
@section('title', $state->name. ' view')

@section('content_header')
    <h1>
        {{__('lang.State_Details')}}
    </h1>
    <ol class="breadcrumb">
        <li >{{__('lang.State_Details')}}</li>
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
                            <td>{{__('lang.State_Name')}}</td>
                            <td>{{$state->name}}</td>
                        </tr>
                        <tr>
                            <td>{{__('lang.Country_Name')}}</td>
                            <td>{{$state->country->name}}</td>
                        </tr>
                        <tr>
                            <td>{{__('lang.Description')}}</td>
                            <td>{{$state->description}}</td>
                        </tr>
                        <tr>
                            <td>{{__('lang.Slug')}}</td>
                            <td>{{$state->slug}}</td>
                        </tr>
                        <tr>
                            <td>{{__('lang.keywords')}}</td>
                            <td>{{$state->keywords}}</td>
                        </tr>
                        <tr>
                            <td>{{__('lang.Meta_Description')}}</td>
                            <td>{{$state->meta_description}}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
