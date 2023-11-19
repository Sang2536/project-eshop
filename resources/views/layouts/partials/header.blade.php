<!-- Navbar -->
<nav id="main-navbar" class="navbar navbar-expand-lg navbar-white bg-danger fixed-top">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="{{ route('dashboards.index') }}">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/08/No_Logo_logo.svg/1280px-No_Logo_logo.svg.png" height="25" alt="Logo" loading="lazy" />
        </a>

        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
            <!-- Notification dropdown -->
            <li class="nav-item dropdown mx-1">
                <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow"  href="#" id="dropdownNotification" role="button" data-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    <span class="badge rounded-pill badge-notification bg-danger">1</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownNotification">
                    <li><a class="dropdown-item" href="#">Some news</a></li>
                    <li><a class="dropdown-item" href="#">Another news</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li>

            <!-- Icon dropdown -->
            <li class="nav-item dropdown mx-1">
                <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="dropdownLanguage" role="button" data-toggle="dropdown"  aria-expanded="false">
                    {{-- <i class="flag-united-kingdom flag m-0"></i> --}}
                    <i class="fa fa-flag" aria-hidden="true"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownLanguage">
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="flag-united-kingdom flag"></i>
                            English
                            <i class="fa fa-check text-success ms-2"></i>
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider" />
                    </li>

                    <li>
                        <a class="dropdown-item" href="#"><i class="flag-vietnam flag"></i>Vietnam</a>
                    </li>

                    <li class="bg-success">
                        <a class="dropdown-item" href="#"><i class="flag-united-kingdom flag"></i>English</a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#"><i class="flag-poland flag"></i>Polski</a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#"><i class="flag-china flag"></i>中文</a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#"><i class="flag-japan flag"></i>日本語</a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#"><i class="flag-germany flag"></i>Deutsch</a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#"><i class="flag-france flag"></i>Français</a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#"><i class="flag-spain flag"></i>Español</a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#"><i class="flag-russia flag"></i>Русский</a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#"><i class="flag-portugal flag"></i>Português</a>
                    </li>
                </ul>
            </li>

            <!-- Avatar -->
            <li class="nav-item dropdown mx-1">
                <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#" id="dropdownMenuUser" role="button" data-toggle="dropdown" aria-expanded="false">
                    {{-- <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp" class="rounded-circle" height="22" alt="Avatar" loading="lazy" /> --}}
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuUser">
                    <li>
                        <a class="dropdown-item" href="{{ route('user.profile', auth()->user()->id) }}">My profile</a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('user.setting', auth()->user()->id) }}">Settings</a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('logout-user') }}">Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->
