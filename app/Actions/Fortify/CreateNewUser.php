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
            'first_name'=> ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'     => ['required', 'string', 'size:10'],
            'curp'      => ['required', 'string', 'size:18','unique:users','regex:/^([A-Z&]|[a-z&]{1})([AEIOU]|[aeiou]{1})([A-Z&]|[a-z&]{1})([A-Z&]|[a-z&]{1})([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([HM]|[hm]{1})([AS|as|BC|bc|BS|bs|CC|cc|CS|cs|CH|ch|CL|cl|CM|cm|DF|df|DG|dg|GT|gt|GR|gr|HG|hg|JC|jc|MC|mc|MN|mn|MS|ms|NT|nt|NL|nl|OC|oc|PL|pl|QT|qt|QR|qr|SP|sp|SL|sl|SR|sr|TC|tc|TS|ts|TL|tl|VZ|vz|YN|yn|ZS|zs|NE|ne]{2})([^A|a|E|e|I|i|O|o|U|u]{1})([^A|a|E|e|I|i|O|o|U|u]{1})([^A|a|E|e|I|i|O|o|U|u]{1})([0-9]{2})/'],
            'birthday'  => ['required', 'date', 'before:'. $max_birtdhay ],
            'password'  => $this->passwordRules(),
            'terms'     => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'adult'     =>  ['accepted', 'required'],
        ])->validate();


        $user= User::create([
            'first_name'    => $input['first_name'],
            'last_name'     => $input['last_name'],
            'email'         => $input['email'],
            'phone'         => $input['phone'],
            'gender'        => $input['gender'],
            'password'      => Hash::make($input['password']),
            'birthday'      => $input['birthday'],
            'curp'          => $input['curp'],
            'accept_terms'  => $input['terms'] ? 1 : 0,
            'adult'         => $input['adult'] ? 1 : 0,
            'active'        => 1
        ]);


        if(env('ASSIGN_ROLE_PARTICIPANT',false)){
            $user->assignRole(env('ROLE_TO_PARTICIPANT','participante'));
        };

        $stripeCustomer = $user->createAsStripeCustomer();
        return $user;
    }
}
