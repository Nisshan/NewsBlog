@extends('layouts.app')
<table class="table table-striped">
    <thead>
    <tr>
        <th>Title</th>
        <td>{{$news->title}}</td>
    </tr>
    <tr>
        <th>Description</th>
        <td>{{$news->description}}</td>
    </tr>
    <tr>
        <th>Images</th>
        <td>{{$news->image}}</td>
    </tr>
    <tr>
        <td>{{__('lang.cover')}}</td>
        <td>

                <img src="{{url($news->cover)}}" class="img-thumbnail" width="100px"
                     height="100px">

        </td>
    </tr>

    </thead>

</table>

