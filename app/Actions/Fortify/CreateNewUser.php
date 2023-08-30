<?php

namespace App\Actions\Fortify;

use App\Models\Configuration;
use Carbon\Carbon;
use App\Models\User;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
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
            'first_name'=> ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'     => ['required', 'string', 'numeric'],
            'password'  => $this->passwordRules(),
            'terms'     => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'adult'     =>  ['accepted', 'required'],
        ])->validate();

        if(env('USE_RECAPTCHA',false)){
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify',[
                'secret'    => '6LeMws4nAAAAAPUAbE2g24I9qfuAdvsakfcz_5E9',
                'response'  =>$input['g-recaptcha-response']
            ])->object();

            if(!$response->success && $response->score >= 0.7){
               return false;
            }

        }

        $user= User::create([
            'first_name'    => $input['first_name'],
            'last_name'     => $input['last_name'],
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


        if($configuration_record && $configuration_record->add_user_to_stripe){
            $stripeCustomer = $user->createAsStripeCustomer();
        }

        return $user;
    }
}
