<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run()
    {
        $items = [
            ['name' => 'RGB Gaming Keyboard', 'quantity' => 15, 'price' => 80.00, 'product_id' => 1],
            ['name' => 'Wireless Gaming Mouse', 'quantity' => 20, 'price' => 50.00, 'product_id' => 1],
            ['name' => 'Ergonomic Office Chair', 'quantity' => 10, 'price' => 300.00, 'product_id' => 2],
            ['name' => 'Laptop Cooling Pad', 'quantity' => 50, 'price' => 40.00, 'product_id' => 3],
            ['name' => 'USB-C Hub', 'quantity' => 30, 'price' => 25.00, 'product_id' => 4],
            ['name' => 'Monitor Arm Mount', 'quantity' => 25, 'price' => 60.00, 'product_id' => 5],
            ['name' => 'Gaming Headset', 'quantity' => 15, 'price' => 120.00, 'product_id' => 6],
            ['name' => 'Webcam HD', 'quantity' => 40, 'price' => 90.00, 'product_id' => 7],
            ['name' => 'Mechanical Keyboard', 'quantity' => 20, 'price' => 150.00, 'product_id' => 8],
            ['name' => 'SSD Internal Drive', 'quantity' => 35, 'price' => 120.00, 'product_id' => 9],
            ['name' => 'External Hard Drive', 'quantity' => 30, 'price' => 100.00, 'product_id' => 10],
            ['name' => 'Gaming Mousepad', 'quantity' => 60, 'price' => 20.00, 'product_id' => 11],
            ['name' => 'Ink Cartridge Set', 'quantity' => 80, 'price' => 35.00, 'product_id' => 12],
            ['name' => 'Wireless Printer Adapter', 'quantity' => 20, 'price' => 75.00, 'product_id' => 13],
            ['name' => 'Premium Paper Ream', 'quantity' => 100, 'price' => 15.00, 'product_id' => 14],
            ['name' => 'Photo Editing Pen Tablet', 'quantity' => 10, 'price' => 250.00, 'product_id' => 15],
            ['name' => 'Cloud Storage Plan', 'quantity' => 200, 'price' => 10.00, 'product_id' => 16],
            ['name' => 'Budget Laptop Sleeve', 'quantity' => 150, 'price' => 20.00, 'product_id' => 17],
            ['name' => 'High-Speed HDMI Cable', 'quantity' => 100, 'price' => 15.00, 'product_id' => 18],
            ['name' => 'Laptop Docking Station', 'quantity' => 25, 'price' => 200.00, 'product_id' => 19],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}