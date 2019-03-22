<?php

use App\Category;
use App\District;
use App\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Country::class, 50)->create();

        factory(App\State::class,50)->create();

        factory(App\District::class,50)->create();

        factory(App\Category::class,50)->create();

        factory(App\Post::class,50)->create();

        factory(App\Gallery::class,50)->create();

        factory(App\User::class,50)->create();

        $galids = DB::table('galleries')->pluck('id');
        foreach ($galids as $i){
            DB::table('images')->insert([
                'gallery_id' => $i,
                'url' => 'https://via.placeholder.com/350x150',

            ]);
        }

        for($i=0;$i<100;$i++){
        DB::table('category_post')->insert(
            [
                'category_id' => Category::select('id')->orderByRaw("RAND()")->first()->id,
                'post_id' => Post::select('id')->orderByRaw("RAND()")->first()->id,
            ]
        );

        }
        for($i=0;$i<100;$i++){
            DB::table('district_post')->insert(
                [
                    'district_id' => District::select('id')->orderByRaw("RAND()")->first()->id,
                    'post_id' => Post::select('id')->orderByRaw("RAND()")->first()->id,
                ]
            );

        }




    }

}
