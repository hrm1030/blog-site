<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
}
