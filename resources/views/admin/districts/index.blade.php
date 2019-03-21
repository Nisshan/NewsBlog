@extends('adminlte::page')

@section('title', 'Districts')

@section('content_header')

@stop

@section('content')
    @include('flash::message')
    
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h1 class="box-title">{{__('lang.Districts')}}</h1>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead>
                            <tr>
                            <tr>
                                <th>{{__('lang.ID')}}</th>
                                <th>{{__('lang.Name')}}</th>
                                <th>{{__('lang.Action')}}</th>

                            </tr>
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
                ajax: '{{ url('dataset/getDistrict') }}',
                columns: [
                    { data: 'id', name: 'ID' },
                    { data: 'name', name: 'Name' },
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
