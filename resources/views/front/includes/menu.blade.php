<!-- ##### Header Area Start ##### -->

<header class="header-area">

    <!-- Top Header Area -->
    <div class="top-header-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="top-header-content d-flex align-items-center justify-content-between">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="{{url('/home')}}"><img src="{{ asset('img/core-img/logo.png') }}" alt=""></a>
                        </div>

                        <!-- Login Search Area -->
                        <div class="login-search-area d-flex align-items-center">
                            <!-- Login -->
                            <div class="login d-flex">
                                <a href="#">Login</a>
                                <a href="#">Register</a>
                            </div>
                            <!-- Search Form -->
                            <div class="search-form">
                                <form action="#" method="post">
                                    <input type="search" name="search" class="form-control" placeholder="Search">
                                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar Area -->
    <div class="newspaper-main-menu" id="stickyMenu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="newspaperNav">

                    <!-- Logo -->
                    <div class="logo">
                        <a href="{{url('/home')}}"><img src="{{ asset('img/core-img/logo.png') }}" alt=""></a>
                    </div>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- close btn -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                <li class="active"><a href="{{url('/home')}}">Home</a></li>
                                <li class="cn-dropdown-item"><a href="#">Pages</a>
                                        <ul class="dropdown">
                                            <li><a href="{{url('/home')}}">Home</a></li>
                                            <li><a href="catagories-post.html">Catagories</a></li>
                                            <li><a href="single-post.html">Single Articles</a></li>
                                            <li><a href="about.html">About Us</a></li>
                                            <li><a href="contact.html">Contact</a></li>
                                            <li><a href="#">Dropdown</a>
                                                <ul class="dropdown">
                                                    <li><a href="{{url('/home')}}">Home</a></li>
                                                    <li><a href="catagories-post.html">Catagories</a></li>
                                                    <li><a href="single-post.html">Single Articles</a></li>
                                                    <li><a href="about.html">About Us</a></li>
                                                    <li><a href="contact.html">Contact</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                </li>
                                <li><a href="#">Mega Menu</a>
                                    <div class="megamenu" >
                                        <ul class="single-mega cn-col-4">
                                            <li class="title">
                                                <div class="form-group">
                                                    <label for="country">Select Country</label><br>
                                                    <select id="country" name="country_id" class="form-control" style="width:150px">
                                                        <option value="{{ old('country_id') }}" selected disabled>Select</option>
                                                        @foreach($countries as $key => $country)
                                                            <option value="{{$key}}"> {{$country}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="form-group" id="state">

                                        </div>
                                    </div>
                                </li>
                                @foreach($Categories as $category)
                                    <li>
                                        @if(($category->parent_id) == 0)
                                            <a href="{{ url('/category-news/'.$category->id) }}">{{ $category->name }}</a>
                                        @endif
                                        <ul class="dropdown">
                                            @foreach($Categories as $category1)
                                                <li>
                                                    @if(($category1->parent_id) == ($category->id))
                                                        <a href="{{ url('/category-news/'.$category1->id) }}">
                                                            {{$category1->name}}
                                                        </a>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                        </ul>
                        <!-- Nav End -->
                    </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<script type="text/javascript">

    $('#country').change(function(){

        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:"GET",
                url:"{{url('getStateList')}}?country_id="+countryID,
                success:function(res){
                    if(res){
                        $("#state").empty();
                        //$("#state").append('<option>Select</option>');
                        $.each(res,function(key,value){
                            $("#state").append('' +
                                '<ul class="single-mega cn-col-4">' +
                                '<li class="title" value="'+key+'">' +
                                '<a href="/state-news/'+key+'">'+value+'</a></li></ul>');
                                $.ajax({
                                    type:"GET",
                                    url:"{{url('getDistrictList')}}?state="+key,
                                    success:function(re){
                                        if(re){
                                            $.each(re,function(key,value){
                                                console.log(key);
                                                $("#state").append('' +
                                                    '<li value="'+key+'">' +
                                                    '<a href="/district-news/'+key+'">'+value+'</a></li>');
                                            });

                                        }else{
                                            $("#state").empty();
                                        }
                                    }
                                });
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
