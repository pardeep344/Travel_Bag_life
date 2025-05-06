<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="{{ asset('js/slider.js') }}"></script>
    <script src="{{ asset('js/banner.js') }}" ></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
@include('layout.header.index')  
@include('layout.banner.index')
@include('layout.slider.index')
@include('layout.gallary.index')
@include('layout.blog.index')
@include('layout.servicepage.index')
@include('layout.about.index')
@include('layout.footer.index')
</body>
</html>