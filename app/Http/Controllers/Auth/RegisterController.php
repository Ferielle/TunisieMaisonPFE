<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
{
    return Validator::make($data, [
        'firstname' => ['required', 'string', 'max:255'],
        'phone' => ['required', 'string', 'max:15', 'unique:users,phone'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ], [
        'phone.unique' => 'Ce numéro de téléphone est déjà utilisé.',
        'email.unique' => 'Cet email est déjà utilisé.',
    ]);
}


    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
