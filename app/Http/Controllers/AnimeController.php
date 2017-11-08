<?php

namespace App\Http\Controllers;

use App\Akira;
use App\AkiraType;
use App\Anime;
use App\AnimeFile;
use App\Tag;
use App\TagType;
use Illuminate\Http\Request;

class AnimeController extends Controller
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
                        $akira = Akira::firstOrCreate(['name' => $akira]);
                    }
                }else{
                    $akira = Akira::firstOrCreate(['name' => '未知声优']);
                }
                $akiraData = strstr($item['akira'][0],"\n") == false ? implode(',',$item['akira']) : '未知声优';
            }else{
                $akira = Akira::firstOrCreate(['name' => '未知声优']);
                $akiraData = '未知声优';
            }





            $count = 0;

            $anime_data = [
                'title' => $item['title'],
                'thumb' => asset('').$item['local_thumb'],
                'introduction' => $item['abstract'],
                'episodes' => $item['episodes'],
                'status' => 1,
                'issue_date' => $item['created_at'],
                'tag' => implode(',',$item['tag']),
                'akira' => $akiraData,
            ];



            if (Anime::where('title',$item['title'])->first()){
                $anime = Anime::where('title',$item['title'])->first();
            }else{
                $anime = Anime::create($anime_data);

                foreach ($item['tag'] as $tag){
                    $tag_id = Tag::where('name', $tag)->first()->id;
                    TagType::firstOrCreate([
                        'tag_id' =>  $tag_id,
                        'tag_type' =>  'anime'
                    ]);
                }

                if (isset($item['akira'][0])){
                    if (strstr($item['akira'][0],"\n") == false){
                        foreach ($item['akira'] as $akira){
                            $akira_id = Akira::where('name', $akira)->first()->id;
                            AkiraType::firstOrCreate([
                                'akira_id' =>  $akira_id,
                                'akira_type' =>  'anime'
                            ]);
                        }
                    }else{
                        $akira_id = Akira::where('name', '未知声优')->first()->id;
                        AkiraType::firstOrCreate([
                            'akira_id' =>  $akira_id,
                            'akira_type' =>  'anime'
                        ]);
                    }
                }else{
                    $akira_id = Akira::where('name', '未知声优')->first()->id;
                    AkiraType::firstOrCreate([
                        'akira_id' =>  $akira_id,
                        'akira_type' =>  'anime'
                    ]);
                }


                foreach ($item['file_url'] as $file_url){

                    $file_name = isset($item['file_name'][$count]) ? $item['file_name'][$count] : '';


                    AnimeFile::firstOrCreate([
                        'file_name' =>  $file_name,
                        'file_url' =>   $file_url,
                        'anime_id' => $anime->id
                    ]);
                    $count += 1;

                }
            }


        }
        dd('创建完毕');

    }
}
