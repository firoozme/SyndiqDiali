<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">

            <li class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <a href="{{ route('user.dashboard') }}">
                    <span class="pcoded-micon"><i class="far fa-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('user.users') ? 'active' : '' }}">
                <a href="{{ route('user.users') }}">
                    <span class="pcoded-micon"><i class="far fa-users"></i></span>
                    <span class="pcoded-mtext">Users</span>
                </a>
            </li>
           
            <li class="{{ request()->routeIs('user.syndicates') ? 'active' : '' }}">
                <a href="{{ route('user.syndicates') }}">
                    <span class="pcoded-micon"><i class="far fa-users-class"></i></span>
                    <span class="pcoded-mtext">Syndicates</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('user.accounts') ? 'active' : '' }}">
                <a href="{{ route('user.accounts') }}">
                    <span class="pcoded-micon"><i class="far fa-wallet"></i></span>
                    <span class="pcoded-mtext">Bank Accounts</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('user.charges') ? 'active' : '' }}">
                <a href="{{ route('user.charges') }}">
                    <span class="pcoded-micon"><i class="fal fa-file-invoice-dollar"></i></span>
                    <span class="pcoded-mtext">Charges</span>
                </a>
            </li>

            <li class="{{ request()->routeIs('user.cashes') ? 'active' : '' }}">
                <a href="{{ route('user.cashes') }}">
                    <span class="pcoded-micon"><i class="fal fa-cash-register"></i></span>
                    <span class="pcoded-mtext">Cashes</span>
                </a>
            </li>
            
            <li class="{{ request()->routeIs('user.company.charges') ? 'active' : '' }}">
                <a href="{{ route('user.company.charges') }}">
                    <span class="pcoded-micon"><i class="fal fa-building"></i></span>
                    <span class="pcoded-mtext">Company Charges</span>
                </a>
            </li>
            <li class="{{ request()->routeIs('user.logs') ? 'active' : '' }}">
                <a href="{{ route('user.logs') }}">
                    <span class="pcoded-micon"><i class="far fa-history"></i></span>
                    <span class="pcoded-mtext">History Logs</span>
                </a>
            </li>

            <li class="">
                <a href="{{ route('user.logout') }}">
                    <span class="pcoded-micon"><i class="far fa-sign-out"></i></span>
                    <span class="pcoded-mtext">Log Out</span>
                </a>
            </li>
        </ul>
    </div>
</nav>