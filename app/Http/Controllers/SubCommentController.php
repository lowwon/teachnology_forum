<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Datetime;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\SubComment;
class SubCommentController extends Controller
{
    public function createSubComment(Request $rq, $id){
        $saa = SubComment::all();
        $e = 0;
        foreach($saa as $a){
            $e = $a->id;
        }
        $e = $e + 1;
        $date = new DateTime('now');
        if($rq->subcomment != "")
        {
            $subcomment = SubComment::create([
                'id' => $e,
                'comment_id'=> $id,
                'Date' => $date,
                'user_id' => Auth::user()->id,
                'Content' => $rq->subcomment,
            ]);
        }
        return back();
    }
    public function deleteSubComment($id){
        $subcomment = SubComment::where('id',$id)->first();
        if(Auth::user()->role_id<2){
            $this->authorize('delete',$subcomment);
        }
        else{
            $user = User::where('id',$subcomment->user_id)->first();
            if(Auth::user()->role_id < $user->role_id)
                return back()->withInput();
        }
        $subcomment = SubComment::where('id',$id)->delete();
        return back()->withInput();
    }
}