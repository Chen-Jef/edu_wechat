<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/2/27
 * Time: 17:06
 */
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    protected function failedValidation(Validator $validator) {
        throw (new HttpResponseException(response()->json([
            'code' => 300,
            'msg' => $validator->errors()->first(),
            'data' => [],
        ], 200)));
    }
}