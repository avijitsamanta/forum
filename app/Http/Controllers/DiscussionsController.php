<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Discussion;
use App\Notifications\NewReplyAdded;
use App\Reply;
use App\User;
use App\Watch;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Session;

class DiscussionsController extends Controller
{
   public function create()
   {

   		$channels = Channel::all();
   	
   		return view('discuss',compact('channels'));
   }

   public function store(Request $request)
   {

   		$this->validate($request,[

   				'channel_id'=>'required',

   				'title'=>'required',

   				'content'=>'required'

   		]);

         $discussion = Discussion::create([

               'title'=> $request->title,

               'slug'=> str_slug($request->title),

               'content'=> $request->content,

               'user_id'=> Auth::id(),

               'channel_id'=>$request->channel_id
         ]);

         Session::flash('success','Discussion created successfully');
   	
   		return redirect()->route('discussion',['slug'=> $discussion->slug]);
   }

   public function show($slug)
   {

      $discussion = Discussion::where('slug',$slug)->first();

      $best_answer = $discussion->replies()->where('best_answer',1)->first();

      return view('discussions.show',compact('discussion','best_answer'));
      
   }

   public function edit($slug)
   {
      $discussion = Discussion::where('slug',$slug)->first();

      return view('discussions.edit',compact('discussion'));
   }

   public function update($id,Request $request)
   {
      $this->validate($request,[

         'content'=>'required'
      ]);

      $discussion = Discussion::find($id);

      $discussion->content = $request->content;

      $discussion->save();

      Session::flash('success','Updated suceessfully');

      return redirect()->route('discussion',['slug'=>$discussion->slug]);
   }

   public function reply($id,Request $request)
   {
      $d = Discussion::find($id);

      //$request = request()->reply;

      $this->validate($request,[

               'reply'=>'required'

         ]);

      $reply = Reply::create([

               'user_id'=>Auth::id(),

               'discussion_id'=>$id,

               'content'=>request()->reply

      ]);

      $reply->user->points += 25;

      $reply->user->save();

      $watches = array();

      foreach ($d->watches as $watch) {

         array_push($watches, User::find($watch->user_id));
         
      }

      Notification::send($watches,new \App\Notifications\NewReplyAdded($d));
  
      Session::flash('success','Reply posted successfully');

      return redirect()->back();
      
   }

   public function watch($id)
   {
      $discussion = Discussion::find($id);

      Watch::create([

            'discussion_id'=> $discussion->id,

            'user_id'=>Auth::id()

      ]);

      Session::flash('success','Watching');

      return redirect()->back();
   }

   public function unwatch($id)
   {
      $watch = Watch::where('discussion_id',$id)->where('user_id', Auth::id())->first();

      $watch->delete();

      Session::flash('success','You are successfully unwatch the discussion');

      return redirect()->back();
   }
}
