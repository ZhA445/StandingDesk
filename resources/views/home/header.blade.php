<header>
    <div class="nav-bar">
        <input type="checkbox" name="searchbar" id="searchbar">
        <input type="checkbox" name="menubtn" id="menubtn">
        <div class="logo-group" id="logo-group">
            <div>
                <p class="logo-name-1">Standing</p>
                <p class="logo-name-2">Desk</p>
            </div>
        </div>

        <nav class="nav align-items-center">
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{url('/shop')}}">Shop</a></li>
                <li><a href="{{url('/benefit')}}">Benefits</a></li>
                <li><a href="{{url('/contact')}}">Contact</a></li>
                <li><a href="{{ url('/show_order') }}">Order</a></li>
            </ul>
            @if (Route::has('login'))
                @auth
                    <x-app-layout>

                    </x-app-layout>
                @else
                    <li><a href="{{ route('login') }}" class="btn btn-primary" id="logincss">Login</a></li>
                    <li><a href="{{ route('register') }}" class="btn btn-success" id="registercss">Register</a></li>
                @endauth
            @endif
        </nav>

        <div class="nav-icon">
            <form action="{{url('/products/search')}}" method="GET">
                @csrf
                <input type="text" name="search" id="search" placeholder="Search">
                <button type="submit" id="searchicon" class="nav-icon2"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <label for="menubtn" class="nav-icon1" id="nav-icon1"><i class="fa-solid fa-bars"></i></label>

            <a href="{{ url('/cart') }}" class="nav-icon3"><i class="fa-solid fa-cart-shopping"></i></a>

        </div>

    </div>
</header>
