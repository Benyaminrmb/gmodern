<?php

namespace Database\Seeders;

use App\Http\Controllers\Sources\GamefaHandlerController;
use App\Http\Controllers\Sources\ZoomgHandlerController;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
//        \App\Models\User::factory(10)->create();

        $this->call(SourceSeeder::class);


        DB::table('categories')->insert([
            'name' => 'متفرقه',
            'status' => 'active',
        ]);
        DB::table('source_urls')->insert([
            'source_id' => '1',
            'url' => 'https://www.zoomg.ir/',
        ]);
        DB::table('source_urls')->insert([
            'source_id' => '2',
            'url' => 'https://gamefa.com/',
        ]);
        DB::table('source_urls')->insert([
            'source_id' => '3',
            'url' => 'https://dbazi.com/',
        ]);
    }
}
