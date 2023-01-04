<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\SourceResource;
use App\Models\Category;
use App\Models\Source;
use App\Models\SourceUrl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    public function getAllSources(): \Illuminate\Http\JsonResponse
    {
        $sources=Source::all();
        $allSources = SourceResource::collection($sources);
        return $this->generateResponse($allSources,true,null,201);
    }
    public function storeSourceUrl($url,$source_id): SourceUrl
    {
        $sourceUrl=new SourceUrl();
        $sourceUrl->source_id=$source_id;
        $sourceUrl->url=$url;
        $sourceUrl->save();
        return $sourceUrl;
    }

    public function get($url)
    {
        $data=SourceUrl::where('url',$url)->first();
        if($data){
            return $data;
        }
        return false;
    }

    public function checkExist($url): bool
    {
        $data=SourceUrl::where('url',$url)->first();
        if($data){
            return true;
        }
        return false;
    }

    public function runner(): bool
    {
        $sources=Source::all();
        $source_handler=new CrawlerController();
        foreach ($sources as $source) {
            $classBuilder=new $source->namespace;
            $result=$classBuilder->run($source);
            $source_handler->newCrawledPost($result);
        }

        return true;
    }
}
