<?php

namespace Ozgurince\Simpleforum\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ozgurince\Simpleforum\Models\Comment;
use Ozgurince\Simpleforum\Models\Like;

class LikesController extends Controller
{
    public function like(Request $request)
    {
        $comment = Comment::find(intval(request('comment_id')));
        
        if ($comment == null) 
            return array('status' => -1);

        Like::create(['comment_id' => request('comment_id'),
                      'user_id' => Auth::user()->id 
                     ]);    

        $response = array('status' => 1, 
                          'comment_likes_number' => count($comment->likes)
        );       

    	return $response;
    }

    public function unlike()
    {
        $comment = Comment::find(intval(request('comment_id')));
    	$likeRow = Like::where('comment_id', $comment->id)->where('user_id', Auth::user()->id)->first();

        if ($comment == null || $likeRow == null) 
            return array('status' => -1);

		$likeRow->delete();
        $response = array('status' => 1, 
                          'comment_likes_number' => count($comment->likes)
        );
    	
        return $response;
    }
}
