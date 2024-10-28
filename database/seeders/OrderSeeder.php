<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Menu;
use App\Models\Promo;
use App\Models\User;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Create orders with random data
        for ($i = 0; $i < 10; $i++) {
            $menu = Menu::inRandomOrder()->first();
            $promo = Promo::inRandomOrder()->first();
            $user = User::inRandomOrder()->first();

            // Calculate total price considering promo
            $totalPrice = $promo ? ($menu->harga_menu - $promo->nilai_potongan) : $menu->harga_menu;

            $order = new Order([
                'menu_id' => $menu->id,
                'promo_id' => $promo ? $promo->id : null,
                'user_id' => $user->id,
                'quantity' => $faker->numberBetween(1, 5),
                'total_price' => $totalPrice,
            ]);

            $order->save();
        }
    }
}