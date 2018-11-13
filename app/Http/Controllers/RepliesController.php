<?php

namespace App\Http\Controllers;

use Session;
use App\Like;
use App\Reply;
use Auth;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function like($id)
    {
    	$reply = Reply::find($id);

    	Like::create(
    		[

    			'reply_id'=>$reply->id,

    			'user_id'=>Auth::id()
    		]
    	);

    	Session::flash('success','Like success');

    	return redirect()->back();
    }

    public function unlike($id)
    {
    	$like = Like::where('reply_id',$id)->where('user_id', Auth::id())->first();

    	$like->delete();

    	Session::flash('success','You unlike the reply');

    	return redirect()->back();
    }

    public function best_answer($id)
    {
        $reply = Reply::find($id);

        $reply->best_answer = 1;

        $reply->save();

        $reply->user->points += 100;

        $reply->user->save();

        Session::flash('success','You marked the answer as best answer.');

        return redirect()->back();
    }

    public function edit($id)
    {
        $reply = Reply::where('id',$id)->first();

        return view('replies.edit',compact('reply'));
    }

    public function update($id,Request $request){

       $this->validate($request,[

         'content'=>'required'
      ]);

      $reply = Reply::find($id);

      $reply->content = $request->content;

      $reply->save();

      Session::flash('success','Updated suceessfully');

      return redirect()->route('discussion',['slug'=>$reply->discussion->slug]);
    }
}
