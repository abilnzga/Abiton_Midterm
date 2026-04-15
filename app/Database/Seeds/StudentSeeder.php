<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'        => 'John Doe',
                'email'       => 'john@example.com',
                'course'      => 'Computer Science',
                'year_level'  => 'First Year',
                'status'      => 'Active',
                'description' => 'Interested in backend development and database design.',
            ],
            [
                'name'        => 'Jane Smith',
                'email'       => 'jane@example.com',
                'course'      => 'Information Technology',
                'year_level'  => 'Second Year',
                'status'      => 'Active',
                'description' => 'Focuses on web application development and interface design.',
            ],
            [
                'name'        => 'Alex Rivera',
                'email'       => 'alex@example.com',
                'course'      => 'Data Science',
                'year_level'  => 'Fourth Year',
                'status'      => 'Graduated',
                'description' => 'Completing capstone work in analytics and machine learning.',
            ],
        ];

        foreach ($data as $student) {
            $existingStudent = $this->db->table('students')->where('email', $student['email'])->get()->getRowArray();

            if ($existingStudent) {
                $this->db->table('students')->update($student, ['id' => $existingStudent['id']]);
                continue;
            }

            $this->db->table('students')->insert($student);
        }
    }
}
