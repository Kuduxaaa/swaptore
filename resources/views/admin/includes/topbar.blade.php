<div class="topbar">
    <div class="topbar-left">
        <a href="/" class="logo"><span>{{ env('APP_NAME') }}</span><i class="mdi mdi-layers"></i></a>
    </div>
    <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">

            <div class="clearfix">
                 <ul class="nav navbar-left">
                    <li>
                        <button class="button-menu-mobile open-left waves-effect">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
                </ul>

                <ul class="nav navbar-right">
                    <li class="dropdown user-box">
                        <a href="{{ route('auth.logout') }}" class="waves-effect user-link">
                            <i class="mdi mdi-logout"></i>
                            Logout
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>