<?php
/**
 * 格式整理
 *
 * @version 0.1.0
 * @author eden.chen eden.chen@kkday.com
 * @date 2024/12/25
 * @since 0.1.0 2024/12/25 eden.chen: 新建立Formatter class
 */

namespace App\Formatters;

use App\Formatters\Response\statusMessage;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class Formatter
{
    /**
     * @param $response
     * @param int $httpCode
     * @return JsonResponse
     */
    public function formatResponse($response, int $httpCode = Response::HTTP_OK): JsonResponse
    {
        $statusCode = $response['status'] ?? StatusMessage::CODE_ERROR;
        $description = $response['description'] ?? StatusMessage::getDescription($statusCode);
        $httpCode = StatusMessage::getHttpCode($statusCode);
        $description = str_replace('\u0000', '', $description);

        $result =  [
            'metadata' =>   [
                "status"        =>  $statusCode,
                "description"   =>  $description
            ]
        ];

        if ($statusCode === StatusMessage::CODE_ALL_SUCCESS) {
            if (isset($response['data'])) {
                $result['data'] = empty($response['data']) ? (object)[] : $response['data'];
            }

            $httpCode = Response::HTTP_CREATED;
        }

        $headers = array(
            'Content-Type' => 'application/json; charset=utf-8'
        );
        return response()->json($result, $httpCode, $headers, JSON_UNESCAPED_UNICODE);
    }
}
