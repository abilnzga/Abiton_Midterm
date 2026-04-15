<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MasterLayoutMenu extends Seeder
{
    public function run()
    {
        $category = $this->db->table('user_menu_category')
            ->where('menu_category', 'Common Page')
            ->get()
            ->getRowArray();

        if (!$category) {
            $this->db->table('user_menu_category')->insert([
                'menu_category' => 'Common Page',
            ]);
            $categoryId = (int) $this->db->insertID();
        } else {
            $categoryId = (int) $category['id'];
        }

        $menu = $this->db->table('user_menu')
            ->where('url', 'master-layout')
            ->get()
            ->getRowArray();

        if (!$menu) {
            $this->db->table('user_menu')->insert([
                'menu_category' => $categoryId,
                'title' => 'Master Layout',
                'url' => 'master-layout',
                'icon' => 'layout',
                'parent' => 0,
            ]);
            $menuId = (int) $this->db->insertID();
        } else {
            $menuId = (int) $menu['id'];
        }

        $access = $this->db->table('user_access')
            ->where([
                'role_id' => 1,
                'menu_id' => $menuId,
            ])
            ->get()
            ->getRowArray();

        if (!$access) {
            $this->db->table('user_access')->insert([
                'role_id' => 1,
                'menu_category_id' => 0,
                'menu_id' => $menuId,
                'submenu_id' => 0,
            ]);
        }
    }
}
