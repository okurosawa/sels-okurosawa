<div class="top-gradation-border">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel shadow">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="{{ url('/admin/home') }}">
                {{ config('app.name', 'E-Learning') }} - Admin
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
    
                </ul>
    
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @auth('admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.home') }}">{{ __('Categories') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.list') }}">{{ __('Admin List') }}</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->first_name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            @auth
                                <a class="nav-link" href="{{ route('home') }}">{{ __('Back to User dashboard') }}</a>
                            @else
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login as User') }}</a>
                            @endauth
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</div>
