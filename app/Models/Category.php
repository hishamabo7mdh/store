<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Category extends Model
{
    protected $fillable =[
        'parent_id','name','slug','description','image','status'
    ];
    public static function rule($id=0){
        return[
                        //'name' => 'required|string|min:3|max:255|unique',//تؤتيب rule مهم
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('categories','name')->ignore($id)
            ],
            'parent_id' => ['nullable','int', 'exists:categories,id'],
            'image' => ['image','max:1048576','dimensions:min_width=100,ma_height=100'],
            'status' => ['in:active,archived']
        ];
    }
}
