<?php

namespace Database\Seeders;

use database\Label;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Label::factory()->createMany([
            ['name' => 'ошибка', 'description' => 'Какая-то ошибка в коде или проблема с функциональностью'],
            ['name' => 'документация', 'description' => 'Задача которая касается документации'],
            ['name' => 'дубликат', 'description' => 'Повтор другой задачи'],
            ['name' => 'доработка', 'description' => 'Новая фича, которую нужно запилить'],
        ]);
    }
}
