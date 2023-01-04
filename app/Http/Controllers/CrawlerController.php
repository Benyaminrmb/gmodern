<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SourceController;
use App\Http\Controllers\Sources\DbaziHandlerController;
use App\Http\Controllers\Sources\GamefaHandlerController;
use App\Http\Controllers\Sources\ZoomgHandlerController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CategoryController;
use App\Models\Post;
use App\Models\Source;
use Goutte\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerController extends Controller
{

    /**
     * @throws GuzzleException
     */
    public function test()
    {
        $DbaziHandlerController=new DbaziHandlerController();

        $source=Source::find(3);
        $run=$DbaziHandlerController->run($source);
    }

    public function run(): bool
    {
        $sourceController = new SourceController();
        return ($sourceController->runner());
    }
    public function getDetail(Post $post)
    {
        $source = $post->source_url->source;
        $source_controller = new $source->namespace;
        return $source_controller->getDetail($post);

    }
    /**
     * @param array $response
     */
    public function newCrawledPost(array $response)
    {

        $postController = new PostController();
        $categoryController = new CategoryController();
        $sourceController = new SourceController();
        $telegram_controller = new TelegramController();
        foreach ($response['posts'] as $item) {

            $arrayCategories = [];


            foreach ($item['categories'] as $key => $category) {
                if (!$newCategory = $categoryController->checkExist($category['name'])) {
                    $newCategory = $categoryController->store($category['name']);
                }
                $arrayCategories = array_merge($arrayCategories, [$newCategory->id]);

              /*  if (!$sourceController->checkExist($category['url'])) {
                    $newSourceUrl = $sourceController->storeSourceUrl($category['url'], $response['source']['id']);
                } else {
                    $newSourceUrl = $sourceController->get($category['url']);
                }*/
            }


            if (!$postController->checkUrlExist($item['url'])) {
                $posts = new Post();
                $posts->title = $item['title'];
                $posts->text = $item['text'];
                $posts->img = $item['img'];
                $posts->source_url_id = $response['source']['source_urls'][0]['id'];
                $posts->biggerImg = $item['biggerImg'];
                $posts->url = $item['url'];
                $posts->save();
                $posts->categories()->attach(array_unique($arrayCategories));

                $url='https://gmodern.ir/post/'.$posts->id;
                $title=$telegram_controller->bodyGenerator($posts->title,$posts->source_url->source->name,$posts->categories,$url);
                $telegram_controller->store('sendPhoto',$title,$posts->biggerImg);

            }

        }
    }
}
