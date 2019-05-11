
@extends('layouts.app')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('lang.Categories')}}</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>{{__('lang.ID')}}</th>
                                <th>{{__('lang.Title')}}</th>
                                <th>{{__('lang.Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($news as $newss)
                                <tr>
                                    <td>{{$newss->id}}</td>
                                    <td>{{$newss->title}}</td>
                                    <td> <a href="{{route('newsview',[$newss->slug])}}">show</a> </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$news->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
