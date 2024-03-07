@php
    use Illuminate\Support\Facades\Auth;
    use App\Helper\Functions;
@endphp

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route("admin.user.index") }}">MY APP
        <span class="first-name">@if(Auth::check())({{ Auth::user() -> first_name }})@endif</span>
    </a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0 w-100 justify-content-end">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if(Auth::check())
                    <img style="width: 35px; border-radius: 50%"
                         src="{{ Functions::getImage("user", Auth::user() -> picture) }}">
                    <span class="first-name">{{ Auth::user() -> first_name }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route("authAdmin.logout") }}">Đăng xuất</a>
            </div>
        </li>
    </ul>
</nav>
<style>
    .first-name{
        font-size: 14px;
        opacity: .7;
    }
</style>
