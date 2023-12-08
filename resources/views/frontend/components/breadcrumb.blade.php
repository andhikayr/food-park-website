<!--=============================
        BREADCRUMB START
    ==============================-->
<section class="fp__breadcrumb" style="background: url({{ asset('frontend/images/counter_bg.jpg') }});">
    <div class="fp__breadcrumb_overlay">
        <div class="container">
            <div class="fp__breadcrumb_text">
                <h1>@yield('title')</h1>
                <ul>
                    <li><a href="{{ url('/') }}">home</a></li>
                    <li class="text-white">@yield('title')</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--=============================
        BREADCRUMB END
    ==============================-->
