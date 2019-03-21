@extends('adminlte::page')
@section('title', $country->name.  ' view' )

@section('content_header')
    <h1>

        {{__('lang.View_Country_Detail')}}
    </h1>
    <ol class="breadcrumb">
        <li ><b>{{__('lang.View_Country_Detail')}}</b></li>
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
                            <td>{{__('lang.Name')}}</td>
                            <td>{{$country->name}}</td>
                        </tr>
                        <tr>
                            <td>{{__('lang.Description')}}</td>
                            <td>{!! $country->description !!}</td>
                        </tr>
                        <tr>
                            <td>{{__('lang.Slug')}}</td>
                            <td>{{$country->slug}}</td>
                        </tr>
                        <tr>
                            <td>{{__('lang.keywords')}}</td>
                            <td>{{$country->keywords}}</td>
                        </tr>
                        <tr>
                            <td>{{__('lang.Meta_Description')}}</td>
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
