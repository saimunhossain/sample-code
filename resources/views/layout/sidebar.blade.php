<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      Admin <span></span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">

      <li class="nav-item nav-category">Main</li>

      {{-- <li class="nav-item {{ active_class(['/dashboard']) }}"> --}}
      <li class="nav-item">
        <a href="" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item nav-category">web apps</li>

        <li class="nav-item {{ request()->is('administrator/product') ? 'active' : '' }}">
            <a href="{{route('product')}}" class="nav-link">
                <i class="link-icon" data-feather="book"></i>
                <span class="link-title">Product</span>
            </a>
        </li>
    </ul>
  </div>
</nav>
