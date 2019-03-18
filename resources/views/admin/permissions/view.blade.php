@extends('adminlte::page')

@section('content')
    @include('flash::message')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">{{__('Create Permission')}}</h1>
                    </div>
                    <div class="box-header with-border">
                        <form action="{{ route('')}}" method="POST">
                            @csrf

                            <div class="form-group">

                            </div>
                            <div class="form-group">
                                <label for="Email">{{__('Select Email')}}</label>
                                <select name="country_id" id="country" class="form-control myselect">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->email}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="form-group col-md-4">
                                    <input type="checkbox" name="create country" class="child" value="create country">Create
                                    Country<br>
                                    <input type="checkbox" name="view country" class="child" value="view country">View Country<br>
                                    <input type="checkbox" name="edit country" class="child" value="edit country">Edit Country<br>
                                    <input type="checkbox" name="delete country" class="child" value="delete country">Delete
                                    Country<br>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="checkbox" name="create state" class="child" value="create state">Create State<br>
                                    <input type="checkbox" name="view state" value="view state">View State<br>
                                    <input type="checkbox" name="edit state" value="edit state">Edit State<br>
                                    <input type="checkbox" name="delete state" value="delete state">Delete State<br>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="checkbox" name="create district" value="create district">Create District<br>
                                    <input type="checkbox" name="view district" value="view district">View District<br>
                                    <input type="checkbox" name="edit district" value="edit district">Edit District<br>
                                    <input type="checkbox" name="delete district" value="delete district">Delete District<br>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="checkbox" name="create post" value="create post">Create Post<br>
                                    <input type="checkbox" name="view post" value="view post">View Post<br>
                                    <input type="checkbox" name="edit post" value="edit post">Edit Post<br>
                                    <input type="checkbox" name="delete post" value="delete post">Delete Post<br>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="checkbox" name="create gallery" value="create gallery">Create Gallery<br>
                                    <input type="checkbox" name="view gallery" value="view gallery">View Gallery<br>
                                    <input type="checkbox" name="edit gallery" value="edit gallery">Edit Gallery<br>
                                    <input type="checkbox" name="delete gallery" value="delete gallery">Delete Gallery<br>
                                </div>
                            </div>




                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-success">Submit!</button>
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

