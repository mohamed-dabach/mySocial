<?php

namespace App\Http\Controllers;

use App\Mail\MailConfirmation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class MailController extends Controller
{

    public function mailConfirmation(User $user)
    {
        Mail::to($user->email, $user->name)->send(new MailConfirmation($user));
    }

    public function mailConfirmationVerify(Request $request)
    {


        $user =   User::findOrFail($request->id);


        if (!$request->hasValidSignature() ||  ($user->created_at->toDateTimeString() !== Carbon::createFromTimestampMs($request->created_at)->toDateTimeString())) abort(401);
        if ($user->email_verified_at) return abort(419);

        $user->email_verified_at = now();
        $user->save();

        return redirect()->route("login")->with(['message', 'Email verified.']);
    }
}
