<?php

namespace App\Requests\User;

use App\Requests\BaseRequestFormApi;

class LoginUserValidator extends BaseRequestFormApi
{
    public function rules(): array
    {
        // TODO: Implement rules() method.
        return [
            'email' => 'required|min:5|email|exists:users,email',
            'password' => 'required|min:6|max:50'
        ];
    }

}
