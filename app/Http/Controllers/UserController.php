<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $data = config('data');
        return view('user.profile', compact('user','data'));
    }

    public function viewProfile(User $user)
    {
        $data = config('data');
        return view('admin.profile', compact('user','data'));
    }

    public function editProfile(User $user)
    {
        $data = config('data');
        return view('user.edit-profile', compact('user','data'));
    }

    public function updateProfile(User $user, Request $request)
    {
        $this->validate($request, [
            'dob' => 'required|date_format:Y-m-d',
            //'email' => 'required|unique:users,email'.$request->id,
            'nickname' => 'required',
            'facebook_username' => 'required',
            'marital_status' => 'required',
            'state' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'best_course' => 'required',
            'worst_course' => 'required',
            'best_lecturer' => 'required',
            'hobbies' => 'required',
            'likes_dislikes' => 'required',
            'best_moment' => 'required',
            'worst_moment' => 'required',
            'most_admired' => 'required',
            'role_model' => 'required',
            'future_aspiration' => 'required',
        ]);
        $user->update($request->all());
        if (auth()->user()->level == 1){
            return redirect()->route('admin.profile',$user->id)->with('info', 'Update Successful');
        }
        return redirect()->route('profile')->with('info', 'Upload Successful');
    }

    public function uploadPicture(User $user, Request $request)
    {
//        $this->validate($request, [
//            'image' => 'image',
//        ]);


        $image = Image::make($request->file('image'));
//        $image->fit(300, 300, function ($constraint) {
//            $constraint->aspectRatio();
//        });


            $filename = $user->phone.'.'.$request->file('image')->extension();
            $old_filename = $user->image;

        $update = false;
        if (Storage::disk('users')->has($old_filename)) {
            $old_file = Storage::disk('users')->get($old_filename);
            Storage::disk('users')->put($filename, $old_file);
            $update = true;
            //return response()->json(array('info' => 'Picture exists'));
        }
        if ($update && $old_filename !== $filename) {
            Storage::delete($old_filename);
        }
        //Storage::put($path, (string) $image->encode());
        Storage::disk('users')->put($filename, (string) $image->encode());

        $user->update([
            'image' => $filename,
        ]);


        return back()->with('info', 'Image Upload Successful');
    }

    public function printProfile(User $user)
    {
        $pdf = \PDF::loadView('exports.print', compact('user'));
        return $pdf->stream('registered.pdf');
    }
}
