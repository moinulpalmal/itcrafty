<!-- BEGIN: Main Menu-->
<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper">
    <!-- Horizontal menu content-->
    <div class="navbar-container main-menu-content" data-menu="menu-container">
        <!-- include ../../../includes/mixins-->
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ (request()->is('home')) ? 'active' : '' }}" data-menu="dropdown"><a class="nav-link" href="{{route('home')}}" data-toggle="dropdown"><i class="feather icon-home"></i><span data-i18n="Home">Home</span></a></li>
            @if(Auth::user()->hasPermission('administrator', Auth::user()->id))
            <li class="dropdown nav-item {{ (request()->is('admin*')) ? 'active' : '' }}" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="feather icon-monitor"></i><span data-i18n="Administration">Administration</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown dropdown-submenu {{ (request()->is('admin/user*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="Software Users" data-toggle="dropdown">Software Users</a>
                        <ul class="dropdown-menu">
                            @if(Auth::user()->hasTaskPermission('createuser', Auth::user()->id))
                                <li class="{{ (request()->is('admin/user/active')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('admin.user.active')}}" data-i18n="Active Users" data-toggle="dropdown">Active Users</a></li>
                            @endif
                            @if(Auth::user()->hasTaskPermission('restoreuser', Auth::user()->id))
                                <li class="{{ (request()->is('admin/user/historical')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('admin.user.historical')}}" data-i18n="Historical Users" data-toggle="dropdown">Historical Users</a></li>
                                @endif
                                @if(Auth::user()->id == 1)
                                <li class="{{ (request()->is('admin/user/role')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('admin.user.role')}}" data-i18n="Roles" data-toggle="dropdown">Roles</a></li>
                                <li class="{{ (request()->is('admin/user/task')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('admin.user.task')}}" data-i18n="Tasks" data-toggle="dropdown">Tasks</a></li>
                                @endif
                        </ul>
                    </li>
                </ul>
            </li>
            @endif
            @if(Auth::user()->hasPermission('settings', Auth::user()->id))
            <li class="dropdown nav-item {{ (request()->is('settings*')) ? 'active' : '' }}" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="feather icon-settings"></i><span data-i18n="Settings">Settings</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown dropdown-submenu {{ (request()->is('settings/factory*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="Factory & Department" data-toggle="dropdown">Factory & Department</a>
                        <ul class="dropdown-menu">
                            @if(Auth::user()->hasTaskPermission('factory_department', Auth::user()->id))
                            <li class="{{ (request()->is('settings/factory/setup')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.factory.setup')}}" data-i18n="Factory Setup" data-toggle="dropdown">Factory Setup</a></li>
                            <li class="{{ (request()->is('settings/factory/department-setup')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.factory.department-setup')}}" data-i18n="Department IT Setup" data-toggle="dropdown">Department Setup</a></li>
                            @endif
                            @if(Auth::user()->hasTaskPermission('factory_it', Auth::user()->id))
                            <li class="{{ (request()->is('settings/factory/it-setup')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.factory.it-setup')}}" data-i18n="Factory IT Setup" data-toggle="dropdown">Factory IT Setup</a></li>
                            @endif
                        </ul>
                    </li>
                    @if(Auth::user()->hasTaskPermission('product', Auth::user()->id))
                    <li class="dropdown dropdown-submenu {{ (request()->is('settings/product*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="Product" data-toggle="dropdown">Product</a>
                        <ul class="dropdown-menu">
                            @if(Auth::user()->hasTaskPermission('product_vendor', Auth::user()->id))
                                <li class="{{ (request()->is('settings/product/manufacturer')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.product.manufacturer')}}" data-i18n="Manufacturer" data-toggle="dropdown">Manufacturer</a></li>
                                 <li class="dropdown dropdown-submenu {{ (request()->is('settings/product/vendor*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="Vendor" data-toggle="dropdown">Vendor</a>
                                    <ul class="dropdown-menu">
                                        <li class="{{ (request()->is('settings/product/vendor/setup')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.product.vendor.setup')}}" data-i18n="Vendor Setup" data-toggle="dropdown">Vendor Setup</a></li>
                                        <li class="{{ (request()->is('settings/product/vendor/person')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.product.vendor.person')}}" data-i18n="Vendor Person" data-toggle="dropdown">Vendor Person</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if(Auth::user()->hasTaskPermission('product_master', Auth::user()->id))
                                <li class="{{ (request()->is('settings/product/category')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.product.category')}}" data-i18n="Category" data-toggle="dropdown">Category</a></li>
                                <li class="{{ (request()->is('settings/product/sub-category')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.product.sub-category')}}" data-i18n="Sub-Category" data-toggle="dropdown">Sub-Category</a></li>
                                <li class="{{ (request()->is('settings/product/master')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.product.master')}}" data-i18n="Master" data-toggle="dropdown">Master Setup</a></li>
                            @endif
                                @if(Auth::user()->hasTaskPermission('product_detail', Auth::user()->id))
                                    <li class="{{ (request()->is('settings/product/detail')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.product.detail')}}" data-i18n="Detail" data-toggle="dropdown">Detail Setup</a></li>
                                @endif
                        </ul>
                    </li>
                    @endif
                    @if(Auth::user()->hasTaskPermission('designation', Auth::user()->id))
                    <li class="{{ (request()->is('settings/designation')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.designation')}}" data-i18n="Designation" data-toggle="dropdown">Designation</a></li>
                    @endif
                    @if(Auth::user()->hasTaskPermission('employee', Auth::user()->id))
                        <li class="{{ (request()->is('settings/employee')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.employee')}}" data-i18n="Employee" data-toggle="dropdown">Employee</a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if(Auth::user()->hasPermission('services', Auth::user()->id))
            <li class="dropdown nav-item {{ (request()->is('services*')) ? 'active' : '' }}" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-wrench"></i><span data-i18n="Services">Services</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown dropdown-submenu {{ (request()->is('services/factory*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="Services Master" data-toggle="dropdown">Master</a>
                        <ul class="dropdown-menu">
                            @if(Auth::user()->hasTaskPermission('service_receive_desk', Auth::user()->id))
                            <li class="{{ (request()->is('services/master/new')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('services.master.new')}}" data-i18n="New" data-toggle="dropdown">New</a></li>
                            @endif
                            @if(Auth::user()->hasTaskPermission('service_person', Auth::user()->id))
                                <li class="{{ (request()->is('services/master/queue')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('services.master.queue')}}" data-i18n="Queue" data-toggle="dropdown">Queue</a></li>
                                <li class="{{ (request()->is('services/master/assigned')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('services.master.assigned')}}" data-i18n="Assigned" data-toggle="dropdown">Assigned</a></li>
                                <li class="{{ (request()->is('services/master/under-process')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('services.master.under-process')}}" data-i18n="Under Process" data-toggle="dropdown">Under Process</a></li>
                                <li class="{{ (request()->is('services/master/warranty-requested')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('services.master.warranty-requested')}}" data-i18n="Warranty Requested" data-toggle="dropdown">Warranty Requested</a></li>
                                <li class="{{ (request()->is('services/master/warranty-received')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('services.master.warranty-received')}}" data-i18n="Warranty Received" data-toggle="dropdown">Warranty Received</a></li><li class="{{ (request()->is('services/master/solved')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('services.master.solved')}}" data-i18n="Queue" data-toggle="dropdown">Solved</a></li>
                                    <li class="{{ (request()->is('services/master/solved-approved')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('services.master.solved-approved')}}" data-i18n="Queue" data-toggle="dropdown">Solved Approved</a></li>
                                    <li class="{{ (request()->is('services/master/delivered')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('services.master.delivered')}}" data-i18n="Queue" data-toggle="dropdown">Delivered</a></li>
                                @endif
                                    {{--<li class="{{ (request()->is('settings/factory/department-setup')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('settings.factory.department-setup')}}" data-i18n="Department IT Setup" data-toggle="dropdown">Department Setup</a></li>
                        --}}</ul>
                    </li>
                    @if(Auth::user()->hasTaskPermission('service_team_leader', Auth::user()->id))
                    <li class="dropdown dropdown-submenu {{ (request()->is('services/search*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="Search" data-toggle="dropdown">Search</a>
                        <ul class="dropdown-menu">
                            <li class="{{ (request()->is('services/search/product')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('services.search.product')}}" data-i18n="Product" data-toggle="dropdown">Product</a></li>
                            {{--<li class="{{ (request()->is('services/search/factory')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('services.search.factory')}}" data-i18n="Factory" data-toggle="dropdown">Factory</a></li>
                        --}}</ul>
                    </li>
                        @endif
                   </ul>
            </li>
            @endif
            @if(Auth::user()->hasPermission('purchase', Auth::user()->id))
            <li class="dropdown nav-item {{ (request()->is('purchase*')) ? 'active' : '' }}" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-cart-plus"></i><span data-i18n="Purchase">Purchase</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown dropdown-submenu {{ (request()->is('purchase/warranty*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="Warranty" data-toggle="dropdown">Warranty</a>
                        <ul class="dropdown-menu">
                            <li class="{{ (request()->is('purchase/warranty/service-requested')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('purchase.warranty.service-requested')}}" data-i18n="Requested Service" data-toggle="dropdown">Requested from Service</a></li>
                            <li class="{{ (request()->is('purchase/warranty/requested')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('purchase.warranty.requested')}}" data-i18n="Requested" data-toggle="dropdown">Requested</a></li>
                            <li class="{{ (request()->is('purchase/warranty/mail-sent')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('purchase.warranty.mail-sent')}}" data-i18n="Mail Sent" data-toggle="dropdown">Mail Sent</a></li>
                            <li class="{{ (request()->is('purchase/warranty/product-sent')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('purchase.warranty.product-sent')}}" data-i18n="Product Sent to Vendor" data-toggle="dropdown">Product Sent to Vendor</a></li>
                            <li class="{{ (request()->is('purchase/warranty/product-received')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('purchase.warranty.product-received')}}" data-i18n="Product Received from Vendor" data-toggle="dropdown">Product Received from Vendor</a></li>
                            <li class="{{ (request()->is('purchase/warranty/product-sent-service')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('purchase.warranty.product-sent-service')}}" data-i18n="Product Sent to Service Desk" data-toggle="dropdown">Product Sent to Service Desk</a></li>
                            <li class="{{ (request()->is('purchase/warranty/canceled')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('purchase.warranty.canceled')}}" data-i18n="Product Sent to Service Desk" data-toggle="dropdown">Canceled</a></li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-submenu {{ (request()->is('purchase/requisition*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="Requisition" data-toggle="dropdown">Requisition</a>
                        <ul class="dropdown-menu">
                            <li class="{{ (request()->is('purchase/requisition/service-requested')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('purchase.requisition.service-requested')}}" data-i18n="Requested Requisition" data-toggle="dropdown">Requested from Service</a></li>
                           {{-- <li class="{{ (request()->is('purchase/warranty/requested')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('purchase.warranty.requested')}}" data-i18n="Requested" data-toggle="dropdown">Requested</a></li>
                            <li class="{{ (request()->is('purchase/warranty/mail-sent')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('purchase.warranty.mail-sent')}}" data-i18n="Mail Sent" data-toggle="dropdown">Mail Sent</a></li>
                            <li class="{{ (request()->is('purchase/warranty/product-sent')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('purchase.warranty.product-sent')}}" data-i18n="Product Sent to Vendor" data-toggle="dropdown">Product Sent to Vendor</a></li>
                            <li class="{{ (request()->is('purchase/warranty/product-received')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('purchase.warranty.product-received')}}" data-i18n="Product Received from Vendor" data-toggle="dropdown">Product Received from Vendor</a></li>
                            <li class="{{ (request()->is('purchase/warranty/product-sent-service')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('purchase.warranty.product-sent-service')}}" data-i18n="Product Sent to Service Desk" data-toggle="dropdown">Product Sent to Service Desk</a></li>
                            <li class="{{ (request()->is('purchase/warranty/canceled')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('purchase.warranty.canceled')}}" data-i18n="Product Sent to Service Desk" data-toggle="dropdown">Canceled</a></li>
                        --}}</ul>
                    </li>
                    <li class="dropdown dropdown-submenu {{ (request()->is('purchase/product*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="Product" data-toggle="dropdown">Product</a>
                        <ul class="dropdown-menu">
                            <li class="{{ (request()->is('purchase/product/new')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('purchase.product.new')}}" data-i18n="New Product" data-toggle="dropdown">New</a></li>
                            <li class="{{ (request()->is('purchase/product/search')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('purchase.product.search')}}" data-i18n="Search" data-toggle="dropdown">Search</a></li>
                            <li class="{{ (request()->is('purchase/product/search-sl-no')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('purchase.product.search-sl-no')}}" data-i18n="Search Sl No." data-toggle="dropdown">Search Sl No.</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            @endif

            @if(Auth::user()->hasPermission('issue', Auth::user()->id))
                <li class="dropdown nav-item {{ (request()->is('issue*')) ? 'active' : '' }}" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="fa fa-cart-plus"></i><span data-i18n="Purchase">Issue</span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown dropdown-submenu {{ (request()->is('issue/old*')) ? 'active' : '' }}" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-i18n="Warranty" data-toggle="dropdown">Old</a>
                            <ul class="dropdown-menu">
                                <li class="{{ (request()->is('issue/old/entry')) ? 'active' : '' }}" data-menu=""><a class="dropdown-item" href="{{route('purchase.warranty.service-requested')}}" data-i18n="Requested Service" data-toggle="dropdown">Individual Issue Form</a></li>
                            </ul>


                    </ul>
                </li>
            @endif
        </ul>
    </div>
    <!-- /horizontal menu content-->
</div>
<!-- END: Main Menu-->


