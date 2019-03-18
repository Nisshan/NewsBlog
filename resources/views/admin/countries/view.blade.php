@extends('adminlte::page')
@section('title', 'View country')

@section('content_header')
    <h1>
        {{__('Country')}}
        <small>{{__('View Country Detail')}}</small>
    </h1>
    <ol class="breadcrumb">
        <li class="active">{{__('View Country Detail')}}</li>
    </ol>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header bg-blue">
                    <h3 class="box-title">{{$country->name}}</h3>
                </div>
                <div class="box-body">
                    <table class="table table-responsive table-striped">
                        <tr>
                            <td>{{__('name')}}</td>
                            <td>{{$country->name}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Description')}}</td>
                            <td>{!! $country->description !!}</td>
                        </tr>
                        <tr>
                            <td>{{__('slug')}}</td>
                            <td>{{$country->slug}}</td>
                        </tr>
                        <tr>
                            <td>{{__('keywords')}}</td>
                            <td>{{$country->keywords}}</td>
                        </tr>
                        <tr>
                            <td>{{__('meta_description')}}</td>
                            <td>{!! $country->meta_description !!}</td>
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
