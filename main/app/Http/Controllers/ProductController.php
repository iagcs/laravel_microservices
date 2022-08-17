<?php

namespace App\Http\Controllers;

use App\Jobs\ProductLike;
use App\Models\Product;
use App\Models\ProductUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function index()
    {
        dd( session()->get('user_token'));
        return  "ök";
    }

    public function like($id, Request $request)
    {

        $response = Http::get("http://docker.for.mac.localhost:8000/api/user");

        $user = $response->json();

        $productUser = ProductUser::create([
            'user_id' => $user["id"],
            'product_id'=> $id
        ]);

        ProductLike::dispatch($id)->onQueue('admin_queue');

        return response()->json($productUser, Response::HTTP_ACCEPTED);
    }
}
