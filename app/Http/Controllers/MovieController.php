<?php

namespace App\Http\Controllers;

use App\Akira;
use App\AkiraType;
use App\Director;
use App\DirectorType;
use App\Movie;
use App\Star;
use App\StarType;
use App\Tag;
use App\TagType;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    //
    public function mysql(){
        $json_string = file_get_contents('articleexport.json');

// 把JSON字符串转成PHP数组
        $data = json_decode($json_string, true);

        foreach ($data as $item){

//            dd(strstr($item['akira'][0],"\n") == false);


            if (isset($item['akira'][0])){
                if (strstr($item['akira'][0],"\n") == false){
                    foreach ($item['akira'] as $akira){
                        $star = Star::firstOrCreate(['name' => $akira]);
                        $director= Director::firstOrCreate(['name' => $akira]);
                    }
                }else{
                    $star = Star::firstOrCreate(['name' => '未知明星']);
                    $director = Director::firstOrCreate(['name' => '未知导演']);
                }
                $akiraData = strstr($item['akira'][0],"\n") == false ? implode(',',$item['akira']) : '未知声优';
            }else{
                $star = Star::firstOrCreate(['name' => '未知明星']);
                $director = Director::firstOrCreate(['name' => '未知导演']);
                $akiraData = '未知声优';
            }





            $count = 0;

            $movie_data = [
                'title' => $item['title'],
                'thumb' => asset('').$item['local_thumb'],
                'introduction' => '22',
                'status' => 1,
                'tag' => "未知类型",
                'star' => $akiraData,
                'director' => $akiraData,
                'url' => $item['address'],
            ];



            if (Movie::where('title',$item['title'])->first()){
                $movie = Movie::where('title',$item['title'])->first();
            }else{
                $movie = Movie::create($movie_data);

            }


        }
        dd('创建完毕');

    }
}
