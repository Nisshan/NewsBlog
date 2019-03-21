@extends('adminlte::page')
@section('title', 'Edit '. $role->name )

@section('content')
    @include('flash::message')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">{{__('lang.Edit_Roles')}}</h1>
                    </div>
                    <div class="box-header with-border">
                        <form action="{{ route('roles.update',[$role->id])}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="title">{{__('lang.Edit_Role_Name')}}</label>
                                <input type="text" class="form-control" required="required"
                                       placeholder="Enter Role.."
                                       id="role" name="name" value="{{$role->name}}">
                            </div>
                            <div class="form-group">
                                @foreach($permissions as $permission)
                                    <input type="checkbox" name="permission[] " id="permission-{{$permission->id}}"
                                           value="{{$permission->id}}" {{$role->permissions->contains($permission->id)? 'checked="checked"':''}}>
                                    <label for="permission-{{$permission->id}}">{{$permission->name}}</label><br>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">{{__('lang.Submit')}}</button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
