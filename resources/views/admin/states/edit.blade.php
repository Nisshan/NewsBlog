@extends('adminlte::page')

@section('title', $state->name. ' Edit')
@section('js')
    <script>
        $(document).ready(function () {
            $('#summernote').summernote();
            $('#keywords').tagator();

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
                        <h1 class="box-title">{{__('lang.Edit_state_Details')}}</h1>
                    </div>
                    <div class="box-header with-border">
                        <form action="{{route('states.update', [$state->id])}}" method="POST">
                            @csrf

                                @method('PATCH')


                            <div class="form-group">
                                <label for="title">{{__('lang.Country_Name')}}</label>
                                <select name="country_id" id="title" class="form-control myselect" >
                                    <option selected >{{$state->country->name}}</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="statename">{{__('lang.State_Name')}}</label>
                                <input type="text" class="form-control" required="required"
                                       placeholder="Enter state name.." id="statename" name="name"
                                       value="{{ $state->name}}">
                            </div>
                            <div class="form-group">
                                <label for="description"> {{__('lang.Description')}}</label>
                                <textarea id="summernote" placeholder="Description..." class="form-control"
                                          name="description">{{ $state->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="metades">{{__('lang.Meta_Description')}}</label>
                                <input type="text" class="form-control" placeholder="Enter meta_description"
                                       id="metades" name="meta_description"
                                       value="{{$state->meta_description}}">
                            </div>
                            <div class="form-group">
                                <label for="keywords">{{__('lang.keywords')}}</label>
                                <input type="text" class="form-control" placeholder="Enter keywords"
                                       id="keywords" name="keywords" value="{{$state->keywords}}">
                            </div>
                            <div class="form-group">
                                <label for="slug">{{__('lang.Slug')}}</label>
                                <input type="text" class="form-control" required="required" placeholder="Enter slug..."
                                       id="slug" name="slug" readonly="readonly" value="{{$state->slug}}">
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


