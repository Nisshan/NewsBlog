@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('js')
    <script src="{{asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
    <script>
        $(function () {
            $('#lfm').filemanager('image');
            $('#lfm1').filemanager('image');
        })
    </script>
@stop
@section('content_header')

@endsection
@section('content')
    @include('flash::message')
    <div class="container">
        <link rel="stylesheet" href="http://www.expertphp.in/css/bootstrap.css">
        <script src="http://demo.expertphp.in/js/jquery.js"></script>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <form action="{{route('galleries.update', [$gallery->id])}}" method="POST">
                            @csrf
                            @if(isset($gallery))
                                @method('PATCH')
                            @endif
                            <div class="form-group">
                                <label for="name">Title*</label>
                                <input type="text" class="form-control" placeholder="Enter name of Title..."
                                       name="title" id="title" value="{{$gallery->title}}">
                            </div>
                            <div class="form-group">
                                <label for="title">Description</label>
                                <textarea class="form-control summernote" placeholder="Description...."
                                          name="description" id="description">{{$gallery->description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="lfm">Select images</label>
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                       <i class="fa fa-picture-o"></i> Choose
                                    </a>
                                </span>
                                    <input id="thumbnail" readonly="readonly" class="form-control" type="text"
                                           name="images" value="{{$images}}">
                                </div>
                                <div id="image_preview" class="row">
                                    @if ((strlen($images)>5))
                                        @foreach($gallery->images as $image)
                                            <img src="{{$image->url}}" class="img" style="height: 100px; width: 60px; ">
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="title">{{__('Meta Description')}}</label>
                                    <input type="text" class="form-control" placeholder="Enter meta_description"
                                           id="metades" name="meta_description"
                                           value="{{ $gallery->meta_description}}">
                                </div>
                                <div class="form-group">
                                    <label for="title">{{__('keywords')}}</label>
                                    <input type="text" class="form-control" placeholder="Enter keywords"
                                           id="keywords" name="keywords" value="{{$gallery->keywords}}">
                                </div>
                                <div class="form-group">
                                    <label for="title">{{__('Slug')}}</label>
                                    <input type="text" class="form-control" required="required" placeholder="Enter slug..."
                                           id="slug" name="slug" readonly="readonly" value="{{ $gallery->slug}}">
                                </div>

                                <div class="form-group">
                                    <label for="lfm1">Select Cover</label>
                                    <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                                       <i class="fa fa-picture-o"></i> Choose Cover Image
                                    </a>
                                </span>
                                        <input id="thumbnail1" readonly="readonly" class="form-control" type="text"
                                               name="cover" value="{{$gallery->cover}}">
                                    </div>
                                    <div id="cover_preview">

                                        @if ((strlen($gallery->cover)>5))

                                            <img src="{{$gallery->cover}}" class="img img-responsive"
                                                 style="height: 60px; width: 40px;"/>
                                        @endif
                                    </div>


                                    <button type="submit" class="btn btn-success">Submit!</button>
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


