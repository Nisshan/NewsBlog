@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@endsection
@section('content')
    @include('flash::message')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <form action="{{ route('posts.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Title*</label>
                                <input type="text" class="form-control" placeholder="Enter name of Title..." name="title" id="title">
                            </div>

                            <div class = "form-group">
                                <label for = "title">Description</label>
                                <textarea class="form-control " placeholder="Description...." name="description" id="summernote"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="country">Select Country</label><br>
                                <select id="country" name="country_id" class="form-control" style="width:350px" >
                                    <option value="{{ old('country_id') }}" selected disabled hidden>Select</option>
                                    @foreach($countries as $key => $country)
                                        <option value= "{{$key}}"> {{$country}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" id="stateDiv" style="display: none">
                                <label for="state" >Select State</label><br>
                                <select id="state" name = "state" class="form-control " style = "width:350px;" >
                                </select>
                            </div>

                            <div class="form-group" style="display: none" id="districtDiv">
                                <label for="myselect">{{__('Select District')}}</label><br>
                                <select id="district" name="district_id[]" class="form control myselect" style="width:500px;" multiple >
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="category">{{__('Categories')}}</label><br>
                                <select id="category" name="category_id[]" class="form control myselect" style="width:500px;" multiple>
                                    @foreach($categories as $key => $category)
                                        <option value = "{{$key}}"> {{$category}}</option>
                                    @endforeach
                                </select>
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

        function stateFunction() {// show state on state

        }
        function districtFunction() {

        }

        $('#country').change(function(){
            var x = document.getElementById("stateDiv");
            x.style.display = "block";
            var countryID = $(this).val();
            if(countryID){
                $.ajax({
                    type:"GET",
                    url:"{{url('getStateList')}}?country_id="+countryID,
                    success:function(res){
                        if(res){
                            $("#state").empty();
                            $("#state").append('<option  selected disabled hidden>Select</option>');
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

        $('#state').change(function(){
            var x = document.getElementById("districtDiv");
            x.style.display = "block";
            var countryID = $(this).val();
            if(countryID){
                $.ajax({
                    type:"GET",
                    url:"{{url('getDistrictList')}}?state="+countryID,
                    success:function(res){
                        if(res){
                            $("#district").empty();
                            $("#district").append('<option disabled>Select</option>');
                            $.each(res,function(key,value){
                                $("#district").append('<option value="'+key+'">'+value+'</option>');
                            });

                        }else{
                            $("#district").empty();
                        }
                    }
                });
            }else{
                $("#district").empty();
            }
        });
    </script>
@endsection


