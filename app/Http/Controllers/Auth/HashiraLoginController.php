<?php 


namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Cache\RateLimiter;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;

class HashiraLoginController extends Controller {

    public function showLoginForm(){
        return view("loginForm");
    }

    public function login(Request $request){
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);        
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string|',
            'password' => 'required|string',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        if(Auth::guard('Hashiras')->user()!=null || Auth::guard()->user()!=null){
            return false;
        }
        return $this->guard()->attempt($this->credentials($request), $request->filled('remember'));
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect("/error");
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'username' => [trans('auth.failed')],
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect("/hashira/account");
    }


    protected function credentials(Request $request)
    {
        return $request->only('username', 'password');
    }

    protected function guard() : StatefulGuard
    {
        return Auth::guard('Hashiras');
    }

    /////////////////////////Throttle Login //////////////////////////////////////

    protected function hasTooManyLoginAttempts(Request $request){
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $this->maxAttempts(), $this->decayMinutes()
        );
        
    }

    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        throw ValidationException::withMessages([
            
                'username'=> [Lang::get('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ])],
        ])->status(Response::HTTP_TOO_MANY_REQUESTS);
    }

    protected function incrementLoginAttempts(Request $request)
    {
        $this->limiter()->hit(
            $this->throttleKey($request), $this->decayMinutes()
        );
    }

    protected function clearLoginAttempts(Request $request)
    {
        $this->limiter()->clear($this->throttleKey($request));
    }


    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input('username')).'|'.$request->ip();
    }

    protected function limiter()
    {
        return app(RateLimiter::class);
    }


    
    public function maxAttempts()
    {
        return property_exists($this, 'maxAttempts') ? $this->maxAttempts : 5;
    }

    public function decayMinutes()
    {
        return property_exists($this, 'decayMinutes') ? $this->decayMinutes : 1;
    }


}