<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <div id="sidebar-menu">
            <ul>
                <li class="menu-title">Management</li>

                <li>
                    <a href="{{ route('admin') }}" class="waves-effect @if (Route::currentRouteName() == 'admin') active @endif"><i class="mdi mdi-chart-arc"></i><span> Dashboard </span></a>
                </li>
                
                <li>
                    <a href="{{ route('admin.products') }}" class="waves-effect @if (Route::currentRouteName() == 'admin.products') active @endif"><i class="mdi mdi-cube"></i><span> Products </span></a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="mdi mdi-shield-account"></i> 
                        <span> Users </span>
                        <span class="menu-arrow"></span>
                    </a>
                    
                    <ul class="list-unstyled">
                        <li><a href="{{ route('admin.user.admins') }}" class="@if (Route::currentRouteName() == 'admin.user.admins') active @endif">Admins</a></li>
                        <li><a href="{{ route('admin.user.members') }}" class="@if (Route::currentRouteName() == 'admin.user.members') active @endif">Members</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.categories') }}" class="waves-effect @if (Route::currentRouteName() == 'admin.categories') active @endif"><i class="mdi mdi-shape"></i> Categories</a>
                </li>

                <li>
                    <a href="{{ route('admin.orders') }}" class="waves-effect  @if (Route::currentRouteName() == 'admin.orders') active @endif"><i class="mdi mdi-file-document-outline"></i> Orders</a>
                </li>

                {{-- <li class="menu-title">Stats</li> --}}

                {{-- <li>
                    <a href="{{ route('admin.stats') }}" class="waves-effect @if (Route::currentRouteName() == 'admin.stats') active @endif"><i class="mdi mdi-chart-line"></i> Statistics</a>
                </li> --}}

                <li>
                    <a href="{{ route('admin.visitors') }}" class="waves-effect @if (Route::currentRouteName() == 'admin.visitors') active @endif"><i class="mdi mdi-eye"></i> Visitors</a>
                </li>
                
                {{-- <li>
                    <a href="#" class="waves-effect  @if (Route::currentRouteName() == 'admin.lids') active @endif"><i class="mdi mdi-information"></i> Lids</a>
                </li> --}}


                {{-- <li class="menu-title">Advenced</li> --}}

                <li>
                    <a href="{{ Route('admin.user.edit', ['id' => auth()->user()->id]) }}" class="waves-effect"><i class="mdi mdi-account"></i> My profile</a>
                </li>

                <li>
                    <a href="{{ route('auth.logout') }}" class="waves-effect"><i class="mdi mdi-logout"></i> Logout</a>
                </li>

            </ul>
        </div>
        
    </div>
</div>