@extends('adminlte::page')

@section('title', 'Create Gallery' )

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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <form action="{{route('galleries.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{__('lang.Title')}}</label>
                                <input type="text" class="form-control" placeholder="Enter name of Title..."
                                       name="title" id="title">
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('lang.Description')}}</label>
                                <textarea class="form-control summernote" placeholder="Description...."
                                          name="description" id="description"></textarea>
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
                                           name="images">
                                </div>

                                <div id="holder"></div>
                            </div>
                            <div class="form-group">
                                <label for="lfm1">{{__('lang.Select_Cover')}}</label>
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                                       <i class="fa fa-picture-o"></i> {{__('lang.Choose_Cover_Image')}}
                                    </a>
                                </span>
                                    <input id="thumbnail1" class="form-control" type="text" name="cover"
                                           readonly="readonly">
                                </div>
                                <div id="holder1"></div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">{{__('lang.Submit')}}</button>
                            </div>

                        </form>
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


