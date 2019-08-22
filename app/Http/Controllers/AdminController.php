<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Group;
use App\Imports\ImportUsers;
use App\Lcc;
use App\User;
use Chumper\Zipper\Facades\Zipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function usersTable()
    {
        if (Auth::user()->level == 1){
            $users = User::where('level', 2);
        }
        return DataTables::of($users)

            ->addColumn('actions', function($row){

                $id = $row->id;
                $viewUrl = route('admin.profile', $row->id);
                $confirmUrl = route('admin.confirm', $row->id);
                $deleteUrl = route('destroy.profile', $row->id);
                if ($row->deleted_at !== null){
                    $restoreUrl = route('restore.profile');
                }else{
                    $restoreUrl = 0;
                }
                $c = $row->level;

                return view('partials.formActions', compact('viewUrl', 'deleteUrl','restoreUrl','id','c','confirmUrl'));
            })
            ->make(true);
    }

    public function toExcel(Request $request)
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function viewProfile(User $user)
    {
        $data = config('data');
        return view('admin.profile', compact('user','data'));
    }

    public function editProfile(User $user)
    {
        $data = config('data');
        return view('admin.edit', compact('user','data'));
    }

    public function updateProfile(User $user, Request $request)
    {
        $user->update($request->all());
        return redirect()->route('admin.profile', $user->id)->with('info', 'Update Successful');
    }

    public function confirmProfile(User $user)
    {
        $user->update([
            'level' => 3,
        ]);
        return back()->with('info', 'User Confirmed');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('info', 'User Deleted');
    }

    public function restore(Request $request)
    {
        $user = User::withTrashed()->find($request->id);
        $user->restore();
        return back()->with('info', 'User Restored');
    }

    public function downloadZip()
    {
        $files = glob('public/storage/users/*');
        Zipper::make('public/pictures.zip')->add($files)->close();

        dd()

        return response()
            ->download('public/pictures.zip');
    }

    public function admins()
    {
        $users = User::withTrashed()->where('level', 1)->where('email', '<>', 'yelmism@yahoo.com')->get();

        return view('admin.admins', compact('users'));
    }

    public function createUser(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'level' => ['required', 'integer'],
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->except(['password_confirmation']));

        return back()->with('info', 'Admin User Created');

    }

    public function uploadUsers(Request $request)
    {
        set_time_limit(3000);
        Excel::import(new ImportUsers($request), $request->file('students'));
        return back()->with('info', 'Upload Successful');

    }

}
