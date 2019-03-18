@extends('adminlte::page')

@section('title', 'AdminLTE')
@section('js')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
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
                        <h1 class="box-title">{{__('Create Country Details')}}</h1>
                    </div>
                    <div class="box-header with-border">
                        <form action="{{ route('countries.store')}}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="title">{{__('Country Name')}}</label>
                                <input type="text" class="form-control" required="required" placeholder="Enter country name.." id="title" name="name"  >
                            </div>
                            <div class="form-group">
                                <label for="description">{{__('Description')}}</label>
                                <textarea id="summernote" placeholder="Description..." class="form-control" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit!</button>
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


