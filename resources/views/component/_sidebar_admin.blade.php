
        <ul class="navbar-nav bg-orange-sidebar sidebar sidebar-dark accordion" id="accordionSidebar">

          <!-- Sidebar - Brand -->
          <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
              <div class="sidebar-brand-icon">
                  <i class="fas fa-shopping-cart"></i>
              </div>
              <div class="sidebar-brand-text mx-3">Smart Kiosk <sup>Dashboard</sup></div>
          </a>

          <!-- Divider -->
          <hr class="sidebar-divider">

          <!-- Heading -->
          <div class="sidebar-heading">
              Master Data
          </div>

          
          <li class="nav-item {{ request()->is('superadmin/smart*') ? 'active' : ''  }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseZero"
                aria-expanded="true" aria-controls="collapseZero">
                <i class="fas fa-chart-line"></i>
                <span>Overview</span>
            </a>
            <div id="collapseZero" class="collapse 
            {{ request()->is('superadmin/smart**') ? 'show' : ''  }}"
            >
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ request()->is('superadmin/smart-canteen*') ? 'active' : ''  }}" href="{{ route('superadmin.smart_canteen.index') }}">Smart Canteen</a>
                    <a class="collapse-item {{ request()->is('superadmin/smart-parking*') ? 'active' : ''  }}" href="{{ route('superadmin.smart_parking.index') }}">Smart Parking</a>
                </div>
            </div>
        </li>
          <li class="nav-item 
          {{-- {{ request()->is('superadmin/canteen*') ? 'active' : ''  || request()->is('superadmin/category*') ? 'active' : ''  }} --}}
          ">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                  aria-expanded="true" aria-controls="collapseTwo">
                  <i class="fas fa-chart-line"></i>
                  <span>Canteen</span>
              </a>
              <div id="collapseTwo" class="collapse 
              {{-- {{ request()->is('superadmin/canteen*') ? 'show' : ''  || request()->is('superadmin/category*') ? 'show' : ''  }} --}}
              ">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item {{ request()->is('superadmin/canteen') ? 'active' : ''  }}" href="{{ route('superadmin.canteen.index') }}">Canteen List</a>
                      <a class="collapse-item {{ request()->is('superadmin/canteen/create') ? 'active' : ''  }}" href="{{ route('superadmin.canteen.create') }}">Add New Canteen</a>
                      <a class="collapse-item {{ request()->is('superadmin/category*') ? 'active' : ''  }} {{ request()->is('superadmin/categories*') ? 'active' : ''  }}" href="{{ route('superadmin.category.index') }}">Categories</a>
                  </div>
              </div>
          </li>
          <li class="nav-item {{ request()->is('superadmin/parking-spot*') ? 'active' : ''  }}">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                  aria-expanded="true" aria-controls="collapseThree">
                  <i class="fas fa-chart-line"></i>
                  <span>Parking</span>
              </a>
              <div id="collapseThree" class="collapse 
              {{-- {{ request()->is('superadmin/parking-spot*') ? 'show' : ''  }} --}}
              ">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item {{ request()->is('superadmin/parking-spot') ? 'active' : ''  }}" href="{{ route('superadmin.parking_spot.index') }}">Parking Spot</a>
                      <a class="collapse-item {{ request()->is('superadmin/parking-spot/create') ? 'active' : ''  }}" href="{{ route('superadmin.parking_spot.create') }}">Add New Parking</a>
                  </div>
              </div>
          </li>
          <li class="nav-item 
          {{-- {{ request()->is('superadmin/client*') ? 'active' : '' || request()->is('superadmin/admin*') ? 'active' : '' || request()->is('superadmin/user*') ? 'active' : ''  }} --}}
          ">
              <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
                  aria-expanded="true" aria-controls="collapseFour">
                  <i class="fas fa-chart-line"></i>
                  <span>Superadmin</span>
              </a>
              <div id="collapseFour" class="collapse 
              {{-- {{ request()->is('superadmin/client*') ? 'show' : '' || request()->is('superadmin/admin*') ? 'show' : '' || request()->is('superadmin/user*') ? 'show' : ''  }} --}}
              ">
                  <div class="bg-white py-2 collapse-inner rounded">
                      <a class="collapse-item {{ request()->is('superadmin/client') ? 'active' : ''  }}" href="{{ route('superadmin.client.index') }}">Add New Client</a>
                      <a class="collapse-item {{ request()->is('superadmin/admin') ? 'active' : ''  }}" href="{{ route('superadmin.admin.index') }}">Add New Admin</a>
                      <a class="collapse-item {{ request()->is('superadmin/user') ? 'active' : ''  }}" href="{{ route('superadmin.student.index') }}">Add New User</a>
                  </div>
              </div>
          </li>

      </ul>