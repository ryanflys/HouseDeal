<?php

use Illuminate\Database\Seeder;
use App\Agent;
use App\User;

class AgentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agentUser = User::where('role', User::ROLE_AGENT)->first();

        Agent::create([
            'user_id'     => $agentUser->id,
            'name'        => '张经纪',
            'phone'       => '13800000002',
            'email'       => 'agent@housedeal.com',
            'agency'      => 'HouseDeal 地产',
            'license_no'  => 'AG20240001',
            'avatar'      => '/img/demo/av2.jpg',
            'description' => '资深房产经纪人，5年行业经验，专注二手房交易。',
            'rating'      => 4.8,
        ]);

        Agent::create([
            'name'        => '李经纪',
            'phone'       => '13800000003',
            'email'       => 'agent2@housedeal.com',
            'agency'      => 'HouseDeal 地产',
            'license_no'  => 'AG20240002',
            'avatar'      => '/img/demo/av3.jpg',
            'description' => '擅长新房销售，熟悉各区域楼盘信息。',
            'rating'      => 4.6,
        ]);
    }
}
