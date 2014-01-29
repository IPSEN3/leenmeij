<form method="POST" action="{{{ (Confide::checkAction('UserController@store')) ?: URL::to('user')  }}}" accept-charset="UTF-8">
    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">
    <fieldset>
        <div class="form-group">
            <label for="username">{{{ Lang::get('confide::confide.username') }}}*</label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.username') }}}" type="text" name="username" id="username" value="{{{ Input::old('username') }}}">
        </div>
        <div class="form-group">
            <label for="email">{{{ Lang::get('confide::confide.e_mail') }}} <small>{{ Lang::get('confide::confide.signup.confirmation_required') }}*</small></label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.e_mail') }}}" type="text" name="email" id="email" value="{{{ Input::old('email') }}}">
        </div>
        <div class="form-group">
            <label for="password">{{{ Lang::get('confide::confide.password') }}}*</label>
            <input class="form-control {{ $err = $errors->first('password') ? 'err' : 'null' }}" placeholder="{{{ Lang::get('confide::confide.password') }}}" type="password" name="password" id="password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">{{{ Lang::get('confide::confide.password_confirmation') }}}*</label>
            <input class="form-control" placeholder="{{{ Lang::get('confide::confide.password_confirmation') }}}" type="password" name="password_confirmation" id="password_confirmation">
        </div>
        <div class="form-group">
            <label for="firstname">{{{ Lang::get('site.firstname') }}}*</label>
            <input class="form-control {{ $err = $errors->first('firstname') ? 'err' : 'null' }}" name="firstname" type="text" id="firstname" value="{{{ Input::old('firstname') }}}">
        </div>
        <div class="form-group">
            <label for="insertion">{{{ Lang::get('site.insertion') }}}</label>
            <input class="form-control" name="insertion" type="text" id="insertion" value="{{{ Input::old('insertion') }}}">
        </div>
        <div class="form-group">
            <label for="lastname">{{{ Lang::get('site.lastname') }}}*</label>
            <input class="form-control {{ $err = $errors->first('lastname') ? 'err' : 'null' }}" name="lastname" type="text" id="lastname" value="{{{ Input::old('lastname') }}}">
        </div>
        <div class="form-group">
            <label for="company">{{{ Lang::get('site.company') }}}</label>
            <input class="form-control" name="company" type="text" id="company" value="{{{ Input::old('company') }}}">
        </div>
        <div class="form-group">
            <label for="kvknr">{{{ Lang::get('site.kvknr') }}}</label>
            <input class="form-control" name="kvknr" type="text" id="kvknr" value="{{{ Input::old('kvknr') }}}">
        </div>
        <div class="form-group">
            <label for="phone">{{{ Lang::get('site.phone') }}}*</label>
            <input class="form-control {{ $err = $errors->first('phone') ? 'err' : 'null' }}" name="phone" type="text" id="phone" value="{{{ Input::old('phone') }}}">
        </div>
        <div class="form-group">
            <label for="address">{{{ Lang::get('site.address') }}}*</label>
            <input class="form-control {{ $err = $errors->first('address') ? 'err' : 'null' }}" name="address" type="text" id="address" value="{{{ Input::old('address') }}}">
        </div>
        <div class="form-group">
            <label for="zip">{{{ Lang::get('site.zip') }}}*</label>
            <input class="form-control {{ $err = $errors->first('zip') ? 'err' : 'null' }}" name="zip" type="text" id="zip" value="{{{ Input::old('zip') }}}">
        </div>
        <div class="form-group">
            <label for="city">{{{ Lang::get('site.city') }}}*</label>
            <input class="form-control {{ $err = $errors->first('city') ? 'err' : 'null' }}" name="city" type="text" id="city" value="{{{ Input::old('city') }}}">
        </div>
        <div class="form-group">
            <label for="birthdate">{{{ Lang::get('site.birthdate') }}}*</label>
            <input class="form-control js__birthdaypicker {{ $err = $errors->first('d__birthdate__m') ? 'err' : 'null' }}" name="birthdate" type="text" id="birthdate" data-value="{{{ Input::old('d__birthdate__m') }}}">
        </div>
        <div class="form-group">
            <label for="passportnumber">{{{ Lang::get('site.passportnumber') }}}*</label>
            <input class="form-control {{ $err = $errors->first('passportnumber') ? 'err' : 'null' }}" name="passportnumber" type="text" id="passportnumber" value="{{{ Input::old('passportnumber') }}}">
        </div>

        <div class="form-group">
            <label for="captcha">{{{ Lang::get('site.captcha') }}}*  {{ HTML::image(Captcha::img(), 'Captcha image') }}</label>
            <input class="form-control {{ $err = $errors->first('captcha') ? 'err' : 'null' }}" name="captcha" type="text">
        </div>

    </fieldset>
    <fieldset>

        @if ( Session::get('notice') )
            <div class="alert">{{ Session::get('notice') }}</div>
        @endif

        <div class="form-actions form-group">
          <button type="submit" class="btn btn-primary">{{{ Lang::get('confide::confide.signup.submit') }}}</button>
        </div>

    </fieldset>
</form>