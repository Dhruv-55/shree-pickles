<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const ACTIVE = 1 , INACTIVE =2;

    protected $fillable = [
        'category_id','brand_id','name','slug','short_description','description','original_price','selling_price','quantity','trending','status','images','qty_type'
    ];

    protected $casts = [
      'images' => 'object'
    ];
    public function scopeActive($q){
      return $q->where('status',self::ACTIVE);
    }

    public function category(){
      return $this->belongsTo(Category::class);
    }

  

    // public function getPrimaryImageAttribute(){
    //   return ProductImage::where('product_id',$this->id)->oldest()->first()->image;
    // }

    public function getDiscountAttribute(){
      
      return number_format(($this->original_price -$this->selling_price)*0.1);
    }


    public static function variations()
    {
        return [
            1 => '250g',
            2 => '500g',
            3 => '1kg',
            4 => '2kg',
            5 => '5kg'
        ];
    }

    // Helper method to get variation name by key
    public static function variation($key)
    {
        return static::variations()[$key] ?? '';
    }

    // Product model

    public static function getFirstImage($productId)
    {
        // Retrieve the product by ID
        $product = self::find($productId);
    
        // Check if the product exists and if it has images (stored as an array)
        if ($product && is_array($product->images) && count($product->images) > 0) {
            // Return the first image filename from the array
            return env('PRODUCT_IMAGE_URL').$product->images[0];
        }
    
        return null; // Return null if no images are found or product doesn't exist
    }


    public function addProduct(){
      $dummyData = [
        [
            'category_id' => 1,
            'brand_id' => 2,
            'name' => 'Spicy Mango Pickle',
            'slug' => 'spicy-mango-pickle',
            'short_description' => 'A tangy and spicy mango pickle for all pickle lovers.',
            'description' => 'Our Spicy Mango Pickle is made with ripe mangoes and a special blend of spices. It’s perfect to complement any meal and add a burst of flavor to your palate. Packed with rich spices, it’s a must-have for your kitchen!',
            'original_price' => 199.99,
            'selling_price' => 149.99,
            'quantity' => 150,
            'trending' => true,
            'status' => 1,
            'images' => 'spicy_mango_pickle.jpg',
            'qty_type' => 1
        ],
        [
            'category_id' => 2,
            'brand_id' => 3,
            'name' => 'Garlic Chilli Pickle',
            'slug' => 'garlic-chilli-pickle',
            'short_description' => 'A fiery garlic and chili pickle to spice up your meals.',
            'description' => 'This Garlic Chilli Pickle brings the perfect combination of garlic, chili, and spices to give your food a bold kick. Perfect for those who love spicy and garlicky flavors!',
            'original_price' => 249.99,
            'selling_price' => 199.99,
            'quantity' => 100,
            'trending' => false,
            'status' => 1,
            'images' => 'garlic_chilli_pickle.jpg',
            'qty_type' => 1
        ],
        [
            'category_id' => 1,
            'brand_id' => 1,
            'name' => 'Sweet & Sour Lemon Pickle',
            'slug' => 'sweet-sour-lemon-pickle',
            'short_description' => 'A blend of sweet and sour flavors from fresh lemons.',
            'description' => 'This Sweet & Sour Lemon Pickle is made with fresh lemons, sugar, and tangy spices. It’s an ideal companion to your daily meals and will add a refreshing flavor to your tastebuds.',
            'original_price' => 179.99,
            'selling_price' => 139.99,
            'quantity' => 200,
            'trending' => true,
            'status' => 1,
            'images' => 'sweet_sour_lemon_pickle.jpg',
            'qty_type' => 1
        ],
        [
            'category_id' => 3,
            'brand_id' => 4,
            'name' => 'Mixed Vegetable Pickle',
            'slug' => 'mixed-vegetable-pickle',
            'short_description' => 'A rich, tangy, and flavorful mix of vegetables in spices.',
            'description' => 'Our Mixed Vegetable Pickle combines a variety of fresh vegetables like carrots, cauliflower, and green beans with a spicy tangy blend of spices. Perfect for adding flavor to any dish.',
            'original_price' => 229.99,
            'selling_price' => 189.99,
            'quantity' => 120,
            'trending' => false,
            'status' => 1,
            'images' => 'mixed_vegetable_pickle.jpg',
            'qty_type' => 1
        ],
        [
            'category_id' => 2,
            'brand_id' => 5,
            'name' => 'Tamarind Ginger Pickle',
            'slug' => 'tamarind-ginger-pickle',
            'short_description' => 'A tangy tamarind and spicy ginger pickle for bold flavor.',
            'description' => 'This Tamarind Ginger Pickle is the perfect balance of tangy tamarind and spicy ginger, mixed with an array of spices that bring out rich, bold flavors. A true delight for pickle lovers.',
            'original_price' => 219.99,
            'selling_price' => 179.99,
            'quantity' => 80,
            'trending' => true,
            'status' => 1,
            'images' => 'tamarind_ginger_pickle.jpg',
            'qty_type' => 1
        ]
    ];
    foreach($dummyData as $data){
      Product::create($data);
    }
    }



    public function getDiscountPercentageAttribute(){
      return number_format(($this->original_price -$this->selling_price)*0.1);
    }
}
