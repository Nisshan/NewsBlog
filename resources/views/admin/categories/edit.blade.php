@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="box box-primary">
                    <div class="box-header with-border" >
                        <h1 class="box-title">{{__('Categories')}}</h1>
                    </div>
                    <div class="box-header with-border">
                        <form action="{{route('categories.update',[$category->id])}}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="name">{{__('Category')}}</label>
                                <input type="text" class="form-control" placeholder="Enter name of Title..." name="name" id="title" value="{{$category->name}}">
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('parent_id')}}</label>
                                <input type="text" class="form-control" readonly="readonly" id="title" value="{{$category->parent_id}}">
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('Meta Description')}}</label>
                                <input type="text" class="form-control" placeholder="Enter meta_description"
                                       id="metades" name="meta_description"
                                       value="{!! $category->meta_description  !!} ">
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('keywords')}}</label>
                                <input type="text" class="form-control" placeholder="Enter keywords"
                                       id="keywords" name="keywords" value="{{ $category->keywords}}">
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('Slug')}}</label>
                                <input type="text" class="form-control" required="required" placeholder="Enter slug..."
                                       id="slug" name="slug" readonly="readonly" value="{{ $category->slug}}">
                            </div>

                            <div class="form-group">
                                <label for="title">{{__('Description')}}</label>
                                <textarea class="form-control summernote" placeholder="Description...."
                                          name="description" id="summernote">{!! $category->description  !!} </textarea>
                            </div>
                            <div class="form-group">

                                <div class="radio">
                                    <label><b>Status</b> <br><input type="radio" name="status" checked value="true" {{ $category->status == 'true' ? 'checked' : '' }} >active</label>

                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="status"  value="false" {{ $category->status == 'false' ? 'checked' : '' }} >inactive</label>

                                </div>


                            </div>


                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Submit</button>
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

