<nav class="navbar navbar-default navbar-fixed-side">
    <div class="container">
        <div class="navbar-header">
            <div class="row" style="margin-left:15px;margin-right:0px;">
                <div class="col-xs-10" style="margin-bottom:20px;">
                    <!-- Branding Image -->
                    <div class="">
                        <a href="{{url('/')}}">
                            <h1 class="visible-xs" style="color:white;">That Dance Guy</h1>
                            <img class="hidden-xs" src="/theme/logo.png" style="margin:10px auto 15px auto;">
                        </a>
                        <div style="font-size:18px;color:white;">Find upcoming swing dance events in the greater Tampa Bay area.</div>
                    </div>
                </div>
                <div class="col-xs-2" style="margin-top:20px;">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>




        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{route('events')}}"><i class="fa fa-calendar-o" aria-hidden="true"></i> View all Upcoming Events</a></li>
                <li><a href="{{route('venues')}}"><i class="fa fa-building-o" aria-hidden="true"></i> Search by Venue</a></li>
                <li><a href="{{route('posts')}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Read Posts</a></li>
                <li><a href="{{route('venues')}}"><i class="fa fa-handshake-o" aria-hidden="true"></i> Our Partners</a></li>
                <li><a href="{{route('venues')}}"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Hire Me</a></li>
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
