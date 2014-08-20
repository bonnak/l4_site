<?php namespace App\Controllers\Admin;

use App\Models\Comment;
use App\Models\Article;
use App\Models\User;
use Input, Notification, Redirect, Sentry, Str;

class CommentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Comment::get();
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$comment = Comment::create(array(
			'author' => Input::get('author'),
			'text' => Input::get('text'),
			'article_id' => Input::get('article_id')
		));

		return $comment;
	}

	// Update comment.
	public function update($id)
    {
        $comment = Comment::find($id);
        $comment->text = Input::get('text');
        $comment->save();

        return ['success' => true];
    }


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$article = Comment::find($id)->article;
		Comment::destroy($id);
		return $article;
	}


	public function show($slug)
    {    	
    	$comment = Article::where('slug', $slug)->first()->comments();
        return $comment->get();
    }
}
