@extends('adminlte::page')

@section('title', 'Categories List')

@section('content_header')

@stop

@section('content')
    @include('flash::message')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h1 class="box-title">{{__('lang.Categories')}}</h1>
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
                            <tbody id="sortable">
                            @foreach($categories as $category)
                                <tr class="row1" data-id="{{ $category->id }}">
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>

                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info">Action</button>
                                            <button type="button" class="btn btn-info dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    <button class="btn btn-sm btn-primary"><a
                                                            href="{{route('categories.edit',[$category->id])}}">Edit</a>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="btn btn-sm btn-primary"><a
                                                            href="{{route('categories.show',[$category->id])}}">view</a>
                                                    </button>
                                                </li>
                                                <li class="divider"></li>
                                                <li>
                                                    <form action="{{route('categories.destroy', [$category->id])}}"
                                                          method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete
                                                        </button>
                                                    </form>
                                                </li>

                                            </ul>
                                        </div>


                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
    <script>

        $(function () {
            {{--$("#table").DataTable({--}}
                {{--processing: true,--}}
                {{--serverSide: true,--}}
                {{--ajax: '{{ url('dataset/getCategory') }}',--}}
                {{--columns: [--}}
                    {{--{data: 'id', name: 'ID',orderable: false, searchable: false},--}}
                    {{--{data: 'name', name: 'Name',orderable: false, searchable: false},--}}
                    {{--{data: 'action', name: 'action', orderable: false, searchable: false}--}}
                {{--]--}}
            {{--});--}}
// this is to sort using the position in the table index ui-method
            $("#sortable").sortable({
                items: "tr",
                opacity: 0.6,
                cursor: 'move',
                update: function () {
                    sendOrdertoServer();
                }
            });
            var position = [];

            function sendOrdertoServer() {
                // position = [];
                $('tr.row1').each(function (index, element) {
                    position.push({
                        id: $(this).attr('data-id'),
                        order: index + 1
                    });
                });
                console.log(position)
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('orderupdate') }}",
                    data: {
                        position: position,
                        _token: '{{csrf_token()}}'
                    },
                    success: function (response) {
                        if (response.status == 200) {
                            console.log(response);
                        } else {
                            console.log(response);
                        }
                    }
                });

            }


        });

        // $('#table').on('click', '.delete', function (e) {
        //     e.preventDefault();
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     var url = $(this).attr("href");
        //     // confirm then
        //     if (confirm('Are you sure you want to delete this?')) {
        //         $.ajax({
        //             url: url,
        //             type: 'DELETE',
        //             dataType: false,
        //             data: {'_method': 'DELETE', 'submit': true}
        //         }).always(function (data) {
        //             window.location.reload();
        //         });
        //     } else
        //         alert("You have cancelled!");
        // });


    </script>


@stop


