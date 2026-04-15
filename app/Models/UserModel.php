<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useAutoIncrement = true;
    protected $useTimestamps = false;

    protected $allowedFields = [
        'name',
        'email',
        'password',
        'student_id',
        'course',
        'year_level',
        'section',
        'phone',
        'address',
        'profile_image',
        'fullname',
        'username',
        'updated_at',
    ];

    public function updateProfile(int $userId, array $data): bool
    {
        return (bool) $this->update($userId, $data);
    }
}
