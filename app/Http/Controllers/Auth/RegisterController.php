<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param RegisterUserRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function register(RegisterUserRequest $request)
    {
        event(new Registered($user = $this->create($request->validated())));

        $expiry = config('auth.verification.expire');

        return back()->with('message', [
            'type'  => 'success',
            'title' => 'Registration successful',
            'body'  => "An e-mail verification link has been sent to you. The link expires in {$expiry} minutes.",
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        if ($data['user_type'] == 'volunteer') {
            return User::create([
                'role_id'  => Role::whereName($data['user_type'])->first()->id,
                'username' => $data['username'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        }
        $user = User::create([
            'role_id'  => Role::whereName($data['user_type'])->first()->id,
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Profile::create([
            'user_id'           => $user->id,
            'organization_name' => $data['organization_name'],
        ]);

        return $user;
    }
}
