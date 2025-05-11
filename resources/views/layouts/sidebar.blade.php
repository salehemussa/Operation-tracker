<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
        @if(auth()->user()->hasRole('admin'))  <!-- Check if user is admin -->

            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Main</li>
                <li class="">
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect {{ request()->is("admin") || request()->is("admin/*") ? "mm active" : "" }}">
                        <i class="ti-home"></i><span> Dashboard </span>
                    </a>
               </li>
                    <li>
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-user"></i><span> Employees & Sites<span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                        <ul class="submenu">
                            <li>
                                <a href="/admin/employees" class="waves-effect {{ request()->is("employees") || request()->is("/employees/*") ? "mm active" : "" }}"><i class="dripicons-view-apps"></i><span>Employee List</span></a>
                            </li>
                            <li>
                                <a href="/admin/operator" class="waves-effect {{ request()->is("operator") || request()->is("/operator/*") ? "mm active" : "" }}"><i class="dripicons-view-apps"></i><span>Site List</span></a>
                            </li>
                        </ul>
                    </li>
                <li class="menu-title">Manage Sites</li>

                <li class="">
                    <a href="/admin/schedule" class="waves-effect {{ request()->is("schedule") || request()->is("schedule/*") ? "mm active" : "" }}">
                        <i class="ti-time"></i> <span> Schedule </span>
                    </a>
                </li>
    
                <li class="">
                    <a href="/admin/sheet-report" class="waves-effect {{ request()->is("sheet-report") || request()->is("sheet-report/*") ? "mm active" : "" }}">
                        <i class="dripicons-to-do"></i> <span> Sheet Report </span>
                    </a>
                </li>
                <li class="">
                    <a href="/admin/attendance" class="waves-effect {{ request()->is("attendance") || request()->is("attendance/*") ? "mm active" : "" }}">
                        <i class="ti-calendar"></i> <span> Attendance Logs </span>
                    </a>
                </li>
                <li class="menu-title"> Manage Inventory</li>

                <li class="">
                    <a href="/admin/inventory" class="waves-effect {{ request()->is("inventory") || request()->is("inventory/*") ? "mm active" : "" }}">
                        <i class="dripicons-store"></i> <span> Inventory Items </span>
                    </a>
                </li>

                <li class="">
                    <a href="/admin/stock" class="waves-effect {{ request()->is("stock") || request()->is("stock/*") ? "mm active" : "" }}">
                        <i class="dripicons-store"></i> <span> Stocks </span>
                    </a>
                </li>

                <li class="">
                    <a href="/admin/requests" class="waves-effect {{ request()->is("requests") || request()->is("requests/*") ? "mm active" : "" }}">
                        <i class="dripicons-store"></i> <span class="badge badge-primary badge-pill float-right">0</span> <span> Requests </span>
                    </a>
                </li>
                <li class="menu-title">Manage Profile</li>
                <li class="">
                    <a href="/admin/profile"  class="waves-effect {{ request()->is("profile") || request()->is("profile/*") ? "mm active" : "" }}">
                        <i class="dripicons-user"></i> <span> My Profile </span>
                    </a>
                </li>
            </ul>

            @endif  <!-- End of admin check -->
            @if(auth()->user()->hasRole('operator'))  <!-- Check if user is admin -->
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
            <li class="menu-title">Main</li>
            <li class="">
              <a href="{{ route('operator.dashboard') }}" class="waves-effect {{ request()->is("operator") || request()->is("operator/*") ? "mm active" : "" }}">
            <i class="ti-home"></i> <span> Dashboard </span>
        </a>
    </li>

    <li class="menu-title">Manage Attendance</li>

    <li class="">
        <a href="/operator/check" class="waves-effect {{ request()->is("check") || request()->is("check/*") ? "mm active" : "" }}">
            <i class="dripicons-to-do"></i> <span> Attendance Sheet </span>
        </a>
    </li>

    <li class="">
        <a href="/operator/attendance" class="waves-effect {{ request()->is("attendance") || request()->is("attendance/*") ? "mm active" : "" }}">
            <i class="ti-calendar"></i> <span> Attendance Logs </span>
        </a>
    </li>
    <li class="menu-title">Manage Inventory</li>
    <li class="">
        <a href="/operator/opstock" class="waves-effect {{ request()->is("opstock") || request()->is("opstock/*") ? "mm active" : "" }}">
            <i class="dripicons-store"></i> <span> Stock </span>
        </a>
    </li>
    <li class="">
        <a href="/operator/requestsop" class="waves-effect {{ request()->is("requestsop") || request()->is("requestsop/*") ? "mm active" : "" }}">
             <i class="dripicons-store"></i> <span class="badge badge-primary badge-pill float-right">2</span> <span> Requests </span>
         </a>
    </li>

    <li class="menu-title">Manage Profile</li>
                <li class="">
                    <a href="/operator/profileop"  class="waves-effect {{ request()->is("profile") || request()->is("profile/*") ? "mm active" : "" }}">
                        <i class="dripicons-user"></i> <span> My Profile </span>
                    </a>
                </li>
            </ul>
    </ul>
    @endif 
    </div>
    <!-- Sidebar -->
    <div class="clearfix"></div>
   </div>
  <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->
