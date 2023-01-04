<?php

namespace Database\Seeders;

use App\Http\Controllers\Sources\DbaziHandlerController;
use App\Http\Controllers\Sources\GamefaHandlerController;
use App\Http\Controllers\Sources\ZoomgHandlerController;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sources')->insert([
            'name' => 'zoomg',
            'name_fa' => 'زومجی',
            'namespace' => ZoomgHandlerController::class,
            'icon' => 'https://www.zoomg.ir/favicon.ico',
            'url' => 'https://www.zoomg.ir/',
        ]);
        DB::table('sources')->insert([
            'name' => 'gamefa',
            'name_fa' => 'گیمفا',
            'namespace' => GamefaHandlerController::class,
            'icon' => 'https://gamefa.com/wp-content/uploads/2019/09/cropped-icon-180x180.png',
            'url' => 'https://gamefa.com/',
        ]);
        DB::table('sources')->insert([
            'name' => 'dbazi',
            'name_fa' => 'دنیای بازی',
            'namespace' => DbaziHandlerController::class,
            'icon' => 'https://www.dbazi.com/wp-content/themes/dbazi/dist/images/logo.svg',
            'url' => 'https://dbazi.com/',
        ]);
    }
}
