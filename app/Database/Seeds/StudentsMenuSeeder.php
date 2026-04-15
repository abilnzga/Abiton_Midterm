<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StudentsMenuSeeder extends Seeder
{
    public function run()
    {
        $category = $this->db->table('user_menu_category')
            ->where('menu_category', 'Common Page')
            ->get()
            ->getRowArray();

        $categoryId = $category ? (int) $category['id'] : 1;

        $menu = $this->db->table('user_menu')
            ->where('url', 'students')
            ->get()
            ->getRowArray();

        if (!$menu) {
            $this->db->table('user_menu')->insert([
                'menu_category' => $categoryId,
                'title'         => 'Students',
                'url'           => 'students',
                'icon'          => 'users',
                'parent'        => 0,
            ]);
            $menuId = (int) $this->db->insertID();
        } else {
            $menuId = (int) $menu['id'];
        }

        $access = $this->db->table('user_access')
            ->where(['role_id' => 1, 'menu_id' => $menuId])
            ->get()
            ->getRowArray();

        if (!$access) {
            $this->db->table('user_access')->insert([
                'role_id'          => 1,
                'menu_category_id' => 0,
                'menu_id'          => $menuId,
                'submenu_id'       => 0,
            ]);
        }
    }
}
