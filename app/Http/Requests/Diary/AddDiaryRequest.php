<?php

namespace App\Http\Requests\Diary;

use App\Http\Requests\BaseRequest;

class AddDiaryRequest extends BaseRequest
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
            'user_id'=>'required',
            'title'=>'required',
            'content'=>'required'
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
            'user_id.required' => '缺少用户ID',
            'title.required' => '请填写标题',
            'content.required' => '请填写内容'
        ];
    }

}
