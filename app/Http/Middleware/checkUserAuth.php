<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\AccessRight, App\Models\User;
use Session;

class checkUserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //get entered url        
        $path = $request->path();
        // print_r($path); die;
        //checking current session for one user logged in at one time
        if (Auth::check()) {
            $current_token = csrf_token();
            // print_r($current_token);  die;
            // echo "<br>";
            $saved_token = Auth::user()->session_token;
            // print_r($current_token); die;
            if ($current_token != $saved_token) {
                echo 'session_expired';
                Auth::logout();
                return redirect('/')->with('success', 'Your sesion has been expired');
            }
        }

        if (!Auth::check()) {
            // echo $request->ajax(); die; 
            if ($request->ajax()) {
                echo 'logged_out';
                die;
            }

            // if this is bug report case then do not redirect to login
            if (strpos('bug-report', $path) !== false) {
                return true;
            } else {
                return redirect('/login');
            }
        } else {

            // if user is logged in 

            //check lockscreen button is not pressed
            if (Session::has('LOCKED')) {
                if ($request->ajax()) {
                    echo json_encode('locked');
                    die;
                } else {
                    return redirect('/lockscreen');
                }
            }
            // print_r(Session::has('LAST_ACTIVITY')); die;

            //check user last activity time and redirect to lockscreen if it is delayed more than 30 sec.
            if (Session::has('LAST_ACTIVITY')) {
                $time_diff = time() - Session::get('LAST_ACTIVITY');
                //echo LOCK_TIME; die;

                //checks is ideal time more than the automatically set locked time.
                if ($time_diff > LOCK_TIME) { //in seconds
                    if ($request->ajax()) {
                        echo json_encode('locked');
                        die;
                    }
                    //if it is <a href> case then save the current path for future use
                    $pre_path = $request->path();
                    // Session::set('PREVIOUS_PATH',$pre_path);
                    Session::put('PREVIOUS_PATH', $pre_path);
                    return redirect('/lockscreen');
                }
            }
            Session::put('LAST_ACTIVITY', time());
            User::updateUserLastActivityTime();
        
            //check if user has permission to access this page.
            if ($path != '/') {

                $path = preg_replace('/\d/', '', $path);
                // print_r($path); die;
                //paths that does not need permssions
                $allowed_path = array('send-modify-request', 'bug-report', 'bug-report/add', 'notif/response');
                //,'/general/petty_cash/check-balance'
                //if requested path is not one of them that don't need permission. then check it for permission 
                if (!in_array($path, $allowed_path)) {
                    // echo $path; die;
                    $res = $this->checkPermission($path);
                    if (!$res) {
                        // if($request->ajax()){
                        //     echo json_encode('unauthorize'); die;    
                        // }
                        // return redirect()->back()->with("error", UNAUTHORIZE_ERR);
                    } else {
                    }
                }
            } 
        }

        return $next($request);
    }

    function checkPermission($path)
    {
        //return true; //by passing route check 
        $user_rights = Auth::user()->access_rights;
        $user_rights = explode(',', $user_rights);
        $rights      = AccessRight::select('id', 'route')->whereIn('id', $user_rights)->get()->toArray();
        // echo '<pre>'; print_r( $user_rights ); die;
        foreach ($rights as $key => $right) {
            if (strpos($right['route'], $path) !== false) {
                return true;
            }
        }
        return false;
    }
}
