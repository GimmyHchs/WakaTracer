<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 各自建立基本Prototype資料，最後藉由InitPrototypes連結關聯
        $this->call(ProtomissionTableSeeder::class);
        $this->call(ProtolevelTableSeeder::class);
        $this->call(ProtolanguageTableSeeder::class);
        $this->call(InitPrototypes::class);
    }
}
