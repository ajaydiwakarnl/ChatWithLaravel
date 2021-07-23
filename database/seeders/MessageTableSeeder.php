<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::insert([
           [
                'user_id' => 1,
                'message' => "Hello Sam Drick",
                'senderId' => 2,
                'type' => 1
           ],
            [
                'user_id' => 1,
                'message' => "Please provide your bank details",
                'senderId' => 2,
                'type' => 1
            ],
            [
                'user_id' => 2,
                'message' => "Hii Novus Logics",
                'senderId' => 1,
                'type' => 2
            ],
            [
                'user_id' => 2,
                'message' => "I already mail you,please check it",
                'senderId' => 1,
                'type' => 2
            ],



        ]);
    }
}
