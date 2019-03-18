@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
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
                    <h1 class="box-title">{{__('Edit District')}}</h1>
                </div>
                <div class="box-body">
                    <form action="{{route('districts.update', [$district->id])}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="title">{{__('State ID')}}</label>
                            <input type="text" class="form-control" required="required" readonly="readonly"
                                   placeholder="Enter country name.." id="title" name="name" value="{{$district->state_id }}">
                        </div>

                        <div class="form-group">
                            <label for="title">{{__('District Name')}}</label>
                            <input type="text" class="form-control" required="required"
                                   placeholder="Enter country name.." id="title" name="name" value="{{$district->name }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="summernote" placeholder="Description..." class="form-control"
                                      name="description" >{{ $district->description }}</textarea>
                            <div class="form-group">
                                <label for="title">{{__('Meta Description')}}</label>
                                <input type="text" class="form-control" placeholder="Enter meta_description"
                                       id="metades" name="meta_description"
                                       value="{{ $district->meta_description}}">
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('keywords')}}</label>
                                <input type="text" class="form-control" placeholder="Enter keywords"
                                       id="keywords" name="keywords" value="{{ $district->keywords}}">
                            </div>
                            <div class="form-group">
                                <label for="title">{{__('Slug')}}</label>
                                <input type="text" class="form-control" required="required" placeholder="Enter slug..."
                                       id="slug" name="slug" readonly="readonly" value="{{ $district->slug}}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit!</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
