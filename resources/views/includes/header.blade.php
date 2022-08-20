<div id="kt_header" class="header header-fixed">
<!--begin::Header Wrapper-->
    <div class="header-wrapper rounded-top-xl d-flex flex-grow-1 align-items-center">
			<!--begin::Container-->
		<div class="container-fluid d-flex align-items-center justify-content-end justify-content-lg-between flex-wrap">
				<!--begin::Menu Wrapper-->
			<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
					<!--begin::Menu-->
				<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
						<!--begin::Nav-->
					<ul class="menu-nav">
						@hasanyrole('Admin')
						
						<li class="menu-item menu-item-submenu menu-item-rel @if(isset($activePage) && $activePage == 'e') menu-item-here @endif" data-menu-toggle="click" aria-haspopup="true">
							<a href="javascript:;" class="menu-link menu-toggle">
								<span class="menu-text">User Permissions
								<i id="customer_show" class="fa fa-circle text-danger icon-sm d-none"></i>
								</span>
								<i class="menu-arrow"></i>
							</a>
							<div class="menu-submenu menu-submenu-classic menu-submenu-left">
								<ul class="menu-subnav">
								    <li class="menu-item" aria-haspopup="true">
										<a href="{{route('customer.index')}}" class="menu-link">
											<span class="menu-text">All users</span>
											<span class="menu-desc"></span>
											<i id="new_user" class="fa fa-circle text-danger icon-sm d-none"></i>
										</a>
									</li>
									<li class="menu-item" aria-haspopup="true">
										<a href="{{route('permission.index')}}" class="menu-link">
											<span class="menu-text">Create Permission</span>
											<span class="menu-desc"></span>
											<i id="new_user" class="fa fa-circle text-danger icon-sm d-none"></i>
										</a>
									</li>
									<li class="menu-item" aria-haspopup="true">
										<a href="{{route('role.index')}}" class="menu-link">
											<span class="menu-text">Create Role
											
											</span>
											<span class="menu-desc"></span>
											<i id="customer_verify" class="fa fa-circle text-danger icon-sm d-none"></i>
										</a>
									</li>
									<li class="menu-item" aria-haspopup="true">
										<a href="{{route('permission.user')}}" class="menu-link">
											<span class="menu-text">Create Customer Role
											
											</span>
											<span class="menu-desc"></span>
											<i id="customer_verify" class="fa fa-circle text-danger icon-sm d-none"></i>
										</a>
									</li>
								</ul>
							</div>
						</li>
						@endhasanyrole
						@hasanyrole('Pharmacy|Admin')
						<li class="menu-item menu-item-submenu menu-item-rel @if(isset($activePage) && $activePage == 'prescriptionse') menu-item-here @endif" data-menu-toggle="click" aria-haspopup="true">
							<a href="javascript:;" class="menu-link menu-toggle">
								<span class="menu-text">Pharmacy
								<i id="prescriptions_show" class="fa fa-circle text-danger icon-sm d-none"></i>
								</span>
								<i class="menu-arrow"></i>
							</a>
							<div class="menu-submenu menu-submenu-classic menu-submenu-left">
								<ul class="menu-subnav">
								   
								    <li class="menu-item" aria-haspopup="true">
										<a href="{{route('drug.index')}}" class="menu-link">
											<span class="menu-text">Add Drugs</span>
											<span class="menu-desc"></span>
											<i id="new_user" class="fa fa-circle text-danger icon-sm d-none"></i>
										</a>
									</li>

									<li class="menu-item" aria-haspopup="true">
										<a href="{{route('time.index')}}" class="menu-link">
											<span class="menu-text">Add Time Slot</span>
											<span class="menu-desc"></span>
											<i id="new_user" class="fa fa-circle text-danger icon-sm d-none"></i>
										</a>
									</li>
									
									<li class="menu-item" aria-haspopup="true">
										<a href="{{route('prescriptions.index')}}" class="menu-link">
											<span class="menu-text">prescriptions view</span>
											<span class="menu-desc"></span>
											<i id="prescriptions_show_id" class="fa fa-circle text-danger icon-sm d-none"></i>
										</a>
									</li>
									
								</ul>
							</div>
						</li>
						@endhasanyrole
						<li class="menu-item menu-item-submenu menu-item-rel @if(isset($activePage) && $activePage == 'cus') menu-item-here @endif" data-menu-toggle="click" aria-haspopup="true">
							<a href="javascript:;" class="menu-link menu-toggle">
								<span class="menu-text">Request prescription
								<i id="customer_show" class="fa fa-circle text-danger icon-sm d-none"></i>
								</span>
								<i class="menu-arrow"></i>
							</a>
							<div class="menu-submenu menu-submenu-classic menu-submenu-left">
								<ul class="menu-subnav">
									
									<li class="menu-item" aria-haspopup="true">
										<a href="{{route('prescriptions.cus.index')}}" class="menu-link">
											<span class="menu-text">My Prescriptions</span>
											<span class="menu-desc"></span>
											<i id="new_user" class="fa fa-circle text-danger icon-sm d-none"></i>
										</a>
									</li>

									<li class="menu-item" aria-haspopup="true">
										<a href="{{route('prescriptions.add')}}" class="menu-link">
											<span class="menu-text">Add Prescriptions</span>
											<span class="menu-desc"></span>
											<i id="new_user" class="fa fa-circle text-danger icon-sm d-none"></i>
										</a>
									</li>
									
								</ul>
							</div>
						</li>
											
                    </ul>
                </div>
				
            </div>
        </div>			
		<!--end::Container-->
	</div>
<!--end::Header Wrapper-->
</div>

