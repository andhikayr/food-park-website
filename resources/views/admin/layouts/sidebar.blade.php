<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('admin/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Food Park</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='fas fa-bars'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li class="menu-label">Pengaturan Menu Homepage</li>

        <li>
            <a href="{{ route('admin.slider.index') }}">
                <div class="parent-icon"><i class='fas fa-list'></i>
                </div>
                <div class="menu-title">Slider Produk</div>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.why-choose-us.index') }}">
                <div class="parent-icon"><i class='fas fa-list'></i>
                </div>
                <div class="menu-title">"Mengapa Memilih Kita"</div>
            </a>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='fas fa-utensils'></i>
                </div>
                <div class="menu-title">Kelola Restoran</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.product-category.index') }}"><i class="bx bx-right-arrow-alt"></i>Kategori Produk</a>
                </li>
                <li> <a href="{{ route('admin.product.index') }}"><i class="bx bx-right-arrow-alt"></i>Daftar Produk</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='fas fa-shopping-bag'></i>
                </div>
                <div class="menu-title">Kelola E-Commerce</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.coupon.index') }}"><i class="bx bxs-coupon"></i>Kupon</a>
                </li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</div>
