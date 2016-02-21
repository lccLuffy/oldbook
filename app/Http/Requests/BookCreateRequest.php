<?php

namespace App\Http\Requests;

use App\Http\Controllers\FileController;
use App\Http\Requests\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BookCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'address' => 'required',
            'pictures' => 'required|image',
            'categories' => 'required',
            'phone_number'=>'required|size:11',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '书的名字不能为空',
            'description.required' => '描述不能为空',
            'price.required' => '价格不能为空',
            'address.required' => '地址不能为空',
            'pictures.required' => '上传一张图片比较好',
            'categories.required' => '分类不能为空',
        ];
    }

    public function bookFillData()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'address' => $this->address,
            'is_draft' => (bool)$this->is_draft,
            'phone_number'=>$this->phone_number,
            'other_contact_way'=>$this->other_contact_way,
        ];
    }

}
