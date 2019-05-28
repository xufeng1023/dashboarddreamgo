<?php

namespace App\Http\Controllers;

use DB;
use App\WPPostMeta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $programs = $profile = $majors = [];
        $userId = WPPostMeta::where('meta_key', 'ms_profile_password')->where('meta_value', auth()->user()->wp_password)->firstOrFail()->post_id;
        $user = WPPostMeta::where('post_id', $userId)->where('meta_key', 'LIKE', "ms_profile\_%")->get();
        foreach($user as $u) {
            $profile[$u->meta_key] = $u->meta_value;
        }

        $meta_value = WPPostMeta::where('post_id', $userId)->where('meta_key', 'LIKE', "ms_p\_%")->get();

        foreach($meta_value as $value) {
            if(preg_match('/\d{1,2}/', $value->meta_key, $match)) {
                $key = $match[0];
                if($value->meta_key == 'ms_p_'.$key.'_diy') $programs[$key]['diy'] = $value->meta_value;
                elseif($value->meta_key == 'ms_p_'.$key.'_vip') $programs[$key]['vip'] = $value->meta_value;
                elseif($value->meta_key == 'ms_p_'.$key.'_gpa') $programs[$key]['gpa'] = $value->meta_value;
                elseif($value->meta_key == 'ms_p_'.$key.'_gregmat') $programs[$key]['gregmat'] = $value->meta_value;
                elseif($value->meta_key == 'ms_p_'.$key.'_activity') $programs[$key]['activity'] = $value->meta_value;
                elseif($value->meta_key == 'ms_p_'.$key.'_major') { 
                    $majorMeta = WPPostMeta::where('post_id', $value->meta_value)->where('meta_key', 'like', 'mp_%')->get();
                    foreach($majorMeta as $mm) {
                        $majors[$key][$mm->meta_key] = $mm->meta_value;
                    }
                }
            }
        }
        // dd($majors);
        return view('home', ['programs' => $programs,'majors' => $majors, 'profile' => $profile]);
    }
}
