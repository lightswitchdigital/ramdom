<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use Str;

class RegionsSeeder extends Seeder
{

    public function run()
    {
        Region::truncate();
        Region::insert([
            [
                'name' => 'Москва',
                'slug' => Str::slug('Москва'),
                'kladr' => '7700000000000'
            ],
            [
                'name' => 'Санкт-Петербург',
                'slug' => Str::slug('Санкт-Петербург'),
                'kladr' => '7800000000000'
            ],
            [
                'name' => 'Белгород',
                'slug' => Str::slug('Белгород'),
                'kladr' => '3100000100000'
            ],
            [
                'name' => 'Великий Новгород',
                'slug' => Str::slug('Великий Новгород'),
                'kladr' => '5300000100000'
            ],
            [
                'name' => 'Волгоград',
                'slug' => Str::slug('Волгоград'),
                'kladr' => '3400000100000'
            ],
            [
                'name' => 'Воронеж',
                'slug' => Str::slug('Воронеж'),
                'kladr' => '3600000100000'
            ],
            [
                'name' => 'Казань',
                'slug' => Str::slug('Казань'),
                'kladr' => '1600000100000'
            ],
            [
                'name' => 'Краснодар',
                'slug' => Str::slug('Краснодар'),
                'kladr' => '2300000100000'
            ],
            [
                'name' => 'Курск',
                'slug' => Str::slug('Курск'),
                'kladr' => '4600000100000'
            ],


            [
                'name' => 'Набережные Челны',
                'slug' => Str::slug('Набережные Челны'),
                'kladr' => '1600000200000'
            ],
            [
                'name' => 'Нижний Новгород',
                'slug' => Str::slug('Нижний Новгород'),
                'kladr' => '5200000100000'
            ],
            [
                'name' => 'Нижний Тагил',
                'slug' => Str::slug('Нижний Тагил'),
                'kladr' => '6600002300000'
            ],
            [
                'name' => 'Оренбург',
                'slug' => Str::slug('Оренбург'),
                'kladr' => '5600000100000'
            ],
            [
                'name' => 'Псков',
                'slug' => Str::slug('Псков'),
                'kladr' => '6000000100000'
            ],
            [
                'name' => 'Ростов-на-Дону',
                'slug' => Str::slug('Псков'),
                'kladr' => '6100000100000'
            ],
            [
                'name' => 'Самара',
                'slug' => Str::slug('Самара'),
                'kladr' => '6300000100000'
            ],


            [
                'name' => 'Саратов',
                'slug' => Str::slug('Саратов'),
                'kladr' => '6400000100000'
            ],
            [
                'name' => 'Сочи',
                'slug' => Str::slug('Сочи'),
                'kladr' => '2300000700000'
            ],
            [
                'name' => 'Таганрог',
                'slug' => Str::slug('Таганрог'),
                'kladr' => '6100001100000'
            ],
            [
                'name' => 'Тольятти',
                'slug' => Str::slug('Тольятти'),
                'kladr' => '6300000700000'
            ],
            [
                'name' => 'Ульяновск',
                'slug' => Str::slug('Ульяновск'),
                'kladr' => '7300000100000'
            ],
            [
                'name' => 'Уфа',
                'slug' => Str::slug('Уфа'),
                'kladr' => '0200000100000'
            ],
            [
                'name' => 'Челябинск',
                'slug' => Str::slug('Челябинск'),
                'kladr' => '7400000100000'
            ],
        ]);
    }
}
