<?php

namespace App\Http\Controllers;
use App\Models\Author;
use App\Models\Category;
use App\Models\ArticleNews;
use App\Models\BannerAdvertisement;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index (){
        $categories = Category::all();

        $articles = ArticleNews::with(['category'])
        ->where('is_featured','not_featured')
        ->latest()
        ->take(3)
        ->get();


        $featured_articles = ArticleNews::with(['category'])
        ->where('is_featured','not_featured')
        ->inRandomOrder()
        ->take(3)
        ->get();

        $authors = Author::all();

        $bannerads = BannerAdvertisement::where('is_active', 'active')
        ->where('type', 'banner')
        ->inRandomOrder()
        // ->take(1)
        ->first();


        $entertainment_articles = ArticleNews::with('category')
        ->whereHas('category', function ($query) {
            $query->where('name', 'Entertainment');
        })
        ->latest()
        ->take(6)
        ->get();

        $entertainment_featured_articles = ArticleNews::with('category')
        ->whereHas('category', function ($query) {
        $query->where('name', 'Entertainment')
        ->where('is_featured', 'featured');
    })
    ->inRandomOrder()
    ->first();


        // $entertainment_featured_articles = ArticleNews::with('category')
        // ->whereHas('category', function ($query) {
        //     $query->where('name', 'Entertainment');
        // })
        // ->where('is_featured','not_featured')
        // ->inRandomOrder()
        // ->first();

        $business_articles = ArticleNews::with('category')
        ->whereHas('category', function ($query) {
            $query->where('name', 'Business');
        })
        ->latest()
        ->take(6)
        ->get();

        $business_featured_articles = ArticleNews::with('category')
    ->whereHas('category', function ($query) {
        $query->where('name', 'Business')
            ->where('is_featured', 'featured');
    })
    ->inRandomOrder()
    ->first();

    
    $automotive_articles = ArticleNews::with('category')
        ->whereHas('category', function ($query) {
            $query->where('name', 'Automotive');
        })
        ->latest()
        ->take(6)
        ->get();

        $automotive_featured_articles = ArticleNews::with('category')
        ->whereHas('category', function ($query) {
        $query->where('name', 'Automotive')
        ->where('is_featured', 'featured');
    })
    ->inRandomOrder()
    ->first();

        
    

        return view('front.index', [
            'categories' => $categories,
            'articles' => $articles,
            'authors' => $authors,
            'featured_articles' => $featured_articles,
            'bannerads' => $bannerads,
            'entertainment_articles' => $entertainment_articles,
            'entertainment_featured_articles' => $entertainment_featured_articles,
            'business_articles' => $business_articles,
            'business_featured_articles' => $business_featured_articles,
            'automotive_articles' => $automotive_articles,
            'automotive_featured_articles' => $automotive_featured_articles,

        ]);
        
    }



    
    //
};
