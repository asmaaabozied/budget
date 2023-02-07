<?php
/**
 * File JsonResponse.php
 *
 * @author Tuan Duong <bacduong@gmail.com>
 *
 * @version 1.0
 */

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Http\JsonResponse as BaseJsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class JsonResponse
 * Simple response object for Laravue application
 * Response format:
 * {
 *   'success': true|false,
 *   'data': [],
 *   'error': ''
 * }
 */
class JsonResponse implements \JsonSerializable
{
    const STATUS_SUCCESS = true;

    const STATUS_ERROR = false;

    /**
     * Data to be returned
     *
     * @var mixed
     */
    private $data = [];

    /**
     * Error message in case process is not success. This will be a string.
     *
     * @var string
     */
    private $error = '';

    /**
     * @var bool
     */
    private $success = false;

    /**
     * JsonResponse constructor.
     *
     * @param  mixed  $data
     * @param  string  $error
     */
    public function __construct($data = [], string $error = '')
    {
        if ($this->shouldBeJson($data)) {
            $this->data = $data;
        }

        $this->error = $error;
        $this->success = ! empty($data);
    }

    /**
     * Success with data
     *
     * @param  array  $data
     */
    public function success($data = [])
    {
        $this->success = true;
        $this->data = $data;
        $this->error = '';
    }

    /**
     * Fail with error message
     *
     * @param  string  $error
     */
    public function fail($error = '')
    {
        $this->success = false;
        $this->error = $error;
        $this->data = [];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'success' => $this->success,
            'data' => $this->data,
            'error' => $this->error,
        ];
    }

    public function respondForbidden(?string $message = null): BaseJsonResponse
    {
        return $this->apiResponse(
            ['error' => $message ?? 'Forbidden'],
            Response::HTTP_FORBIDDEN
        );
    }

    /**
     * Determine if the given content should be turned into JSON.
     *
     * @param  mixed  $content
     * @return bool
     */
    private function shouldBeJson($content): bool
    {
        return $content instanceof Arrayable ||
            $content instanceof Jsonable ||
            $content instanceof \ArrayObject ||
            $content instanceof \JsonSerializable ||
            is_array($content);
    }

    private function apiResponse(array $data, int $code = 200): BaseJsonResponse
    {
        return response()->json($data, $code);
    }
}
