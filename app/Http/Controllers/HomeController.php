<?php


namespace App\Http\Controllers;

use App\Models\AbFlag;
use App\Models\AbTestResults;
use App\Models\CookiesCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(Request $request) {

        if(!isset($_COOKIE['visitor']) || isset($request->clear_cookie)) {

            // set cookie
            $cookie_val = 'visitor_'.time();
            setcookie('visitor', $cookie_val, time() + 60 * 60 * 24 * 30);
            CookiesCheck::insert([
                'cookie_value'  => $cookie_val
            ]);

            // set flag A || B
            $flag_model = AbFlag::first();
            if($flag_model == null) AbFlag::insert([
                'flag'  => 'a'
            ]);
            if($flag_model->flag == 'a') AbFlag::where('flag', 'a')->update(['flag'  => 'b']);
            if($flag_model->flag == 'b') AbFlag::where('flag', 'b')->update(['flag'  => 'a']);

            // set results into ab_test_results table
            $ab_results_model = AbTestResults::first();
            if($flag_model->flag == 'a') {
                $ab_results_model->num_visitors_for_b += 1;
            } else {
                $ab_results_model->num_visitors_for_a += 1;
            }
            $ab_results_model->save();

            if(isset($request->clear_cookie)) return Redirect::to('/')->withCookie($_COOKIE['visitor']);

        }

        // set clicked flag for cookies_check table
        if(isset($request->flag) && isset($_COOKIE['visitor'])) {
            if($cookie_check = CookiesCheck::where('cookie_value', $_COOKIE['visitor'])->where('clicked', false)->first()) {
                $cookie_check->clicked = true;
                $cookie_check->save();

                // count++ in ab_test_results
                $ab_results_model = AbTestResults::first();
                if($request->flag == 'a') {
                    $ab_results_model->num_clicks_for_a += 1;
                } else {
                    $ab_results_model->num_clicks_for_b += 1;
                }
                $ab_results_model->save();
            }
            return Redirect::to('/');
        }


        $flag_model = AbFlag::first();

        return view('welcome', ['flag' => $flag_model->flag]);
    }

    public function report() {
        $report_data = AbTestResults::first();
        return view('report', ['report_data' => $report_data]);
    }

}
