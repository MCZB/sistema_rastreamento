<?php

namespace Database\Factories;

// database/factories/EntregaFactory.php
use App\Models\Entrega;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Entrega::class, function (Faker $faker) {
    return [
        '_id' => Str::uuid(),
        '_id_transportadora' => Str::uuid(),
        '_volumes' => $faker->numberBetween(1, 10),
        '_remetente' => [
            '_nome' => $faker->name,
            // Adicione outros atributos do remetente conforme necessário
        ],
        '_destinatario' => [
            '_nome' => $faker->name,
            '_cpf' => $faker->cpf,
            '_endereco' => $faker->address,
            '_estado' => $faker->state,
            '_cep' => $faker->postcode,
            '_pais' => $faker->country,
            '_geolocalizao' => [
                '_lat' => $faker->latitude,
                '_lng' => $faker->longitude,
            ],
        ],
        '_rastreamento' => [
            [
                'message' => 'ENTREGA CRIADA',
                'date' => $faker->dateTimeThisMonth,
            ],
            // Adicione mais etapas de rastreamento conforme necessário
        ],
        // Adicione outros atributos conforme necessário
    ];
});
