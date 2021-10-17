<aside class="sidebar-nav-wrapper">
    {{-- <div class="navbar-logo">
      <a href="index.html">
        <img src="{{ asset('assets/images/logo/logo.svg') }}" alt="logo" />
      </a>
    </div> --}}
    <nav class="sidebar-nav">
      <ul>
        <li class="nav-item @if($menu == 'home') active @endif">
          <a href="{{ route('home.index') }}">
            <span class="icon">
              <i class="lni lni-home"></i>
            </span>
            <span class="text">Home</span>
          </a>
        </li>
        <li class="nav-item @if($menu == 'status_migrate') active @endif">
          <a href="{{ route('status_migrate.index') }}">
            <span class="icon">
              <i class="lni lni-archive"></i>
            </span>
            <span class="text">Status Migrate</span>
          </a>
        </li>
      </ul>
    </nav>
  </aside>