<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    function add_donation(Request $request)
    {
        $id=Auth::user()->id;
        $item_name=$request->itemName;
        $quantity=$request->quantity;
        $date=$request->expiryDate;
        $category=$request->category;
        $description=$request->description;
        $request->validate([
           'itemName'=>'required',
           'quantity'=>'required|numeric',
            'expiryDate'=>'required|date',
            'category'=>'required|string',
             'description'=>'required',
             'imageUpload'=>'required'           
        ]);
        $donation='donation';
        $file=$request->file('imageUpload');
        $OrignalName=pathinfo($file,PATHINFO_FILENAME);
        $extension=$file->getClientOriginalExtension();
        $filename=date('y-m-h-m-i-s').'_'.$OrignalName.'.'.$extension;
        $path=$file->storeAs('Donation',$filename,'public');
        DB::table('add_donation')->insert(['user_id'=>$id,'item_name'=>$item_name,'quantity'=>$quantity,'expire_date'=>$date,'category'=>$category,'description'=>$description,'image'=>$path,'post_type'=>$donation,]);

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
                 $description=$request->description;
                 DB::table('simple_post')->insert(['user_id'=>$id,'post'=>$description,'image_post'=>$path,'post_type'=>'image']);
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
           $description=$request->description;
           DB::table('simple_post')->insert(['user_id'=>$id,'post'=>$description,'video_post'=>$path,'post_type'=>'video']);
           return redirect()->back()->with('success', 'Post created successfully!');
        }


            function donation_request(Request $request)
            {
                $id=Auth::user()->id;
                $fname=$request->fname;
                $lname=$request->lname;
                $address=$request->address;
                $number=$request->number;
                $email=$request->email;
                $request->validate([
                  'fname'=>'required',
                  'lname'=>'required',
                  'email'=>'required|email',
                  'address'=>'required',
                  'number'=>'required|numeric'
                ]);
            
                DB::table('reqeust_donation')->insert([
                    'user_id'=>$id,
                    'fname'=>$fname,
                    'lname'=>$lname,
                    'address'=>$address,
                    'number'=>$number,
                    'email'=>$email
                ]);
                return back()->with('success','record inserted successfully');
            }

       function fetch_posts()
{
    $donations = DB::table('add_donation')
        ->leftJoin('users', 'add_donation.user_id', '=', 'users.id')
        ->select(
            'users.first_name',
            'users.last_name',
            'add_donation.item_name',
            'add_donation.quantity',
            'add_donation.expire_date',
            'add_donation.category',
            'add_donation.description',
            'add_donation.image',
            'add_donation.created_at',
            'add_donation.post_type',
        )
        ->get();

    $simple_posts = DB::table('simple_post')
        ->join('users', 'simple_post.user_id', '=', 'users.id')
        ->select(
            'users.first_name',
            'users.last_name',
            'simple_post.id',
            'simple_post.post',
            'simple_post.image_post',
            'simple_post.video_post',
            'simple_post.created_at',
            'simple_post.post_type',
        )
        ->get();

    $posts = collect($donations)->merge($simple_posts)->sortByDesc('created_at')->values();
    return view('posts.posts', compact('posts'));
}

    public function toggleLike(Request $request, $id)
    {
        $user = auth()->user();
        $post = \App\Models\Post::findOrFail($id);
        $like = $post->likes()->where('user_id', $user->id)->first();
        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            $post->likes()->create([
                'user_id' => $user->id,
                'post_type' => 'simple_post',
            ]);
            $liked = true;
        }
        return response()->json([
            'liked' => $liked,
            'count' => $post->likes()->count(),
        ]);
    }

}
