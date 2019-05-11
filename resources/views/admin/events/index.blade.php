@extends('adminlte::page')

@section('title', 'Event List')

@section('content_header')

@stop

@section('content')
    @include('flash::message')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h1 class="box-title">{{__('lang.Events')}}</h1>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                            <tr>
                                <th>{{__('lang.ID')}}</th>
                                <th>{{__('lang.name')}}</th>
                                <th>{{__('lang.Action')}}</th>
                            </tr>
                            </thead>
                            {{--<tbody id="sortable" >--}}
                            {{--@foreach($events as $event)--}}
                                {{--<tr class="row1" data-id="{{ $event->id }}">--}}
                                    {{--<td>{{$event->id}}</td>--}}
                                    {{--<td>{{$event->name}}</td>--}}

                                    {{--<td>--}}
                                        {{--<div class="btn-group">--}}
                                            {{--<button type="button" class="btn btn-info">Action</button>--}}
                                            {{--<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">--}}
                                                {{--<span class="caret"></span>--}}
                                                {{--<span class="sr-only">Toggle Dropdown</span>--}}
                                            {{--</button>--}}
                                            {{--<ul class="dropdown-menu" role="menu">--}}
                                                {{--<li ><button class="btn btn-sm btn-primary"><a  href="{{route('events.edit',[$event->id])}}">Edit</a></button></li>--}}
                                                {{--<li ><button class="btn btn-sm btn-primary"><a  href="{{route('events.show',[$event->id])}}">view</a></button></li>--}}
                                                {{--<li class="divider"></li>--}}
                                                {{--<li><form action="{{route('events.destroy', [$event->id])}}" method="post">--}}
                                                        {{--@csrf--}}
                                                        {{--@method('DELETE')--}}
                                                        {{--<button type="submit" class="btn btn-sm btn-danger">Delete</button>--}}
                                                    {{--</form>--}}
                                                {{--</li>--}}

                                            {{--</ul>--}}
                                        {{--</div>--}}


                                    {{--</td>--}}

                                {{--</tr>--}}
                            {{--@endforeach--}}

                            {{--</tbody>--}}
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url('dataset/getEvents') }}',
                columns: [
                    { data: 'id', name: 'ID' },
                    { data: 'name', name: 'Name ' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            // Delete country
            $('#table').on('click', '.delete', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = $(this).attr("href");
                // confirm then
                if (confirm('Are you sure you want to delete this?')) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: false,
                        data: {'_method': 'DELETE', 'submit': true}
                    }).always(function (data) {
                        window.location.reload();
                    });
                }else
                    alert("You have cancelled!");
            });
        });
    </script>
@stop

