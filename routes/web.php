<?php

use Illuminate\Cache\RateLimiter;

Route::get('/', function () {
    return view('login');
});

// Inject RateLimiter
Route::post('login', function (RateLimiter $limiter)
{
    $ip = request()->ip();
    $maxLogin = 5;
    $decay = 0.1; // In minutes

    if ($limiter->tooManyAttempts($ip, $maxLogin, $decay))
    {
        return back()->withMessage(
            "Too many login. Please wait in {$limiter->availableIn($ip)} second(s)."
        );
    }

    $limiter->hit($ip, $decay);

    $credentials = request()->only('email', 'password');

    if (!auth()->attempt($credentials)) {
        return back()->withMessage(
            "Invalid credentials. Retries left: " . $limiter->retriesLeft($ip, $maxLogin)
        );
    }

    $limiter->clear($ip);

    return 'Congratulations!';
});
