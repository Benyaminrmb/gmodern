<?php

namespace  App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store($name): Category
    {
        $category=new Category();
        $category->name=$name;
        $category->status='active';
        $category->save();
        return ($category);
    }

    public function ddd()
    {
        return 'ddd runed !!!';
    }
    public function getList()
    {
        $data = Category::where('status', 'active')->get();
        return response($data);
    }
    public function getAdminList()
    {
        $data = Category::where('status', 'active')->get();
        return response($data);
    }
    public function checkExist($name)
    {
        $post=Category::where('name','LIKE','%'.$name.'%')->first();
        if($post){
            return $post;
        }
        return false;
    }
}
