<?php

namespace App\Controllers;

use App\Models\StudentInfoModel;

class StudentInfo extends BaseController
{
    private StudentInfoModel $studentModel;

    public function __construct()
    {
        $this->studentModel = new StudentInfoModel();
    }

    public function index()
    {
        $data = array_merge($this->data, [
            'title'    => 'Student Records',
            'students' => $this->studentModel->orderBy('created_at', 'DESC')->paginate(10),
            'pager'    => $this->studentModel->pager,
        ]);

        return view('pages/students/index', $data);
    }

    public function new()
    {
        $data = array_merge($this->data, [
            'title'   => 'Add Student',
            'student' => null,
            'action'  => base_url('students'),
            'method'  => 'POST',
        ]);

        return view('pages/students/form', $data);
    }

    public function create()
    {
        $validated = $this->validateStudent();
        if ($validated !== true) {
            return redirect()->back()->withInput();
        }

        $inserted = $this->studentModel->insert($this->getStudentPayload());
        if (! $inserted) {
            session()->setFlashdata('notif_error', 'Unable to create the student record.');
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('notif_success', 'Student record created successfully.');
        return redirect()->to(base_url('students'));
    }

    public function show($id)
    {
        $student = $this->studentModel->find($id);
        if (! $student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Student record not found.');
        }

        $data = array_merge($this->data, [
            'title'   => 'Student Details',
            'student' => $student,
        ]);

        return view('pages/students/show', $data);
    }

    public function edit($id)
    {
        $student = $this->studentModel->find($id);
        if (! $student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Student record not found.');
        }

        $data = array_merge($this->data, [
            'title'   => 'Edit Student',
            'student' => $student,
            'action'  => base_url('students/' . $id),
            'method'  => 'PUT',
        ]);

        return view('pages/students/form', $data);
    }

    public function update($id)
    {
        $student = $this->studentModel->find($id);
        if (! $student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Student record not found.');
        }

        $validated = $this->validateStudent($id);
        if ($validated !== true) {
            return redirect()->back()->withInput();
        }

        $updated = $this->studentModel->update($id, $this->getStudentPayload());
        if (! $updated) {
            session()->setFlashdata('notif_error', 'Unable to update the student record.');
            return redirect()->back()->withInput();
        }

        session()->setFlashdata('notif_success', 'Student record updated successfully.');
        return redirect()->to(base_url('students'));
    }

    public function delete($id)
    {
        $student = $this->studentModel->find($id);
        if (! $student) {
            session()->setFlashdata('notif_error', 'Student record not found.');
            return redirect()->to(base_url('students'));
        }

        $deleted = $this->studentModel->delete($id);
        if (! $deleted) {
            session()->setFlashdata('notif_error', 'Unable to delete the student record.');
            return redirect()->to(base_url('students'));
        }

        session()->setFlashdata('notif_success', 'Student record deleted successfully.');
        return redirect()->to(base_url('students'));
    }

    private function validateStudent(?int $id = null): bool
    {
        $emailRule = 'required|valid_email';
        if ($id === null) {
            $emailRule .= '|is_unique[students.email]';
        } else {
            $emailRule .= '|is_unique[students.email,id,' . $id . ']';
        }

        return $this->validate([
            'name' => [
                'label' => 'Name',
                'rules' => 'required|min_length[3]|max_length[100]',
            ],
            'email' => [
                'label' => 'Email',
                'rules' => $emailRule,
            ],
            'course' => [
                'label' => 'Course',
                'rules' => 'required|min_length[2]|max_length[50]',
            ],
            'year_level' => [
                'label' => 'Year Level',
                'rules' => 'required|in_list[First Year,Second Year,Third Year,Fourth Year]',
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required|in_list[Active,Inactive,Graduated]',
            ],
            'description' => [
                'label' => 'Description',
                'rules' => 'required|min_length[10]|max_length[1000]',
            ],
        ]);
    }

    private function getStudentPayload(): array
    {
        return [
            'name'        => trim((string) $this->request->getPost('name')),
            'email'       => trim((string) $this->request->getPost('email')),
            'course'      => trim((string) $this->request->getPost('course')),
            'year_level'  => trim((string) $this->request->getPost('year_level')),
            'status'      => trim((string) $this->request->getPost('status')),
            'description' => trim((string) $this->request->getPost('description')),
        ];
    }
}
