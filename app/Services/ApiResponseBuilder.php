<?php

namespace App\Services;

class ApiResponseBuilder
{
    private ApiResponseService $apiService;

    public function __construct()
    {
        $this->apiService = new ApiResponseService();
    }

    public function message(string $message)
    {
        $this->apiService->setMessage($message);
        return $this;
    }

    public function data(mixed $data)
    {
        $this->apiService->setData($data);
        return $this;
    }

    public function code(int $code)
    {
        $this->apiService->setStatusCode($code);
        return $this;
    }

    public function get()
    {
        return $this->apiService;
    }

    public function response()
    {
        return $this->apiService->response();

    }
}
