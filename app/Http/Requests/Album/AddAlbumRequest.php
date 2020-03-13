<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/2/28
 * Time: 17:10
 */

namespace App\Http\Requests\Diary;

use App\Http\Requests\BaseRequest;

class AddAlbumRequest extends BaseRequest
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
            'name'=>'required',
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
            'name.required' => '请填写标题',
        ];
    }

}
