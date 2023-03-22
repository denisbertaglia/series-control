<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Save the series</title>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div class="container">
        <header class="blog-header lh-1 py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">

                    @if (Route::has('login'))
                    <div class="">
                        @auth
                        <a href="{{ url('/dashboard') }}" class="text-secondary">Dashboard</a>
                        @else

                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-secondary">Register</a>
                        @endif
                        @endauth
                    </div>
                    @endif
                </div>
                <div class="col-4 text-center">
                    <a class=" text-dark" href="#">
                        <x-application-logo style="width: 72px;height:57px" class="m-auto mb-2" />
                    </a>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    @if (Route::has('login'))
                    @guest
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}">
                        Sign up
                    </a>
                    @endguest
                    @auth
                    <form method="POST" action="{{ route('logout') }}" class="">
                        @csrf
                        <button class="btn btn-sm btn-outline-danger">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                    @endauth
                    @endif
                </div>
            </div>
        </header>
    </div>
    <div class="container py-4">
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Save the series</h1>
                <p class="col-md-8 fs-4">
                    Ideal for series lovers who want to keep track of their binge-watching in an easy and secure way.
                </p>
            </div>
        </div>
    </div>
    <div class="container">

        <!-- START THE FEATURETTES -->

        <hr class="my-5">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">
                    Streamline your binge-watching with
                    <span class="text-muted">
                        efficient organization.
                    </span>
                </h2>
                <p class="lead">
                    The platform is perfect for series lovers who want to keep track of their binge-watching. It allows
                    users to store and organize their favorite series, making it easier to keep track of what they are
                    watching.
                </p>
            </div>
            <div class="col-md-5">
                <img src="{{asset('img/save.svg')}}" class="img-fluid rounded" alt="Save form" />
            </div>
        </div>

        <hr class="my-5">

        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading fw-normal lh-1">
                    Simplify your TV show progress with
                    <span class="text-muted">
                        easy tracking
                    </span>.
                </h2>
                <p class="lead">
                    The platform makes it simple to track progress within each season. Users can mark
                    episodes as watched, making it easy to remember which episodes they have already seen and which ones
                    they still need to watch.
                </p>
            </div>
            <div class="col-md-5 order-md-1">
                <img src="{{asset('img/progress.svg')}}" class="img-fluid rounded" alt="Checklist" />
            </div>
        </div>

        <hr class="my-5">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">Protect your privacy with enhanced <span
                        class="text-muted">security features</span>.
                </h2>
                <p class="lead">
                    Privacy is a top priority, ensuring that users' personal information is protected and secure. This
                    feature is essential for users who value their privacy and want to keep their information safe.
                </p>
            </div>
            <div class="col-md-5">
                <img src="{{asset('img/secure.svg')}}" class="img-fluid rounded" alt="Login form" />
            </div>
        </div>

        <!-- /END THE FEATURETTES -->

        <footer class="pt-3 mt-4 text-muted border-top">
            © {{
            (new \DateTime())->format('Y')
            }}
        </footer>
    </div><!-- /.container -->

</body>

</html>
