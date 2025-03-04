@extends('adminlte::page')

@section('title', 'States')

@section('content_header')
    
@stop

@section('content')
    @include('flash::message')
   
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">

                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Country ID</th>
                                <th>Created at</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
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
                ajax: '{{ url('dataset/getState') }}',
                columns: [
                    { data: 'id', name: 'ID' },
                    { data: 'name', name: 'Title' },
                    {data: 'country_id', name: 'Country ID'},
                    {data: 'created_at', name: 'created At'},
                    {data: 'action', name: 'Action', orderable: false, searchable: false}
                ]
            });
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
