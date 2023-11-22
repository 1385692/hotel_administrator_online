<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('customer_home') }}">Customer Panel</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('customer_home') }}"></a>
        </div>

        <ul class="sidebar-menu">

            <li class="{{ Request::is('customer/home') ? 'active' : '' }}"><a class="nav-link" href="{{ route('customer_home') }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Dashboard"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
            
            <li class="{{ Request::is('customer/order/view') || Request::is('customer/invoice/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('customer_order_view') }}" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Órdenes"><i class="fa fa-cart-plus"></i> <span>Orders</span></a></li>

            {{-- <li class="nav-item dropdown {{ Request::is('customer/amenity/view')||Request::is('customer/room/view') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fa fa-hand-o-right"></i><span>Room Section</span></a>
                <ul class="dropdown-menu">
                    <li class={{ Request::is('customer/amenity/view') ? 'active' : '' }}><a class="nav-link" href="{{ route('customer_amenity_view') }}"><i class="fa fa-angle-right"></i> Amenities</a></li>
                    
                    <li class="{{ Request::is('customer/room/view') ? 'active' : '' }}"><a class="nav-link" href="{{ route('customer_room_view') }}"><i class="fa fa-angle-right"></i> Rooms</a></li>
                    
                </ul>
            </li> --}}

            
        </ul>
    </aside>
</div>