<?php

namespace App\Http\Requests\Diary;

use App\Http\Requests\BaseRequest;

class DelAlbumRequest extends BaseRequest
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
            'id'=>'required',
            'user_id'=>'required'
        ];
    }

    /**
     * 获取已定义的验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id.required' => '缺少ID',
            'user_id.required' => '缺少用户ID'
        ];
    }

}
