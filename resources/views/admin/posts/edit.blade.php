@extends('adminlte::page')

@section('title', 'Edit ' . $post->title)
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
                        <form action="{{route('posts.update',[$post->id])}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="name">{{__('lang.Title')}}</label>
                                <input type="text" class="form-control" placeholder="Enter name of Title..."
                                       name="title"
                                       id="title" value="{{$post->title}}">
                            </div>
                            <div class="form-group">
                                <label for="description">{{__('lang.Description')}}</label>
                                <textarea id="summernote" placeholder="Description..." class="form-control"
                                          name="description">{{$post->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('lang.Meta_Description')}}</label>
                                <input type="text" class="form-control" placeholder="Enter meta_description"
                                       id="metades" name="meta_description"
                                       value="{{ $post->meta_description  }}">
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('lang.keywords')}}</label>
                                <input type="text" class="form-control" placeholder="Enter keywords"
                                       id="keywords" name="keywords" value="{{ $post->keywords}}">
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('lang.Slug')}}</label>
                                <input type="text" class="form-control" required="required" placeholder="Enter slug..."
                                       id="slug" name="slug" readonly="readonly" value="{{ $post->slug}}">
                            </div>


                            <div class="form-group">
                                <div class="radio">
                                    <label><b>{{__('lang.Status')}}</b> <br><input type="radio" name="status"  value="0" {{ $post->status == '0' ? 'checked' : '' }}>{{__('lang.Breaking')}}</label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="status" value="1" {{ $post->status == '1' ? 'checked' : '' }}>{{__('lang.Active')}}</label>
                                </div>
                                <div class="form-group">
                                    <label ><input type="radio" name="status"  value ='2' {{ $post->status == '2' ? 'checked' : '' }}>{{__('lang.Inactive')}}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lfm">{{__('lang.Select_images')}}</label>
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                       <i class="fa fa-picture-o"></i> {{__('lang.Choose_Images')}}
                                    </a>
                                </span>
                                    <input id="thumbnail" readonly="readonly" class="form-control" type="text"
                                           name="images" value="{{$images}}">
                                </div>
                                <div id="holder">
                                    @if ((strlen($post)>5))
                                        @foreach($post->images as $image)
                                            <img src="{{$image->image}}" class="img" style="height: 100px; width: 60px; ">
                                        @endforeach
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="lfm1">{{__('lang.Select_Cover')}}</label>
                                    <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                                       <i class="fa fa-picture-o"></i>{{__('lang.Choose_Cover_Image')}}
                                    </a>
                                </span>
                                        <input id="thumbnail1" class="form-control" type="text" name="cover" value="{{$post->cover}}" readonly="readonly">
                                    </div>
                                    <div id="holder1">
                                        @if ((strlen($post->cover)>5))

                                            <img src="{{$post->cover}}" class="img img-responsive"
                                                 style="height: 60px; width: 40px;"/>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">{{__('lang.Submit')}}</button>
                                    </div>
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


