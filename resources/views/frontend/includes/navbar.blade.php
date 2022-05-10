{{-- Header --}}
<header id="header" data-fullwidth="true">
    <div class="header-inner">
        <div class="container">
            {{-- Logo --}}
            <div id="logo"> <a href="{{ route('home') }}"><span class="logo-default"><img src="{{ asset('frontend/images/logo.png') }}" style="max-width: 60px"></span><span class="logo-dark"><img src="{{ asset('frontend/images/logo.png') }}" style="max-height: 50%"></span></a> </div>
            {{-- End: Logo --}}

            {{-- Navigation Resposnive Trigger --}}
            <div id="mainMenu-trigger"> <a class="lines-button x"><span class="lines"></span></a> </div>
            {{-- end: Navigation Resposnive Trigger --}}
            {{-- Navigation --}}
            <div id="mainMenu">
                <div class="container">
                    <nav>
                        <ul>
                            <li><a href="{{ route('home') }}">Trading House</a></li>
                            @guest
                                <li><a href="{{ route('login') }}">Login</a></li>
                                <li><a href="{{ route('register') }}">Register</a></li>
                            @endguest
                            @auth()
                                <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            @endauth
                        </ul>
                    </nav>
                </div>
            </div>
            {{-- end: Navigation --}}
        </div>
    </div>
</header>
{{-- end: Header --}}
