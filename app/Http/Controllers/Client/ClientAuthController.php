<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientAuthController extends Controller
{
    /**
     * Afficher le formulaire de connexion client
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('client.home');
        }

        return view('client.auth.login'); // Ajustez le chemin de la vue si nécessaire (ex: auth.login)
    }

    /**
     * Traiter la connexion client
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Adresse email ou mot de passe incorrect.',
            ])->onlyInput('email');
        }

        $passwordMatches = false;

        // Migration/Vérification automatique si le mot de passe n'est pas au format Bcrypt
        if (Hash::needsRehash($user->password)) {
            if ($credentials['password'] === $user->password) {
                $passwordMatches = true;
                $user->password = Hash::make($credentials['password']);
                $user->save();
            }
        } else {
            $passwordMatches = Hash::check($credentials['password'], $user->password);
        }

        if ($passwordMatches) {
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            return redirect()->intended(route('client.checkout.index'))
                ->with('success', 'Connexion réussie !');
        }

        return back()->withErrors([
            'email' => 'Adresse email ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    /**
     * Afficher le formulaire d'inscription client
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('client.home');
        }

        return view('client.auth.register'); // Ajustez le chemin si nécessaire
    }

    /**
     * Traiter l'inscription client
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'client',
        ]);

        Auth::login($user);

        return redirect()->route('client.checkout.index')
            ->with('success', 'Votre compte a été créé avec succès !');
    }

    /**
     * Déconnexion client
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('client.home');
    }
}