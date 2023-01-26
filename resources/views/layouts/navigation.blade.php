<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <x-application-logo alt="Bootstrap" width="30" height="24" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <x-nav-link :href="route('dashboard')" class="nav-link" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </li>
                <li class="nav-item">
                    <x-nav-link :href="route('series.index')" class="nav-link" :active="request()->routeIs('series.index')">
                        {{ __('Series') }}
                    </x-nav-link>
                </li>
                <li class="navbar-text d-lg-none border-top fw-semibold ">
                        {{ Auth::user()->name }}
                       - {{ Auth::user()->email }}
                </li>
                <li class="nav-item d-lg-none">
                    <a class="nav-link" href="{{route('profile.edit')}}">{{ __('Profile') }}</a>
                </li>
                <li class="nav-item d-lg-none">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" class="">
                        @csrf
                        <button class="btn nav-link pt-1">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </li>

            </ul>
            <div class="dropdown d-none d-lg-block">
                <a class="btn btn-outline-secondary btn-sm dropdown-toggle" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu">
                    <li class="d-lg-none">
                        <span class="dropdown-header">
                            <div class="nav-link">{{ Auth::user()->name }}</div>
                            <div class="nav-link">{{ Auth::user()->email }}</div>
                        </span>
                    </li>
                    <li><a class="dropdown-item" href="{{route('profile.edit')}}">{{ __('Profile') }}</a></li>
                    <li>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" class=" dropdown-item nav-link">
                            @csrf
                            <button class="btn dropdown-item ">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</nav>
