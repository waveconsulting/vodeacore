<?php

namespace App\Http\Controllers\Admin;

use App\Entity\User\Admin;
use App\Http\Controllers\Controller;
use App\Util\Constant;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller {

    public function loginPage() {
        return view('admin.auth.login');
    }


    public function submitLogin() {
        $input = (object)Input::all();

        if (\Auth::isAdmin()) return redirect()->route('admin.dashboard');

        $admin = Admin::where('email', $input->email)->with('roles')->first();

        if ($admin == null){

            return Redirect::back()->withErrors('Username / password salah, mohon ulang kembali.');
        } else if ($admin->status != Constant::STATUS_ACTIVE){

            return Redirect::back()->withErrors(['Akun belum terverifikasi, silahkan verifikasi terlebih dahulu.']);
        }

        if(!\Auth::attempt(['email' => $input->email, 'password' => $input->password])){

            return Redirect::back()->withErrors(['Username / password salah, mohon ulang kembali.']);
        }

        return redirect()->route('admin.dashboard');
    }

    public function logout() {
        \Auth::logout();

        return redirect()->route('admin.login-page');
    }


}
