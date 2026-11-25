<?php

use Illuminate\Database\Seeder;
use App\House;
use App\User;
use App\Agent;

class HousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user   = User::where('role', User::ROLE_AGENT)->first();
        $agent  = Agent::first();

        $houses = [
            [
                'user_id'        => $user->id,
                'agent_id'       => $agent->id,
                'title'          => '阳光花园 精装三房 南北通透',
                'description'    => '阳光花园小区，精装修三室两厅，南北通透，采光极佳。周边配套齐全，地铁口200米，学区房。',
                'price'          => 3200000,
                'type'           => House::TYPE_SECOND,
                'status'         => House::STATUS_SALE,
                'city'           => '深圳市',
                'district'       => '南山区',
                'address'        => '南山区阳光花园8栋3单元502室',
                'area'           => 98.5,
                'bedrooms'       => 3,
                'living_rooms'   => 2,
                'bathrooms'      => 2,
                'floor'          => '5',
                'total_floor'    => '18',
                'orientation'    => '南北',
                'decoration'     => '精装',
                'images'         => ['/img/demo/gallery-boxed.jpg', '/img/demo/gallery.png'],
                'is_featured'    => true,
            ],
            [
                'user_id'        => $user->id,
                'agent_id'       => $agent->id,
                'title'          => '翠湖豪苑 豪华四房 湖景房',
                'description'    => '翠湖豪苑一线湖景大平层，豪华装修，带超大阳台，视野开阔。物业管理优质，居住品质高。',
                'price'          => 6800000,
                'type'           => House::TYPE_SECOND,
                'status'         => House::STATUS_SALE,
                'city'           => '深圳市',
                'district'       => '福田区',
                'address'        => '福田区翠湖豪苑2栋1单元2801室',
                'area'           => 168.0,
                'bedrooms'       => 4,
                'living_rooms'   => 2,
                'bathrooms'      => 3,
                'floor'          => '28',
                'total_floor'    => '32',
                'orientation'    => '南',
                'decoration'     => '豪装',
                'images'         => ['/img/demo/gallery-boxed.jpg'],
                'is_featured'    => true,
            ],
            [
                'user_id'        => $user->id,
                'agent_id'       => $agent->id,
                'title'          => '城市绿洲 温馨两房 拎包入住',
                'description'    => '城市绿洲小区温馨两房，全新装修，家具家电齐全，拎包入住。适合年轻白领或小家庭居住。',
                'price'          => 1800000,
                'type'           => House::TYPE_SECOND,
                'status'         => House::STATUS_SALE,
                'city'           => '深圳市',
                'district'       => '宝安区',
                'address'        => '宝安区城市绿洲5栋2单元301室',
                'area'           => 72.0,
                'bedrooms'       => 2,
                'living_rooms'   => 1,
                'bathrooms'      => 1,
                'floor'          => '3',
                'total_floor'    => '15',
                'orientation'    => '东南',
                'decoration'     => '精装',
                'images'         => ['/img/demo/gallery.png'],
                'is_featured'    => false,
            ],
            [
                'user_id'        => $user->id,
                'agent_id'       => $agent->id,
                'title'          => '海景湾 新房开盘 三房户型',
                'description'    => '海景湾新楼盘开盘在售，一线海景，三房两厅户型，南北通透，社区配套完善，含学区。',
                'price'          => 5500000,
                'type'           => House::TYPE_NEW,
                'status'         => House::STATUS_SALE,
                'city'           => '深圳市',
                'district'       => '盐田区',
                'address'        => '盐田区海景湾大道88号',
                'area'           => 115.0,
                'bedrooms'       => 3,
                'living_rooms'   => 2,
                'bathrooms'      => 2,
                'floor'          => '12',
                'total_floor'    => '30',
                'orientation'    => '南',
                'decoration'     => '毛坯',
                'images'         => ['/img/demo/gallery-boxed.jpg'],
                'is_featured'    => true,
            ],
            [
                'user_id'        => $user->id,
                'agent_id'       => $agent->id,
                'title'          => '学府苑 精装一房 出租',
                'description'    => '学府苑精装一房出租，紧邻大学城，适合学生或青年教师。月租含物业费，拎包入住。',
                'price'          => 0,
                'rent_price'     => 3500,
                'type'           => House::TYPE_RENT,
                'status'         => House::STATUS_RENT,
                'city'           => '深圳市',
                'district'       => '南山区',
                'address'        => '南山区学府苑3栋605室',
                'area'           => 45.0,
                'bedrooms'       => 1,
                'living_rooms'   => 1,
                'bathrooms'      => 1,
                'floor'          => '6',
                'total_floor'    => '12',
                'orientation'    => '南',
                'decoration'     => '精装',
                'images'         => ['/img/demo/gallery.png'],
                'is_featured'    => false,
            ],
            [
                'user_id'        => $user->id,
                'agent_id'       => $agent->id,
                'title'          => '金域华府 舒适三房 已售',
                'description'    => '金域华府舒适三房，户型方正，采光好，小区绿化率高，配套成熟。',
                'price'          => 2900000,
                'type'           => House::TYPE_SECOND,
                'status'         => House::STATUS_SOLD,
                'city'           => '深圳市',
                'district'       => '龙岗区',
                'address'        => '龙岗区金域华府7栋3单元1203室',
                'area'           => 89.0,
                'bedrooms'       => 3,
                'living_rooms'   => 2,
                'bathrooms'      => 1,
                'floor'          => '12',
                'total_floor'    => '20',
                'orientation'    => '南北',
                'decoration'     => '普装',
                'images'         => ['/img/demo/gallery-boxed.jpg'],
                'is_featured'    => false,
            ],
        ];

        foreach ($houses as $houseData) {
            House::create($houseData);
        }
    }
}
