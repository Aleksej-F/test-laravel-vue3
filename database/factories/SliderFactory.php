<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
{
   
    protected array $slider = [
       '1'=>[
            [
              'img'=> "KAES-1.jpg",
              'title'=> "Конференц-зал",
              'description'=> "Дизайнерский потолок Ecophon",
              'id'=> 1,
            ],
            [
              'img'=> "KAES-2.jpg",
              'title'=> "Конференц-зал",
              'description'=> "Дизайнерский потолок Ecophon",
              'id'=>2,
            ],
            [
              'img'=> "KAES-3.jpg",
              'title'=> "Конференц-зал",
              'description'=> "Дизайнерский потолок Ecophon",
              'id'=> 3,
            ],
            [
              'img'=> "KAES-4.jpg",
              'title'=> "Конференц-зал",
              'description'=> "Дизайнерский потолок Ecophon",
              'id'=> 4,
            ],
            [
              'img'=> "KAES-5.jpg",
              'title'=> "Комната для совещаний",
              'description'=> "Световой кесон Ecophon",
              'id'=> 5,
            ],
            [
              'img'=> "KAES-6.jpg",
              'title'=> "Комната для совещаний",
             'description'=> "Световой кесон Ecophon",
              'id'=> 6,
            ],
            [
              'img'=> "KAES-7.jpg",
              'title'=> "Монтаж Ecophon",
              'description'=> "Сборка светового кесона",
              'id'=> 7,
            ],
            [
              'img'=> "KAES-8.jpg",
              'title'=> "Монтаж Ecophon",
              'description'=> "Криволинейные переходы между уровнями потолка",
              'id'=> 8,
            ],
          ],
    ];

    public function definition(): array
    {
        return [
            //
        ];
    }
}
