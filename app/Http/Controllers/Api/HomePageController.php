<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $userType = $user->user_type;
        return response()->json([
            'status' => 'success',
            'is_logged_in' => $user ? true : false,
            'user' => $user ? new UserResource($user->load('role')) : null,
            'homepage_content' => "This is home page",
        ]);
    }
}
