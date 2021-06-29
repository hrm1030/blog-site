<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function personal_info()
    {
        return view('pages.profile.personal_info');
    }

    public function personal_info_save(Request $request)
    {
        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $company = $request->company;
        $phone = $request->phone;
        $email = $request->email;
        $company_site = $request->company_site;
        if ($request->hasFile('profile_avatar')) {
            $filenameWithExtension = $request->file('profile_avatar')->getClientOriginalName();
            $filenameWithoutExtension = Auth::user()->username.'_'.Auth::user()->id;
            $extension = $request->file('profile_avatar')->getClientOriginalExtension();
            $filenameToStore = $filenameWithoutExtension.'.'.$extension;
            // Storing The Image
            $path = $request->file('profile_avatar')->storeAs('upload/users', $filenameToStore);
        } else {
            $path = '';
        }

        if($path != null) {
            User::where('id', Auth::user()->id)
                ->update([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'company' => $company,
                    'phone' => $phone,
                    'email' => $email,
                    'company_site' => $company_site,
                    'photo' => $path
                ]);
        } else {
            User::where('id', Auth::user()->id)
                ->update([
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'company' => $company,
                    'phone' => $phone,
                    'email' => $email,
                    'company_site' => $company_site,
                ]);
        }

        return redirect('/profile/personal_info');
    }

    public function account_info()
    {
        return view('pages.profile.account_info');
    }

    public function change_password()
    {
        return view('pages.profile.change_password');
    }

    public function change_password_save(Request $request)
    {
        $validate = $request->validate([
            'current_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6'
        ]);

        if($validate)
        {
            if(Hash::check($request->current_password, Auth::user()->password))
            {
                User::where('id', Auth::user()->id)->update([
                    'password' => $request->new_password
                ]);
                $error = 'Your password is changed successfully';
            } else {
                $error = 'Your current password is not correct. Please try again.';
            }

            return redirect()->back()->withErrors([
                'error' => $error
            ]);
        }
    }
}
