<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@shopverse.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Create regular user
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // Create categories
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics'],
            ['name' => 'Clothing', 'slug' => 'clothing'],
            ['name' => 'Books', 'slug' => 'books'],
            ['name' => 'Home & Garden', 'slug' => 'home-garden'],
            ['name' => 'Sports', 'slug' => 'sports'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $electronics = Category::where('slug', 'electronics')->first();
        $clothing = Category::where('slug', 'clothing')->first();
        $books = Category::where('slug', 'books')->first();
        $homeGarden = Category::where('slug', 'home-garden')->first();
        $sports = Category::where('slug', 'sports')->first();

        // Create products
        $products = [
            // Electronics
            [
                'category_id' => $electronics->id,
                'name' => 'Wireless Bluetooth Headphones',
                'description' => 'Premium wireless headphones with active noise cancellation, 30-hour battery life, and crystal-clear sound quality.',
                'price' => 149.99,
                'sale_price' => 119.99,
                'stock' => 50,
                'image' => 'https://via.placeholder.com/400x300/6366f1/FFFFFF?text=Headphones',
                'featured' => true,
            ],
            [
                'category_id' => $electronics->id,
                'name' => 'Smart Watch Pro',
                'description' => 'Feature-packed smartwatch with health monitoring, GPS, and a stunning AMOLED display.',
                'price' => 299.99,
                'sale_price' => null,
                'stock' => 30,
                'image' => 'https://via.placeholder.com/400x300/6366f1/FFFFFF?text=SmartWatch',
                'featured' => true,
            ],
            [
                'category_id' => $electronics->id,
                'name' => 'Portable Bluetooth Speaker',
                'description' => 'Waterproof portable speaker with 360-degree sound and 20-hour battery life.',
                'price' => 79.99,
                'sale_price' => 59.99,
                'stock' => 75,
                'image' => 'https://via.placeholder.com/400x300/6366f1/FFFFFF?text=Speaker',
                'featured' => false,
            ],
            [
                'category_id' => $electronics->id,
                'name' => '4K Action Camera',
                'description' => 'Capture stunning 4K video and 12MP photos with this rugged, waterproof action camera.',
                'price' => 199.99,
                'sale_price' => 169.99,
                'stock' => 25,
                'image' => 'https://via.placeholder.com/400x300/6366f1/FFFFFF?text=ActionCamera',
                'featured' => true,
            ],
            // Clothing
            [
                'category_id' => $clothing->id,
                'name' => 'Classic Denim Jacket',
                'description' => 'Timeless denim jacket with a modern fit, available in multiple washes.',
                'price' => 89.99,
                'sale_price' => null,
                'stock' => 100,
                'image' => 'https://via.placeholder.com/400x300/ec4899/FFFFFF?text=DenimJacket',
                'featured' => true,
            ],
            [
                'category_id' => $clothing->id,
                'name' => 'Slim Fit Chinos',
                'description' => 'Versatile slim-fit chinos made from premium cotton blend fabric.',
                'price' => 59.99,
                'sale_price' => 44.99,
                'stock' => 80,
                'image' => 'https://via.placeholder.com/400x300/ec4899/FFFFFF?text=Chinos',
                'featured' => false,
            ],
            [
                'category_id' => $clothing->id,
                'name' => 'Athletic Running Shoes',
                'description' => 'Lightweight and responsive running shoes with advanced cushioning technology.',
                'price' => 119.99,
                'sale_price' => null,
                'stock' => 60,
                'image' => 'https://via.placeholder.com/400x300/ec4899/FFFFFF?text=RunningShoes',
                'featured' => true,
            ],
            [
                'category_id' => $clothing->id,
                'name' => 'Casual Graphic Tee',
                'description' => 'Comfortable 100% cotton graphic tee with unique artistic prints.',
                'price' => 24.99,
                'sale_price' => 19.99,
                'stock' => 150,
                'image' => 'https://via.placeholder.com/400x300/ec4899/FFFFFF?text=GraphicTee',
                'featured' => false,
            ],
            // Books
            [
                'category_id' => $books->id,
                'name' => 'The Art of Clean Code',
                'description' => 'A practical guide to writing clean, maintainable code for software developers of all levels.',
                'price' => 34.99,
                'sale_price' => null,
                'stock' => 200,
                'image' => 'https://via.placeholder.com/400x300/f59e0b/FFFFFF?text=CleanCode',
                'featured' => false,
            ],
            [
                'category_id' => $books->id,
                'name' => 'Business Strategy Masterclass',
                'description' => 'Comprehensive guide to modern business strategy and competitive advantage.',
                'price' => 29.99,
                'sale_price' => 22.99,
                'stock' => 150,
                'image' => 'https://via.placeholder.com/400x300/f59e0b/FFFFFF?text=BusinessBook',
                'featured' => false,
            ],
            // Home & Garden
            [
                'category_id' => $homeGarden->id,
                'name' => 'Smart LED Desk Lamp',
                'description' => 'Energy-efficient LED desk lamp with adjustable brightness and color temperature.',
                'price' => 49.99,
                'sale_price' => 39.99,
                'stock' => 45,
                'image' => 'https://via.placeholder.com/400x300/10b981/FFFFFF?text=DeskLamp',
                'featured' => true,
            ],
            [
                'category_id' => $homeGarden->id,
                'name' => 'Ceramic Plant Pot Set',
                'description' => 'Set of 3 beautiful ceramic plant pots in various sizes, perfect for indoor plants.',
                'price' => 39.99,
                'sale_price' => null,
                'stock' => 60,
                'image' => 'https://via.placeholder.com/400x300/10b981/FFFFFF?text=PlantPots',
                'featured' => false,
            ],
            [
                'category_id' => $homeGarden->id,
                'name' => 'Bamboo Kitchen Organizer',
                'description' => 'Eco-friendly bamboo kitchen organizer with multiple compartments for utensils and tools.',
                'price' => 29.99,
                'sale_price' => 24.99,
                'stock' => 80,
                'image' => 'https://via.placeholder.com/400x300/10b981/FFFFFF?text=Organizer',
                'featured' => false,
            ],
            // Sports
            [
                'category_id' => $sports->id,
                'name' => 'Yoga Mat Premium',
                'description' => 'Non-slip premium yoga mat with alignment lines, 6mm thickness for joint support.',
                'price' => 54.99,
                'sale_price' => 44.99,
                'stock' => 90,
                'image' => 'https://via.placeholder.com/400x300/f97316/FFFFFF?text=YogaMat',
                'featured' => true,
            ],
            [
                'category_id' => $sports->id,
                'name' => 'Adjustable Dumbbell Set',
                'description' => 'Space-saving adjustable dumbbell set ranging from 5 to 52.5 lbs per dumbbell.',
                'price' => 299.99,
                'sale_price' => 249.99,
                'stock' => 20,
                'image' => 'https://via.placeholder.com/400x300/f97316/FFFFFF?text=Dumbbells',
                'featured' => true,
            ],
            [
                'category_id' => $sports->id,
                'name' => 'Cycling Helmet',
                'description' => 'Lightweight aerodynamic cycling helmet with MIPS protection and adjustable fit system.',
                'price' => 79.99,
                'sale_price' => null,
                'stock' => 35,
                'image' => 'https://via.placeholder.com/400x300/f97316/FFFFFF?text=CyclingHelmet',
                'featured' => false,
            ],
        ];

        foreach ($products as $productData) {
            $productData['slug'] = Str::slug($productData['name']);
            Product::create($productData);
        }
    }
}
