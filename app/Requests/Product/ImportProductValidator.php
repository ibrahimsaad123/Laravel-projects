<?php

namespace App\Requests\Product;

use App\Requests\BaseRequestFormApi;

class ImportProductValidator extends BaseRequestFormApi
{
    public function rules(): array
    {
        // TODO: Implement rules() method.
        return [
            'file' => 'required|mimes:csv,xlsx|max:8162'
        ];
    }

}
