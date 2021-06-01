
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>{{ config('app.name')}} | @yield('title', 'Admin')</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="favicon_16.ico"/>
    <link rel="bookmark" href="favicon_16.ico"/>
    <!-- site css -->
    <link rel="stylesheet" href="{{ asset('dist/css/site.min.css')}}">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('dist/js/site.min.js')}}"></script>


<script type="text/javascript">
    $(document).ready(function(){
        var input = $('input[name="img"]');
        readURL(input);
    });

</script>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah1')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
		input[type="checkbox"] {
		transform:scale(1.5, 1.5);
    }
    ul li {
  display: inline;
}


	</style>

  </head>
  <body>
    <!--nav-->
    <nav role="navigation" class="navbar navbar-custom">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header ">
          <button data-target="#bs-content-row-navbar-collapse-5" data-toggle="collapse" class="navbar-toggle" type="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <img src="#" alt="">
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div id="bs-content-row-navbar-collapse-5" class="collapse navbar-collapse  ">
            <ul class="nav navbar-nav navbar-left">
            <li class="active" ><a href="{{route('home')}}">Home</a></li>

            </ul>

          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    <!--header-->
    <div class="container-fluid">
    <!--documents-->
        <div class="row row-offcanvas row-offcanvas-left">
          <div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
            <ul class="list-group panel">
                <li class="list-group-item"><i class="glyphicon glyphicon-align-justify"></i> <b>SIDE PANEL</b></li>

                
                <li>
                  <a href="#demo4" class="list-group-item " data-toggle="collapse"><i class="fa fa-users"></i>Categories<span class="glyphicon glyphicon-chevron-right"></span></a>
                  <div class="collapse" id="demo4">
                    <a href="{{route('admin.categories.index')}}" class="list-group-item">All Categories</a>
                    <a href="{{route('admin.categories.create')}}" class="list-group-item "><i class="fa fa-plus"></i> Add category</a>
                  </div>

                </li>

                <li>
                  <a href="#demo6" class="list-group-item " data-toggle="collapse"><i class="fa fa-user"></i>Products<span class="glyphicon glyphicon-chevron-right"></span></a>
                  <div class="collapse" id="demo6">
                    <a href="{{route('admin.products.index')}}" class="list-group-item">All Products</a>
                    <a href="{{route('admin.products.create')}}" class="list-group-item "><i class="fa fa-plus"></i> Add Product</a>
                  </div>

                </li>
                
                <li>
                  <a href="#demo3" class="list-group-item " data-toggle="collapse"><i class="fa fa-sliders"></i> Coupons<span class="glyphicon glyphicon-chevron-right"></span></a>
                  <div class="collapse" id="demo3">
                    <a href="{{route('admin.coupons.index')}}" class="list-group-item">All Coupons</a>
                    <a href="{{route('admin.coupons.create')}}" class="list-group-item "><i class="fa fa-plus"></i> Add coupon</a>
                  </div>

                </li>

                

              </ul>
          </div>
          <div class="col-xs-12 col-sm-9 content">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><a href="javascript:void(0);" class="toggle-sidebar"><span class="fa fa-angle-double-left" data-toggle="offcanvas" title="Maximize Panel"></span></a> Panel Title</h3>
              </div>
              
              @yield('content')
            </div>
            
        </div><!-- content -->
      </div>
    </div>


  </body>



</html>
