<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Te123User',
            'email' => 'helow@example.com',
            'password' => 'password',
        ]);
        Product::create([
        'name' => 'Смартфон Samsung Galaxy S23',
        'description' => '6.1\" AMOLED, 128 ГБ, 50 Мп, 5G',
        'price' => 299990,
        'image' => 'https://images.samsung.com/is/image/samsung/p6pim/ru/galaxy-s23/gallery/ru-galaxy-s23-s911-sm-s911bzadeur-thumb-535678237?$344_344_PNG$',
        ]);
        Product::create([
        'name' => 'Ноутбук Apple MacBook Air M2',
        'description' => '13.6\" Retina, 8 ГБ, 256 ГБ SSD',
        'price' => 599990,
        'image' => 'https://store.storeimages.cdn-apple.com/4668/as-images.apple.com/is/macbook-air-m2-2022-hero-space-gray-20220606?wid=904&hei=840&fmt=jpeg&qlt=80&.v=1654122880566',
        ]);
        Product::create([
        'name' => 'Наушники Sony WH-1000XM4',
        'description' => 'Bluetooth, шумоподавление, до 30 часов работы',
        'price' => 129990,
        'image' => 'https://www.sony.ru/image/sonyview7/wh-1000xm4-black-hero.png',
            ]);
    }
}
