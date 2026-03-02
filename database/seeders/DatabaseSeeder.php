<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\User;
use App\Enums\AddressType;
use Illuminate\Database\Seeder;
use App\Enums\UserRole;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => UserRole::ADMIN,
        ]);

        $customers = User::factory(20)->create();

        $brands = Brand::factory(15)->create();

        $parentCategories = Category::factory(6)->create(['parent_id' => null]);

        $subCategories = Category::factory(12)->make()->each(function ($sub) use ($parentCategories) {
            $sub->parent_id = $parentCategories->random()->id;
            $sub->save();
        });

        $allCategories = $parentCategories->concat($subCategories);

        $products = Product::factory(50)->create()->each(function ($product) use ($brands, $allCategories) {

            $product->update(['brand_id' => $brands->random()->id]);

            ProductVariant::factory(rand(2, 5))->create([
                'product_id' => $product->id
            ]);

            $images = ProductImage::factory(3)->create([
                'product_id' => $product->id
            ]);
            $images->first()->update(['is_featured' => true]);

            $product->categories()->attach(
                $allCategories->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        $customers->each(function ($user) {
            Address::factory()->create([
                'user_id' => $user->id,
                'type' => AddressType::SHIPPING,
                'is_default' => true
            ]);
            Address::factory()->create([
                'user_id' => $user->id,
                'type' => AddressType::BILLING,
                'is_default' => false
            ]);
        });

        Order::factory(30)->make()->each(function ($order) use ($customers) {
            $user = $customers->random();
            $shipping = $user->addresses()->where('type', AddressType::SHIPPING)->first();
            $billing = $user->addresses()->where('type', AddressType::BILLING)->first();

            $order->user_id = $user->id;
            $order->shipping_address_id = $shipping->id;
            $order->billing_address_id = $billing->id;
            $order->save();

            $variants = ProductVariant::inRandomOrder()->limit(rand(1, 4))->get();
            $orderTotal = 0;
            $taxTotal = 0;

            foreach ($variants as $variant) {
                $qty = rand(1, 2);
                $price = $variant->price;
                $tax = $price * 0.1;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $variant->id,
                    'quantity' => $qty,
                    'unit_price_at_purchase' => $price,
                    'tax_at_purchase' => $tax,
                ]);

                $orderTotal += ($price * $qty);
                $taxTotal += ($tax * $qty);
            }

            $order->update([
                'total_price' => $orderTotal + $taxTotal + $order->shipping_amount,
                'tax_amount' => $taxTotal,
                'status' => rand(1, 5),
            ]);

            if ($order->status > 0) {
                Payment::factory()->create([
                    'order_id' => $order->id,
                    'amount' => $order->total_price,
                    'status' => 1
                ]);
            }
        });

    }
}
