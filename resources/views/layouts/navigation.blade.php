<!-- Navbar with Sidebar Toggle Button -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <button id="sidebarToggle" class="sidebarToggle btn btn-light d-lg-none">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
        <a class="navbar-brand d-lg-none d-inline-block" href="{{ route('dashboard') }}">BookShelf</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Profile
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">My Profile</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            @persist('search')
                <form>
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                </form>
            @endpersist
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div id="sidebar" class="pt-lg-3 pt-2">
    <div class="px-3 d-flex align-items-center justify-content-lg-start justify-content-end">
        <a class="d-lg-block d-none btn btn-outline-dark" href="{{ route('dashboard') }}">BookShelf</a>
        <button id="sidebarToggle" class=" sidebarToggle btn btn-light d-lg-none">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    <ul class="nav flex-column p-lg-3">
        <li class="nav-item">
            <a wire:navigate.hover
                class="nav-link {{ Route::is('dashboard') || Route::is('bookDetail') ? 'active' : '' }}"
                href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
        </li>
        <li class="nav-item ">
            <a wire:navigate.hover class="nav-link {{ Route::is('favourite') ? 'active' : '' }}"
                href="{{ route('favourite') }}" href="{{ route('favourite') }}"><i class="fas fa-heart"></i> Favorited
                Books</a>
        </li>
        <li class="nav-item">
            <a wire:navigate.hover class="nav-link {{ Route::is('categories.*') ? 'active' : '' }}"
                href="{{ route('categories.index') }}">
                <i class="fas fa-list"></i> Categories
            </a>
        </li>

        <li class="nav-item">
            <a wire:navigate.hover class="nav-link {{ Route::is('records.index') ? 'active' : '' }}"
                href="{{ route('records.index') }}">
                <i class="fas fa-money-bill-alt"></i> Records
            </a>
        </li>
    </ul>
</div>
