<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $cliente = Category::create(['name'=>'Cliente']);
		$proveedor = Category::create(['name'=>'Proveedor']);
		$funinterno = Category::create(['name'=>'Funcionario Interno']);

		User::create([
			'name' => 'Joe',
			'lastname' => 'Doe',
			'dni' => '1234567890',
			'email' => 'joedoe@admin.io',
			'country' => 'CO',
			'address' => 'Calle siempre viva 123',
			'phone' => '3001234567',
			'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
			'category_id' => $funinterno->id,
		]);
    }
}
