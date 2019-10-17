<?php

use Illuminate\Database\Seeder;
use App\Models\Recommend;

class RecommendsTableSeeder extends Seeder
{
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 缩略图假数据
        $thumbs = [
            'https://s0.xinger.ink/acgimg/acgurl.php',
        ];

        // 生成数据集合
        $recommends = factory(Recommend::class)
            ->times(10)
            ->make()
            ->each(function ($recommend, $index)
            use ($faker, $thumbs)
            {
                // 从头像数组中随机取出一个并赋值
                $recommend->article_thumb = $faker->randomElement($thumbs);
            });
//
//        // 让隐藏字段可见，并将数据集合转换为数组
        $recommend_array = $recommends->toArray();

        // 插入到数据库中
        Recommend::insert($recommend_array);
    }
}
