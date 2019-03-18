@extends('adminlte::page')
@section('title', 'View State')

@section('content_header')
    <h1>
        {{__('State Details')}}
    </h1>
    <ol class="breadcrumb">
        <li class="active">{{__('State Details')}}</li>
    </ol>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header bg-blue">
                    <h3 class="box-title">{{$post->title}}</h3>
                </div>
                <div class="box-body">
                    <table class="table table-responsive table-striped">
                        <tr>
                            <td>{{__('name')}}</td>
                            <td>{{$post->title}}</td>
                        </tr>
                        <tr>
                            <td>{{__('Description')}}</td>
                            <td>{!! $post->description !!}</td>
                        </tr>

                        <tr>
                            <td>{{__('slug')}}</td>
                            <td>{{$post->slug}}</td>
                        </tr>
                        <tr>
                            <td>{{__('keywords')}}</td>
                            <td>{{$post->keywords}}</td>
                        </tr>
                        <tr>
                            <td>{{__('user id')}}</td>
                            <td>{{$post->user_id}}</td>
                        </tr>
                        <tr>
                            <td>{{__('status')}}</td>
                            <td>{{$post->status}}</td>
                        </tr>
                        <tr>
                            <td>{{__('cover')}}</td>
                            <td>@if (strlen($post->cover)>5)

                                    <img src="{{url($post->cover)}}" class="img-thumbnail" width="100px"
                                         height="100px">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{__('Gallery images')}}</td>
                            <td>
                                @if ((strlen($images)>5))
                                    @foreach($post->images as $image)
                                        <img src="{{$image->image}}" class="img" style="height: 100px; width: 60px; ">
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{__('meta_description')}}</td>
                            <td>{!! $post->meta_description !!}</td>
                        </tr>
                        <tr>
                            <td>{{__('Created at')}}</td>
                            <td>{{$post->created_at->toFormattedDateString()}}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
