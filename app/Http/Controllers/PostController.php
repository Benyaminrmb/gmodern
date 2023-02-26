<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\LikeResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\SourceResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\Source;
use App\Models\User;
use App\Models\Vote;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function getList(Request $request)
    {
        $sources = Source::all();
        $posts = Post::whereStatus('active')
            ->whereNot('position',['advertising'])
            ->orderBy('id', 'desc')->paginate(10)->through(function ($item) {
            return PostResource::make($item);
        });


        $bannerPosts = PostResource::collection($this->getPostsByPosition('banner', '5'));
        $specialPosts = PostResource::collection($this->getPostsByPosition('special', '4'));
        $mostVisitPosts = PostResource::collection($this->getPostsByVisit('6'));
        $allSources = SourceResource::collection($sources);

        $posts = array_merge(
            ['indexPosts' => $posts],
            ['bannerPosts' => $bannerPosts],
            ['specialPosts' => $specialPosts],
            ['mostVisitPosts' => $mostVisitPosts],
            ['allSources' => $allSources]
        );

        return $this->generateResponse($posts);
    }

    public function getPostsByPosition($position, $limit, $category_id = null)
    {
        if ($category_id) {
            $posts = Post::whereHas('categories', function ($query) use ($category_id) {
                return $query->where('category_id', $category_id);
            })
                ->status('active')
                ->position($position)
                ->orderBy('updated_at', 'desc')
                ->orderBy('id', 'desc')
                ->with('source_url.source')
                ->with('categories')
                ->limit($limit)
                ->get();
        } else {

            $posts = Post::status('active')
                ->position($position)
                ->orderBy('updated_at', 'desc')
                ->orderBy('id', 'desc')
                ->with('source_url.source')
                ->with('categories')
                ->limit($limit)
                ->get();
        }
        return $posts;
    }

    public function getPostsByVisit($limit, $days = '30')
    {
        return Post::status('active')
            ->where('created_at', '>=', Carbon::now()->subDays(30)->toDateTimeString())
            ->orderBy('visit', 'desc')
            ->orderBy('id', 'desc')
            ->with('source_url.source')
            ->with('categories')
            ->limit($limit)
            ->get();
    }

    public function getCategoryPostsByPosition($position, $limit, $categoryId)
    {

        $related_posts = Post::whereHas('categories', function ($query) use ($categoryId) {
            return $query->where('category_id', $categoryId);
        })
            ->position($position)
            ->orderBy('updated_at', 'desc')
            ->orderBy('id', 'desc')
            ->with('source_url.source')
            ->with('categories')
            ->limit($limit)
            ->get();

        return $related_posts;

    }


    public function getRelatedCategoryPosts($post, $limit = 5, $position = null)
    {

        $related_category_ids = $post->categories()->pluck('categories.id');

        $related_posts = Post::whereHas('categories', function ($q) use ($related_category_ids) {
            $q->whereIn('category_id', $related_category_ids);
        })
            ->where('id', '<>', $post->id)
            ->position($position)
            ->status('active')
            ->orderBy('updated_at', 'desc')
            ->orderBy('id', 'desc')
            ->with('source_url.source')
            ->with('categories')
            ->limit($limit)
            ->get();
        return $related_posts;
    }

    public function getRelatedPositionPosts($post, $limit = 5)
    {

        return Post::status('active')
            ->where('id', '<>', $post->id)
            ->position($post->position)
            ->orderBy('updated_at', 'desc')
            ->orderBy('id', 'desc')
            ->with('source_url.source')
            ->with('categories')
            ->limit($limit)
            ->get();
    }


    public function getAdminList()
    {

        $posts = Post::orderBy('created_at','desc')->paginate(10)->through(function ($item) {
            return PostResource::make($item);
        });


        return $this->generateResponse($posts);
    }

    public function postUpdate(Post $post, Request $request)
    {
        $request->validate([
            'name' => 'string',
            'text' => 'string',
            'position' => 'in:default,special,banner,advertising',
            'status' => 'boolean',
        ]);

        $updateFillers = [
            'title',
            'text',
            'position',
            'status',
        ];

        foreach ($updateFillers as $updateFiller) {
            if (isset($request->$updateFiller)) {
                if ($updateFiller == 'status') {
                    $request->$updateFiller = $this->booleanStatusToString($request->$updateFiller);
                }
                $post->$updateFiller = $request->$updateFiller;
            }
        }

        $post->update();
        $post->refresh();

        return $this->generateResponse(PostResource::make($post));
    }

    public function booleanStatusToString($val): string
    {
         if ($val) {
            return 'active';
        }
        return 'removed';
    }

    public function getAdminPost($id)
    {
        $post = Post::where('id', $id)
            ->with('source_url.source')
            ->with('categories')
            ->first();
        $post->shamsi_created_at = Verta::instance($post->created_at)->format('%B %d، %Y');
        return response()->json($post);
    }

    public function getListByCategory(Request $request, $category_id): \Illuminate\Http\JsonResponse
    {
        $category = Category::status('active')
            ->where('id', $category_id)->first();
        $current_page = $request->input("page") ?? 1;
        $per_page = '8';
        $skip = ($current_page - 1) * $per_page;

        $all_posts = Post::whereHas('categories', function ($query) use ($category_id) {
            return $query->where('category_id', $category_id);

        })->status('active')
            ->orderBy('id', 'desc')
            ->count();

        $posts = Post::whereHas('categories', function ($query) use ($category_id) {
            return $query->where('category_id', $category_id);

        })->status('active')
            ->skip($skip)
            ->orderBy('id', 'desc')
            ->limit($per_page)
            ->get();
        $total_count = $all_posts;

        $posts = $this->resourcePagination(PostResource::collection($posts), $total_count, $per_page, $current_page);
        $bannerPosts = PostResource::collection($this->getPostsByPosition('banner', '5', $category_id));
        $specialPosts = PostResource::collection($this->getPostsByPosition('special', '4', $category_id));

        $posts = array_merge(
            ['indexPosts' => $posts],
            ['category' => $category],
            ['bannerPosts' => $bannerPosts],
            ['specialPosts' => $specialPosts],
        );

        return $this->generateResponse($posts, true, null, 201);

    }

    public function getListBySource(Request $request, $source_id): \Illuminate\Http\JsonResponse
    {
        $source = Source::status('active')
            ->where('id', $source_id)->first();
        $current_page = $request->input("page") ?? 1;
        $per_page = '8';
        $skip = ($current_page - 1) * $per_page;

        $all_posts = Post::whereHas('categories', function ($query) use ($category_id) {
            return $query->where('category_id', $category_id);

        })->status('active')
            ->orderBy('id', 'desc')
            ->count();

        $posts = Post::whereHas('categories', function ($query) use ($category_id) {
            return $query->where('category_id', $category_id);

        })->status('active')
            ->skip($skip)
            ->orderBy('id', 'desc')
            ->limit($per_page)
            ->get();
        $total_count = $all_posts;

        $posts = $this->resourcePagination(PostResource::collection($posts), $total_count, $per_page, $current_page);
        $bannerPosts = PostResource::collection($this->getPostsByPosition('banner', '5', $category_id));
        $specialPosts = PostResource::collection($this->getPostsByPosition('special', '4', $category_id));

        $posts = array_merge(
            ['indexPosts' => $posts],
            ['category' => $category],
            ['bannerPosts' => $bannerPosts],
            ['specialPosts' => $specialPosts],
        );

        return $this->generateResponse($posts, true, null, 201);

    }


    public function getDetail($id)
    {
        ini_set('max_execution_time', 180);
        $crawlerController = new CrawlerController();

        $post = Post::where('id', $id)
            ->status('active')
            ->with('source_url.source')
            ->with('categories')
            ->first();

        $post->increment('visit');
//        $post->save();

        $result = $crawlerController->getDetail($post);

        $post->html = $result;


        $special_posts = $this->getRelatedPositionPosts($post, '2');
        $category_posts = $this->getRelatedCategoryPosts($post, '4');


        $special_posts = PostResource::collection($special_posts);
        $post = PostResource::make($post);

        $posts = array_merge(['post' => $post], ['special_posts' => $special_posts], ['category_posts' => $category_posts]);

        return $this->generateResponse($posts);
    }

    public
    function checkUrlExist($url): bool
    {
        $post = Post::where('url', $url)->first();
        if ($post) {
            return true;
        }
        return false;
    }

    public
    function likePost(Request $request, $id)
    {
        $post = Post::status('active')->find($id);

        $like_controller = new LikeController();
        $like_controller->store(Post::class, $post, 1);

        return $this->generateResponse(LikeResource::make($post));
    }

    public
    function dislikePost(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $post = Post::status('active')->find($id);

        $like_controller = new LikeController();
        $like_controller->store(Post::class, $post, 0);

        return $this->generateResponse(LikeResource::make($post));
    }


}
