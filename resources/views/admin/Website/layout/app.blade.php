<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">


    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}" >

    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/student.css') }}" >


</head>

<body class="">

    @if (session()->get('success'))
    <div class="text-success">{{ session()->get('success') }}</div>
    @endif

    @if (session()->get('error'))
    <div class="text-danger">{{ session()->get('error') }}</div>
    @endif

    @include('admin.Website.layout.top_bar')

    @include('admin.Website.layout.sidebar')

    @yield('main_content')

    @include('admin.Website.layout.scripts')

</body>

</html>