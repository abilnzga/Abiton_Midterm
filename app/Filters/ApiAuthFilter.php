<?php

namespace App\Filters;

use App\Models\ApiTokenModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * ApiAuthFilter
 *
 * Validates the Bearer token sent in the Authorization header.
 * On success it attaches the resolved user data to the request object
 * as `$request->apiUser` so downstream controllers can read it.
 */
class ApiAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // ---- 1. Extract the Authorization header ----
        $authHeader = $request->getHeaderLine('Authorization');

        if (empty($authHeader) || ! str_starts_with($authHeader, 'Bearer ')) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => 401,
                    'error'   => 'Unauthorized',
                    'message' => 'Missing or invalid Authorization header. Expected: Bearer <token>',
                ]);
        }

        $rawToken = trim(substr($authHeader, 7));

        if (empty($rawToken)) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => 401,
                    'error'   => 'Unauthorized',
                    'message' => 'Bearer token must not be empty.',
                ]);
        }

        // ---- 2. Look up the token in the database ----
        $tokenModel = new ApiTokenModel();
        $tokenRow   = $tokenModel->findWithUser($rawToken);

        if (! $tokenRow) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => 401,
                    'error'   => 'Unauthorized',
                    'message' => 'Token is invalid or has expired.',
                ]);
        }

        // ---- 3. Attach user data to the request for use in controllers ----
        $request->apiUser = [
            'id'       => $tokenRow['user_id'],
            'username' => $tokenRow['username'] ?? null,
            'email'    => $tokenRow['email']    ?? null,
            'name'     => $tokenRow['fullname'] ?? $tokenRow['name'] ?? null,
        ];

        return $request;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing needed post-response for API auth.
    }
}
