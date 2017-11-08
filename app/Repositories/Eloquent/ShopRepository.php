<?php
namespace App\Repositories\Eloquent;
use App\Shop;

class ShopRepository extends Repository{

    function model()
    {
        // TODO: Implement model() method.
        return Shop::class;
    }

    public function createShop(array $attributes){


        $category_id = $attributes['parent_id'];

        $shop_data = [
            'title' => $attributes['title'],
            'user_id' => $attributes['user_id'],
            'num' => $attributes['num'],
            'price' => $attributes['price'],
            'is_hot' => false,
            'status' => 0,
            'is_sale' => $attributes['is_sale'],
            'sale_price' => $attributes['sale_price'],
            'desc' => $attributes['desc'],
            'thumb' =>json_encode($attributes['thumbList']),
            'category_id' => implode(',',$category_id),
        ];



        return $this->model->create($shop_data);
    }


}