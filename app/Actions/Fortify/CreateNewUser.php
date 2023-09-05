<?php

namespace App\Actions\Fortify;

use App\Models\Configuration;
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
         Validator::make($input, [
            'name'      => ['required', 'string', 'max:50'],
            'alias'     => ['required', 'string', 'min:6','max:12', 'unique:users'],
            'email'     => ['required', 'string', 'email','max:255', 'unique:users'],
            'phone'     => ['required', 'string', 'numeric'],
            'password'  => $this->passwordRules(),
            'terms'     => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'adult'     =>  ['accepted', 'required'],
        ])->validate();



        $user= User::create([
            'name'          => $input['name'],
            'alias'         => $input['alias'],
            'email'         => $input['email'],
            'phone'         => $input['phone'],
            'password'      => Hash::make($input['password']),
            'accept_terms'  => $input['terms'] ? 1 : 0,
            'adult'         => $input['adult'] ? 1 : 0,
            'active'        => 1
        ]);

        $configuration_record = Configuration::first();

        if($configuration_record && $configuration_record->assig_role_to_user){
            $user->assignRole(env('ROLE_TO_PARTICIPANT','participante'));
        }



        return $user;
    }
}
