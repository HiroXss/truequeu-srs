<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Publicacion;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $categorias = collect(['Libros', 'Tecnología', 'Ropa', 'Apuntes', 'Servicios'])
            ->map(fn ($nombre) => Categoria::firstOrCreate(['nombre' => $nombre]));

        $user = User::firstOrCreate(
            ['email' => 'estudiante@truequeu.test'],
            ['name' => 'Estudiante Demo', 'programa' => 'Desarrollo de Software', 'password' => Hash::make('password')]
        );

        $muestras = [
            ['titulo' => 'Calculadora científica', 'descripcion' => 'Calculadora Casio en buen estado, ideal para matemáticas.', 'ofrece' => 'Calculadora científica', 'busca' => 'Audífonos o mochila', 'categoria' => 'Tecnología'],
            ['titulo' => 'Libro de Cálculo', 'descripcion' => 'Libro de cálculo diferencial e integral, edición 2020.', 'ofrece' => 'Libro de Cálculo', 'busca' => 'Apuntes de inglés', 'categoria' => 'Libros'],
            ['titulo' => 'Polera deportiva', 'descripcion' => 'Polera deportiva talla M, poco uso.', 'ofrece' => 'Polera deportiva', 'busca' => 'Set de geometría', 'categoria' => 'Ropa'],
            ['titulo' => 'Tutorías de programación', 'descripcion' => 'Ofrezco tutorías de Python y Laravel los fines de semana.', 'ofrece' => 'Tutorías Python/Laravel', 'busca' => 'Ayuda en diseño gráfico', 'categoria' => 'Servicios'],
        ];

        foreach ($muestras as $m) {
            Publicacion::firstOrCreate(
                ['titulo' => $m['titulo'], 'user_id' => $user->id],
                [
                    'categoria_id' => $categorias->firstWhere('nombre', $m['categoria'])->id,
                    'descripcion' => $m['descripcion'],
                    'ofrece' => $m['ofrece'],
                    'busca' => $m['busca'],
                    'estado' => 'disponible',
                ]
            );
        }
    }
}
