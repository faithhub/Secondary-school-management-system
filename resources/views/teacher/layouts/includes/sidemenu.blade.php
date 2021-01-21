{{-- 
    <div class="dashboard-sidebar">
        <div class="dashboard-nav-trigger">
           <div class="dashboard-nav-trigger-btn">
               <i class="la la-bars"></i> Dashboard Navigation
           </div>
        </div>
        <div class="dashboard-nav-container">
            <div class="humburger-menu">
                <div class="humburger-menu-lines side-menu-close"></div><!-- end humburger-menu-lines -->
            </div><!-- end humburger-menu -->
            <div class="side-menu-wrap">
                <ul class="side-menu-ul">
                    <li class="{{ request()->is('user*')  ? 'page-active' : '' }}" ><a href="{{ url('user') }}"><i class="la la-dashboard icon-element"></i> Dashboard</a></li>
                    <li><a href="employer-dashboard-message.html"><i class="la la-envelope icon-element"></i> Messages <span class="badge badge-info radius-rounded p-1">3</span></a></li>
                    <li><a href="employer-dashboard-bookmark.html"><i class="la la-bookmark icon-element"></i> Courses</a></li>
                    <li><a href="employer-dashboard-bookmark.html"><i class="la la-bookmark icon-element"></i> My Courses <span class="badge badge-info radius-rounded p-1">10</span></a></li>
                    <li><a href="employer-transactions.html"><i class="la la-money-bill icon-element"></i>Payment History</a></li>
                    <li><a href="employer-job-alert.html"><i class="la la-book icon-element"></i>E-Book</a></li>
                    <li class="{{ request()->is('profile*')  ? 'page-active' : '' }}"><a href="{{ url('user/profile') }}"><i class="la la-user icon-element"></i> View Profile</a></li>
                    <li class="{{ request()->is('change-password*')  ? 'page-active' : '' }}"><a href="{{ url('user/change-password') }}"><i class="la la-lock icon-element"></i> Change Password</a></li>
                    <li><a href="{{ url('logout') }}"><i class="la la-power-off icon-element"></i> Logout</a></li>
                </ul>
            </div><!-- end side-menu-wrap -->
        </div>
    </div><!-- end dashboard-sidebar -->
     --}}
	<!-- Left sidebar menu start -->
	<div class="ttr-sidebar">
		<div class="ttr-sidebar-wrapper content-scroll">
			<!-- side menu logo start -->
			<div class="ttr-sidebar-logo">
				<a href="#"><img alt="" src="{{ asset('dashboard/assets/images/logo.png') }}" width="122" height="27"></a>
				<!-- <div class="ttr-sidebar-pin-button" title="Pin/Unpin Menu">
					<i class="material-icons ttr-fixed-icon">gps_fixed</i>
					<i class="material-icons ttr-not-fixed-icon">gps_not_fixed</i>
				</div> -->
				<div class="ttr-sidebar-toggle-button">
					<i class="ti-arrow-left"></i>
				</div>
			</div>
			<!-- side menu logo end -->
			<!-- sidebar menu start -->
			<nav class="ttr-sidebar-navi">
				<ul>
					<li>
						<a href="{{ url('/teacher') }}" class="ttr-material-button">
							<span class="ttr-icon"><i class="ti-home"></i></span>
		                	<span class="ttr-label">Dashborad</span>
		                </a>
		            </li>
					<li>
						<a href="{{ url('teacher/class') }}" class="ttr-material-button">
							<span class="ttr-icon"><i class="ti-book"></i></span>
		                	<span class="ttr-label">Class</span>
		                </a>
		            </li>
					<li>
						<a href="{{ url('teacher/profile') }}" class="ttr-material-button">
							<span class="ttr-icon"><i class="ti-user"></i></span>
		                	<span class="ttr-label">My Profile</span>
		                </a>
		            </li>
					<li>
						<a href="{{ url('logout') }}" class="ttr-material-button">
							<span class="ttr-icon"><i class="ti-lock"></i></span>
		                	<span class="ttr-label">Logout</span>
		                </a>
		            </li>
				</ul>
				<!-- sidebar menu end -->
			</nav>
			<!-- sidebar menu end -->
		</div>
	</div>
	<!-- Left sidebar menu end -->