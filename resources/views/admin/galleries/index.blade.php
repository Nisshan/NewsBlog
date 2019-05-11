w@extends('adminlte::page')

@section('title', 'Galleries')

@section('content_header')

@stop

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h1 class="box-title">Posts</h1>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                            <tr>
                                <th>{{__('lang.ID')}}</th>
                                <th>{{__('lang.Name')}}</th>
                                <th>{{__('lang.cover')}}</th>
                                <th>{{__('lang.Action')}}</th>
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
                ajax: '{{ url('dataset/getGallery') }}',
                columns: [
                    { data: 'id', name: 'ID' },
                    { data: 'title', name: 'Title' },
                    {
                        data: 'cover', "render": function (data) {
                            return '<img src="' + data + '" class="img img-responsive img-circle " />';
                        }, orderable: false, searchable: false
                    },

                    {data: 'action', name: 'action', orderable: false, searchable: false}
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
                        dataType: 'json',
                        data: {'_method': 'DELETE', 'submit': true}
                    }).always(function (data) {
                        // window.location.reload();
                        window.console.log();
                    });
                }else
                    alert("You have cancelled!");
            });

        });
    </script>
@stop
