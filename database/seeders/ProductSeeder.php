<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['name' => 'Ultra Performance Gaming PC', 'description' => 'High-end gaming PC.', 'price' => 2500.00, 'category_id' => 1, 'image' => 'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (1).jpg' ],
            ['name' => 'Custom Workstation PC', 'description' => 'Built for professional work.', 'price' => 3000.00, 'category_id' => 1, 'image' => 'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (3).jpg' ],
            ['name' => 'Lenovo ThinkPad X1 Carbon', 'description' => 'Ultra-light laptop.', 'price' => 1400.00, 'category_id' => 2, 'image' => 'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (4).jpg' ],
            ['name' => 'MacBook Air M2', 'description' => 'Thin and powerful laptop.', 'price' => 1200.00, 'category_id' => 2, 'image' => 'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (1).jpg' ],
            ['name' => 'ASUS ZenBook 14', 'description' => 'Compact and lightweight.', 'price' => 1100.00, 'category_id' => 2, 'image' =>'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (2).jpg' ],
            ['name' => 'Dell UltraSharp 27 Monitor', 'description' => 'High-res monitor.', 'price' => 300.00, 'category_id' => 3, 'image' => 'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (1).jpg' ],
            ['name' => 'LG UltraGear Gaming Monitor', 'description' => 'Monitor for gaming.', 'price' => 450.00, 'category_id' => 3, 'image' => 'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (2).jpg' ],
            ['name' => 'Samsung Smart Monitor M8', 'description' => 'Smart and sleek.', 'price' => 500.00, 'category_id' => 3, 'image' => 'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (4).jpg' ],
            ['name' => 'NVIDIA GeForce RTX 4090', 'description' => 'Powerful GPU.', 'price' => 1500.00, 'category_id' => 4, 'image' => 'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (1).jpg' ],
            ['name' => 'Intel Core i9 13900K', 'description' => 'Latest CPU.', 'price' => 650.00, 'category_id' => 4, 'image' => 'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (1).jpg' ],
            ['name' => 'Corsair Vengeance DDR5 RAM', 'description' => 'Fast memory.', 'price' => 250.00, 'category_id' => 4, 'image' => 'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (2).jpg' ],
            ['name' => 'Canon PIXMA TS3520', 'description' => 'Compact printer.', 'price' => 120.00, 'category_id' => 5, 'image' => 'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (1).jpg' ],
            ['name' => 'Epson EcoTank L3250', 'description' => 'Eco-friendly printer.', 'price' => 200.00, 'category_id' => 5, 'image' => 'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (4).jpg' ],
            ['name' => 'HP LaserJet Pro', 'description' => 'Professional printing.', 'price' => 300.00, 'category_id' => 5, 'image' => 'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (1).jpg' ],
            ['name' => 'Microsoft Office 365', 'description' => 'Productivity suite.', 'price' => 100.00, 'category_id' => 6, 'image' => 'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (2).jpg' ],
            ['name' => 'Adobe Photoshop', 'description' => 'Photo editing software.', 'price' => 250.00, 'category_id' => 6, 'image' => 'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (4).jpg' ],
            ['name' => 'QuickBooks Desktop', 'description' => 'Accounting software.', 'price' => 300.00, 'category_id' => 6, 'image' => 'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (2).jpg' ],
            ['name' => 'Dell G15 Gaming Laptop', 'description' => 'Affordable gaming laptop.', 'price' => 800.00, 'category_id' => 2, 'image' => 'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (4).jpg' ],
            ['name' => 'Razer Blade 15', 'description' => 'Premium gaming laptop.', 'price' => 2400.00, 'category_id' => 2, 'image' => 'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (1).jpg' ],
            ['name' => 'Samsung T7 Portable SSD', 'description' => 'High-speed storage.', 'price' => 150.00, 'category_id' => 4, 'image' => 'Gaming PCs _ Computer Repair _ IT Support Dronfield _ Sheffield _ Direct Computers/1 (2).jpg' ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}