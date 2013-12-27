<form method="POST" action="{{{ (Confide::checkAction('UserController@store')) ?: URL::to('user')  }}}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
    <fieldset>
        <legend>{{ Lang::get('site.common') }}</legend>
        <div class="form-group">
            <label for="username">{{{ Lang::get('confide::confide.username') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.username') }}}" type="text" name="username" id="username" value="{{{ Input::old('username') }}}">
        </div>
        <div class="form-group">
            <label for="email">{{{ Lang::get('confide::confide.e_mail') }}} <small>{{ Lang::get('confide::confide.signup.confirmation_required') }}</small></label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
        </div>
        <div class="form-group">
            <label for="password">{{{ Lang::get('confide::confide.password') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{{ Lang::get('confide::confide.password_confirmation') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
        </div>
         <div class="form-group">
            <label for="day_of_birth">{{{ Lang::get('form.day_of_birth') }}}</label>
            <input class="form-control js__birthdaypicker" placeholder="{{{ Lang::get('form.day_of_birth') }}}" type="text" name="day_of_birth" id="day_of_birth">
        </div>

    </fieldset>
    <fieldset>
        <legend>{{{Lang::get('site.business')}}}</legend>

        <div class="form-group">
            <label for="company">{{{ Lang::get('site.company') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('site.company') }}}" type="text" name="company" id="company" value="{{{ Input::old('company') }}}">
        </div>
        <div class="form-group">
            <label for="kvk">{{{ Lang::get('site.kvknr') }}}</label>
            <input class="form-control" placeholder="{{{ Lang::get('site.kvknr') }}}" type="text" name="kvknr" id="kvknr" value="{{{ Input::old('kvknr') }}}">
        </div>

    </fieldset>
    <fieldset>

         @if ( Session::get('error') )
            <div class="alert alert-error alert-danger">
                @if ( is_array(Session::get('error')) )
                    {{ head(Session::get('error')) }}
                @endif
            </div>
        @endif

        @if ( Session::get('notice') )
            <div class="alert">{{ Session::get('notice') }}</div>
        @endif

        <div class="form-actions form-group">
          <button type="submit" class="btn btn-primary">{{{ Lang::get('confide::confide.signup.submit') }}}</button>
        </div>

    </fieldset>
</form>