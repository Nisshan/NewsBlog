@extends('adminlte::page')

@section('title', 'Edit ' .$page->name)
@section('js')
    <script src="{{asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
            $('#lfm').filemanager('image');
        });
    </script>
@stop

@section('content')
    @include('flash::message')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h1 class="box-title">{{__('Create Page Details')}}</h1>
                    </div>
                    <div class="box-header with-border">
                        <form action="{{route('pages.update',[$page->id])}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="name">{{__('lang.Category')}}</label>
                                <select id="country" name="parent_id" class="form-control" style="width:350px">
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                {{--<input type="text" value="{{$category->name}}" readonly class="form-control">--}}
                            </div>

                            <div class="form-group">
                                <label for="title">{{__('Page Name')}}</label>
                                <input type="text" class="form-control" required="required" placeholder="Enter country name.." id="title" name="name"  value=" {{$page->name}}" >
                            </div>
                            <div class="form-group">
                                <label for="summernote">{{__('lang.Description')}}</label>
                                <textarea id="summernote" placeholder="Description..." class="form-control"  name="description"  required="required">{{$page->description}}</textarea>

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
                                    @if ((strlen($images)>5))
                                        @foreach($photo->photo as $image)
                                            <img src="{{$image->url}}" class="img" style="height: 100px; width: 60px; ">
                                        @endforeach
                                    @endif
                                </div>
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


