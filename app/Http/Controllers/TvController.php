<?php

namespace App\Http\Controllers;

use App\Director;
use App\DirectorType;
use App\Tv;
use App\Star;
use App\StarType;
use App\Tag;
use App\TagType;
use App\TvFile;
use Illuminate\Http\Request;

class TvController extends Controller
{
    //
    public function mysql(){
        $json_string = file_get_contents('articleexport.json');

// 把JSON字符串转成PHP数组
        $data = json_decode($json_string, true);

        foreach ($data as $item){

//            dd(strstr($item['akira'][0],"\n") == false);

            foreach ($item['tag'] as $tag){
                $tag = Tag::firstOrCreate(['name' => $tag]);
            }

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

            $tv_data = [
                'title' => $item['title'],
                'thumb' => asset('').$item['local_thumb'],
                'introduction' => $item['abstract'],
                'status' => 1,
                'episodes' => $item['episodes'],
                'tag' => implode(',',$item['tag']),
                'star' => $akiraData,
                'director' => $akiraData,
                'country' => $item['address'],
            ];



            if (Tv::where('title',$item['title'])->first()){
                $tv = Tv::where('title',$item['title'])->first();
            }else{
                $tv = Tv::create($tv_data);

                foreach ($item['tag'] as $tag){
                    $tag_id = Tag::where('name', $tag)->first()->id;
                    TagType::firstOrCreate([
                        'tag_id' =>  $tag_id,
                        'tag_type' =>  'tv'
                    ]);
                }

                if (isset($item['akira'][0])){

                    if (strstr($item['akira'][0],"\n") == false){
                        foreach ($item['akira'] as $akira){
                            $star_id = Star::where('name', $akira)->first()->id;
                            $director = Director::where('name', $akira)->first()->id;


                            StarType::firstOrCreate([
                                'star_id' =>  $star_id,
                                'star_type' =>  'tv'
                            ]);

                            DirectorType::firstOrCreate([
                                'director_id' =>  $director,
                                'director_type' =>  'tv'
                            ]);

                        }
                    }else{
                        $star_id = Star::where('name', '未知明星')->first()->id;
                        $director = Director::where('name', '未知导演')->first()->id;



                        StarType::firstOrCreate([
                            'star_id' =>  $star_id,
                            'star_type' =>  'tv'
                        ]);

                        DirectorType::firstOrCreate([
                            'director_id' =>  $director,
                            'director_type' =>  'tv'
                        ]);
                    }
                }else{
                    $star_id = Star::where('name', '未知明星')->first()->id;
                    $director = Director::where('name', '未知导演')->first()->id;


                    StarType::firstOrCreate([
                        'star_id' =>  $star_id,
                        'star_type' =>  'tv'
                    ]);

                    DirectorType::firstOrCreate([
                        'director_id' =>  $director,
                        'director_type' =>  'tv'
                    ]);
                }

                foreach ($item['file_url'] as $file_url){

                    $file_name = isset($item['file_name'][$count]) ? $item['file_name'][$count] : '';


                    TvFile::firstOrCreate([
                        'file_name' =>  $file_name,
                        'file_url' =>   $file_url,
                        'tv_id' => $tv->id
                    ]);
                    $count += 1;

                }


            }


        }
        dd('创建完毕');

    }
}
