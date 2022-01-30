<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shortener;
use Redirect;

class ShortenerController extends Controller
{
    private $user_ip;

    public function __construct()
    {
       // $this->user_ip = request()->server('HTTP_X_REAL_IP');
            $this->user_ip = request()->ip();
    }
    
    public function getWelcomeView(){

    //    $recents = Shortener::latest()->take(5)->get();
        $recent = Shortener::where('user_ip', $this->user_ip)->orderBy('created_at', 'desc')->take(5)->get();
        $clicked = Shortener::where('user_ip', $this->user_ip)->orderBy('clicks', 'desc')->take(5)->get();
        return view('welcome', ['recent' => $recent, 'clicked' => $clicked]);
    }

    public function getDirectoryView(){
        $urls = Shortener::where('user_ip', $this->user_ip)->orderBy('created_at', 'desc')->get();
        return view('directory', ['urls' => $urls]);
    }

    public function makeShortUrl(Request $request){
        if(isset($request->url)){
            $url =  $request->url;
            $code = $this->makeCode($url);
            // return empty($code);
            if(!empty($code)){
                // Display success message with shortened URL
                session(['alert' => 'Your short link is -> '.$_SERVER['HTTP_HOST'].'/url/public/c/'.$code]);
            } else{
                // Display error message
                session(['invalid' => 'There was a problem with the URL you provided']);
            }
        }

        return redirect()->route('welcome');
    }

    protected function makeCode($url){
        $url = trim($url);

        if(filter_var($url, FILTER_VALIDATE_URL) === FALSE ){
            return '';
        }
       
        if(Shortener::where('url', $url)->exists()){
            return Shortener::where('url', $url)->first()->code;
        } else{
            // Check for and remove the trailing slash for every URL
            if(substr($url, -1) == '/'){
                $url = substr($url, 0, -1);
            }

            // Insert the URL and user IP address
            $shorter = new Shortener();
            $shorter->url = $url;
            $shorter->user_ip = $this->user_ip;
            $shorter->save();


            // Generate unique code based on item id
            $code = $this->generateCode($shorter->id);
            $shorter->code = $code;
            $shorter->save();

            return $code;
        }
    }

    protected function generateCode($num){
        // Generate unique code
        return base_convert($num, 10, 36);
    }

    public function getUrl($code){
        $code = addslashes($code);

        if(Shortener::where('code', $code)->exists()){
            $entry = Shortener::where('code', $code)->first();
            $entry->clicks += 1;
            $entry->save();
            return Redirect::to($entry->url);
        } 
        else{

            return 'Invalid Link';
        }
    }

}
