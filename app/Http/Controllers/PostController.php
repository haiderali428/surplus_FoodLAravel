<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\SimplePost;

class PostController extends Controller
{
    function add_donation(Request $request)
    {
        $id = Auth::user()->id;
        $item_name = $request->itemName;
        $quantity = $request->quantity;
        $date = $request->expiryDate;
        $category = $request->category;
        $description = $request->description;
        $request->validate([
            'itemName' => 'required',
            'quantity' => 'required|numeric',
            'expiryDate' => 'required|date',
            'category' => 'required|string',
            'description' => 'required',
            'imageUpload' => 'required|image',
        ]);
        $donation = 'donation';
        $file = $request->file('imageUpload');
        if (!$file) {
            return redirect()->back()->with('error', 'Image upload failed.');
        }
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $filename = date('Y-m-d_H-i-s') . '_' . $originalName . '.' . $extension;
        $path = $file->storeAs('Donation', $filename, 'public');
        // Use Eloquent for consistency
        $donationPost = new \App\Models\Post();
        $donationPost->user_id = $id;
        $donationPost->item_name = $item_name;
        $donationPost->quantity = $quantity;
        $donationPost->expire_date = $date;
        $donationPost->category = $category;
        $donationPost->description = $description;
        $donationPost->image = $path;
        $donationPost->post_type = $donation;
        $donationPost->created_at = now();
        $donationPost->save();
        return redirect()->back()->with('success', 'Donation post created successfully!');
    }

    function simple_Post(Request $request)
    {       
       $id = Auth::user()->id;
       $description=$request->description;
        $request->validate(['description'=>'required']);
        
        DB::table('simple_post')->insert([
            'post' => $description,
            'user_id' => $id,
            'post_type'=>'text'
        ]);
        return redirect()->back()->with('success', 'Post created successfully!');
    }


    function image_post(Request $request){
         $id = Auth::user()->id;
         $request->validate([
            'image' => 'image|mimes:jpg,jpeg,png',
        ]);
        $file= $request->file('image');
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $timestamp = date('Y-m-d_H-i-s');
       $filename = $timestamp . '_' . $originalName . '.' . $extension;
        $path = $file->storeAs('post images', $filename, 'public');
        $description = $request->description ?? null;
        SimplePost::create([
            'user_id' => $id,
            'post' => $description,
            'image_post' => $path,
            'post_type' => 'image',
        ]);
        return redirect()->back()->with('success', 'Post created successfully!');
    }

    function video_post(Request $request)
    {
        $id=Auth::user()->id;
        $request->validate([
            'video'=>'mimes:mp4'
        ]);

        $file=$request->file('video');
       $orignalName=pathinfo($file->getClientOriginalName(),PATHINFO_FILENAME);
       $extension=$file->getClientOriginalExtension();
       $timestamp=date('y-m-d-h-i-s');
       $filename=$timestamp.'_'.$orignalName.'.'.$extension;
       $path=$file->storeAs('post_videos',$filename,'public');
       $description = $request->description ?? null;
       SimplePost::create([
           'user_id' => $id,
           'post' => $description,
           'video_post' => $path,
           'post_type' => 'video',
       ]);
       return redirect()->back()->with('success', 'Post created successfully!');
    }


