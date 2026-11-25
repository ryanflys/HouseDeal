<?php

use Illuminate\Database\Seeder;
use App\Deal;
use App\House;
use App\Agent;
use App\User;

class DealsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agent  = Agent::first();
        $admin  = User::where('role', User::ROLE_ADMIN)->first();
        $soldHouse = House::where('status', House::STATUS_SOLD)->first();

        if ($soldHouse) {
            Deal::create([
                'house_id'   => $soldHouse->id,
                'agent_id'   => $agent->id,
                'seller_id'  => $admin->id,
                'buyer_id'   => User::where('role', User::ROLE_USER)->first()->id ?? 1,
                'deal_price' => $soldHouse->price,
                'status'     => Deal::STATUS_DONE,
                'deal_type'  => 'sale',
                'signed_at'  => now()->subDays(15),
            ]);
        }

        // A pending deal
        $saleHouse = House::where('status', House::STATUS_SALE)->first();
        if ($saleHouse) {
            Deal::create([
                'house_id'   => $saleHouse->id,
                'agent_id'   => $agent->id,
                'seller_id'  => $admin->id,
                'buyer_id'   => User::where('role', User::ROLE_USER)->orderBy('id', 'desc')->first()->id ?? 3,
                'deal_price' => $saleHouse->price,
                'status'     => Deal::STATUS_PENDING,
                'deal_type'  => 'sale',
            ]);
        }
    }
}
