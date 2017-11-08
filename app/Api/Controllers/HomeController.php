<?php
/**
 * Created by PhpStorm.
 * User: xiaohai
 * Date: 17/8/4
 * Time: 22:19
 */

namespace App\Api\Controllers;



use App\Anime;
use App\Api\Transformers\ReplyTransformer;
use App\Article;
use App\Commit;
use App\Movie;
use App\Picture;
use App\Topic;
use App\Tv;

class HomeController extends BaseController
{

    private $reply;

    public function __construct()
    {
        $reply = new ReplyTransformer();
        $this->reply = $reply;
    }

   public function index(){
       $data = (object)array();

       $anime = array();
       $anime['new'] = Anime::orderBy('created_at','desc')->take(10)->get();
       $anime['hot'] = Anime::orderBy('see','desc')->take(10)->get();
       $data->anime=$anime;

       $movie = array();
       $movie['new'] = Movie::orderBy('created_at','desc')->take(10)->get();
       $movie['hot'] = Movie::orderBy('see','desc')->take(10)->get();
       $data->movie=$movie;

       $tv = array();
       $tv['new'] = Tv::orderBy('created_at','desc')->take(10)->get();
       $tv['hot'] = Tv::orderBy('see','desc')->take(10)->get();
       $data->tv=$tv;

       $article = array();
       $article['new'] = Article::orderBy('created_at','desc')->take(10)->get();
       $article['hot'] = Article::orderBy('see','desc')->take(10)->get();
       $data->article=$article;

       $picture = array();
       $picture['new'] = Picture::orderBy('created_at','desc')->take(10)->get();
       $picture['hot'] = Picture::orderBy('see','desc')->take(10)->get();
       $data->picture=$picture;

       $data->topic = Topic::orderBy('use_count','desc')->take(10)->get();
       $data->commit = Commit::orderBy('created_at','desc')->with('commit')->with('user')->take(10)->get();

       return $this->reply->data(0,$data);
   }

}