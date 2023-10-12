<!-- begin::Body -->
	<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
		<!-- BEGIN: Left Aside -->
		<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
			<i class="la la-close"></i>
		</button>
		<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
		@if(Auth::user()->hasRole('tenant'))
			 <!-- BEGIN: Aside Menu -->
				<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500" >
					<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
						<li class="m-menu__item  m-menu__item--active" aria-haspopup="true" >
							<a  href="{{ url('/admin-dash') }}" class="m-menu__link ">
								<i class="m-menu__link-icon flaticon-apps"></i>
								<span class="m-menu__link-title">
									<span class="m-menu__link-wrap">
										<span class="m-menu__link-text">
											Tenant Dashboard
										</span>
									</span>
								</span>
							</a>
						</li>

						<li class="m-menu__item" aria-haspopup="true" >
							<a  href="{{ url('/admin-dash') }}" class="m-menu__link ">
								<i class="m-menu__link-icon flaticon-apps"></i>
								<span class="m-menu__link-title">
									<span class="m-menu__link-wrap">
										<span class="m-menu__link-text">
											Dashboard
										</span>
									</span>
								</span>
							</a>
						</li>

						<li class="m-menu__item  m-menu__item--submenu " aria-haspopup="true"  m-menu-submenu-toggle="hover">
							<a  href="javascript:;" class="m-menu__link m-menu__toggle">
								<i class="m-menu__link-icon flaticon-users"></i>
								<span class="m-menu__link-text">
									Rent
								</span>
								<i class="m-menu__ver-arrow la la-angle-right"></i>
							</a>
							<div class="m-menu__submenu ">
								<span class="m-menu__arrow"></span>
								<ul class="m-menu__subnav">
									<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
										<span class="m-menu__link">
											<span class="m-menu__link-text">
												Rent
											</span>
										</span>
									</li>
									<li class="m-menu__item " aria-haspopup="true" >
										<a  href="{{ url('all-my-rents') }}" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Rent
											</span>
										</a>
									</li>
									<li class="m-menu__item " aria-haspopup="true" >
										<a  href="{{ url('my-new-rent') }}" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Pay New Rent
											</span>
										</a>
									</li>
								</ul>
							</div>
                        </li>
                        {{-- buildings --}}
                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
							<a  href="javascript:;" class="m-menu__link m-menu__toggle">
								<i class="m-menu__link-icon fa fa-home"></i>
								<span class="m-menu__link-text">
									Complains
								</span>
								<i class="m-menu__ver-arrow la la-angle-right"></i>
							</a>
							<div class="m-menu__submenu ">
								<span class="m-menu__arrow"></span>
								<ul class="m-menu__subnav">
									<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
										<span class="m-menu__link">
											<span class="m-menu__link-text">
												Complains
											</span>
										</span>
									</li>
									<li class="m-menu__item " aria-haspopup="true" >
										<a  href="{{ url('/all-my-complains') }}" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												All Your Complains
											</span>
										</a>
									</li>
									<li class="m-menu__item " aria-haspopup="true" >
										<a  href="{{ url('/my-new-complains') }}" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Add New
											</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
                        {{-- buildings --}}
                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
							<a  href="javascript:;" class="m-menu__link m-menu__toggle">
								<i class="m-menu__link-icon fa fa-home"></i>
								<span class="m-menu__link-text">
									Apartment
								</span>
								<i class="m-menu__ver-arrow la la-angle-right"></i>
							</a>
							<div class="m-menu__submenu ">
								<span class="m-menu__arrow"></span>
								<ul class="m-menu__subnav">
									<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
										<span class="m-menu__link">
											<span class="m-menu__link-text">
												Apartments
											</span>
										</span>
									</li>
									<li class="m-menu__item " aria-haspopup="true" >
										<a  href="{{ url('/available-apartments') }}" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Available Apartments
											</span>
										</a>
									</li>
								</ul>
							</div>
						</li>


						<li class="m-menu__section ">
							<h4 class="m-menu__section-text">
								Settings
							</h4>
							<i class="m-menu__section-icon flaticon-more-v3"></i>
						</li>

						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
							<a href="{{ url('/logout') }}" class="m-menu__link m-menu__toggle"
								onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
								<i class="fa fa-sign-out m-menu__link-icon "></i>
								<span class="m-menu__link-text">
									Sign Out
								</span>
							</a>

							<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</li>
					</ul>
				</div>
				<!-- END: Aside Menu -->
			</div>
			<!-- END: Left Aside -->

		@elseif(Auth::user()->hasRole('admin'))
				<!-- BEGIN: Aside Menu -->
				<div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500" >
					<ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
						<li class="m-menu__item" aria-haspopup="true" >
							<a  href="{{ url('/admin-dash') }}" class="m-menu__link ">
								<i class="m-menu__link-icon flaticon-apps"></i>
								<span class="m-menu__link-title">
									<span class="m-menu__link-wrap">
										<span class="m-menu__link-text">
											Dashboard
										</span>
									</span>
								</span>
							</a>
						</li>

						<li class="m-menu__item  m-menu__item--submenu " aria-haspopup="true"  m-menu-submenu-toggle="hover">
							<a  href="javascript:;" class="m-menu__link m-menu__toggle">
								<i class="m-menu__link-icon flaticon-users"></i>
								<span class="m-menu__link-text">
									Staff
								</span>
								<i class="m-menu__ver-arrow la la-angle-right"></i>
							</a>
							<div class="m-menu__submenu ">
								<span class="m-menu__arrow"></span>
								<ul class="m-menu__subnav">
									<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
										<span class="m-menu__link">
											<span class="m-menu__link-text">
												Staff
											</span>
										</span>
									</li>
									<li class="m-menu__item " aria-haspopup="true" >
										<a  href="{{ url('all-users') }}" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Staff
											</span>
										</a>
									</li>
									<li class="m-menu__item " aria-haspopup="true" >
										<a  href="{{ url('new-user') }}" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Add New
											</span>
										</a>
									</li>
								</ul>
							</div>
                        </li>
                        {{-- buildings --}}
                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
							<a  href="javascript:;" class="m-menu__link m-menu__toggle">
								<i class="m-menu__link-icon fa fa-home"></i>
								<span class="m-menu__link-text">
									Complains
								</span>
								<i class="m-menu__ver-arrow la la-angle-right"></i>
							</a>
							<div class="m-menu__submenu ">
								<span class="m-menu__arrow"></span>
								<ul class="m-menu__subnav">
									<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
										<span class="m-menu__link">
											<span class="m-menu__link-text">
												Complains
											</span>
										</span>
									</li>
									<li class="m-menu__item " aria-haspopup="true" >
										<a  href="{{ url('/all-my-complains') }}" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												All Complains
											</span>
										</a>
									</li>
									<li class="m-menu__item " aria-haspopup="true" >
										<a  href="{{ url('/my-new-complains') }}" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Add New
											</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
                        {{-- buildings --}}
                        <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
							<a  href="javascript:;" class="m-menu__link m-menu__toggle">
								<i class="m-menu__link-icon fa fa-home"></i>
								<span class="m-menu__link-text">
									Apartment
								</span>
								<i class="m-menu__ver-arrow la la-angle-right"></i>
							</a>
							<div class="m-menu__submenu ">
								<span class="m-menu__arrow"></span>
								<ul class="m-menu__subnav">
									<li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
										<span class="m-menu__link">
											<span class="m-menu__link-text">
												Apartments
											</span>
										</span>
									</li>
									<li class="m-menu__item " aria-haspopup="true" >
										<a  href="{{ url('/available-apartments') }}" class="m-menu__link ">
											<i class="m-menu__link-bullet m-menu__link-bullet--dot">
												<span></span>
											</i>
											<span class="m-menu__link-text">
												Available Apartments
											</span>
										</a>
									</li>
								</ul>
							</div>
						</li>


						<li class="m-menu__section ">
							<h4 class="m-menu__section-text">
								Settings
							</h4>
							<i class="m-menu__section-icon flaticon-more-v3"></i>
						</li>

						<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
							<a href="{{ url('/logout') }}" class="m-menu__link m-menu__toggle"
								onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
								<i class="fa fa-sign-out m-menu__link-icon "></i>
								<span class="m-menu__link-text">
									Sign Out
								</span>
							</a>

							<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</li>


					</ul>
				</div>
				<!-- END: Aside Menu -->
			</div>
			<!-- END: Left Aside -->

        @else
	    @endif
