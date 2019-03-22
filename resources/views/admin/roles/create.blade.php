@extends('adminlte::page')
@section('title', 'Create roles')
@section('content')
@include('flash::message')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h1 class="box-title">{{__('lang.Create_Roles')}}</h1>
                </div>
                <div class="box-header with-border">
                    <form action="{{ route('roles.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            {{--<div class="form-group">--}}
                            {{--<label for="Email">{{__('Select Email')}}</label>--}}
                            {{--<select name="users_id" id="users" class="form-control ">--}}
                            {{--@foreach($users as $user)--}}
                            {{--<option value="{{$user->id}}">{{$user->email}}--}}
                            {{--</option>--}}
                            {{--@endforeach--}}
                            {{--</select>--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <label for="title">{{__('lang.Create_Role_Name')}}</label>
                                <input type="text" class="form-control" required="required" placeholder="Enter Role.."
                                       id="role" name="name">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">{{__('lang.Submit')}}</button>
                            </div>
                        </div>

                    </form>
                </div>
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
@endsection
