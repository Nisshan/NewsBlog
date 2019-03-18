@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@endsection
@section('content')
    @include('flash::message')
    <div class="container">
        <link rel="stylesheet" href="http://www.expertphp.in/css/bootstrap.css">
        <script src="http://demo.expertphp.in/js/jquery.js"></script>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <form action="{{ route('districts.store')}}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="country">Select Country</label><br>
                                <select id="country" name="country_id" class="form-control" style="width:350px">
                                    <option value="{{ old('country_id') }}" selected disabled>Select</option>
                                    @foreach($countries as $key => $country)
                                        <option value="{{$key}}"> {{$country}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="state">Select State</label><br>
                                <select name="state" id="state" class="form-control myselect" style="width:350px">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">District Name</label>
                                <input type="text" class="form-control" required="required" placeholder="Enter district name.." id="title" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="summernote" placeholder="Description..." class="form-control" name="description" >{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit!</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(count($errors))
        <div class="form-group">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <script type="text/javascript">
        $('#country').change(function(){
            var countryID = $(this).val();
            if(countryID){
                $.ajax({
                    type:"GET",
                    url:"{{url('get-state-list')}}?country_id="+countryID,
                    success:function(res){
                        if(res){
                            $("#state").empty();
                            $("#state").append('<option>Select</option>');
                            $.each(res,function(key,value){
                                $("#state").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#state").empty();
                        }
                    }
                });
            }else{
                $("#state").empty();
            }
        });
    </script>
@endsection


