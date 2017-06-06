@include('fragments.single_page_head')
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @if (Auth::check())
                <a href="{{ url('/user/dashboard') }}">Dashboard</a>
            @else
                <a href="{{ url('/login') }}">Login</a>
                <a href="{{ url('/register') }}">Register</a>
            @endif
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            Sales Invoicing & Stock Control
        </div>

        <div class="links">
            <a href="https://github.com/StefanoFrazzetto/GradedUnit2" target="_blank">Documentation</a>
            <a href="https://github.com/StefanoFrazzetto/SISC" target="_blank">Repository</a>
        </div>
    </div>
</div>
@include('fragments.footer')