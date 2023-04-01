<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') </title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    @livewireStyles
    

</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    @include('layouts/include/preloader')
    <!-- Pre-loader end -->

    @yield('content')
    <!-- Warning Section Starts -->
    
    {{-- Flash Message --}}
    @include('layouts/include/flash')
    {{-- ./Flash Message --}}

    <!-- Required Jquery -->
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bs4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/common-pages.js') }}"></script>
    
    <!-- Custom Scripts -->
    @livewireScripts
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

</body>

</html>
