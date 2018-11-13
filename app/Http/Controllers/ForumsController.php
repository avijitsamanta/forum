<?php

namespace App\Http\Controllers;

use App\Discussion;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ForumsController extends Controller
{
    public function index(Request $request)
    {

    	switch ($request->filter) {
    		case 'me':
    			$discussions = Discussion::where('user_id',Auth::id())->orderBy('created_at','Desc')->paginate(3);
    			break;

    		case 'solved':

    			$answered = array();

    			$discussions = Discussion::orderBy('created_at','Desc')->get();


    			foreach ($discussions as $d) {
    				
    				if($d->hasBestAnswer())
    				{
    					array_push($answered, $d);
    				}
    			}

    			$discussions = new Paginator($answered,3);

    		break;

    		case 'unsolved':

    			$unanswered = array();

    			$discussions = Discussion::orderBy('created_at','Desc')->get();

    			foreach ($discussions as $d) {
    				
    				if(!$d->hasBestAnswer())
    				{
    					array_push($unanswered, $d);
    				}
    			}

    			$discussions = new Paginator($unanswered,3);
    			
    		break;
    		
    		default:
    			$discussions = Discussion::orderBy('created_at','Desc')->paginate(3);
    			break;
    	}

    	

    	return view('forum',compact('discussions'));
    }
}
