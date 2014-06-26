
    <div class="navbar-inner">
        <div class="container">





            @if (Auth::check())
            <p id="username"><span class="glyphicon glyphicon-user"></span> {{Auth::user()->username}}</p>


            @endif

            @include('admin._partials.navigation')
        </div>
    </div>
