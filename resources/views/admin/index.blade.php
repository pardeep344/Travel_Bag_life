<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <div class="admin-div">
    <!-- Sidebar -->
    <div class="slide-bar">
        <ul class="">
            <li class="dropdown list-prop">
        <a href="#">Header Section</a>
        <ul class="dropdown-menu">
            <li class="child-list"><a href="{{ route('admin.announcebar') }}" class="anchor-tag">Announcebar</a></li>
            <li class="child-list"><a href="{{ route('admin.navbar') }}" class="anchor-tag">Navbar</a></li>
            <li class="child-list"><a href="{{ route('admin.banner') }}" class="anchor-tag">Banner</a></li>
        </ul>
                </li>
            <li class="list-prop"><a href="{{ route('admin.slider.index') }}">Slider</a></li>
            <li class="list-prop"><a href="{{ route('admin.countryshowcase') }}">Country Cards</a></li>
            <li class="list-prop"><a href="{{ route('admin.blog') }}">Blog Cards</a></li>
            <li class="list-prop"><a href="{{ route('admin.hotel') }}">Add Destination</a></li>
            <li class="list-prop"><a href="{{ route('admin.aboutus') }}">About Us</a></li>
            <li class="list-prop"><a href="{{ route('admin.partner.index') }}">Company Partner</a></li>
            <li class="list-prop"><a href="{{ route('admin.secSlider.index') }}">Second Slider</a></li>

             
            <li class="dropdown list-prop">
                <a href="#">Footer Section</a>
                <ul class="dropdown-menu">
                    <li class="child-list"><a href="{{ route('admin.footerEditable.index') }}">Footer Edit</a></li>
                    <li class="child-list"><a href="{{ route('admin.socialLink.index') }}">Social Link</a></li>
                    <li class="child-list"><a href="{{ route('admin.footerLinks.index') }}">Footer Links</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <!-- Content Area -->
    <div class="content-area">
        @yield('content')
    </div>
  </div>
</body>
</html>
