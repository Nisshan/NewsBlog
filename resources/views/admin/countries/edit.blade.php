@extends('adminlte::page')

@section('title', 'AdminLTE')
@section('js')
    <script>
        $(document).ready(function () {
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
                        <h1 class="box-title">{{__(' Edit Country Details')}}</h1>
                    </div>
                    <div class="box-header with-border">
                        <form action="{{route('countries.update', [$country->id])}}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="title">{{__('Country Name')}}</label>
                                <input type="text" class="form-control" required="required"
                                       placeholder="Enter country name.." id="title" name="name"
                                       value="{{$country->name}}">
                            </div>
                            <div class="form-group">
                                <label for="description"> {{__('Description')}}</label>
                                <textarea id="summernote" placeholder="Description..." class="form-control"
                                          name="description">{{ $country->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('Meta Description')}}</label>
                                <input type="text" class="form-control" placeholder="Enter meta_description"
                                       id="metades" name="meta_description"
                                       value="{{ $country->meta_description}}">
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('keywords')}}</label>
                                <input type="text" class="form-control" placeholder="Enter keywords"
                                       id="keywords" name="keywords" value="{{ $country->keywords}}">
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('Slug')}}</label>
                                <input type="text" class="form-control" required="required" placeholder="Enter slug..."
                                       id="slug" name="slug" readonly="readonly" value="{{ $country->slug}}">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">{{__('Submit')}}</button>
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


