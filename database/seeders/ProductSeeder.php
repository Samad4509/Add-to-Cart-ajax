<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [

            [

                'name' => 'Samsung Galaxy',

                'description' => 'Samsung Brand',

                'image' => 'https://i.ibb.co.com/Kc1twbs6/download.jpg',

                'price' => 100

            ],
            
            [

                'name' => 'Apple iPhone 12',

                'description' => 'Apple Brand',

                'image' => 'https://i.ibb.co.com/fVXFNvTf/apple-iphone-14-pro-max-1.jpg',

                'price' => 500

            ],

            [

                'name' => 'Google Pixel 2 XL',

                'description' => 'Google Pixel Brand',

                'image' => 'https://i.ibb.co.com/xS7xfNC6/download-1.jpg',

                'price' => 400

            ],

            [

                'name' => 'LG V10',

                'description' => 'LG Brand',

                'image' => 'https://i.ibb.co.com/k6z5VQCf/download-2.jpg',

                'price' => 200

            ]

        ];

  

        foreach ($products as $key => $value) {

            Product::create($value);

        }

    }
    
}
