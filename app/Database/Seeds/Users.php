<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Users extends Seeder
{
	public function run()
	{
		$categories = [
			'Common Page',
			'Settings',
		];

		foreach ($categories as $categoryName) {
			$existingCategory = $this->db->table('user_menu_category')->where('menu_category', $categoryName)->get()->getRowArray();
			if (! $existingCategory) {
				$this->db->table('user_menu_category')->insert([
					'menu_category' => $categoryName,
				]);
			}
		}

		$commonCategory = $this->db->table('user_menu_category')->where('menu_category', 'Common Page')->get()->getRowArray();
		$settingsCategory = $this->db->table('user_menu_category')->where('menu_category', 'Settings')->get()->getRowArray();

		$menus = [
			[
				'menu_category' => $commonCategory['id'],
				'title' => 'Dashboard',
				'url' => 'dashboard',
				'icon' => 'home',
				'parent' => 0,
			],
			[
				'menu_category' => $settingsCategory['id'],
				'title' => 'Users',
				'url' => 'users',
				'icon' => 'user',
				'parent' => 0,
			],
			[
				'menu_category' => $settingsCategory['id'],
				'title' => 'Menu Management',
				'url' => 'menu-management',
				'icon' => 'command',
				'parent' => 0,
			],
		];

		foreach ($menus as $menu) {
			$existingMenu = $this->db->table('user_menu')->where('url', $menu['url'])->get()->getRowArray();
			if (! $existingMenu) {
				$this->db->table('user_menu')->insert($menu);
			}
		}

		$existingRole = $this->db->table('user_role')->where('id', 1)->get()->getRowArray();
		if (! $existingRole) {
			$this->db->table('user_role')->insert([
				'id' => 1,
				'role_name' => 'Developer',
			]);
		}

		$existingUser = $this->db->table('users')->where('username', 'developer@mail.io')->get()->getRowArray();
		if (! $existingUser) {
			$this->db->table('users')->insert([
				'fullname' => 'Developer',
				'name' => 'Developer',
				'username' => 'developer@mail.io',
				'email' => 'developer@mail.io',
				'password' => password_hash('123456', PASSWORD_BCRYPT),
				'role' => 1,
				'created_at' => date('Y-m-d h:i:s'),
				'updated_at' => date('Y-m-d h:i:s'),
			]);
		} else {
			$this->db->table('users')->update([
				'name' => 'Developer',
				'email' => 'developer@mail.io',
			], ['id' => $existingUser['id']]);
		}

		$accessRows = [
			['role_id' => 1, 'menu_category_id' => $commonCategory['id'], 'menu_id' => 0, 'submenu_id' => 0],
			['role_id' => 1, 'menu_category_id' => 0, 'menu_id' => $this->getMenuId('dashboard'), 'submenu_id' => 0],
			['role_id' => 1, 'menu_category_id' => $settingsCategory['id'], 'menu_id' => 0, 'submenu_id' => 0],
			['role_id' => 1, 'menu_category_id' => 0, 'menu_id' => $this->getMenuId('users'), 'submenu_id' => 0],
			['role_id' => 1, 'menu_category_id' => 0, 'menu_id' => $this->getMenuId('menu-management'), 'submenu_id' => 0],
		];

		foreach ($accessRows as $accessRow) {
			$existingAccess = $this->db->table('user_access')->where($accessRow)->get()->getRowArray();
			if (! $existingAccess) {
				$this->db->table('user_access')->insert($accessRow);
			}
		}
	}

	private function getMenuId(string $url): int
	{
		$menu = $this->db->table('user_menu')->where('url', $url)->get()->getRowArray();

		return (int) ($menu['id'] ?? 0);
	}
}
