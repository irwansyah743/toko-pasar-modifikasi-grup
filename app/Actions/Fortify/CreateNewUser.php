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
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'emailRegister' => ['required', 'string', 'email', 'max:255', 'unique:App\Models\User,email'],
            'phone' => ['numeric', 'nullable'],
            'passwordRegister' => ['required', 'confirmed', $this->passwordRules()],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ], [
            'emailRegister.unique' => 'This email has already been taken.',
            'passwordRegister.confirmed' => 'The password confirmation does not match.',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['emailRegister'],
            'phone' => $input['phone'],
            'password' => Hash::make($input['passwordRegister']),
        ]);
    }
}