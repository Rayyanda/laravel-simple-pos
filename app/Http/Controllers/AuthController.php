<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * login view
     * 
     */
    public  function getLogin() {
        return view('Pages.login');
    }

    /**
     * register
     * @param mixed $name, $email,$password,$password_confirmation,$request
     */

     public function register(Request $request) {

        //validasi request
       $validated = $request->validate([
            'name' => 'required',
            'email'=>'required|unique:users',
            'password'=>'required|min:6',
            'password_confirmation'=>'required|min:6|same:password'
        ]);

        //buat user baru dan simpan ke database
        $user = User::create([
            'user_uuid'=>Str::uuid(),
            'name' => $request->name,
            'email'=>$request->email,
            'password' => bcrypt($request->password),
            'level'=>'user'
        ]);

        //autentikasi setelah berhasil daftar
        auth()->attempt(['email' => $request->email,'password' =>$request->password]);

        //redirect ke halaman dashboard jika berhasil daftar
       
        return redirect('/')->with('sukses','Pendaftaran Berhasil! Anda telah Teregistrasi');

     }

     /**
      * login
      * @param Request $request
      */
      public function login(Request $request)
      {
        //validasi data yang dikirim oleh user
        $validated = $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6',
        ]);

        if(Auth::attempt($validated)){
          //jika sukses maka redirect ke halaman dashboard
           return redirect('/');  
       }else{
         //jika gagal maka kembali lagi ke form login dengan menampilkan pesan error
         return back()->with('error','Email atau password salah'); 
       }
      }

     /**
      * logout
      * fungsi untuk logout / keluar dari sistem
      */
      public function logout(Request $request)
      {
        Auth::logout();//fungsi untuk menghancurkan session dan membuka halaman login
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
        return redirect('/login');//dan mengarahkan kehalaman login
      }

      /**
       * index users
       */
      public function users()
      {
        $users =  User::where('level','<>','admin')->get();//mendapatkan semua data user
        return view('Pages.users.index_users',[
            'users'=>$users,
           
        ]);//menampikan data user ke halaman users/index_users.blade.php
      }

      /**
       * halaman update user
       */

      public function get_user($uuid)
      {
        $user = User::where('user_uuid',$uuid)->first();//mendapatkan data user berdasarkan uuid yang diinputkan

        return view('Pages.users.update_users',['user'=>$user]);
      }
}
