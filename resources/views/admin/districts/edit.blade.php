@extends('adminlte::page')

@section('title', 'edit '.$district->name )

@section('content_header')

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h1 class="box-title">{{__('lang.Edit_District')}}</h1>
                </div>
                <div class="box-body">
                    <form action="{{route('districts.update', [$district->id])}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="title">{{__('lang.State_Name')}}</label>
                            <input type="text" class="form-control" required="required" readonly="readonly"
                                   placeholder="Enter country name.." id="title" name="name" value="{{$district->states->name }}">
                        </div>

                        <div class="form-group">
                            <label for="title">{{__('lang.District_Name')}}</label>
                            <input type="text" class="form-control" required="required"
                                   placeholder="Enter country name.." id="title" name="name" value="{{$district->name }}">
                        </div>
                        <div class="form-group">
                            <label for="description">{{__('lang.Description')}}</label>
                            <textarea id="summernote" placeholder="Description..." class="form-control"
                                      name="description" >{{ $district->description }}</textarea>
                            <div class="form-group">
                                <label for="title">{{__('lang.Meta_Description')}}</label>
                                <input type="text" class="form-control" placeholder="Enter meta_description"
                                       id="metades" name="meta_description"
                                       value="{{ $district->meta_description}}">
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('lang.keywords')}}</label>
                                <input type="text" class="form-control" placeholder="Enter keywords"
                                       id="keywords" name="keywords" value="{{ $district->keywords}}">
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('lang.Slug')}}</label>
                                <input type="text" class="form-control" required="required" placeholder="Enter slug..."
                                       id="slug" name="slug" readonly="readonly" value="{{ $district->slug}}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">{{__('Submit')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
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
