<?php

namespace App\Http\Controllers\Sources;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Source;
use Goutte\Client;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class ZoomgHandlerController extends SourceHandlerController
{

    public function run(Source $source): array
    {


        $client = new Client();
        $posts = [];
        foreach ($source->source_urls as $url) {
            $crawler = $client->request('GET', $url->url);
            $posts['posts'] = $crawler->filter('.boxWrapper')->each(function (Crawler $node, $i) {
                $result['url'] = $node->filter('h3')->filter('a')->attr('href');
                if (empty($node->filter('.imgContainer')->filter('.js-lazy-load')->attr('data-src'))) {
                    $result['img'] = substr($node->filter('.imgContainer')->filter('a')->attr('data-bc'), 5, -2);
                } else {
                    $result['img'] = $node->filter('.imgContainer')->filter('.js-lazy-load')->attr('data-src');
                }
                $result['biggerImg'] = $this->biggerImg($result['img']);
                $result['title'] = $node->filter('h3')->text();
                $result['text'] = $node->filter('p')->text();
                $result['categories'] = $node->filter('.topicCategories a')->each(function (Crawler $node, $i) {
                    $category['name'] = $node->filter('label')->text();
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
        $articleExcerptNode = $page->filter('#bodyContainer');


        $articleExcerptNode->filter('.beforesource')->each(function (Crawler $crawler) {
            foreach ($crawler as $node) {
                $node->parentNode->removeChild($node);
            }
        });
        $articleExcerptNode->filter('.larticle')->each(function (Crawler $crawler) {
            foreach ($crawler as $node) {
                $node->parentNode->removeChild($node);
            }
        });

        return $articleExcerptNode->html();
    }

    private function biggerImg($src)
    {
        return preg_replace('/--?\d*x-?\d*/','',$src);
    }
}
