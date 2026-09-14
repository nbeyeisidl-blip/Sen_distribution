<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Afficher le formulaire de connexion unique
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectUserByRole(Auth::user());
        }

        return view('auth.login');
    }

    /**
     * Traiter la connexion unique pour tous les rôles
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email', 'password');

        // Migration/Mise à jour automatique des mots de passe en texte clair vers Bcrypt
        $user = User::where('email', $credentials['email'])->first();

        if ($user) {
            $hashInfo = Hash::info($user->password);

            if (empty($hashInfo['algoName']) || $hashInfo['algoName'] === 'unknown') {
                if ($credentials['password'] === $user->password) {
                    $user->password = Hash::make($credentials['password']);
                    $user->save();
                }
            }
        }

        // Tentative de connexion
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return $this->redirectUserByRole(Auth::user());
        }

        return back()
            ->withErrors([
                'email' => 'Adresse email ou mot de passe incorrect.',
            ])
            ->onlyInput('email');
    }

    /**
     * Rediriger l'utilisateur directement selon son rôle (sans intended)
     */
    protected function redirectUserByRole($user)
    {
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');

            case 'cashier':
            case 'caissier':
                return redirect()->route('cashier.dashboard');

            case 'magasinier':
            case 'stock_manager':
                return redirect()->route('storekeeper.dashboard');

            default: // Clients
                return redirect()->route('client.home');
        }
    }

    /**
     * Afficher le formulaire d'inscription
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectUserByRole(Auth::user());
        }

        return view('auth.register');
    }

    /**
     * Enregistrer un nouvel utilisateur
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'role'     => ['nullable', 'string', 'in:client,cashier,caissier,admin'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role ?? 'client',
        ]);

        Auth::login($user);

        return $this->redirectUserByRole($user);
    }

    /**
     * Déconnexion globale
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}