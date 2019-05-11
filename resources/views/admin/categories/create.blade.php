@extends('adminlte::page')

@section('title', 'Create Categories')


@section('content')
    @include('flash::message')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border" >
                        <h1 class="box-title">{{__('lang.Categories')}}</h1>
                    </div>
                    <div class="box-header with-border">
                        <form action="{{route('categories.store')}}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="name">{{__('lang.Category')}}</label>
                                <input type="text" class="form-control" placeholder="Enter name of Title..." name="name" id="title" value="{{old('name')}}">
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('lang.Sub-Category')}}</label>
                                <select id="country" name="parent_id" class="form-control" style="width:350px">
                                    <option value="0">Select</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('lang.Description')}}</label>
                                <textarea class="form-control summernote" placeholder="Description...."
                                          name="description" id="summernote">{{old('description')}}</textarea>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-success" type="submit">{{__('lang.Submit')}}</button>
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

