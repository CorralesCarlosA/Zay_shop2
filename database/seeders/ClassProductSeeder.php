<?php

namespace Database\Seeders;

use App\Models\admin\ClassProduct;
use Illuminate\Database\Seeder;

class ClassProductSeeder extends Seeder
{
    public function run()
    {
        $classes = [
            ['nombreClase' => 'Deporte'],
            ['nombreClase' => 'Calzado'],
            ['nombreClase' => 'Accesorios'],
            ['nombreClase' => 'Interiores'],
            ['nombreClase' => 'Sudaderas']
        ];

        foreach ($classes as $class) {
            ClassProduct::firstOrCreate(
                ['nombreClase' => $class['nombreClase']],
                $class
            );
        }
    }
}