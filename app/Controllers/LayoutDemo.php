<?php

namespace App\Controllers;

class LayoutDemo extends BaseController
{
    public function index(): string
    {
        $data = array_merge($this->data, [
            'title' => 'Custom Layout Demo Page',
        ]);

        return view('pages/commons/layout_demo', $data);
    }
}
