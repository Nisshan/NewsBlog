@extends('adminlte::page')
@section('title', 'View ' . $roles->name)
@section('css')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
@stop

@section('content_header')
    <h1>
        {{__('lang.Role_Details')}}
    </h1>
    <ol class="breadcrumb">
        <li class="active">{{__('lang.Role_Details')}}</li>
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
                        {{--<tr>--}}
                            {{--<td>{{__('lang.ID')}}</td>--}}
                            {{--<td>{{$roles->id}}</td>--}}
                        {{--</tr>--}}
                        <tr>
                            <td>{{__('lang.Name')}}</td>
                            <td>{{$roles->name}}</td>
                        </tr>

                        {{--<tr>--}}
                            {{--<td>{{__('Created at')}}</td>--}}
                            {{--<td>{{$roles->created_at->toFormattedDateString()}}</td>--}}
                        {{--</tr>--}}




                    </table>
                    <hr>

                    <div><p>{{__('lang.Permission_Assigned')}}</p>
                    @foreach ($roles->permissions as $permission)

                            <p><span class="w3-tag w3-blue" >{{$permission->name}}</span></p>
                            {{--<td>Permission</td>--}}
                            {{--<td> {{$permission->name}}</td>--}}
                    @endforeach
                    </div>


                </div>
            </div>
        </div>
    </div>
@stop
