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
                        <form action="{{route('galleries.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Title*</label>
                                <input type="text" class="form-control" placeholder="Enter name of Title..."
                                       name="title" id="title">
                            </div>
                            <div class="form-group">
                                <label for="title">Description</label>
                                <textarea class="form-control summernote" placeholder="Description...."
                                          name="description" id="description"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="lfm">Select images</label>
                                <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                       <i class="fa fa-picture-o"></i> Choose Images
                                    </a>
                                </span>
                                    <input id="thumbnail" readonly="readonly" class="form-control" type="text"
                                           name="images">
                                </div>
                                <div id="holder"></div>
                                <div class="form-group">
                                    <label for="lfm1">Select Cover</label>
                                    <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary">
                                       <i class="fa fa-picture-o"></i> Choose Cover Image
                                    </a>
                                </span>
                                        <input id="thumbnail1" class="form-control" type="text" name="cover">
                                    </div>
                                    <div id="holder1"></div>


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