    function donation_request(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'address' => 'required|string|max:255',
                'number' => 'required|string|max:255',
                'donation_post_id' => 'required|exists:add_donation,id'
            ]);

            // Check if user is authenticated
            if (!Auth::check()) {
                return redirect()->back()->with('error', 'Please login to submit a donation request.');
            }

            $userId = Auth::user()->id;

            // Insert the donation request
            DB::table('reqeust_donation')->insert([
                'user_id' => $userId,
                'fname' => $request->fname,
                'lname' => $request->lname,
                'address' => $request->address,
                'number' => $request->number,
                'email' => $request->email,
                'status' => 'pending',
                'donation_post_id' => $request->donation_post_id
            ]);

            return redirect()->back()->with('success', 'Donation request submitted successfully! We will contact you soon.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            \Log::error('Donation request error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while submitting your request. Please try again.');
        }
    }

   function fetch_posts()
    {
        // Get all posts from both tables, normalize columns, and union them
        $donations = \DB::table('add_donation')
            ->select([
                'id',
                'user_id',
                \DB::raw('NULL as post'),
                'image as image_post',
                \DB::raw('NULL as video_post'),
                'description',
                'item_name',
                'quantity',
                'expire_date',
                'category',
                'image',
                'post_type',
                'created_at',
                'status',
                \DB::raw('"donation" as source_table')
            ]);

        $simple_posts = \DB::table('simple_post')
            ->select([
                'id',
                'user_id',
                'post',
                'image_post',
                'video_post',
                'post as description',
                \DB::raw('NULL as item_name'),
                \DB::raw('NULL as quantity'),
                \DB::raw('NULL as expire_date'),
                \DB::raw('NULL as category'),
                \DB::raw('NULL as image'),
                'post_type',
                'created_at',
                \DB::raw('NULL as status'),
                \DB::raw('"simple_post" as source_table')
            ]);

        $posts = $donations->unionAll($simple_posts)
            ->orderBy('created_at', 'desc')
            ->get();

        // Eager load user for each post
        $userIds = $posts->pluck('user_id')->unique();
        $users = \App\Models\User::whereIn('id', $userIds)->get()->keyBy('id');

        // Attach likes and comments count to each post
        foreach ($posts as $post) {
            // Likes
            $likeQuery = \App\Models\Like::where('post_id', $post->id)
                ->where('post_type', $post->source_table == 'donation' ? 'add_donation' : 'simple_post');
            $post->likes = $likeQuery->pluck('user_id')->toArray();
            $post->like_count = count($post->likes);
            // Dynamic liked-by names and profile images
            $likeUsers = \App\Models\User::whereIn('id', $post->likes)->limit(3)->get();
            $post->like_user_names = $likeUsers->pluck('first_name')->toArray();
            $post->like_user_images = $likeUsers->map(function($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->first_name,
                    'profile_picture' => $user->profile_picture
                ];
            })->toArray();
            // Comments
            $commentQuery = \App\Models\Comment::where('post_id', $post->id)->with('user');
            $post->comments = $commentQuery->get();
            $post->comments_count = $post->comments->count();
        }

        return view('posts.posts', compact('posts', 'users'));
    }

    public function toggleLike(Request $request, $id)
    {
        \Log::info('toggleLike called', [
            'user_id' => auth()->id(),
            'post_id' => $id,
            'post_type' => $request->input('post_type'),
            'is_authenticated' => auth()->check(),
        ]);
        $user = auth()->user();
        $postType = $request->input('post_type');
        if ($postType === 'donation' || $postType === 'add_donation') {
            $post = \App\Models\Post::findOrFail($id);
            $likeType = 'add_donation';
        } else {
            $post = \App\Models\SimplePost::findOrFail($id);
            $likeType = 'simple_post';
        }
        $like = \App\Models\Like::where('post_id', $id)
            ->where('user_id', $user->id)
            ->where('post_type', $likeType)
            ->first();
        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            \App\Models\Like::create([
                'post_id' => $id,
                'user_id' => $user->id,
                'post_type' => $likeType,
            ]);
            $liked = true;
        }
        $likeCount = \App\Models\Like::where('post_id', $id)->where('post_type', $likeType)->count();
        return response()->json([
            'liked' => $liked,
            'count' => $likeCount,
        ]);
    }

    public function show_latest_post()
    {
        // Get the latest donation post
        $latestDonation = \App\Models\Post::with('user')->orderByDesc('created_at')->first();

        // Get the latest simple post
        $latestSimple = \App\Models\SimplePost::with('user')->orderByDesc('created_at')->first();

        // Compare and pick the latesthows
        $latest = null;
        if ($latestDonation && $latestSimple) {
            $latest = $latestDonation->created_at > $latestSimple->created_at
                ? $latestDonation
                : $latestSimple;
        } elseif ($latestDonation) {
            $latest = $latestDonation;
        } elseif ($latestSimple) {
            $latest = $latestSimple;
        }

        return view('posts.latest', compact('latest'));
    }

    public function getComments($id)
    {
        // Get all comments for the post with user information
        $comments = \App\Models\Comment::where('post_id', $id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'comments' => $comments,
            'count' => $comments->count()
        ]);
    }

    public function showRequests($postId)
    {
        $post = \App\Models\Post::with('requests.user')->findOrFail($postId);
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        return view('donation_requests.index', [
            'post' => $post,
            'requests' => $post->requests
        ]);
    }

    public function approveRequest($requestId)
    {
        $request = \App\Models\RequestDonation::with('post')->findOrFail($requestId);
        $post = $request->post;
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        if ($post->status === 'completed') {
            return back()->with('error', 'Donation post is already completed.');
        }
        $request->status = 'approved';
        $request->save();
        $post->status = 'completed';
        $post->save();
        return back()->with('success', 'Request approved and donation marked as completed.');
    }

    public function rejectRequest($requestId)
    {
        $request = \App\Models\RequestDonation::with('post')->findOrFail($requestId);
        $post = $request->post;
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        $request->status = 'rejected';
        $request->save();
        return back()->with('success', 'Request rejected.');
    }

    public function myDonationRequests()
    {
        $user = auth()->user();
        $posts = \App\Models\Post::withCount('requests')
            ->where('user_id', $user->id)
            ->get();

        return view('donation_requests.my_requests', compact('posts'));
    }

}
