<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Nullable;
use Intervention\Image\Facades\Image;
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
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone_number' => 'nullable|numeric',
            'profile_picture' => 'nullable|file|mimetypes:image/jpeg,image/png',
            'birthday' => 'required|date',
        ]);
    }

    protected function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        if(!isset($data['profile_picture'])){
            $path = "img/profile_pic.png";
        }
        else{
            $path = $data['profile_picture']->store('media', ['disk' => 'my_files']);
        }

        $imgFile = Image::make($data['profile_picture']->getRealPath());

        $imgFile->fit(200)->encode('jpg');

        $hash = md5($imgFile->__toString());
        $path = "media/{$hash}.jpg";
        $imgFile->save(public_path($path));

        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'hashed_password' => bcrypt($data['password']),
            'profile_picture' => $path,
            'cover_picture' => 'img/cover_pic.jpg',
            'phone_number' => $data['phone_number'],
            'birthday' => $data['birthday'],
            'id_country' => $data['country'],
        ]);
    }
}
