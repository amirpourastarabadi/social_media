<?php

namespace App\Http\Controllers\User;

use App\Events\User\FollowEvent;
use App\Http\Controllers\Controller;
use App\Models\User;

class FollowController extends Controller
{
    public function follow(User $following)
    {
        $event = new FollowEvent($following, auth()->user());
        
        event($event);   
    
        return response()->json(['message' => 'success']);
    }
}
