<?php

namespace App\Jobs;

use App\Mail\NewProductMail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendNewProductEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $newProductMail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(NewProductMail $newProductMail)
    {
        $this->newProductMail = $newProductMail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::all();

        foreach($users as $user){
            Mail::to($user->email)->send($this->newProductMail);
        }
    }
}
