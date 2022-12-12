<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash, Auth;

class AuthController extends Controller
{
    public function register(Request $request) {
        if($request->isMethod('post')) {
            $validatedData = $request->validate([
                'email' => 'required|unique:users|email',
                'pwd' => 'required',
            ]);

            $data = $request->all();
            $email = strtolower($data['email']);

            $user = new User;
            $user->email = $email;
            $user->password = Hash::make($data['pwd']);
            if($user->save()) {
                return redirect('/login');
            } else {
                return redirect('registration');
            }
        }

        return view('welcome');
    }

    public function login(Request $request) {
        if($request->isMethod('post')) {
            $validatedData = $request->validate([
                'email' => 'required',
                'pwd' => 'required',
            ]);

            $data = $request->all();

            $credentials = array(
                'email'=>$data['email'],
                'password'=>$data['pwd'],
            );

            if(Auth()->attempt($credentials)){
                return redirect('/user/feed');
            } else {
                return redirect('/login');
            }
        }

        return view('login');
    }

    public function userFeed() {

        $user_id = Auth::user()->id;
        
        $feed_url = User::where('id', $user_id)->value('feed_link');
        $feed = (array) simplexml_load_file($feed_url);
        // echo '<pre>'; print_r($feed['channel']); die;
        return view('feed', compact('feed','feed_url'));

    }

    public function userFeedDetail($feed_ind) {
        $user_id = Auth::user()->id;
        
        $feed_url = User::where('id', $user_id)->value('feed_link');
        $feed = (array) simplexml_load_file($feed_url);
        // echo '<pre>'; print_r($feed['channel']->item[1]); die;
        return view('feed_detail', compact('feed', 'feed_ind'));

    }

    public function updateUrl(Request $request) {
        if($request->isMethod('post') && Auth::check()) {
            $validatedData = $request->validate([
                'rss_url' => 'required|url',
            ]);

            $data = $request->all();
            $user_id = Auth::user()->id;

            $upd = User::where('id', $user_id)->update(['feed_link'=> $data['rss_url']] );
            if($upd) { 
                return redirect('/user/feed');
            } else {
                return false;
            }
        } 
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
