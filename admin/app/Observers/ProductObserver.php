<?php

namespace App\Observers;

use App\Jobs\ProductCreated;
use App\Jobs\ProductDeleted;
use App\Jobs\ProductUpdated;
use App\Jobs\SendNewProductEmails;
use App\Mail\NewProductMail;
use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function created(Product $product)
    {
        ProductCreated::dispatch($product->toArray())->onQueue('main_queue');
        //SendNewProductEmails::dispatch(new NewProductMail());
    }

    public function updated(Product $product)
    {
        ProductUpdated::dispatch($product->toArray())->onQueue('main_queue');
    }

    public function deleted(Product $product)
    {
        ProductDeleted::dispatch($product->id)->onQueue('main_queue') ;
    }
}
