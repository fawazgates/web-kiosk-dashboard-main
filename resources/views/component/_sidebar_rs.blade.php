<style>
  li.active * {
    color: black !important;
    font-weight: bold !important;
  }
</style>
    <div class="sidebar" data-color="dark">
        <!--
        Tip 1: You can change the color of the fdebar using: data-color="blue | green | orange | red | yellow"
        -->
      <div class="logo">
        <a href="/" class="text-white logo-mini">
        </a>
        <a href="/" class="text-white logo-normal"> 
          Aplikasi Ulaweng
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li class="{{ request()->is('rs/dashboard*') ? 'active' : ''  }}">
            <a href="{{ route('rs.dashboard.index') }}">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="{{ request()->is('rs/tren*') ? 'active' : ''  }}">
            <a href="{{ route('rs.tren_pelayanan.hak_kelas_kns.index') }}">
              <i class="now-ui-icons tech_mobile"></i>
              <p>Tren Pelayanan</p>
            </a>
          </li>
          <li class="{{ request()->is('rs/k-kns*') ? 'active' : ''  }}">
            <a href="{{ route('rs.kronis_kns.index') }}">
              <i class="now-ui-icons tech_mobile"></i>
              <p>Pasien Kronis</p>
            </a>
          </li>
          <li class="{{ request()->is('rs/d-kns?level=normal*') ? 'active' : ''  }}">
            <a href="{{ route('rs.diagnosa_kns.index', 'level=normal') }}">
              <i class="now-ui-icons tech_mobile"></i>
              <p>Diagnosa KNS</p>
            </a>
          </li>
          
          <li class="{{ request()->is('rs/d-kns?level=tertinggi*') ? 'active' : ''  }}">
            <a href="{{ route('rs.diagnosa_kns.index', 'level=tertinggi') }}">
              <i class="now-ui-icons tech_mobile"></i>
              <p>Diagnosa Tertinggi</p>
            </a>
          </li>
          
          <li class="{{ request()->is('rs/d-kns?level=terbanyak*') ? 'active' : ''  }}">
            <a href="{{ route('rs.diagnosa_kns.index', 'level=terbanyak') }}">
              <i class="now-ui-icons tech_mobile"></i>
              <p>Diagnosa Terbanyak</p>
            </a>
          </li>
          
          <li class="{{ request()->is('rs/ina-kns*') ? 'active' : ''  }}">
            <a href="{{ route('rs.inacbgs_kns.index') }}">
              <i class="now-ui-icons tech_mobile"></i>
              <p>Inacbgs Tertinggi</p>
            </a>
          </li>
        </ul>
      </div>
    </div>