<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class FacilityFactory extends Factory
{
    protected array $projects = [
        [
            'title'=> "Кольская АЭС",
            'h2'=> "Административный корпус",
            'urlImg'=> "Kolsky NPP.png",
            'id'=> "1",
            'titleSlider'=> "Кольская АЭС",
            'address'=> "Мурманская обл, г.Полярные Зори",
            'workPeriod'=> "октябрь 2014г",
            'materials'=> `Ecophon Focus E 600х600мм <br>
                Ecophon Focus Ds 600х600мм <br>
                Криволинейные переходы между уровнями потолка Ecophon Quadro <br>
                Обрамляющие крыловидные эелементы Ecophon Wing <br>
                Световые кессоны Ecophon Ligth Coffer с карнизным освещением <br>
                Нами осуществлена поставка и шеф-монтаж потолков. <br>
                Монтаж основного объема выполнен ООО"Феникс".`
        ],

    ];




    public function definition(): array
    {
        return [
            
        ];
    }
}
