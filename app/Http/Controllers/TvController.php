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

            if (isset($item['akira'][0])){
                if (strstr($item['akira'][0],"\n") == false){
                    foreach ($item['akira'] as $akira){
                        $star = Star::firstOrCreate(['name' => $akira]);
                    }
                }else{
                    $star = Star::firstOrCreate(['name' => '未知明星']);
                }
                $akiraData = strstr($item['akira'][0],"\n") == false ? implode(',',$item['akira']) : '未知声优';
            }else{
                $star = Star::firstOrCreate(['name' => '未知明星']);
                $akiraData = '未知明星';
            }





            $count = 0;

            $tv_data = [
                'title' => $item['title'],
                'thumb' => asset('').$item['local_thumb'],
                'introduction' => $item['abstract'],
                'country' => $item['language'],
                'status' => 1,
                'episodes' => $item['episodes'],
                'tag' => '未知类型',
                'star' => $akiraData,
            ];



            if (Tv::where('title',$item['title'])->first()){
                $tv = Tv::where('title',$item['title'])->first();
            }else{
                $tv = Tv::create($tv_data);


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
