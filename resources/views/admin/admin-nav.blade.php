@extends('nav.nav')

@section('extra')
    @auth('web')
        @if (Auth::user()->role_id == 1)
            <div class="container-fluid- mx-5" style="margin-top: 80px">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.speciality') ? 'active' : '' }}"
                            href="{{ route('admin.speciality') }}">Добавить специалиста</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.doctor') ? 'active' : '' }}"
                            href="{{ route('admin.doctor') }}">Добавить врача</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.timetable') ? 'active' : '' }}"
                            href="{{ route('admin.timetable') }}">Добавить расписание</a>
                    </li>
                </ul>
                @yield('admin-extra')
            </div>
        @else
            <div class="form-text text-danger" style="margin-top: 100px">Страница доступна только администраторам</div>
        @endif
    @endauth
@endsection
