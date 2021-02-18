<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Insta Class - @yield('title')</title>

  @include('layouts.head')
  @yield('css')
</head>

<body>

  <div id="sidebar" class="sidebar">
    <div id="trigger" class="trigger">
      <i class="fa fa-bars"></i>
    </div>
    
    <div class="sidebar-position">
      <i class="fa fa-plus"></i>
      <a href="{{url('create-class')}}">Create Class</a>
    </div>
    <div class="sidebar-position">
      <i class="fa fa-book"></i>
      <a href="{{url('my-class/lecturer')}}">My Classes</a>
    </div>
    <div class="sidebar-position">
      <i class="fa fa-user"></i>
      <a href="{{url('myprofile') }}">My Profile</a>
    </div> 
    <div class="sidebar-position">
      <i class="fa fa-sign-out"></i>
      <form method="POST" action="{{ route('logout') }}" style="margin: 0px;">
        @csrf
        <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                        this.closest('form').submit();">
            {{ __('Logout') }}
        </a>
      </form>
    </div> 
  </div>

  <!-- Content -->
  @yield('content')

  @include('layouts.foot')
  @yield('js')
</body>

</html>