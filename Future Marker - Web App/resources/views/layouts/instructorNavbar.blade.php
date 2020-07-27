<!doctype html>

<html>

<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('images/icon.png') }}" type="image/icon type">
    <title>Future Marker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{ asset('CSS/notifaction.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('CSS/main.css') }}" rel="stylesheet">

</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('instructor') }}">
            <img class="" src="{{ asset('images/logo-white.png') }}" height="20" alt="logo">
        </a>

        <ul class="navbar-nav ml-auto navbar-icons d-flex flex-row order-2 order-sm-3">
            <li class="nav-item dropdown">
                <a class="nav-link text-light pr-3" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell"></i> {{ count($notifications) }}
                </a>

                <ul class="dropdown-menu dropdown-menu-right  scrollable-menu">
                    <li class="head text-light bg-dark">

                        <span><i class="fa fa-bell" aria-hidden="true"></i> Notifications
                            {{ count($notifications) }}</span>

                    </li>
                    @if (count($notifications) == 0)
                    <div class="text-center my-3">
                        There is no notifications.
                    </div>
                    @endif

                    @foreach ($notifications as $notification)

                    <li class="my-3">
                        <div class="row m-auto">
                            <div class="col-2 ">
                                <div class="text-center">
                                    <i class="fa fa-bell-o fa-2x" aria-hidden="true"></i>
                                </div>
                            </div>
                            <div class="col-9">
                                <strong> {{ $notification->content }}</strong>
                                <div>
                                    <small class="text-info">{{ $notification->created_at }}</small>
                                </div>
                            </div>
                        </div>
                    </li>
                    <hr class="my-2">

                    @endforeach
                </ul>
            </li>


            <li class="nav-item">
                <a class="nav-link pr-3" href="#">
                    <i class="fa fa-commenting">

                    </i>

                </a>
            </li>
            <li class="nav-item dropdown  d-none d-sm-block">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    {{ $user['name'] }}
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-default"
                    aria-labelledby="navbarDropdownMenuLink-333">
                    <a class="dropdown-item" href="{{ route('instructor.profile') }}"><i class="fa fa-user"
                            aria-hidden="true"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>

                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <!-- Links -->
        <div class="collapse navbar-collapse order-3 order-sm-2" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('instructor.courses') }}">Courses</a>
                </li>

                <li class="nav-item dropdown d-sm-none">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        {{ $user['name'] }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-default"
                        aria-labelledby="navbarDropdownMenuLink-333">
                        <a class="dropdown-item" href="{{ route('instructor.profile') }}"><i class="fa fa-user"
                                aria-hidden="true"></i> Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>

                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>

            </ul>
        </div>

        <button class="navbar-toggler order-4" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>


    <main class="py-5 px-5">
        @if (session('mssg')!= null)
        <div class="row">
            <div class="col-12">
                <div class="alert alert-info alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('mssg') }}
                </div>
            </div>
        </div>
        @endif

        @if (session('error')!= null)
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('error') }}
                </div>
            </div>
        </div>
        @endif

        @if (session('success')!= null)
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {{ session('success') }}
                </div>
            </div>
        </div>
        @endif

        @yield('content')
    </main>
    <footer class="footer">

        <div class="footer-copyright text-center py-3">© 2020 Copyright
            <a class="footer-link" href="/"> Future Marker</a>
        </div>

    </footer>
</body>

</html>