@include('fragments.single_page_head')
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title m-b-md">
            Sorry, we couldn't find that page
        </div>

        <div class="links">
            @if (Route::has('dashboard') && Auth::check())
                <a href="{{ route('dashboard') }}">Dashboard</a>
            @endif
            <a href="/">Homepage</a>
        </div>
    </div>
</div>
@include('fragments.footer')