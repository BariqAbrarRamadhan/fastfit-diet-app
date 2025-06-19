<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

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

    /**
     * Redirect ke Google untuk OAuth
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cek apakah user sudah ada berdasarkan google_id
            $user = User::where('google_id', $googleUser->id)->first();

            if (!$user) {
                // Cek apakah email sudah terdaftar
                $existingUser = User::where('email', $googleUser->email)->first();

                if ($existingUser) {
                    // Update user yang sudah ada dengan google_id
                    $existingUser->update(['google_id' => $googleUser->id]);
                    $user = $existingUser;
                } else {
                    // Buat user baru
                    $user = User::create([
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'password' => Hash::make(Str::random(24)), // Password random
                        'role' => 'user', // Default role
                    ]);
                }
            }

            // Login user
            Auth::login($user);

            $hasCompletedQuestionnaire = $user->questionnaire()->exists();

            // Redirect berdasarkan status kuesioner dan role
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login dengan Google berhasil! Selamat datang di dashboard admin!');
            } elseif ($user->role == 'user' && $hasCompletedQuestionnaire) {
                return redirect()->route('dashboard')->with('success', 'Login dengan Google berhasil! Selamat datang!');
            } else {
                return redirect()->route('questionnaire.index')->with('info', 'Login dengan Google berhasil! Silakan lengkapi kuesioner terlebih dahulu.');
            }

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login dengan Google. Silakan coba lagi.');
        }
    }
}
