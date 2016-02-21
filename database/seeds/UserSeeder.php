<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($count = 0; $count < 66; $count++) {
            User::create([
                'name' => '用户名' . str_random(random_int(1, 3)) . str_random(random_int(1, 4)),
                'email' => $this->random_num(9) . "@" . 'qq.com',
                'password' => bcrypt('123456'),
                'stu_num' => $this->random_num(),
                'user_info' => '',
                'address' => '沙河校区欣苑.' . $this->random_num(2) . '.栋',
                'nickname' => 'nickname_' . str_random(2),
            ]);
        }
    }

    function random_num($count = 13)
    {
        $data = '';
        for ($i = 0; $i < $count; $i++) {
            $data .= random_int(0, 9);
        }
        return $data;
    }
}
