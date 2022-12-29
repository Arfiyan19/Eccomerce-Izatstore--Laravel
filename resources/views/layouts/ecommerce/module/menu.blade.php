<ul class="nav navbar-nav center_nav pull-center">
    <li class="nav-item {{Request::path() == '/' ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('front.index') }}">Beranda</a>
    </li>
    <li class="nav-item {{Request::path() == 'product' ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('front.product') }}">Produk</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('front.feed')}}">Feed</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('front.galeri') }}">Galeri </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('front.bantuanPelanggan') }}">Bantuan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('front.about') }}">Tentang</a>
    </li>

    <!--<li class="nav-item submenu dropdown">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kategori</a>
        <ul class="dropdown-menu">
            <li class="nav-item">
                <a class="nav-link" href="">Shop Category</a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">Contact</a>
    </li> -->
</ul>
