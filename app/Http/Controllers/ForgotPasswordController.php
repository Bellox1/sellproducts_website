<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * Afficher le formulaire de demande d'OTP (Email)
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Générer et envoyer l'OTP par email
     */
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $email = $request->email;
        $otp = rand(100000, 999999);

        // Stocker l'OTP (on remplace l'existant s'il y en a un)
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => $otp, // On utilise la colonne 'token' pour stocker l'OTP
                'created_at' => now(),
            ]
        );

        // Envoyer l'email
        try {
            Mail::raw("Votre code de réinitialisation de mot de passe est : $otp. Ce code expirera bientôt.", function ($message) use ($email) {
                $message->to($email)
                        ->subject("Réinitialisation de votre mot de passe - Eat&Drink");
            });

            return redirect()->route('password.reset', ['email' => $email])
                             ->with('status', 'Un code de réinitialisation a été envoyé à votre adresse email.');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => "Impossible d'envoyer l'email. Veuillez réessayer plus tard."]);
        }
    }

    /**
     * Afficher le formulaire de réinitialisation (OTP + Nouveau mot de passe)
     */
    public function showResetForm(Request $request)
    {
        $email = $request->get('email');
        return view('auth.reset-password', compact('email'));
    }

    /**
     * Traiter la réinitialisation
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric',
            'password' => 'required|min:8|confirmed',
        ]);

        $reset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->otp)
            ->first();

        if (!$reset || \Carbon\Carbon::parse($reset->created_at)->addMinutes(15)->isPast()) {
            return back()->withErrors(['otp' => 'Le code OTP est invalide ou a expiré.']);
        }

        // Mettre à jour le mot de passe
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Supprimer l'OTP utilisé
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Votre mot de passe a été réinitialisé avec succès. Vous pouvez maintenant vous connecter.');
    }
}
