<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TelegramController extends Controller
{
    /**
     * @var string
     */
    private $main_url;

    public function __construct()
    {
        $this->main_url = 'https://api.telegram.org';
    }


    public function bodyGenerator($title, $source, $categories, $link): string
    {
        $categories_in_text = '';
        foreach ($categories as $key => $category) {
            $categories_in_text .='🔰 #'.preg_replace('/\s+/', '\\_', $category->name).PHP_EOL;
                if ($key == 3) break;
        }
        return $title . PHP_EOL.$categories_in_text. PHP_EOL.'  '. PHP_EOL . '[🟣بیشتر بخونید](' . $link . ')' . PHP_EOL .PHP_EOL. '#' . str_replace(' ', '_', $source).PHP_EOL.'#Gmodern'. PHP_EOL;
    }

    public function store($method, $title, $photo = null)
    {
        $url = $this->main_url . '/' . env('TELEGRAM_BOT') . '/' . $method;
        $data = [
            'chat_id' => env('TELEGRAM_PUBLIC_CHANNEL_ID'),
            'text' => $title,
            'parse_mode' => "markdown",
        ];
        if (!empty($photo)) {
            $data['photo'] = $photo;
            $data['caption'] = $title;
        }


//        $response=Http::get($url,$data);


//        return $response = Http::get($url, $data);
//
//
//        $ddd = $this->generateResponse($this->generateResponse($response), false, '', 400);
//        throw new HttpResponseException($ddd);
    }
}
