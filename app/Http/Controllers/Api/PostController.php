<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\MessagesHelper;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Http\Helpers\ResponseHelper;
use App\Http\Requests\Api\PostRequest;
use App\Models\Post;
use Illuminate\Http\Response;
use Symfony\Component\Mailer\Messenger\MessageHandler;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Helpers\ResponseHelper;
     */
    public function index()
    {
        $posts = Post::whereUserId(auth('api')->id())
                        ->select('id', 'title', 'description', 'created_at')
                        ->paginate(5);

        return ResponseHelper::sendResponseSuccess($posts);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return ResponseHelper
     */
    public function create(PostRequest $request)
    {
        return $request;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return App\Http\Helpers\ResponseHelper;
     */
    public function store(PostRequest $request)
    {
        $post = Post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'user_id'=>auth('api')->id(),
        ]);

        return ResponseHelper::sendResponseSuccess(new PostResource($post) , Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Helpers\ResponseHelper;
     */
    public function show($id)
    {
        $post = Post::whereId($id)->first();

        if($this->ifNotUserPost($post)){
            return $this->ifNotUserPost($post);
        }

        return ResponseHelper::sendResponseSuccess(new PostResource($post));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return App\Http\Helpers\ResponseHelper;
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::whereId($id)->first();

        if($this->ifNotUserPost($post)){
            return $this->ifNotUserPost($post);
        };

        $post->update([
            'title'=>$request->title,
            'description'=>$request->description,
        ]);

        return ResponseHelper::sendResponseSuccess(new PostResource(Post::findOrfail($id)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return App\Http\Helpers\ResponseHelper;
     */
    public function destroy($id)
    {
        $post = Post::whereId($id)->first();

        if($this->ifNotUserPost($post)){
            return $this->ifNotUserPost($post);
        }

        $post->delete();

        return ResponseHelper::sendResponseSuccess([],200,MessagesHelper::DELETED_SUCCESSFULLY);
    }

    /**
     * check is post found and post to user auth
     * @param  $post
     * @return \Illuminate\Http\JsonResponse|bool
     */
    private  function ifNotUserPost( $post){
        if(!$post){
            return ResponseHelper::sendResponseError([], Response::HTTP_NOT_FOUND);
        }

        if(auth('api')->id() != $post->user_id){
            return ResponseHelper::sendResponseError([], Response::HTTP_FORBIDDEN);
        }
        return false;

    }
}
