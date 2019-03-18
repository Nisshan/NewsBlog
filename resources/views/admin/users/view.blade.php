@extends('adminlte::page')
@section('title', 'View Role')

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
                        @foreach($user->roles as $role)
                        <tr>
                            <td>{{__('Assigned Role')}}</td>
                            <td>{{$role->name}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
