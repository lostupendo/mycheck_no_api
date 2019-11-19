<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

/**
 * Class MyCheckAuthController
 *
 * @package App\Http\Controllers
 */
class MyCheckAuthController extends Controller
{
    /**
     * Main screen
     *
     * @return RedirectResponse
     */
    public function home() {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        return view('home', ['user'=>auth()->user()]);
    }

    /**
     * Display Login page
     *
     * @return View
     */
    public function login() {
        return view('login');
    }

    /**
     * If the user exists valid, log in
     *
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function doLogin(Request $request) {
        // validate login
        try {
            $this->validateUser($request);
        } catch (Exception $e) {
            return redirect()->route('login')->withErrors(['danger'=>'User cannot be validated (' . $e->getMessage() . ')'])->withInput($request->all());
        }

        // log in
        $credentials = $request->only('email', 'password');
        if (!auth()->attempt($credentials)) {
            return redirect()->route('login')->withErrors(['danger'=>'Logging in failed, please try again later'])->withInput($request->all());
        }

        // redirect to home page
        return redirect()->route('home')->with('user', auth()->user());
    }

    /**
     * Logging out and redirecting to login
     * @return View
     */
    public function logout() {
        auth()->logout();
        return view('login');
    }

    /**
     * Display registration page
     *
     * @param Request $request
     * @return mixed
     */
    public function register() {
        return view('register');
    }

    /**
     * Register user in database
     *
     * @param Request $request
     * @return mixed
     */
    public function doRegister(Request $request) {
        // validate
        try {
            $this->validateUser($request, true);
        } catch (Exception $e) {
            return redirect()->route('login')->withErrors(['danger'=>'User details cannot be validated (' . $e->getMessage() . ')'])->withInput($request->all());
        }

        // register
        $userCreated = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);

        if ($userCreated) {
            return view('login')->withErrors(['success', 'User successfully created!']);
        }
        return redirect()->route('register')->with($request);
    }

    /**
     * Validate that user is valid before taking an action
     *
     * @param Request $request
     * @param bool $isRegister if name is needed (for registration)
     * @throws Exception
     */
    private function validateUser(Request $request, $isRegister=false) {
        $rules = [
            'email' => 'required|string|email|max:255' . ($isRegister? '|unique:users' : ''),
            'password' => 'required|string|min:6',
        ];
        $messages = [
            'email' => 'Bad or existing Email',
            'password' => 'Bad password'
        ];

        if ($isRegister) {
            $rules['name'] = 'required|string|max:255';
            $messages['name'] = 'Bad name';
        }

        $this->validate($request, $rules, $messages);
    }
}
