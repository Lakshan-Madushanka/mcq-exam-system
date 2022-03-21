<?php


namespace App\Traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

trait ApiResponser
{
    private $successMsg = 'Query succeeded !';
    private $errorMsg = 'Error occurred !';


    public function showOne(mixed $data, array|string|null $message = '',): JsonResponse
    {
        if ($message == '') {
            $message = $this->successMsg;
        }

        return response()->json(['massage' => $message, 'data' => $data]);
    }

    public function showMany(array|Collection|null $data, array|string|null $message = ''): JsonResponse
    {
        if ($message == '') {
            $message = $this->successMsg;
        }

        return response()->json(['massage' => $message, 'data' => $data]);
    }

    public function showError(array|string|null $message, array|null $data = null,): JsonResponse
    {
        if ($message == '') {
            $message = $this->errorMsg;
        }

        $response = ['massage' => $message, 'data' => $data];

        if (is_null($response['data'])) {
            unset($response['data']);
        }

        return response()->json($response);
    }
}