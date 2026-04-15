<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlignExamSchema extends Migration
{
    public function up()
    {
        $userFields = $this->db->getFieldNames('users');
        $studentFields = $this->db->getFieldNames('students');

        if (!in_array('name', $userFields, true)) {
            $this->forge->addColumn('users', [
                'name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                    'after'      => 'id',
                ],
            ]);
        }

        if (!in_array('email', $userFields, true)) {
            $this->forge->addColumn('users', [
                'email' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                    'after'      => 'name',
                ],
            ]);
        }

        $this->db->query('UPDATE users SET name = COALESCE(name, fullname), email = COALESCE(email, username)');

        try {
            $this->db->query('ALTER TABLE users ADD UNIQUE KEY users_email_unique (email)');
        } catch (\Throwable $exception) {
        }

        if (!in_array('description', $studentFields, true)) {
            $this->forge->addColumn('students', [
                'description' => [
                    'type' => 'TEXT',
                    'null' => true,
                    'after' => 'course',
                ],
            ]);
        }

        if (!in_array('year_level', $studentFields, true)) {
            $this->forge->addColumn('students', [
                'year_level' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 30,
                    'default'    => 'First Year',
                    'after'      => 'description',
                ],
            ]);
        }

        if (!in_array('status', $studentFields, true)) {
            $this->forge->addColumn('students', [
                'status' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 20,
                    'default'    => 'Active',
                    'after'      => 'year_level',
                ],
            ]);
        }

        if (!in_array('updated_at', $studentFields, true)) {
            $this->forge->addColumn('students', [
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                    'after' => 'created_at',
                ],
            ]);
        }

        $this->db->query("UPDATE students SET description = COALESCE(description, ''), year_level = COALESCE(year_level, 'First Year'), status = COALESCE(status, 'Active'), updated_at = COALESCE(updated_at, created_at)");
    }

    public function down()
    {
        $userFields = $this->db->getFieldNames('users');
        $studentFields = $this->db->getFieldNames('students');

        if (in_array('name', $userFields, true)) {
            $this->forge->dropColumn('users', 'name');
        }

        if (in_array('email', $userFields, true)) {
            try {
                $this->db->query('ALTER TABLE users DROP INDEX users_email_unique');
            } catch (\Throwable $exception) {
            }
            $this->forge->dropColumn('users', 'email');
        }

        foreach (['description', 'year_level', 'status', 'updated_at'] as $field) {
            if (in_array($field, $studentFields, true)) {
                $this->forge->dropColumn('students', $field);
            }
        }
    }
}