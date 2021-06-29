<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function signin(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        if($validate)
        {
            $credentials = $request->only('email', 'password');

            if(Auth::attempt($credentials, $request->has('remember')))
            {
                $user = User::where('email', $request->email)->first();
                if($user->state == 0)
                {
                    $six_digit_random_number = random_int(100000, 999999);
                    // $data = array('name'=>"HRM hrm");
                    // Mail::send('auth.verify', $data, function($message) use ($user, $six_digit_random_number) {

                    //     $message->to($user->email, 'Account verify')->subject($six_digit_random_number);
                    //     $message->from('maksim.glazunov2020@gmail.com','HRM hrm');

                    // });
                    User::where('email', $user->email)->update([
                        'digit_number' => $six_digit_random_number
                    ]);
                    return redirect('/auth/verify')->withErrors([
                        'six_digit_random_number' => $six_digit_random_number,
                        'email' => $user->email
                    ]);

                } else {
                    $request->session()->regenerate();
                    return redirect('/home');
                }

            } else {
                return redirect()->back()->withErrors([
                    'error' => 'Please type your account information exactly.'
                ]);
            }
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function signup(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|string|min:6',
            'phone' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);
        if($validate)
        {
            $data = $request->all();
            if($this->create($data))
            {
                $credentials = $request->only('email', 'password');

                if(Auth::attempt($credentials, $request->has('remember')))
                {
                    $user = User::where('email', $request->email)->first();
                    if($user->state == 0)
                    {
                        $six_digit_random_number = random_int(100000, 999999);
                        // $data = array('name'=>"HRM hrm");
                        // Mail::send('auth.verify', $data, function($message) use ($user, $six_digit_random_number) {

                        //     $message->to($user->email, 'Account verify')->subject($six_digit_random_number);
                        //     $message->from('maksim.glazunov2020@gmail.com','HRM hrm');

                        // });
                        User::where('email', $user->email)->update([
                            'digit_number' => $six_digit_random_number
                        ]);
                        return redirect('/auth/verify')->withErrors([
                            'six_digit_random_number' => $six_digit_random_number,
                            'email' => $user->email
                        ]);

                    } else {
                        $request->session()->regenerate();
                        return redirect('/home');
                    }

                }
                // return redirect('/home');
            }
        }

    }

    public function create(array $data)
    {
        return User::create([
            'username'=> $data['username'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }

    public function forgot_password()
    {
        return view('auth.forgot_password');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    public function verify()
    {
        return view('auth.verify');
    }

    public function authorization(Request $request)
    {
        $user = User::where('email' , $request->email)->first();
        if($user->digit_number == $request->six_digit_number)
        {
            User::where('email', $user->email)->update([
                'state' => 1
            ]);
            return redirect('/home');
        } else {
            $six_digit_random_number = random_int(100000, 999999);
            // $data = array('name'=>"HRM hrm");
            // Mail::send('auth.verify', $data, function($message) use ($user, $six_digit_random_number) {

            //     $message->to($user->email, 'Account verify')->subject($six_digit_random_number);
            //     $message->from('maksim.glazunov2020@gmail.com','HRM hrm');

            // });
            User::where('email', $user->email)->update([
                'digit_number' => $six_digit_random_number
            ]);
            return redirect()->back()->withErrors([
                'six_digit_random_number' => $six_digit_random_number,
                'email' => $user->email,
                'error' => 'Six digit number is wrong. Please check again.'
            ]);
        }
    }

}
