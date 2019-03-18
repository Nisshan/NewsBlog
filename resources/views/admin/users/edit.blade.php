@extends('adminlte::page')

@section('content')
    @include('flash::message')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">{{__('Edit User Roles')}}</h1>
                    </div>
                    <div class="box-header with-border">
                        <form action="{{ route('users.update',[$user->id])}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="title">{{__(' Edit User Name')}}</label>
                                <input type="text" class="form-control" required="required"
                                       id="role" name="name" value="{{$user->name}}">
                            </div>
                            <div class="form-group">
                                <label for="title">{{__(' Edit Users Email ')}}</label>
                                <input type="text" class="form-control" required="required" readonly="readonly"
                                       id="role" name="email" value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                                @foreach($roles as $role)
                                    <input type="checkbox" name="role[]"
                                           value="{{$role->id}}"}} {{ $user->roles->contains($role->id) ? 'checked="checked"':'' }}>
                                    <label>{{$role->name}}</label><br>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">{{__('Submit!')}}</button>
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
