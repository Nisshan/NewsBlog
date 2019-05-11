@extends('adminlte::page')

@section('title', 'Create State')


@section('content')
    @include('flash::message')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">{{__('lang.Create_State_Details')}}</h1>
                    </div>
                    <div class="box-header with-border">
                        <form action="{{ route('states.store')}}"
                              method="POST">
                            @csrf

                            <div class="form-group" id="formid">
                                <label for="country">{{__('lang.Country_Name')}}</label>
                                <select name="country_id" id="country" class="form-control myselect">
                                    <option selected hidden >Select</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('lang.State_Name')}}</label>
                                <input type="text" class="form-control" required="required"
                                       placeholder="Enter state name.." id="name" name="name"
                                >
                            </div>
                            <div class="form-group">
                                <label for="summernote">{{__('lang.Description')}}</label>
                                <textarea id="summernote" placeholder="Description..." class="form-control"
                                          name="description"></textarea>
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


