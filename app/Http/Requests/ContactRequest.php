<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email:filter,dns',
            'postal' => 'required|max:8|string|regex:/^[0-9]{3}-[0-9]{4}$/',
            'address' => 'required',
            'content' => 'required|max:120'
        ];
    }

    public function messages()
    {
        return[
            'first_name.required' => '※苗字を入力して下さい',
            'last_name.required' => '※名前を入力して下さい',
            'email.required' => '※メールアドレスを入力して下さい',
            'postal.required' =>  '※郵便番号を入力して下さい',
            'postal.max' =>  '※8文字以内で入力して下さい',
            'address.required' =>  '※住所を入力して下さい',
            'content.required' => '※この項目は入力必須です',
            'content.max' => '※120文字以内で入力して下さい',
        ];
    }
}
