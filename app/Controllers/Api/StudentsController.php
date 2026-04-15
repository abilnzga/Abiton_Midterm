<?php

namespace App\Controllers\Api;

use App\Models\StudentInfoModel;

/**
 * StudentsController  (API)
 *
 * Protected by the api_auth filter (Bearer token required).
 *
 * GET    api/v1/students
 * GET    api/v1/students/{id}
 * POST   api/v1/students
 * PUT    api/v1/students/{id}
 * DELETE api/v1/students/{id}
 */
class StudentsController extends BaseApiController
{
    protected StudentInfoModel $model;

    public function __construct()
    {
        $this->model = new StudentInfoModel();
    }

    // ----------------------------------------------------------------
    // GET api/v1/students
    // ----------------------------------------------------------------
    public function index(): \CodeIgniter\HTTP\Response
    {
        $students = $this->model->findAll();

        return $this->respondOk($students, 'Students retrieved successfully.');
    }

    // ----------------------------------------------------------------
    // GET api/v1/students/{id}
    // ----------------------------------------------------------------
    public function show(int $id): \CodeIgniter\HTTP\Response
    {
        $student = $this->model->find($id);

        if (! $student) {
            return $this->respondNotFound("Student with ID {$id} not found.");
        }

        return $this->respondOk($student, 'Student retrieved successfully.');
    }

    // ----------------------------------------------------------------
    // POST api/v1/students
    // ----------------------------------------------------------------
    public function create(): \CodeIgniter\HTTP\Response
    {
        $data = $this->request->getJSON(true) ?? $this->request->getPost();

        $rules = [
            'name'       => 'required|min_length[2]',
            'email'      => 'required|valid_email|is_unique[students.email]',
            'course'     => 'permit_empty|string',
            'year_level' => 'permit_empty|string',
            'status'     => 'permit_empty|in_list[active,inactive]',
        ];

        if (! $this->validate($rules)) {
            return $this->respondValidationError($this->validator->getErrors());
        }

        $id = $this->model->insert([
            'name'        => $data['name']        ?? '',
            'email'       => $data['email']       ?? '',
            'course'      => $data['course']      ?? null,
            'description' => $data['description'] ?? null,
            'year_level'  => $data['year_level']  ?? null,
            'status'      => $data['status']      ?? 'active',
        ]);

        if (! $id) {
            return $this->respondServerError('Failed to create student record.');
        }

        $student = $this->model->find($id);

        return $this->respondCreated($student, 'Student created successfully.');
    }

    // ----------------------------------------------------------------
    // PUT api/v1/students/{id}
    // ----------------------------------------------------------------
    public function update(int $id): \CodeIgniter\HTTP\Response
    {
        $student = $this->model->find($id);

        if (! $student) {
            return $this->respondNotFound("Student with ID {$id} not found.");
        }

        $data = $this->request->getJSON(true) ?? $this->request->getRawInput();

        $rules = [
            'name'       => 'permit_empty|min_length[2]',
            'email'      => "permit_empty|valid_email|is_unique[students.email,id,{$id}]",
            'course'     => 'permit_empty|string',
            'year_level' => 'permit_empty|string',
            'status'     => 'permit_empty|in_list[active,inactive]',
        ];

        if (! $this->validate($rules)) {
            return $this->respondValidationError($this->validator->getErrors());
        }

        $this->model->update($id, array_filter([
            'name'        => $data['name']        ?? null,
            'email'       => $data['email']       ?? null,
            'course'      => $data['course']      ?? null,
            'description' => $data['description'] ?? null,
            'year_level'  => $data['year_level']  ?? null,
            'status'      => $data['status']      ?? null,
        ], fn($v) => $v !== null));

        return $this->respondOk($this->model->find($id), 'Student updated successfully.');
    }

    // ----------------------------------------------------------------
    // DELETE api/v1/students/{id}
    // ----------------------------------------------------------------
    public function delete(int $id): \CodeIgniter\HTTP\Response
    {
        $student = $this->model->find($id);

        if (! $student) {
            return $this->respondNotFound("Student with ID {$id} not found.");
        }

        $this->model->delete($id);

        return $this->respondOk(null, "Student with ID {$id} deleted successfully.");
    }
}
