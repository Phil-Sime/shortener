<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUrlRequest;
use ReCaptcha\ReCaptcha;
use App\URL;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home');
    }

    /**
     * Show the 10 most recently created URLs.
     *
     * @return Response
     */
    public function recentUrls() {
        $urls = Url::orderBy('created_at', 'desc')->limit(10)->get();
        return view('recent', compact('urls'));
    }

    /**
     * Show the 10 most used URLs.
     *
     * @return Response
     */
    public function topUrls() {
        $urls = Url::orderBy('counter', 'desc')->limit(10)->get();
        return view('top', compact('urls'));
    }

    /**
     * Redirect to external URL if an entry
     * exists for the tag provided.
     *
     * @param $tag identifiyng the URL
     * @return redirect
     */
    public function redirect($tag) {
        $url = Url::where('tag', $tag)->first();

        if($url) {
            $url->counter++;
            $url->save();
            return redirect($url->url);
        } else {
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUrlRequest $request)
    {
        $statusMessage = "";
        $remoteIp      = $request->ip();
        $urlToShorten  = $request->url;
        $tag           = $request->desired_id ? $request->desired_id : $this->generateRandomTag();
        $gResponse     = $request['g-recaptcha-response'];

        if( $this->captchaCheck($gResponse, $remoteIp) ) {
            $url = new URL;
            $url->tag = $tag;
            $url->created_by_ip = $remoteIp;
            $url->url = $urlToShorten;
            $url->save();
            $statusMessage = "Created your URL.  <a href=\"http://mutiny.co/$tag\">mutiny.co/$tag</a>";
        } else {
            $statusMessage = "Failed reCAPTCHA!";
        }

        return redirect('/')->with('status', $statusMessage);
    }

    /**
     * Generate a random tag to be used in the 
     * shortened URL.
     *
     * @return $randomTag
     */
    private function generateRandomTag() {
        $randomTag = '';
        // Loop until $randomTag is not empty and not an existing tag
        while ($randomTag == '' || URL::where('tag', $randomTag)->count() != 0) {
            $randomTag = substr(str_shuffle(MD5(microtime())), 0, 5);
        }
        return $randomTag;
    }

    /**
     * Check a Google reCAPTCHA to verify user 
     * is a real person and not a robot!
     *
     * @param  $gResponse from Google reCAPTCHA
     * @return $remoteIp of user we are checking
     */
    private function captchaCheck($gResponse, $remoteIp)
    {
        $secret   = env('RE_CAP_SECRET');

        $recaptcha = new ReCaptcha($secret);
        $resp = $recaptcha->verify($gResponse, $remoteIp);
        if ($resp->isSuccess()) {
            return true;
        } else {
            return false;
        }

    }
}
