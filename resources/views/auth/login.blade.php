<x-head />

<body>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <div class="auth-page">
    <div class="container page">
      <div class="row">
        <div class="col-md-6 offset-md-3 col-xs-12">
          <h1 class="text-xs-center">Sign in</h1>
          <p class="text-xs-center">
            <a href="/register">Need an account?</a>
          </p>

          <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <fieldset class="form-group">
              <input id="email" class="form-control form-control-lg" placeholder="Email" type="email"
                name="email" :value="old('email')" required autofocus autocomplete="username" />
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </fieldset>

            <!-- Password -->
            <fieldset class="form-group">
              <x-input-error :messages="$errors->get('password')" class="mt-2" />
              <input id="password" class="form-control form-control-lg" type="password" name="password" required
                autocomplete="current-password" placeholder="Password" />
            </fieldset>

            <div class="flex items-center justify-end mt-4">
            </div>
            <button class="btn btn-lg btn-primary pull-xs-right">{{ __('Sign in') }}</button>

          </form>
        </div>
      </div>
    </div>
  </div>
  <x-footer />
</body>

</html>
