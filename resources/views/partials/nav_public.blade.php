<nav class="navbar navbar-default navbar-fixed-side">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{url('/')}}">
                <img alt="logo" src="/theme/logo.png">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{route('posts')}}">Posts</a></li>
                <li><a href="{{route('events')}}">Events</a></li>
                <li><a href="{{route('venues')}}">Venues</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest

                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            Welcome {{Auth::user()->name}} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a href="{{route('admin')}}"><i class="fa fa-home" aria-hidden="true"></i> Admin Home</a></li>
                            <li><a href="{{route('admin.tag.index')}}"><i class="fa fa-tags" aria-hidden="true"></i> Tags</a></li>
                            <li><a href="{{route('admin.venue.index')}}"><i class="fa fa-building-o" aria-hidden="true"></i> Venues</a></li>
                            <li><a href="{{route('admin.event.index')}}"><i class="fa fa-calendar" aria-hidden="true"></i> Events</a></li>
                            <li><a href="{{route('admin.post.index')}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Posts</a></li>
                            <li>
                                <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>

                                <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                    {{csrf_field()}}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
