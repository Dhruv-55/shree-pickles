   <!-- Menu -->

   <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{{ route('admin-dashboard')}}" class="app-brand-link" style="justify-content:center">
        <img src="{{ env('LOCAL_URL') }}/logo.jpg" alt="" style="width:50%">
        {{-- <span class="app-brand-text demo menu-text fw-bolder ms-2">Test</span> --}}
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item active">
        <a href="{{ route('admin-dashboard') }}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-admin"></i>
          <div data-i18n="Layouts">Category</div>
        </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="{{ route('admin-category-view')}}" class="menu-link">
                <div data-i18n="Without menu">View</div>
              </a>
            </li>
          </ul>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-admin"></i>
          <div data-i18n="Layouts">Brand</div>
        </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="{{ route('admin-brand-view')}}" class="menu-link">
                <div data-i18n="Without menu">View</div>
              </a>
            </li>
          </ul>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-admin"></i>
          <div data-i18n="Layouts">Product</div>
        </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="{{ route('admin-product-view')}}" class="menu-link">
                <div data-i18n="Without menu">View</div>
              </a>
            </li>
           
          </ul>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-admin"></i>
          <div data-i18n="Layouts">Order</div>
        </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="{{ route('admin-order-view')}}" class="menu-link">
                <div data-i18n="Without menu">View</div>
              </a>
            </li>
           
          </ul>
      </li>
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-admin"></i>
          <div data-i18n="Layouts">Banner</div>
        </a>
          <ul class="menu-sub">
            <li class="menu-item">
              <a href="{{ route('admin-banner-view')}}" class="menu-link">
                <div data-i18n="Without menu">View</div>
              </a>
            </li>
           
          </ul>
      </li>
    </ul>
  </aside>
  <!-- / Menu -->