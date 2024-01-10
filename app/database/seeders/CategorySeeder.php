<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Hatch',
                'description' => 'Ideal para quem busca versatilidade urbana.
                Os hatches oferecem agilidade, facilidade de estacionamento e
                eficiência no consumo de combustível. São perfeitos para o dia
                a dia na cidade, proporcionando praticidade e design compacto.',
            ],
            [
                'name' => 'Sedan',
                'description' => 'Voltado para conforto e elegância, o sedan é a escolha
                 para quem valoriza espaço interno, sofisticação e uma condução suave.
                 Ideal para viagens mais longas e uso familiar, os sedans oferecem um equilíbrio
                  entre estilo e funcionalidade.',
            ],
            [
                'name' => 'Pick-up',
                'description' => 'A opção robusta e prática para quem precisa de força e versatilidade.
                 As pick-ups são ideais para transporte de carga, atividades ao ar livre e para aqueles
                  que exigem capacidade de reboque. Combinam funcionalidade com estilo, atendendo tanto
                   às necessidades profissionais quanto às aventuras recreativas.',
            ],

        ];

        Category::insert($categories);
    }
}
