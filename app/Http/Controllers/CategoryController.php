<?php

namespace App\Http\Controllers;

use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $term = trim($request->term);
        $categories = Category::where([['name', 'LIKE',  '%' . $term . '%']])->orderBy('name', 'asc')->simplePaginate(10);

        $morePages = true;
        if (empty($categories->nextPageUrl())) {
            $morePages = false;
        }
        $results = array(
            "results" => $categories->items(),
            "pagination" => array(
                "more" => $morePages
            )
        );

        return $results;
    }
}
