<?php

namespace App\Controllers\Api;

use App\Models\ApiTokenModel;
use App\Models\UserModel;

/**
 * AuthController  (API)
 *
 * POST   api/v1/auth   → issue a new Bearer token
 * DELETE api/v1/auth   → revoke the current Bearer token
 */
class AuthController extends BaseApiController
{
    protected ApiTokenModel $tokenModel;
    protected UserModel     $userModel;

    public function __construct()
    {
        $this->tokenModel = new ApiTokenModel();
        $this->userModel  = new UserModel();
    }

    // ----------------------------------------------------------------
    // POST api/v1/auth  → Login & issue token
    // ----------------------------------------------------------------

    public function issueToken(): \CodeIgniter\HTTP\Response
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (! $this->validate($rules)) {
            return $this->respondValidationError($this->validator->getErrors());
        }

        $email    = $this->request->getJSON(true)['email']    ?? $this->request->getPost('email');
        $password = $this->request->getJSON(true)['password'] ?? $this->request->getPost('password');

        // Find user by email
        $user = $this->userModel->where('email', $email)->first();

        if (! $user || ! password_verify($password, $user['password'])) {
            return $this->respondUnauthorized('Invalid email or password.');
        }

        // Revoke any existing tokens and issue a fresh one (24-hour lifetime)
        $this->tokenModel->revokeAllForUser((int) $user['id']);
        $token = $this->tokenModel->issueToken((int) $user['id'], 24);

        return $this->respondCreated([
            'token'      => $token,
            'token_type' => 'Bearer',
            'expires_in' => '24 hours',
            'user'       => [
                'id'       => $user['id'],
                'name'     => $user['fullname'] ?? $user['name'] ?? $user['username'],
                'email'    => $user['email'],
                'username' => $user['username'] ?? null,
            ],
        ], 'Token issued successfully.');
    }

    // ----------------------------------------------------------------
    // DELETE api/v1/auth  → Logout & revoke token
    // ----------------------------------------------------------------

    public function revokeToken(): \CodeIgniter\HTTP\Response
    {
        $authHeader = $this->request->getHeaderLine('Authorization');
        $rawToken   = trim(substr($authHeader, 7)); // strip "Bearer "

        if (empty($rawToken)) {
            return $this->respondUnauthorized('No token provided.');
        }

        $this->tokenModel->revokeToken($rawToken);

        return $this->respondOk(null, 'Token revoked. You have been logged out.');
    }
}
