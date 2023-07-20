<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request)
    {
        // return response()->redirectTo(route('profile.edit'));
// return back()->with(['message'=>'Avatar is changed']);
// return back()->with('message','Udało się');
        $path = $request->file('avatar')->store('avatars','public');
      

        auth()->user()->update(['avatar' => $path]);


        return back()->with('message', 'Udało się');
    }
}