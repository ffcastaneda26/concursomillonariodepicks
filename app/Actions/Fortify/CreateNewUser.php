<?php

namespace App\Actions\Fortify;

use Carbon\Carbon;
use App\Models\User;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $max_birtdhay = Carbon::now()->subYear(18);

        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'      => ['required', 'string', 'size:10'],
            'curp'       => ['required', 'string', 'max:18','min:18'],
            'birthday'   => ['required', 'date', 'before:'. $max_birtdhay ],
            'password'  => $this->passwordRules(),
            'terms'     => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();


        $user= User::create([
            'first_name'    => $input['first_name'],
            'last_name'     => $input['last_name'],
            'email'         => $input['email'],
            'phone'         => $input['phone'],
            'password'      => Hash::make($input['password']),
            'birthday'      => $input['birthday'],
            'curp'          => $input['curp'],
            'accept_terms'  => $input['terms'] ? 1 : 0,
            'active'        => 1
        ]);


        if(env('ASSIGN_ROLE_PARTICIPANT',false)){
            $user->assignRole(env('ROLE_TO_PARTICIPANT','participante'));
        };

        return $user;
    }
}
