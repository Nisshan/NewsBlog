<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <!-- Title -->
        <title>The News Paper - News &amp; Lifestyle Magazine Template</title>

        <!-- Favicon -->
        <link href="{{ asset('img/core-img/favicon.ico') }}" rel="icon">

        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
        </script>
        <!-- Core Stylesheet -->
        <link href="{{ asset('style.css') }}" rel="stylesheet" type="text/css" >
        <!--   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">-->
            <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
       </head>

       <body class="home">
       <!--Preloader area Start here
       <div class="preloader " >
           <div class="sk-cube-grid">
               <div class="sk-cube sk-cube1"></div>
               <div class="sk-cube sk-cube2"></div>
               <div class="sk-cube sk-cube3"></div>
               <div class="sk-cube sk-cube4"></div>
               <div class="sk-cube sk-cube5"></div>
               <div class="sk-cube sk-cube6"></div>
               <div class="sk-cube sk-cube7"></div>
               <div class="sk-cube sk-cube8"></div>
               <div class="sk-cube sk-cube9"></div>
           </div>
       </div>
       -->
    <!--Preloader area end here-->

    <!--Header area start here-->
    <header>
        @include('front.includes.menu')
    </header>
    <!--Header area end here-->
    <!-- Slider Section Start Here -->
    @yield('content')
    <!-- All News Section end Here -->
    <!-- Footer Area Section Start Here -->

    <footer>
    @include('front.includes.footer')
    <!-- Footer Copyright Area End Here -->
    </footer>

    <!-- Start scrollUp  -->
    <div id="return-to-top">
        <span>Top</span>
    </div>
    <!-- End scrollUp  -->

    <!-- Footer Area Section End Here -->

    <!-- all js here -->
    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Files ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="{{ asset('js/jquery/jquery-2.2.4.min.js') }}" type="text/javascript"></script>

    <!-- Popper js -->
    <script src="{{ asset('js/bootstrap/popper.min.js') }}" type="text/javascript"></script>

    <!-- Bootstrap js -->
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}" type="text/javascript"></script>

    <!-- All Plugins js -->
    <script src="{{ asset('js/plugins/plugins.js') }}" type="text/javascript"></script>

    <!-- Active js -->
    <script src="{{ asset('js/active.js') }}" type="text/javascript"></script>

    </body>


<!-- Mirrored from rstheme.com/products/news24/news-magazine/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 19 Oct 2017 20:11:47 GMT -->
</html>
