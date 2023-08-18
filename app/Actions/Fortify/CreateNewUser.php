<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

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
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => $this->passwordRules(),
            'terms'     => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();


        $user= User::create([
            'first_name'    => $input['first_name'],
            'last_name'     => $input['last_name'],
            'email'         => $input['email'],
            'password'      => Hash::make($input['password']),
            'accept_terms'  => $input['terms'] ? 1 : 0,
            'active'        => 1
        ]);


        if(env('ASSIGN_ROLE_PARTICIPANT',false)){
            $user->assignRole(env('ROLE_TO_PARTICIPANT','participante'));
        };

        return $user;
    }
}
