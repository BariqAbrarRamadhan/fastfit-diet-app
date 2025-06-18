<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function indexLogin()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function indexRegister()
    {
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            // 'terms' => 'required|accepted',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Login otomatis setelah register
        Auth::login($user);

        $hasCompletedQuestionnaire = $user->questionnaire()->exists();

        // Redirect berdasarkan status kuesioner dan role
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Registrasi & login berhasil! Selamat datang di dashboard admin!');
        } elseif ($user->role == 'user' && $hasCompletedQuestionnaire) {
            return redirect()->route('dashboard')->with('success', 'Registrasi & login berhasil! Selamat datang!');
        } else {
            return redirect()->route('questionnaire.index')->with('info', 'Registrasi berhasil! Silakan lengkapi kuesioner terlebih dahulu.');
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah.'],
            ]);
        }

        $request->session()->regenerate();

        $user = $request->user();
        $hasCompletedQuestionnaire = $user->questionnaire()->exists();

        // Redirect berdasarkan status kuesioner
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang di dashboard admin!');
        } elseif ($user->role == 'user' && $hasCompletedQuestionnaire) {
            return redirect()->route('dashboard')->with('success', 'Selamat datang kembali!');
        } else {
            return redirect()->route('questionnaire.index')->with('info', 'Silakan lengkapi kuesioner terlebih dahulu.');
        }

        // return redirect()->route('questionnaire')->with('info', 'Silakan lengkapi kuesioner terlebih dahulu.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }



    //     class AuthController extends Controller
// {
//     public function register(Request $request)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|string|email|unique:users',
//             'password' => 'required|string|min:6',
//         ]);

    //         $user = User::create([
//             'name' => $validated['name'],
//             'email' => $validated['email'],
//             'password' => Hash::make($validated['password']),
//         ]);

    //         return response()->json($user, 201);
//     }

    //     // public function login(Request $request)
//     // {
//     //     $credentials = $request->validate([
//     //         'email' => 'required|string|email',
//     //         'password' => 'required|string'
//     //     ]);

    //     //     if (!Auth::attempt($credentials)) {
//     //         throw ValidationException::withMessages([
//     //             'email' => ['Email atau password salah.'],
//     //         ]);
//     //     }

    //     //     $user = Auth::user();
//     //     $token = $user->createToken('auth_token')->plainTextToken;

    //     //     $hasCompletedQuestionnaire = $user->questionnaire()->exists();

    //     //     return response()->json([
//     //         'message' => 'Berhasil login',
//     //         'token' => $token,
//     //         'user' => $user,
//     //         'hasCompletedQuestionnaire' => $hasCompletedQuestionnaire
//     //     ])->withCookie(cookie('role', $user->role, 60 * 24, null, null, false, false, false, 'Strict'))
//     //       ->withCookie(cookie('hasCompletedQuestionnaire', $hasCompletedQuestionnaire ? '1' : '0', 60 * 24, null, null, false, false, false, 'Strict'));
//     // }    
//     public function login(Request $request)
// {
//     $credentials = $request->validate([
//         'email' => 'required|string|email',
//         'password' => 'required|string'
//     ]);

    //     if (!Auth::attempt($credentials)) {
//         throw ValidationException::withMessages([
//             'email' => ['Email atau password salah.'],
//         ]);
//     }

    //     $request->session()->regenerate(); // sangat penting agar session aman

    //     $user = $request->user();
//     $hasCompletedQuestionnaire = $user->questionnaire()->exists();

    //     return response()->json([
//         'message' => 'Berhasil login',
//         'user' => $user,
//         'hasCompletedQuestionnaire' => $hasCompletedQuestionnaire
//     ])
//         ->withCookie(cookie('role', $user->role, 60 * 24, null, null, false, false, false, 'Strict'))
//         ->withCookie(cookie('hasCompletedQuestionnaire', $hasCompletedQuestionnaire ? '1' : '0', 60 * 24, null, null, false, false, false, 'Strict'));
// }


    //     public function user(Request $request)
//     {
//         return response()->json($request->user());
//     }

    //     public function logout(Request $request)
//     {
//         Auth::guard('web')->logout();

    //         $request->session()->invalidate();
//         $request->session()->regenerateToken();

    //         return response()->json(['message' => 'Logout berhasil'])
//             ->withCookie(Cookie::forget('role'))
//             ->withCookie(Cookie::forget('hasCompletedQuestionnaire'));
//     }


    // }

}
