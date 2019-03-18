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
                    <h3 class="box-title">{{$roles->name}}</h3>
                </div>
                <div class="box-body">
                    <table class="table table-responsive table-striped">
                        <tr>
                            <td>{{__('ID')}}</td>
                            <td>{{$roles->id}}</td>
                        </tr>
                        <tr>
                            <td>{{__('name')}}</td>
                            <td>{{$roles->name}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Created at')}}</td>
                            <td>{{$roles->created_at->toFormattedDateString()}}</td>
                        </tr>

                        @foreach ($roles->permissions as $permission)
                            <tr>


                                    <td>Permission</td>
                                    <td> {{$permission->name}}</td>

                            </tr>
                        @endforeach


                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
