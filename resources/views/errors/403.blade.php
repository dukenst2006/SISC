@include('fragments.single_page_head')
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Sorry, you can't access this page
        </div>

        <div class="links">
            @if (!Auth::check())
                @if (Route::has('register') && Route::has('login'))
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endif
            <a href="/">Homepage</a>
        </div>
    </div>
</div>
@include('fragments.footer')