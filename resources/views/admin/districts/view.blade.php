@extends('adminlte::page')
@section('title', $district->name . ' view')

@section('content_header')
    <h1>
        {{__('lang.District_Details')}}
    </h1>
    <ol class="breadcrumb">
        <li >{{__('lang.District_Details')}}</li>
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
                            <td>{{__('lang.Name')}}</td>
                            <td>{{$district->name}}</td>
                        </tr>
                        <tr>
                            <td>{{__('lang.Description')}}</td>
                            <td>{!! $district->description !!}</td>
                        </tr>
                        <tr>
                            <td>{{__('lang.State_Name')}}</td>
                            <td>{{$district->states->state_id}}</td>
                        </tr>
                        <tr>
                            <td>{{__('lang.Slug')}}</td>
                            <td>{{$district->slug}}</td>
                        </tr>
                        <tr>
                            <td>{{__('lang.keywords')}}</td>
                            <td>{{$district->keywords}}</td>
                        </tr>
                        {{--<tr>--}}
                            {{--<td>{{__('user id')}}</td>--}}
                            {{--<td>{{$district->user_id}}</td>--}}
                        {{--</tr>--}}
                        <tr>
                            <td>{{__('lang.Meta_Description')}}</td>
                            <td>{!! $district->meta_description !!}</td>
                        </tr>
                        {{--<tr>--}}
                            {{--<td>{{__('Created at')}}</td>--}}
                            {{--<td>{{$district->created_at->toFormattedDateString()}}</td>--}}
                        {{--</tr>--}}

                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
