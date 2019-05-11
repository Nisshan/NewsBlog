@extends('adminlte::page')
@section('title', 'View ' . $post->title)

@section('content_header')
    <h1>
        {{__('Post Details')}}
    </h1>
    <ol class="breadcrumb">
        <li class="active">{{__('Post Details')}}</li>
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
                            <td>{{__('lang.Name')}}</td>
                            <td>{{$post->title}}</td>
                        </tr>
                        <tr>
                            <td>{{__('lang.Description')}}</td>
                            <td>{!! $post->description !!}</td>
                        </tr>

                        <tr>
                            <td>{{__('lang.Slug')}}</td>
                            <td>{{$post->slug}}</td>
                        </tr>
                        <tr>
                            <td>{{__('lang.keywords')}}</td>
                            <td>{{$post->keywords}}</td>
                        </tr>

                        <tr>
                            <td>{{__('lang.Status')}}</td>
                            <td>{{$post->status}}</td>
                        </tr>
                        <tr>
                            <td>{{__('lang.cover')}}</td>
                            <td>@if (strlen($post->cover)>5)

                                    <img src="{{url($post->cover)}}" class="img-thumbnail" width="100px"
                                         height="100px">
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{__('lang.Gallery_images')}}</td>
                            <td>
                                @if ((strlen($images)>5))
                                    @foreach($post->images as $image)
                                        <img src="{{url($image->image)}}" class="img" style="height: 100px; width: 60px; ">
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>{{__('lang.Meta_Description')}}</td>
                            <td>{!! $post->meta_description !!}</td>
                        </tr>

                        {{--<tr>--}}
                            {{--<td>{{__('Created at')}}</td>--}}
                            {{--<td>{{$post->created_at->toFormattedDateString()}}</td>--}}
                        {{--</tr>--}}

                    </table>
                    <hr>
                    <div><p>{{__('lang.Category_tagged')}}</p>
                        @foreach($post->category as $category)

                            {{--<td>{{__('Assigned Role')}}</td>--}}
                            <p><span class="w3-tag w3-blue">{{$category->name}}</span></p>
                            {{--<td>{{$role->name}}</td>--}}

                        @endforeach
                    </div>
                    <br>

                    <div><p>{{__('lang.District_tagged')}}</p>
                        @foreach($post->districts as $district)

                            {{--<td>{{__('Assigned Role')}}</td>--}}
                            <p><span class="w3-tag w3-blue">{{$district->name}}</span></p>
                            {{--<td>{{$role->name}}</td>--}}

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
