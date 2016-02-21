<?php
/**
 * Created by PhpStorm.
 * User: lcc_luffy
 * Date: 2016/1/14
 * Time: 16:51
 */
use App\Book;
use App\Category;
use App\Picture;
use App\User;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run()
    {
        for ($count = 0; $count < 166; $count++) {
            $book = Book::create([
                    'name' => '书名_' . $count . str_random(3),
                    'description' => '描述' . str_random(3),
                    'price' => rand(5.0, 100.0),
                    'address' => '地址地址地址地址地址' . str_random(10),
                    'is_draft' => 0,
                    'phone_number' => '134' . str_random(8),
                    'other_contact_way' => '其他联系方式' . str_random(5)]
            );

            $c = random_int(2, 4);
            $book->syncCategories(Category::all()->random($c)->lists('name')->all());

            $pic_count = random_int(1, 5);
            for ($i = 0; $i < $pic_count; $i++) {
                $picture = new Picture();
                $picture->url = 'https://img.alicdn.com/bao/uploaded/i2/TB1dsZTGXXXXXcpaXXXXXXXXXXX_!!0-item_pic.jpg_430x430q90.jpg';
                $book->pictures()->save($picture);
            }
            User::all()->random()->books()->save($book);
        }

    }
}