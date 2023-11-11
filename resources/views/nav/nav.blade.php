@extends('default')

@section('content')
    <header>
        <nav class="navbar navbar-expand-md fixed-top navbar-light bg-light">
            <div class="container-fluid mx-3">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ asset('storage/images/logo.png') }}" alt="logo" height="50">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">О нас</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('doctors') ? 'active' : '' }}"
                                href="{{ route('doctors') }}">Специалисты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Отзывы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('appointments') ? 'active' : '' }}"
                                href="{{ route('appointments') }}">Записаться на прием</a>
                        </li>
                        @auth('web')
                            @if (Auth::user()->role_id == 1)
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Администратор</a>
                                </li>
                            @endif
                        @endauth
                        {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li> --}}

                    </ul>
                    <div class="d-flex">
                        @auth('web')
                            <div class="btn-group">
                                <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"
                                    data-bs-display="static" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end">
                                    <li><a class="dropdown-item" href="#">Личный кабинет</a></li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}">Выйти</a></li>
                                </ul>
                            </div>
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="btn btn-light">Войти</a>
                        @endguest

                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid" style="margin-top: 75px">
        @yield('extra')
    </div>
@endsection
