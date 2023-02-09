
        <ul class="navbar-nav bg-orange-sidebar sidebar sidebar-dark accordion" id="accordionSidebar">

          <!-- Sidebar - Brand -->
          <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
              <div class="sidebar-brand-icon">
                  <i class="fas fa-shopping-cart"></i>
              </div>
              <div class="sidebar-brand-text mx-3">Smart Kiosk <sup>Dashboard</sup></div>
          </a>

          <!-- Divider -->
          <hr class="sidebar-divider my-0">

          
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseZero"
                aria-expanded="true" aria-controls="collapseZero">
                <i class="fas fa-chart-line"></i>
                <span>Canteen</span>
            </a>
            <div id="collapseZero" class="collapse ">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ request()->is('admin-canteen/overview*') ? 'active' : ''  }}" href="{{ route('admin_canteen.overview.index') }}">Overview</a>
                    <a class="collapse-item {{ request()->is('admin-canteen/product*') ? 'active' : ''  }}" href="{{ route('admin_canteen.product.create') }}">Add Product</a>
                    {{-- <a class="collapse-item {{ request()->is('admin-canteen/transaction*') ? 'active' : ''  }}" href="{{ route('admin_canteen.transaction.index') }}">Orders</a> --}}
                    <a class="collapse-item {{ request()->is('admin-canteen/report*') ? 'active' : ''  }}" href="{{ route('admin_canteen.report.index') }}">Orders</a>
                </div>
            </div>
        </li>

      </ul>