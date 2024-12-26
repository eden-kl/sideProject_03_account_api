<?php
/**
 * 狀態代碼對應message
 *
 * @version 0.1.0
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/25
 * @since 0.1.0 2024/12/25 eden.chen: 新建立statusMessage class
 */

namespace App\Formatters\Response;

use Symfony\Component\HttpFoundation\Response;

final class StatusMessage
{
    private const CODE_MAPPING = [
        self::CODE_ALL_SUCCESS => [
            'statusCode' => self::CODE_ALL_SUCCESS,
            'message' => 'Success',
            'httpCode' => Response::HTTP_OK,
        ],
        self::CODE_PARAMETER_ERROR => [
            'statusCode' => self::CODE_PARAMETER_ERROR,
            'message' => '參數錯誤',
            'httpCode' => Response::HTTP_BAD_REQUEST,
        ],
        self::CODE_ERROR => [
            'statusCode' => self::CODE_ERROR,
            'message' => 'Error',
            'httpCode' => Response::HTTP_OK,
        ],
    ];

    public const CODE_ALL_SUCCESS = '0000';
    public const CODE_PARAMETER_ERROR = 'E001';
    public const CODE_ERROR = 'E999';

    /**
     * @param string|null $code
     * @return string
     */
    public static function getMessage(string $code = null): string
    {
        return self::CODE_MAPPING[$code]['message'];
    }

    /**
     * @param string $code
     * @return string
     */
    public static function getHttpCode(string $code): string
    {
        return self::CODE_MAPPING[$code]['httpCode'];
    }
}
