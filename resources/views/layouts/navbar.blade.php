<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container-fluid d-flex">
        <a class="navbar-brand" href="/">XiAO DiNGDoNG</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 d-flex align-items-center justify-content-sm-between">
                <div class="d-flex w-100 align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">Home</a>
                    </li>

                    {{-- USER --}}
                    @if (Auth::user() && Auth::user()->role == 'Xiao User')
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/search">Search Food</a>

                            <div class="d-flex">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/cart">Cart</a>
                        </li>
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <div class="nav-link dropdown-toggle d-flex align-items-center" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <div style="margin-right: 10px">
                                        Welcome, {{ Auth::user()->username }}
                                    </div>
                                    <div>
                                        <img src="{{ asset('storage/images/'.Auth::user()->profile_picture) }}" alt="aaaa" style="width: 30px; border-radius: 25px; margin-right: 10px">
                                    </div>
                                </div>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/profile">Profile</a></li>
                                    <li><a class="dropdown-item" href="/history">Transaction History</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="/logout">Sign out</a></li>
                                </ul>
                            </li>
                        </ul>
                </div>
                </li>

                {{-- ADMIN --}}
            @elseif(Auth::user() && Auth::user()->role == 'Admin')
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/addNewFood">Add New Food</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/search">Manage Food</a>
                </li>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <div class="nav-link dropdown-toggle d-flex align-items-center" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <div style="margin-right: 10px">
                                Welcome, {{ Auth::user()->username }}
                            </div>
                            <div>
                                <img src="{{ asset('storage/images/'.Auth::user()->profile_picture) }}" alt="aaaa" style="width: 30px; border-radius: 25px; margin-right: 10px">
                            </div>
                        </div>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/profile">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/logout">Sign Out</a></li>
                        </ul>
                    </li>
                </ul>

                {{-- GUEST --}}
            @else
                <div class="d-flex w-100 justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/register">Register</a>
                    </li>
                </div>
            @endauth



    </div>
</div>
</nav>
