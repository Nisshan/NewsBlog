@extends('adminlte::page')

@section('title', 'Create Event')
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
            $('#datepicker').datepicker({
                autoclose: true
            })
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
                        <h1 class="box-title">{{__('lang.Events_Details')}}</h1>
                    </div>
                    <div class="box-header with-border">
                        <form action="{{ route('events.store')}}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="title">{{__('lang.Event_Name')}}</label>
                                <input type="text" class="form-control" required="required" placeholder="Enter Event name.." id="title" name="name"  value=" {{old('name')}}" >
                            </div>
                            <div class="form-group">
                                <label for="summernote">{{__('lang.Description')}}</label>
                                <textarea id="summernote" placeholder="Description..." class="form-control" name="description"  required="required" >{{old('description')}}</textarea>

                            </div>

                            <div class="form-group">
                                <label>Date:</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker" name="date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Posts">{{__('lang.Posts')}}</label><br>
                                <select id="Posts" name="post_id[]" class="form control myselect"
                                        style="width:500px;" multiple>
                                    @foreach($posts as $post)
                                        <option value="{{$post->id}}">{{$post->title}}
                                        </option>
                                    @endforeach
                                </select>
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
