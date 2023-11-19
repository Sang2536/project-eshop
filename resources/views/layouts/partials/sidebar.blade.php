<!-- Sidebar -->
<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white w-30">
    <div class="position-sticky">
        <div class="list-group list-group-flush mt-3">
            <a href="{{ route('dashboards.index') }}" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
            </a>
            <a href="{{ route('home.index') }}" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                <i class="fas fa-home fa-fw me-3"></i><span>Home</span>
            </a>
            <a href="{{ route('analytics.index') }}" class="list-group-item list-group-item-action py-2 ripple">
                <i class="fas fa-chart-line fa-fw me-3"></i><span>Analytics</span>
            </a>
            <a href="{{ route('contacts.index') }}" class="list-group-item list-group-item-action py-2 ripple">
                <i class="fas fa-address-book fa-fw me-3"></i><span>Contacts</span>
            </a>
            <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action py-2 ripple active">
                <i class="fas fa-list-alt fa-fw me-3"></i><span>Categories</span>
            </a>
            <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action py-2 ripple">
                <i class="fab fa-product-hunt fa-fw me-3"></i><span>Products</span>
            </a>
            <a href="{{ route('units.index') }}" class="list-group-item list-group-item-action py-2 ripple active">
                <i class="fas fa-list-alt fa-fw me-3"></i><span>Units</span>
            </a>

            @can('administrator')
                <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-users fa-fw me-3"></i><span>Users</span>
                </a>
                <a href="{{ route('roles.index') }}" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="fas fa-balance-scale fa-fw me-3"></i><span>Roles</span>
                </a>
            @endcan

            <a href="{{ route('transactions.index') }}" class="list-group-item list-group-item-action py-2 ripple">
                <i class="fa-solid fa-hand-holding-dollar me-3"></i><span>Transactions</span>
            </a>
            <a href="{{ route('invoce-discounts.index') }}" class="list-group-item list-group-item-action py-2 ripple">
                <i class="fa-solid fa-tags fa-fw me-3"></i><span>Invoice discount</span>
            </a>
            <a href="{{ route('reports.index') }}" class="list-group-item list-group-item-action py-2 ripple">
                <i class="fa-solid fa-file fa-fw me-3"></i><span>Reports</span>
            </a>
            <a href="{{ route('configs.index') }}" class="list-group-item list-group-item-action py-2 ripple">
                <i class="fas fa-cog fa-fw me-3"></i><span>Config website</span>
            </a>
      </div>
    </div>
  </nav>
  <!-- Sidebar -->
