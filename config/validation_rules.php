<?php
/**
 * 檢查規則表
 *
 * @version 0.1.0
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/26
 * @since 0.1.0 2024/12/26 eden.chen: 新建立validation rule
 */

return [
    'account' => [
        'create' => [
            'rules' => [
                'data.account' => 'required',
                'data.password' => 'required',
            ],
            'errorMessages' => [
                'data.account.required' => 'account:帳號為必填',
                'data.password.required' => 'password:密碼為必填',
            ],
        ],
    ],
];
