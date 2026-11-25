<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        User::create([
            'name'     => '管理员',
            'email'    => 'admin@housedeal.com',
            'password' => bcrypt('admin123'),
            'phone'    => '13800000001',
            'role'     => User::ROLE_ADMIN,
            'avatar'   => '/img/demo/av1.jpg',
        ]);

        // Agent user
        User::create([
            'name'     => '张经纪',
            'email'    => 'agent@housedeal.com',
            'password' => bcrypt('agent123'),
            'phone'    => '13800000002',
            'role'     => User::ROLE_AGENT,
            'avatar'   => '/img/demo/av2.jpg',
        ]);

        // Regular users
        factory(User::class, 5)->create()->each(function ($user) {
            $user->update(['role' => User::ROLE_USER]);
        });
    }
}
