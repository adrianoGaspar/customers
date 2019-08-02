<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" id="bootstrap-css">

    <!------ Include the above in your HEAD tag ---------->
    <style>
        body{background:#f3f3f3;}
        #wrapper{padding:90px 15px;}
        .navbar-expand-lg .navbar-nav.side-nav{flex-direction: column;}
        .card{margin-bottom: 15px; border-radius:0; box-shadow: 0 3px 5px rgba(0,0,0,.1); }
        .header-top{box-shadow: 0 3px 5px rgba(0,0,0,.1)}
        .leftmenutrigger, .navbar-nav li a .shortmenu{display: none}
        .card-title{ font-size: 28px}
        @media(min-width:992px) {
            .leftmenutrigger{display: block;display: block;margin: 7px 20px 4px 0;cursor: pointer;}
            #wrapper{padding: 90px 15px 15px 75px; }
            #wrapper.open{padding: 90px 15px 15px 225px; }
            .navbar-nav.side-nav.open {left:0;}
            .side-nav li a {padding: 20px}
            .navbar-nav li a .shortmenu {float: right;display: block;opacity: 1}
            .navbar-nav.side-nav.open.navbar-nav li a .shortmenu {opacity: 0}
            .navbar-nav.side-nav{background: #585f66;box-shadow: 2px 1px 2px rgba(0,0,0,.1);position:fixed;top:56px;flex-direction: column!important;left:-140px;width:200px;bottom:0;padding-bottom:40px}
        }
        .animate{-webkit-transition:all .2s ease-in-out;-moz-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;-ms-transition:all .2s ease-in-out;transition:all .2s ease-in-out}
        .navbar-nav li a svg{font-size: 25px;float: left;margin: 0 10px 0 5px;}
        .side-nav li { border-bottom: 1px solid #50575d;}
        .side-nav .dropdown {position:initial;}
        .side-nav .dropdown-menu {position:relative;opacity:0;left:120%;top:0;height:100%;border:0;padding:0;margin:0;border-radius:0;box-shadow:5px 0 5px rgba(0,0,0,.1);background:#eee;visibility: hidden;display:block;transition: .4s ease all;}
        .side-nav .dropdown-menu.show {left:100%;opacity:1;visibility: visible;display:block;transition: .4s ease all;}
    </style>

    @yield('head')

</head>
<div id="wrapper" class="animate">
    <nav class="navbar header-top fixed-top navbar-expand-lg navbar-dark bg-dark">
        <span class="navbar-toggler-icon leftmenutrigger"></span>
        <a class="navbar-brand" href="#">LOGO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav animate side-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/" title="Cart"><i class="fas fa-user"></i> Clientes <i class="fas fa-user shortmenu animate"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-md-auto d-md-flex">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-user"></i> Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-key"></i> Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid">

        <!-- ============================================================== -->
        <!-- conteúdo -->
        <!-- ============================================================== -->
        @yield('content')
        <!-- ============================================================== -->
        <!-- fim conteúdo -->
        <!-- ============================================================== -->

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<script>
    $(document).ready(function () {
        $('.leftmenutrigger').on('click', function (e) {
            $('.side-nav').toggleClass("open");
            $('#wrapper').toggleClass("open");
            e.preventDefault();
        });
    });
</script>

@yield('script')

</html>
