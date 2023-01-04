<?php

namespace App\Http\Controllers\Sources;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Source;
use Goutte\Client;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class GamefaHandlerController extends SourceHandlerController
{

    public function run(Source $source): array
    {

        $client = new Client();
        $posts = [];
        foreach ($source->source_urls as $url) {
            $crawler = $client->request('GET', $url->url);
            $posts['posts'] = $crawler->filter('#posts-body .posts .box')->each(function (Crawler $node, $i) use ($client) {
                $result['url'] = $node->filter('.d-block.px-2')->attr('href');
                $src = $node->filter('.position-relative.image')->filter('img')->attr('src');



                $result['biggerImg'] = $this->biggerImg($src);


                $result['title'] = $node->filter('h3')->text();

                $peed_crawler = $client->request('GET', $result['url']);
                $result['text'] = $peed_crawler->filter('.content')->filter('p')->text();
                $result['img'] = $peed_crawler->filter('.single-article')->filter('.text-center')->filter('img')->attr('src');


//                $result['text'] = $node->filter('p')->text();
                $result['categories'] = $peed_crawler->filter('.meta')->filter('a[rel="category tag"]')->each(function (Crawler $node, $i) {
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

    public function getDetail(Post $post): string
    {
        $client = new Client();
        $page = $client->request('GET', $post->url);


        $articleExcerptNode = $page->filter('.content-area div.content');


        $articleExcerptNode->filter('.wpulike')->each(function (Crawler $crawler) {
            foreach ($crawler as $node) {
                $node->parentNode->removeChild($node);
            }
        });

        return $articleExcerptNode->html();
    }
}
