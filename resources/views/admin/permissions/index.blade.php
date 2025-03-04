@extends('adminlte::page')

@section('title', 'Countries')

@section('content_header')

@stop

@section('content')
    @include('flash::message')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h1 class="box-title">Countries</h1>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                <td>{{$permission->id}}</td>
                                <td>{{$permission->name}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

