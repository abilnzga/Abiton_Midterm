<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfileController extends BaseController
{
    private function userModel(): UserModel
    {
        return new UserModel();
    }

    public function show()
    {
        $sessionUser = session('user');
        $userId = (int) ($sessionUser['id'] ?? session('user_id') ?? 0);

        if ($userId <= 0) {
            session()->destroy();
            return redirect()->to(base_url('login'));
        }

        $user = $this->userModel()->find($userId);
        if (! $user) {
            session()->destroy();
            return redirect()->to(base_url('login'));
        }

        $data = array_merge($this->data, [
            'title' => 'My Profile',
            'user'  => $user,
        ]);

        return view('profile/show', $data);
    }

    public function edit()
    {
        $sessionUser = session('user');
        $userId = (int) ($sessionUser['id'] ?? session('user_id') ?? 0);

        if ($userId <= 0) {
            session()->destroy();
            return redirect()->to(base_url('login'));
        }

        $user = $this->userModel()->find($userId);
        if (! $user) {
            session()->destroy();
            return redirect()->to(base_url('login'));
        }

        $data = array_merge($this->data, [
            'title' => 'Edit Profile',
            'user'  => $user,
        ]);

        return view('profile/edit', $data);
    }

    public function update()
    {
        $sessionUser = session('user');
        $userId = (int) ($sessionUser['id'] ?? session('user_id') ?? 0);

        if ($userId <= 0) {
            session()->destroy();
            return redirect()->to(base_url('login'));
        }

        $currentUser = $this->userModel()->find($userId);
        if (! $currentUser) {
            session()->destroy();
            return redirect()->to(base_url('login'));
        }

        $rules = [
            'name' => [
                'label' => 'Name',
                'rules' => 'required|min_length[3]|max_length[255]',
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.email,id,' . $userId . ']',
            ],
            'student_id' => [
                'label' => 'Student ID',
                'rules' => 'permit_empty|max_length[20]',
            ],
            'course' => [
                'label' => 'Course',
                'rules' => 'permit_empty|max_length[100]',
            ],
            'year_level' => [
                'label' => 'Year Level',
                'rules' => 'permit_empty|integer|greater_than_equal_to[1]|less_than_equal_to[5]',
            ],
            'section' => [
                'label' => 'Section',
                'rules' => 'permit_empty|max_length[50]',
            ],
            'phone' => [
                'label' => 'Phone Number',
                'rules' => 'permit_empty|max_length[20]',
            ],
            'address' => [
                'label' => 'Address',
                'rules' => 'permit_empty|max_length[1000]',
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $profileImageName = $currentUser['profile_image'] ?? null;
        $file = $this->request->getFile('profile_image');

        if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
            if (! $file->isValid() || $file->hasMoved()) {
                return redirect()->back()->withInput()->with('errors', ['profile_image' => 'The uploaded image is not valid.']);
            }

            $fileValidationRules = [
                'profile_image' => [
                    'label' => 'Profile Image',
                    'rules' => 'is_image[profile_image]|mime_in[profile_image,image/jpg,image/jpeg,image/png,image/webp]|max_size[profile_image,2048]',
                ],
            ];

            if (! $this->validate($fileValidationRules)) {
                return redirect()->back()->withInput()->with('errors', array_merge((array) session('errors'), $this->validator->getErrors()));
            }

            $uploadDir = FCPATH . 'uploads/profiles/';
            if (! is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if (! empty($profileImageName)) {
                $oldImagePath = $uploadDir . $profileImageName;
                if (is_file($oldImagePath)) {
                    @unlink($oldImagePath);
                }
            }

            $extension = strtolower($file->getExtension() ?: $file->getClientExtension());
            $newFilename = 'avatar_' . $userId . '_' . time() . '.' . $extension;
            $file->move($uploadDir, $newFilename, true);
            $profileImageName = $newFilename;
        }

        $name = trim((string) $this->request->getPost('name'));
        $email = trim((string) $this->request->getPost('email'));

        $updateData = [
            'name'          => $name,
            'fullname'      => $name,
            'email'         => $email,
            'username'      => $email,
            'student_id'    => trim((string) $this->request->getPost('student_id')),
            'course'        => trim((string) $this->request->getPost('course')),
            'year_level'    => $this->request->getPost('year_level') !== '' ? (int) $this->request->getPost('year_level') : null,
            'section'       => trim((string) $this->request->getPost('section')),
            'phone'         => trim((string) $this->request->getPost('phone')),
            'address'       => trim((string) $this->request->getPost('address')),
            'profile_image' => $profileImageName,
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        if (! $this->userModel()->updateProfile($userId, $updateData)) {
            session()->setFlashdata('notif_error', 'Unable to update profile details. Please try again.');
            return redirect()->back()->withInput();
        }

        session()->set([
            'name'       => $name,
            'fullname'   => $name,
            'email'      => $email,
            'username'   => $email,
            'user'       => [
                'id'    => $userId,
                'name'  => $name,
                'email' => $email,
            ],
        ]);

        session()->setFlashdata('notif_success', 'Profile updated successfully.');
        return redirect()->to(base_url('profile'));
    }
}
