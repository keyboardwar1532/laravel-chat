<?php

namespace App\Http\Controllers;

use App\Model\Like;
use App\Model\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT');
    }
    public function LikeIt(Reply $reply){
        $reply->like()->create([
            // 'user_id' => auth()->id()
            'user_id' => '1'
            ]);
    }
    public function unLikeIt(Reply $reply){
        // $reply->like()->where('user_id',auth()->id())->delete();
        $reply->like()->where('user_id',1)->delete();
    }
}
