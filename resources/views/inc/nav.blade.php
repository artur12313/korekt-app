<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            Korekt s.c.
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown03" 
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Towary i usługi</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown03">
                        <a class="dropdown-item" href="{{url('/kategorie')}}">Kategorie</a>
                        <a class="dropdown-item" href="{{url('/products')}}">Produkty</a>
                        <a class="dropdown-item" href="{{url('/klienci')}}">Klienci</a>
                        <a class="dropdown-item" href="{{url('/zamowienia')}}">Zamówienia</a>                        
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown03" 
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mój biznes</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown03">
                        <a class="dropdown-item" href="{{url('/klienci')}}">Lista klientów</a>
                        <a class="dropdown-item" href="{{url('/sprzedaz')}}">Sprzedaż</a>
                        <a class="dropdown-item" href="{{url('/oferta')}}">Oferta</a>
                        <a class="dropdown-item" href="{{url('/pracownicy')}}">Pracownicy</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown03" 
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Archiwum</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown03">
                        <a class="dropdown-item" href="{{url('/archiwum')}}">Klienci</a>
                        <a class="dropdown-item" href="{{url('/zamowienia-archiwum')}}">Zamówienia</a>
                        <a class="dropdown-item" href="{{url('/kategorie-archiwum')}}">Kategorie</a>
                        <a class="dropdown-item" href="{{url('/produkty-archiwum')}}">Produkty</a>
                    </div>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Zaloguj') }}</a></li>
                @else

                <div class="media">
                        <img class="rounded-circle" src="/images/avatars/{{Auth::user()->avatar}}" alt="Generic placeholder image" width="38" height="38">
                        
                      </div>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('/profil')}}">Edytuj profil</a>
                        <a class="dropdown-item" href="{{url('/changePassword')}}">Zmiana hasła</a>
                        <hr>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Wyloguj') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>