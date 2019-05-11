@extends('adminlte::page')

@section('title', 'Edit '. $category->name )
@section('js')
    <script>
        $(function () {
            $('#keywords').tagator();

        })
    </script>
@stop

@section('content')
    @include('flash::message')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="box box-primary">
                    <div class="box-header with-border" >
                        <h1 class="box-title">{{__('lang.Categories')}}</h1>
                    </div>
                    <div class="box-header with-border">
                        <form action="{{route('categories.update',[$category->id])}}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="name">{{__('lang.Category')}}</label>
                                <input type="text" class="form-control" placeholder="Enter name of Title..." name="name" id="title" value="{{$category->name}}">
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('lang.parent_name')}}</label>
                                <input type="text" class="form-control" readonly="readonly" id="title" value="{{$category->parent['name']}}">
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('lang.Description')}}</label>
                                <textarea class="form-control summernote" placeholder="Description...."
                                          name="description" id="summernote">{!! $category->description  !!} </textarea>
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('lang.Meta_Description')}}</label>
                                <input type="text" class="form-control" placeholder="Enter meta_description"
                                       id="metades" name="meta_description"
                                       value="{!! $category->meta_description  !!} ">
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('lang.keywords')}}</label>
                                <input type="text" class="form-control" placeholder="Enter keywords"
                                       id="keywords" name="keywords" value="{{ $category->keywords}}">
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('lang.Slug')}}</label>
                                <input type="text" class="form-control" required="required" placeholder="Enter slug..."
                                       id="slug" name="slug" readonly="readonly" value="{{ $category->slug}}">
                            </div>
                            <div class="form-group">

                                <div class="radio">
                                    <label><b>{{__('lang.Status')}}</b> <br><input type="radio" name="status" checked value="true" {{ $category->status == 'true' ? 'checked' : '' }} >{{__('lang.Active')}}</label>

                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="status"  value="false" {{ $category->status == 'false' ? 'checked' : '' }} >{{__('lang.Inactive')}}</label>

                                </div>


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

