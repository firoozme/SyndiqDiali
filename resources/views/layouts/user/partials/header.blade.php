<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">

        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="fas fa-bars"></i>
            </a>
            <a href="index-1.htm">
                <img class="img-fluid" src="{{ asset('images/auth/logo.png') }}" alt="Theme-Logo">
            </a>
            <a class="mobile-options">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li class="header-search">
                    <div class="main-search morphsearch-search">
                        <div class="input-group">
                            <span class="input-group-addon search-close"><i class="far fa-times"></i></span>
                            <input type="text" class="form-control">
                            <span class="input-group-addon search-btn"><i class="far fa-search"></i></span>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()">
                        <i class="far fa-expand"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">
                
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <span>{{ auth()->user()->username }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                           
                            <li>
                                <a href="{{ route('user.users',['type'=>'detail','id' => auth()->user()->id]) }}">
                                    <i class="far fa-user"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.logout') }}">
                                    <i class="far fa-sign-out"></i> Logout
                                </a>
                            </li>
                        </ul>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>