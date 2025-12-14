<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateProductSlugs extends Command
{
    protected $signature = 'products:generate-slugs';
    protected $description = 'Generate slugs for existing products';

    public function handle()
    {
        $products = Product::whereNull('slug')->orWhere('slug', '')->get();
        
        $this->info("Found {$products->count()} products without slugs.");
        
        $bar = $this->output->createProgressBar($products->count());
        $bar->start();
        
        foreach ($products as $product) {
            $slug = Str::slug($product->name);
            
            // Handle duplicate slugs
            $count = 1;
            $originalSlug = $slug;
            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            
            $product->slug = $slug;
            $product->save();
            
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine();
        $this->info('Slugs generated successfully!');
        
        return 0;
    }
}