<?php
/**
 * http request 檢查參數是否符合
 *
 * @version 0.1.0
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/26
 * @since 0.1.0 2024/12/26 eden.chen: 新建立HttpRequestValidation class
 */

namespace App\Validations;

use App\Exceptions\HttpRequestCustomException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HttpRequestValidation
{
    /**
     * @param Request $request
     * @param array $rules
     * @return void
     * @throws HttpRequestCustomException
     */
    public static function checkRequest(Request $request, array $rules): void
    {
        $validation = Validator::make($request->all(), $rules['rules'], $rules['errorMessages']);
        if ($validation->fails()) {
            $errors = $validation->errors();
            $messages = [];
            foreach ($errors->all() as $errorMsg) {
                $messages[] = $errorMsg;
            }
            throw new HttpRequestCustomException(implode(',', $messages));
        }
    }
}
