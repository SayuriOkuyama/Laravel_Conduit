<nav class="navbar navbar-light">
  <div class="container">
    <a class="navbar-brand" href="{{ route('conduit.index') }}">conduit</a>
    <ul class="nav navbar-nav pull-xs-right">
      <li class="nav-item">
        <!-- Add "active" class when you're on that page" -->
        <a class="nav-link active" href="{{ route('conduit.index') }}">Home</a>
      </li>
      @auth
        <li class="nav-item">
          <a class="nav-link" href="{{ route('conduit.create') }}"> <i class="ion-compose"></i>&nbsp;New Article </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/settings"> <i class="ion-gear-a"></i>&nbsp;Settings </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/profile/eric-simons">
            <img src="" class="user-pic" />
            Eric Simons
          </a>
        </li>
      @else
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Sign in</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">Sign up</a>
        </li>
      @endauth
    </ul>
  </div>
</nav>
