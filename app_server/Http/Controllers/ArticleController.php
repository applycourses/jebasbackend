<?php

namespace App\Http\Controllers;

use App\Article;
use App\Country;
use App\Post_taxonomy;
use App\Seo;
use App\StudyLevel;
use App\Subject;
use App\Tag_taxonomy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\DocBlock\Tag;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contents/blogs/articles/list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('name','name')->all();
        return view('contents/blogs/articles/add',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $description   = $request->description;
       $tags          = $request->tags;
       $category      = $request->selectedCategory;
       $titleOfImage  = $request->titleOfImage;
       $name          = $request->name;

       $string_time = strtotime(Carbon::now());



       if($request->hasFile('image')){
           $s3                     = Storage::disk('s3');
           $filePath               = 'articles/'.uniqid().$request->image;
           $path                   = $s3->put($filePath,$request->image, 'public');
       }

       $post= [
           'name' => $name,
           'image_title' =>$titleOfImage,
           'description' => $description,
           'image_path' => ($path) ? $path : 'sdasdas',
           'url' =>  $string_time.'/'.str_slug($name),
       ];

       $post = Article::create($post);


       if($post->id)
       {
           $category =  explode(",",$category);
               foreach($category as $key => $value){
                   Post_taxonomy::create([
                       'post_id' => $post->id,
                       'category' => $value
                   ]);
               }
               $tags =  explode(",",$tags);
               foreach($tags as $key => $value){
                    Tag_taxonomy::create([
                       'post_id' => $post->id,
                       'tag'     => $value
                   ]);
               }
               $seo_data = [
                   'row_id' => $post->id,
                   'type'   => 'articles',
                   'title' => $request->fb_title,
                   'description' => $request->fb_description,
                   'image' =>  Storage::disk('s3')->url($path),
                   'keywords' =>  $request->tags
               ];

              Seo::create($seo_data);

            $message = ['succcess' => true];
       }else{
           $message = ['succcess' => false];
       }
       return response()->json($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('contents.blogs.articles.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article_old   = Article::find($request->id);
        $tags          = $request->tags;
        $category = $request->selectedCategory;
        Post_taxonomy::where('post_id', $id)->delete();
        Tag_taxonomy::where('post_id', $id)->delete();
        $seo_old         = Seo::where('type','articles')->where('row_id',$id)->first();
        $seo_new['description'] = $request->fb_description;
        $seo_new['title	'] = $request->title;


       $old             = Article::find($request->id);


       $article_new = [];
       $article_new['name'] = $request->name;
       $article_new['image_title'] = $request->titleOfImage;
       $article_new['description'] = $request->description;

        if($request->hasFile('image')){
            $s3                     = Storage::disk('s3');
            $filePath               = 'articles/'.uniqid().$request->image;
            $article_new['image_path']    = $s3->put($filePath,$request->image, 'public');
            $seo_new['image'] =  $article_new['image_path'];
        }
        $post = $article_old->update($article_new);
        if($post)
        {
            $category =  explode(",",$category);
            foreach($category as $key => $value){
                Post_taxonomy::create([
                    'post_id' => $id,
                    'category' => $value
                ]);
            }
            $tags =  explode(",",$tags);
            foreach($tags as $key => $value){
                Tag_taxonomy::create([
                    'post_id' => $id,
                    'tag'     => $value
                ]);
            }
            $seo_old->update($seo_new);
            $message = ['success' => true];
        }


       return response()->json($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function all_category(){
        $countries = Country::pluck('name');
        $study_levels = StudyLevel::pluck('name');
        $subjects = Subject::pluck('name');
        $others = ['Test Preparation'];
        $data = [
            'countries' => $countries,
            'study_levels' => $study_levels,
            'subjects' => $subjects,
            'others' => $others
        ];
        return response()->json($data);

    }
    public function all_articles(Request $request){

        if($request->has('per_page'))
            $per_page= $request->per_page;
        else
            $per_page = 20;


        if($request->has('search_query'))
            $data = Article::where('name','like','%'.$request->search_query.'%')->paginate($per_page);
        else
            $data = Article::paginate($per_page);

        return response()->json($data);

    }
    public function get_data($id){
        $all_tags               = array();
        $all_categories         = array();
        $article                = Article::find($id);
        $article['image_path']  = Storage::disk('s3')->url($article->image_path);
        $tags                   = Tag_taxonomy::where('post_id', $id)->get();
        $category               = Post_taxonomy::where('post_id', $id)->get();
        $article['seos']        = Seo::select('id','title','description')->where('type','articles')->where('row_id',$id)->first();

        foreach($category as $key => $value)
        {
            if($key == 0)
                $all_categories[$key]= $value->category;
            else
                $all_categories[$key]= $value->category;

        }
        $article['category'] =$all_categories;
        foreach($tags as $key => $value){
            if($key == 0){
                $all_tags[$key]= $value->tag;
            }else{
                $all_tags[$key]= $value->tag;
            }
        }
        $article['tags'] = $all_tags;
        return response()->json($article);

    }
}
