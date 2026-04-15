<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiTokenModel extends Model
{
    protected $table            = 'api_tokens';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useAutoIncrement = true;
    protected $useTimestamps    = false;

    protected $allowedFields = [
        'user_id',
        'token',
        'created_at',
        'expires_at',
    ];

    // ----------------------------------------------------------------
    // Helpers
    // ----------------------------------------------------------------

    /**
     * Find a token record and join it with the owning user.
     * Returns the row array on success, or null if not found / expired.
     */
    public function findWithUser(string $rawToken): ?array
    {
        return $this->db->table('api_tokens AS t')
            ->select('t.*, u.id AS user_id, u.username, u.email, u.name, u.fullname')
            ->join('users u', 'u.id = t.user_id')
            ->where('t.token', $rawToken)
            ->where('(t.expires_at IS NULL OR t.expires_at > NOW())')
            ->get()
            ->getRowArray();
    }

    /**
     * Issue a new token for the given user.
     * Returns the generated token string.
     */
    public function issueToken(int $userId, int $expiresInHours = 24): string
    {
        $token = bin2hex(random_bytes(32));

        $this->insert([
            'user_id'    => $userId,
            'token'      => $token,
            'created_at' => date('Y-m-d H:i:s'),
            'expires_at' => date('Y-m-d H:i:s', strtotime("+{$expiresInHours} hours")),
        ]);

        return $token;
    }

    /**
     * Delete a specific token (revoke it).
     */
    public function revokeToken(string $rawToken): bool
    {
        return $this->where('token', $rawToken)->delete();
    }

    /**
     * Delete all tokens belonging to a user.
     */
    public function revokeAllForUser(int $userId): bool
    {
        return $this->where('user_id', $userId)->delete();
    }
}
