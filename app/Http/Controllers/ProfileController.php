<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user= User::find(Auth::id());
        return view('profile.index',['user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user= User::find(Auth::id());
        return view('profile.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProfileRequest  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
//        return $request;
        $request->validate([
            "profile"=>"mimetypes:image/jpeg,image/png",
        ]);
//        return $request;
        $file = $request->file("profile");
        $newFileName = uniqid()."_profile.".$file->getClientOriginalExtension();
        $dir = "public/profile/";
//        Move method nae file ko save tr
//        $file->move("store/",$newFileName);
        $file->storeAs($dir,$newFileName);
//        Storage nae file ko save tr
//        Storage::putFileAs($dir,$file,$newFileName);

//        $arr = scandir(public_path("/storage"));

        $user = User::find(Auth::id());
        $user->profile = $newFileName;
        $user->update();


        return redirect()->route("profile.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
