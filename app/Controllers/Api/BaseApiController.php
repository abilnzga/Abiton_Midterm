<?php

namespace App\Controllers\Api;

use CodeIgniter\Controller;

/**
 * BaseApiController
 *
 * Provides standardised JSON response helpers for all API controllers.
 */
class BaseApiController extends Controller
{
    // ----------------------------------------------------------------
    // Success Responses
    // ----------------------------------------------------------------

    protected function respondOk(mixed $data = null, string $message = 'OK'): \CodeIgniter\HTTP\Response
    {
        return $this->response->setStatusCode(200)->setJSON([
            'status'  => 200,
            'message' => $message,
            'data'    => $data,
        ]);
    }

    protected function respondCreated(mixed $data = null, string $message = 'Created'): \CodeIgniter\HTTP\Response
    {
        return $this->response->setStatusCode(201)->setJSON([
            'status'  => 201,
            'message' => $message,
            'data'    => $data,
        ]);
    }

    // ----------------------------------------------------------------
    // Error Responses
    // ----------------------------------------------------------------

    protected function respondUnauthorized(string $message = 'Unauthorized'): \CodeIgniter\HTTP\Response
    {
        return $this->response->setStatusCode(401)->setJSON([
            'status'  => 401,
            'error'   => 'Unauthorized',
            'message' => $message,
        ]);
    }

    protected function respondForbidden(string $message = 'Forbidden'): \CodeIgniter\HTTP\Response
    {
        return $this->response->setStatusCode(403)->setJSON([
            'status'  => 403,
            'error'   => 'Forbidden',
            'message' => $message,
        ]);
    }

    protected function respondNotFound(string $message = 'Not Found'): \CodeIgniter\HTTP\Response
    {
        return $this->response->setStatusCode(404)->setJSON([
            'status'  => 404,
            'error'   => 'Not Found',
            'message' => $message,
        ]);
    }

    protected function respondValidationError(array $errors): \CodeIgniter\HTTP\Response
    {
        return $this->response->setStatusCode(422)->setJSON([
            'status'  => 422,
            'error'   => 'Validation Error',
            'errors'  => $errors,
        ]);
    }

    protected function respondServerError(string $message = 'Internal Server Error'): \CodeIgniter\HTTP\Response
    {
        return $this->response->setStatusCode(500)->setJSON([
            'status'  => 500,
            'error'   => 'Server Error',
            'message' => $message,
        ]);
    }
}
