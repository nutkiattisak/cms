@auth()
    @include('layouts.partial.navs.auth')
@endauth

@guest()
    @include('layouts.partial.navs.guest')
@endguest
