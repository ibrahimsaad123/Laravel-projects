<?php

namespace App\Requests\Product;

use App\Requests\BaseRequestFormApi;

class UpdateProductValidator  extends BaseRequestFormApi
{
    public function rules(): array
    {
        // TODO: Implement rules() method.
        $id = $this->request()->segment(3);
        return [
            'title'=>'required|min:3|max:50|unique:products,title,'. $id .',id',
            'desc'=>'min:3|max:100',
            'size'=>'required|numeric|min:30|max:100',
            'color'=>'required|in:red,green',
            'price'=>'required|min:1|max:100000'
        ];
    }
}
