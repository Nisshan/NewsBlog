@extends('adminlte::page')
@section('title', 'View Role')
@section('css')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@stop


@section('content_header')
    <h1>
        {{__('Role Details')}}
    </h1>
    <ol class="breadcrumb">
        <li class="active">{{__('Role Details')}}</li>
    </ol>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header bg-blue">
                    <h3 class="box-title">{{$user->name}}</h3>
                </div>
                <div class="box-body">
                    <table class="table table-responsive table-striped">
                        <tr>
                            <td>{{__('ID')}}</td>
                            <td>{{$user->id}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Name')}}</td>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Email')}}</td>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Created at')}}</td>
                            <td>{{$user->created_at->toFormattedDateString()}}</td>
                        </tr>
                    </table>

                    <div><p>{{__('Roles Assigned : ')}}</p>
                    @foreach($user->roles as $role)

                            {{--<td>{{__('Assigned Role')}}</td>--}}
                            <p><span class="w3-tag w3-blue">{{$role->name}}</span></p>
                            {{--<td>{{$role->name}}</td>--}}

                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
