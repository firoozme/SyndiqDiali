<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">

            <li class="">
                <a href="{{ route('user.dashboard') }}">
                    <span class="pcoded-micon"><i class="far fa-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('user.users') }}">
                    <span class="pcoded-micon"><i class="far fa-users"></i></span>
                    <span class="pcoded-mtext">Users</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('user.residents') }}">
                    <span class="pcoded-micon"><i class="far fa-house-return"></i></span>
                    <span class="pcoded-mtext">Residents</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('user.syndicates') }}">
                    <span class="pcoded-micon"><i class="far fa-users-class"></i></span>
                    <span class="pcoded-mtext">Syndicates</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('user.fees') }}">
                    <span class="pcoded-micon"><i class="far fa-hand-holding-usd"></i></span>
                    <span class="pcoded-mtext">Fee</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('user.accounts') }}">
                    <span class="pcoded-micon"><i class="far fa-wallet"></i></span>
                    <span class="pcoded-mtext">Bank Accounts</span>
                </a>
            </li>
            <li class="">
                <a href="{{ route('user.logs') }}">
                    <span class="pcoded-micon"><i class="far fa-history"></i></span>
                    <span class="pcoded-mtext">History Logs</span>
                </a>
            </li>
           
           
        </ul>
        
        
        <ul class="pcoded-item pcoded-left-item">
           
            <li class="">
                <a href="{{ route('user.logout') }}" >
                    <span class="pcoded-micon"><i class="far fa-sign-out"></i></span>
                    <span class="pcoded-mtext text-warning">Log Out</span>
                </a>
            </li>
        </ul>
    </div>
</nav>