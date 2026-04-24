<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    /**
     * ÉTAPE 1: Demande d'email
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        $email = $request->email;
        $otp = rand(100000, 999999);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['token' => $otp, 'created_at' => now()]
        );

        try {
            Mail::raw("Votre code Eat&Drink : $otp", function ($message) use ($email) {
                $message->to($email)->subject("Code de vérification");
            });

            // On stocke l'email en session pour l'étape suivante
            session(['reset_email' => $email]);

            return redirect()->route('password.verify')->with('status', 'Code envoyé !');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => "Erreur d'envoi."]);
        }
    }

    /**
     * ÉTAPE 2: Vérification de l'OTP
     */
    public function showVerifyForm()
    {
        if (!session('reset_email')) return redirect()->route('password.request');
        return view('auth.verify-otp', ['email' => session('reset_email')]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|array|size:6',
            'otp.*' => 'required|numeric'
        ]);

        $fullOtp = implode('', $request->otp);
        $email = session('reset_email');

        $reset = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $fullOtp)
            ->first();

        if (!$reset || Carbon::parse($reset->created_at)->addMinutes(15)->isPast()) {
            return back()->withErrors(['otp' => 'Code invalide ou expiré.']);
        }

        // Marquer comme vérifié en session
        session(['otp_verified' => true]);

        return redirect()->route('password.reset');
    }

    public function resendOtp()
    {
        $email = session('reset_email');
        if (!$email) return redirect()->route('password.request');

        $otp = rand(100000, 999999);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['token' => $otp, 'created_at' => now()]
        );

        try {
            Mail::raw("Votre nouveau code Eat&Drink : $otp", function ($message) use ($email) {
                $message->to($email)->subject("Nouveau code de vérification");
            });

            return back()->with('status', 'Un nouveau code a été envoyé !');
        } catch (\Exception $e) {
            return back()->withErrors(['otp' => "Erreur d'envoi."]);
        }
    }

    /**
     * ÉTAPE 3: Nouveau mot de passe
     */
    public function showResetForm()
    {
        if (!session('otp_verified') || !session('reset_email')) {
            return redirect()->route('password.request');
        }
        return view('auth.reset-password', ['email' => session('reset_email')]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $email = session('reset_email');
        if (!$email || !session('otp_verified')) {
            return redirect()->route('password.request');
        }

        $user = User::where('email', $email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Nettoyage
        DB::table('password_reset_tokens')->where('email', $email)->delete();
        session()->forget(['reset_email', 'otp_verified']);

        return redirect()->route('login')->with('status', 'Mot de passe mis à jour !');
    }
}
