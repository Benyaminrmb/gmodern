<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store($table, $model, $value)
    {
        $user = Auth::user();
        $like=$model->likes->where('user_id', $user->id)->first();
         if (!$like) {

            $like = new Like();
            $like->user_id = $user->id;
            $like->value = $value;
            $like->likeable_id = $model->id;
            $like->likeable_type = $table;
            $like->save();

            return [$like];
        }

        $like->value = $value;
        $like->save();

        return [$like];
    }
}
