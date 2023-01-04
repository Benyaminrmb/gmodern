<?php

namespace App\Http\Controllers\Sources;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Source;
use Goutte\Client;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class DbaziHandlerController extends SourceHandlerController
{

    public function run(Source $source): array
    {

        $client = new Client();
        $posts = [];
        foreach ($source->source_urls as $url) {
            $crawler = $client->request('GET', $url->url);
            $posts['posts'] = $crawler->filter('.box_main article')->each(function (Crawler $node, $i) use ($client) {
                $result['url']=$node->filter('h2')->filter('a')->attr('href');
                $result['title'] = $node->filter('h2')->text();
                $result['biggerImg'] = $this->biggerImg($node->filter('img')->attr('data-lazy-src'));
                $result['img'] = $result['biggerImg'];
//                $result['img'] = $node->filter('img')->attr('data-lazy-src');
                $result['text'] = $node->filter('p')->text();

                $peed_crawler = $client->request('GET', $result['url']);
                $result['text'] = $peed_crawler->filter('article')->filter('p')->text();


                $result['categories'] = $peed_crawler->filter('ul.tags')->filter('a')->each(function (Crawler $node, $i) {
                    $category['name'] = $node->text();
                    $category['url'] = $node->attr('href');
                    return $category;
                });

                return $result;
            });


            $posts['source'] = $source;
        }
        return $posts;
    }

    public function getDetail(Post $post): string
    {
        $client = new Client();
        $page = $client->request('GET', $post->url);
        $articleExcerptNode = $page->filter('.the-content');

        return $articleExcerptNode->html();
    }

    /**
     * @param string|null $src
     * @return string
     */
    private function biggerImg(string $src): string
    {
        if (preg_match('/((?:webp|jpeg))$/', $src)) {
            $get_extension = substr($src, '-5', '5');
        } else {
            $get_extension = substr($src, '-4', '4');
        }

        $img = preg_replace('/--?\d*x\d*\..*/', "", $src) . $get_extension;
        if (strstr($src, '.jpeg')) {
            $img = preg_replace('/.jpeg.*/', "", $src) . '.jpeg';
        }
        return $img;
    }
}
