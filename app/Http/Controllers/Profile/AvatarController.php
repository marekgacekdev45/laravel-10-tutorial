<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateAvatarRequest;

class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request)
    {
        // return response()->redirectTo(route('profile.edit'));
// return back()->with(['message'=>'Avatar is changed']);
// return back()->with('message','Udało się');

$path = Storage::disk('public')->put('avatars',$request->file('avatar'));
        // $path = $request->file('avatar')->store('avatars','public');
      
        if($oldAvatar =$request->user()->avatar){
            // dd($oldAvatar);
            Storage::disk('public')->delete($oldAvatar);
        }

        auth()->user()->update(['avatar' => $path]);


        return back()->with('message', 'Udało się');
    }
}