<?php
namespace Database\Factories\client; use Illuminate\Database\Eloquent\Factories\Factory; use Illuminate\Support\Str;
    class ClientFactory extends Factory { // Asegúrate de apuntar al modelo correcto protected
    $model=\App\Models\client\Client::class; public function definition() { return [ 'nombres'=>
    $this->faker->firstName,
    'apellidos' => $this->faker->lastName,
    'tipo_identificacion' => $this->faker->randomElement(['Cedula de ciudadania (CC)', 'Tarjeta de identidad (TI)',
    'NIT']),
    'n_identificacion' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
    'correoE' => $this->faker->unique()->safeEmail,
    'tipo_cliente' => $this->faker->randomElement(['Oro', 'Plata', 'Bronce', 'Hierro']),
    'n_telefono' => $this->faker->phoneNumber,
    'Direccion_recidencia' => $this->faker->address,
    'sexo' => $this->faker->randomElement(['Masculino', 'Femenino', 'Otro']),
    'estatura' => $this->faker->optional()->randomFloat(2, 1.5, 2.0),
    'password' => bcrypt('password'),
    'ciudad' => \App\Models\admin\City::factory(),
    'id_administrador' => \App\Models\admin\Administrator::factory(),
    'estado_cliente' => true,
    ];
    }
}
}