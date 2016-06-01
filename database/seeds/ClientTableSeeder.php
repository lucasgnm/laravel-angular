<?php

use Illuminate\Database\Seeder;
use NettworkProject\Entities\Clients;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clients::truncate();
        factory(Clients::class, 10)->create();
    }
}
