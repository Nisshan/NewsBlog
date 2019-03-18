@extends('adminlte::page')
@section('title', 'View Gallery')

@section('content_header')
    <h1>
        {{__('Gallery')}}

    </h1>
    <ol class="breadcrumb">
        <li class="active">{{__('Gallery Detail')}}</li>
    </ol>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header bg-blue">
                    <h3 class="box-title">{{$gallery->title}}</h3>
                </div>
                <div class="box-body">
                    <table class="table table-responsive table-striped">
                        <tr>
                            <td>{{__('title')}}</td>
                            <td>{{$gallery->title}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Description')}}</td>
                            <td>{!! $gallery->description !!}</td>
                        </tr>
                        <tr>
                            <td>{{__('slug')}}</td>
                            <td>{{$gallery->slug}}</td>
                        </tr>
                        <tr>
                            <td>{{__('keywords')}}</td>
                            <td>{{$gallery->keywords}}</td>
                        </tr>
                        <tr>
                            <td>{{__('meta_description')}}</td>
                            <td>{!! $gallery->meta_description !!}</td>
                        </tr>
                        <tr>
                            <td>{{__('Gallery cover')}}</td>
                            <td>
                                @if (strlen($gallery->cover)>5)

                                    <img src="{{url($gallery->cover)}}" class="img-thumbnail" width="100px"
                                         height="100px">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{__('Gallery images')}}</td>
                            <td>
                                @if ((strlen($images)>5))
                                    @foreach($gallery->images as $image)
                                        <img src="{{$image->url}}" class="img" style="height: 100px; width: 60px; ">
                                    @endforeach
                                @endif
                            </td>
                        </tr>


                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
