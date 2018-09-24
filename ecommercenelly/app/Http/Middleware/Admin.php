<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use App\Category;
use Illuminate\Http\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
   
    public function handle($request, Closure $next)
        {
            if($request->user() && $request->user()->usertype_id == '2'){
                $categories = Category::all();
                // return view('categories.indexC',compact('categories')); 
                // return redirect('home')->with('error','You do not have admin access');
                return new Response(view('categories.indexC',compact('categories'))->with('role','ADMIN'));
            }
            // return view('categories.indexC');
            // return $next($request);
            return new Response(view('unauthorized')->with('role','ADMIN')); 
            
        }
    }
