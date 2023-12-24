<x-head />

<body>
  <div class="auth-page">
    <div class="container page">
      <div class="row">
        <div class="col-md-6 offset-md-3 col-xs-12">
          <h1 class="text-xs-center">Sign up</h1>
          <p class="text-xs-center">
            <a href="/login">Have an account?</a>
          </p>

          <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <fieldset class="form-group">
              <input class="form-control form-control-lg" type="text" placeholder="Username" id="name"
                class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus
                autocomplete="name" />
              <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </fieldset>

            <!-- Email Address -->
            <fieldset class="form-group">
              <input class="form-control form-control-lg" type="text" placeholder="Email" id="email"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </fieldset>

            <!-- Password -->
            <fieldset class="form-group">
              <input class="form-control form-control-lg" type="password" placeholder="Password" id="password"
                type="password" name="password" required autocomplete="new-password" />
              <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </fieldset>

            <!-- Confirm Password -->
            <fieldset class="form-group">
              <input class="form-control form-control-lg" type="password" placeholder="Confirm Password" id="Confirm"
                type="password" name="password_confirmation" required autocomplete="new-password" />
              <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </fieldset>

            <button class="btn btn-lg btn-primary pull-xs-right">{{ __('Sign Up') }}</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <x-footer />
</body>

</html>
