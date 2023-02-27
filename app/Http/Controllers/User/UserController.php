<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserListResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function listUsers(Request $request){

        $users = User::where('is_admin', false);

        $users = UserListResource::collection($users->get());
        return response($users, 200);
    }
}
