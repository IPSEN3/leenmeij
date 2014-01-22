<?php

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\Confide;
use Zizaco\Confide\ConfideEloquentRepository;
use Zizaco\Entrust\HasRole;
use Robbo\Presenter\PresentableInterface;
use Carbon\Carbon;

class User extends ConfideUser implements PresentableInterface {
    use HasRole;

    protected $user;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

    public function getPresenter()
    {
        return new UserPresenter($this);
    }

    /**
     * Get user by username
     * @param $username
     * @return mixed
     */
    public function getUserByUsername( $username )
    {
        return $this->where('username', '=', $username)->first();
    }

    /**
     * Get the date the user was created.
     *
     * @return string
     */
    public function joined()
    {
        return String::date(Carbon::createFromFormat('Y-n-j G:i:s', $this->created_at));
    }

    /**
     * Save roles inputted from multiselect
     * @param $inputRoles
     */
    public function saveRoles($inputRoles)
    {
        if(! empty($inputRoles)) {
            $this->roles()->sync($inputRoles);
        } else {
            $this->roles()->detach();
        }
    }

    /**
     * Returns user's current role ids only.
     * @return array|bool
     */
    public function currentRoleIds()
    {
        $roles = $this->roles;
        $roleIds = false;
        if( !empty( $roles ) ) {
            $roleIds = array();
            foreach( $roles as &$role )
            {
                $roleIds[] = $role->id;
            }
        }
        return $roleIds;
    }

    /**
     * Redirect after auth.
     * If ifValid is set to true it will redirect a logged in user.
     * @param $redirect
     * @param bool $ifValid
     * @return mixed
     */
    public static function checkAuthAndRedirect($redirect, $ifValid=false)
    {
        // Get the user information
        $user = Auth::user();
        $redirectTo = false;

        if(empty($user->id) && ! $ifValid) // Not logged in redirect, set session.
        {
            Session::put('loginRedirect', $redirect);
            $redirectTo = Redirect::to('user/login')
                ->with( 'notice', Lang::get('user/user.login_first') );
        }
        elseif(!empty($user->id) && $ifValid) // Valid user, we want to redirect.
        {
            $redirectTo = Redirect::to($redirect);
        }

        return array($user, $redirectTo);
    }

    public function getUserFromCustomerListByEmail()
    {
        $user = Auth::user();

        $customer = DB::table('customer')
        ->select('id')
        ->where('email', $user->email)
        ->first();

       return $customer->id;
    }

    public function currentUser()
    {
        return (new Confide(new ConfideEloquentRepository()))->user();
    }

    public function check($email) 
    {
        $this->user = DB::table('customer')
        ->where('email', $email)
        ->first();

        // registratie probleem fixen

        if($this->user) {
            
            return true;
            
        }

        else {

            $this->createNewCustomer($email);
            return true;

        }
    }

    private function createNewCustomer($email) 
    {
        DB::table('customer')->insert(
            array('email' => $email, 'firstname' => '', 'insertion' => '', 'lastname' => '', 'company' => '', 'kvknr' => 0, 'phone' => '', 'address' => '', 'zip' => '', 'city' => '', 'birthdate' => '01-01-1970', 'passportnumber' => '') //fix de birthday and check it!!
        );

        $this->check($email);
    }

    public function getSettings($email)
    {
        $settings = DB::table('customer')
            ->where('email', '=', $email)
            ->first();

        return $settings;
    }

    public function saveSettings($email, $settings)
    {
        DB::table('customer')
            ->where('email', '=', $email)
            ->update(array('firstname' => $settings['firstname'], 'insertion' => $settings['insertion'], 'lastname' => $settings['lastname'], 'company' => $settings['company'], 'kvknr' => $settings['kvknr'], 'phone' => $settings['phone'], 'address' => $settings['address'], 'zip' => $settings['zip'], 'city' => $settings['city'], 'birthdate' => $settings['d__birthdate__m'], 'passportnumber' => $settings['passportnumber']));
    }


}
