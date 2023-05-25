<?php

namespace App\Requests\User;

use App\Requests\BaseRequestFormApi;

class CreateUserValidator extends BaseRequestFormApi
{

    public function rules(): array
    {
        // TODO: Implement rules() method.
        return [
            'name' => 'required|max:50',
            'email' => 'required|min:5|email|unique:users,email',
            'password' => 'required|min:6|max:50|confirmed'
        ];

    }
    public function authorized():bool
    {
        return true;
    }
}
