<header id="header-v1" class="navbar-wrapper">
            <div class="container">
                <div class="row">
                    <nav class="navbar navbar-default">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="navbar-header">
                                    <div class="navbar-brand">
                                        <h1>
                                            <a href="{{ route('main') }}">
                                                <img src="images/libraria-logo-v1.png" alt="LIBRARIA" />
                                            </a>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <!-- Header Topbar -->
                                <div class="header-topbar hidden-sm hidden-xs">
                                    <div class="row">
                                            <div class="col-sm-6">
                                            <div class="topbar-links">
                                            @if (Auth::check())
                                            <a>Welcome, {{ Auth::user() -> name }}.</a>
                                            @if (Auth::user() -> isAdmin)
                                            <a>You is admin.</a>
                                            <a href="{{ route('bookAddForm') }}">You can add book</a>
                                            @endif
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                                <input type="submit" value="Logout">
                                            </form>
                                            </div>
                                            @else
                                                <a href="{{ route('singin') }}"><i class="fa fa-lock"></i>Login / Register</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="navbar-collapse hidden-sm hidden-xs">
                                    <ul class="nav navbar-nav">
                                        <li class="dropdown active">
                                            <a data-toggle="dropdown" class="dropdown-toggle disabled" href="{{ route('main') }}">Home</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('main') }}">Home V1</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle disabled" href="{{ route('book-list') }}">Books &amp; Media</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('book-list') }}">Books &amp; Media List View</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" class="dropdown-toggle disabled" href="#">Pages</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{ route('book-list') }}">Books &amp; Media List View</a></li>
                                                <li><a href="{{ route('singin') }}">Signin/Register</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </header>