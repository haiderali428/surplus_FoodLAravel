@extends('layout.app')

@section('header')
    @include('header.main_header')
@endsection

@section('content')
   <div class="container">
       <div class="row">
           <div class="col-lg-3 col-md-1 mt-3">
              
               <!-- Bottom Navbar for small screens -->
               <div class="bottom-navbar d-md-none fixed-bottom bg-white py-2"
                   style="display: flex; justify-content: center; align-items: center;">
                   <div class="d-flex overflow-auto scrollbar-hidden px-0">
                       <a href="#" class="nav-link text-center bottombar-nav-links ">
                           <img src="./img/sidebar/newadmin-dashboard.svg" class="Bottombar-icons"
                               style="width: 18px; height: 18px;">
                       </a>
                       <a href="#" class="nav-link text-center bottombar-nav-links">
                           <img src="./img/sidebar/newadmin-post.svg" class="Bottombar-icons"
                               style="width: 18px; height: 18px;">
                       </a>
                       <a href="#" class="nav-link text-center bottombar-nav-links">
                           <img src="./img/sidebar/newadmin-comment.svg" class="Bottombar-icons"
                               style="width: 18px; height: 18px;">
                       </a>
                       <!-- <a href="#" class="nav-link bottom-nav-link text-center">
                               <img src="../asset/images/newsadmin/Profile.svg" class="Bottombar-icons" style="width: 18px; height: 18px;">
                           </a>
                           <a href="#" class="nav-link bottom-nav-link text-center">
                               <img src="../asset/images/newsadmin/Bookmarks.svg" class="Bottombar-icons" style="width: 18px; height: 18px;">
                           </a>
                           <a href="#" class="nav-link bottom-nav-link text-center">
                               <img src="../asset/images/newsadmin/Setting.svg" class="Bottombar-icons" style="width: 18px; height: 18px;">
                           </a>
   
                       -->



                   </div>
               </div>

           </div>
           <div class="col-lg-6 col-md-7 lefti-brdr px-lg-0" style="margin-top: 10px;">
               <!-- for post creation head started here-->
               <div class="share-box container py-3 px-sm-5 px-2 rounded-4 border gap-2">
                <div class="d-flex gap-2 align-items-center ">
                       @if(auth()->check() && auth()->user()->profile_picture)
                           <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}"
                               style="width: 28px; height: 28px; border-radius: 50%; object-fit: cover;">
                       @else
                           <img src="./img/avatars/avatar-{{ rand(2,5) }}.jpg"
                           style="width: 28px; height: 28px; border-radius: 50%;">
                       @endif
                       <input type="text" class="form-control py-2 px-2 rounded-4 search-input" type="button"  data-bs-toggle="modal" data-bs-target=".simplepost_modal" placeholder="What's on your mind?">
                  </div> 
                  <div class="d-flex share-box-posts justify-content-between mt-3 align-items-center">
                   <a href="" class="d-flex gap-2 align-items-center" type="button" data-bs-toggle="modal" data-bs-target=".photopost_modal"><img src="./img/Home/camera-icon.jpg"  alt=""> Photo</a>
                   <a href="" class="d-flex gap-2 align-items-center" type="button"  data-bs-toggle="modal" data-bs-target=".videopost_modal"> <img src="./img/Home/video-cam-icon.png" alt=""> Video</a>
                   @if(auth()->check() && auth()->user()->role === 'donor')
                   <a href="" class="d-flex gap-2 align-items-center" type="button"  data-bs-toggle="modal" data-bs-target="#donationModal"><img src="./img/Home/images.png"  alt=""> Donation</a>
                   @endif
                  </div>
   
               </div>
               <!-- for post creation head ended here-->
               <!--####### images post started here ########-->
           @foreach ($posts as $post)
    @php $user = $users[$post->user_id] ?? null; @endphp
    @if ($post->post_type == 'text' || $post->post_type == 'image' || $post->post_type == 'video' || $post->post_type == 'donation')
         <div class="images-post px-sm-3 px-1 mt-4">
                    <section>
                        
                        <div class="d-flex justify-content-between">
                            <div class="d-flex gap-2 align-items-center">
                                <div>
                                    <a href="./profile.html">
                                        @if($user && $user->profile_picture)
                                            <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                                style="width: 28px; height: 28px; border-radius: 50%; object-fit: cover;">
                                        @else
                                            <img src="./img/avatars/avatar-{{ rand(2,5) }}.jpg"
                                            style="width: 28px; height: 28px; border-radius: 50%;">
                                        @endif
                                    </a>
                                </div>
                                <div class="d-flex gap-1 align-items-center">
                                    <a href="./profile.html" style="text-decoration: none !important;">
                                        <p class="mb-0 timeline-profile-name">
                                            @if($user)
                                                {{ $user->first_name }} {{ $user->last_name }}
                                            @else
                                                Unknown User
                                            @endif
                                        </p>
                                    </a>
                                    <div>
                                        <img src="./img/Home/leafe.svg">
                                    </div>
                                    <div>
                                        <p class="m-ago mb-0">
                                            @php
                                                $diffInHours = \Carbon\Carbon::parse($post->created_at)->diffInHours();
                                            @endphp
                                            @if ($diffInHours >= 1)
                                                {{ (int) $diffInHours }} hour{{ $diffInHours > 1 ? 's' : '' }} ago
                                            @else
                                                just now
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Menu 1 -->
                            <div class="menu-container position-relative">
                                <div class="dots-icon">⋯</div>
                                <div class="options-menu">
                                    <a href="./postdetail-photo.html" class="option d-flex align-items-center px-1">
                                        <img src="./img/Home/rprt.svg" class="me-2" style="width: 13px; height: 13px;" alt=""> Post Detail
                                    </a>
                                    <a href="./postdetail-photo.html" class="option d-flex align-items-center px-1">
                                        <img src="./img/Home/rprt.svg" class="me-2" style="width: 13px; height: 13px;" alt=""> Report
                                    </a>
                                    <a href="./postdetail-photo.html" class="option d-flex align-items-center px-1">
                                        <img src="./img/Home/copiii.svg" class="me-2" style="width: 13px; height: 13px;" alt=""> Copy Link
                                    </a>
                                    <a href="./postdetail-photo.html" class="option d-flex align-items-center px-1">
                                        <img src="./img/Home/embed-icon.svg" class="me-2" style="width: 13px; height: 13px;" alt=""> Embed
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                    @if ($post->post_type == 'text')
                        <div>
                            <p class="mb-1 thanks-p mt-2">{{ $post->post }}</p>
                        </div>
                    @elseif ($post->post_type == 'image')
                        <div>
                            <img src="{{ asset('storage/' . $post->image_post) }}" alt="Image Post" class="img-fluid mt-2 post-media" style="cursor:pointer;"
                                data-type="image"
                                data-src="{{ asset('storage/' . $post->image_post) }}"
                                data-description="{{ $post->post }}"
                                data-user="{{ $user ? $user->first_name . ' ' . $user->last_name : 'Unknown User' }}">
                        </div>
                    @elseif ($post->post_type == 'video')
                        <div>
                            <video src="{{ asset('storage/' . $post->video_post) }}" controls class="img-fluid mt-2 post-media" style="cursor:pointer;"
                                data-type="video"
                                data-src="{{ asset('storage/' . $post->video_post) }}"
                                data-description="{{ $post->post }}"
                                data-user="{{ $user ? $user->first_name . ' ' . $user->last_name : 'Unknown User' }}"></video>
                        </div>
                    @elseif ($post->post_type == 'donation')
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-12 ">
                                    <div class="card position-relative mb-0">
                                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top post-media" alt="Donation Image" style="cursor:pointer;"
                                            data-type="donation"
                                            data-src="{{ asset('storage/' . $post->image) }}"
                                            data-item="{{ $post->item_name }}"
                                            data-description="{{ $post->description }}"
                                            data-quantity="{{ $post->quantity }}"
                                            data-category="{{ $post->category }}"
                                            data-expiry="{{ $post->expire_date }}"
                                            data-user="{{ $user ? $user->first_name . ' ' . $user->last_name : 'Unknown User' }}">
                                        <div class="card-body text-white position-absolute bottom-0 start-0 w-100 p-3 d-flex flex-sm-row flex-column justify-content-between align-items-end" style="background-color: rgba(12, 140, 133, 0.7);">
                                            <div class="d-flex flex-column align-items-start donation-post-detail">
                                                <h5 class="card-title text-white">{{$post->item_name}}</h5>
                                                <p class="card-text text-white mb-0">{{$post->description}}</p>
                                                <p class="card-text text-white mb-0"><small>Quantity: {{$post->quantity}}</small></p>
                                                <p class="card-text text-white mb-0"><small>Category: {{$post->category}}</small></p>
                                                <p class="card-text text-white mb-0"><small>Expiry Date: {{$post->expire_date}}</small></p>
                                            </div>
                                            <div>
                                                @if(($post->status ?? null) === 'approved' || ($post->status ?? null) === 'completed')
                                                    <span class="badge bg-success" style="font-size:1rem;">Donation is completed</span>
                                                @elseif(auth()->check() && auth()->id() !== $post->user_id && auth()->user()->role !== 'donor')
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".donation-modal" onclick="setDonationPostId({{ $post->id }})">Request Donation</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                   
                       <!-- liked by -->
                       <div class="post-footer d-flex justify-content-between align-items-center mt-2">
                        <div class="liked-by">
                            <div class="profile-images-ok">
                                @if($post->like_count > 0)
                                    @foreach($post->like_user_images as $likeUser)
                                        @if($likeUser['profile_picture'])
                                            <img src="{{ asset('storage/' . $likeUser['profile_picture']) }}" alt="{{ $likeUser['name'] }}" />
                                        @else
                                            <img src="./img/avatars/avatar-{{ rand(2,5) }}.jpg" alt="{{ $likeUser['name'] }}" />
                                        @endif
                                    @endforeach
                                
                                    
                                @endif
                            </div>
                            <div class="text-liked-by">
                                @if($post->like_count > 0)
                                    Liked by
                                    @foreach($post->like_user_names as $i => $name)
                                        <span class="px-1 text-liked-by1">{{ $name }}</span>@if($i < count($post->like_user_names) - 1),@endif
                                    @endforeach
                                    @if($post->like_count > count($post->like_user_names))
                                        and <span class="ps-1 text-liked-by1">{{ $post->like_count - count($post->like_user_names) }} others</span>
                                    @endif
                                @else
                                    Be the first to like this
                                @endif
                            </div>
                        </div>
                    </div>
                     <!-- Reactions Section -->
                     <div class="position-relative">
                        <div class="reactions">
                            <div class="d-flex gap-2">
                                <div class="fb-like-btn like-btn d-flex align-items-center {{ (auth()->check() && in_array(auth()->id(), $post->likes)) ? 'liked' : '' }}" data-post-id="{{ $post->id }}" data-post-type="{{ $post->source_table }}" style="cursor:pointer;gap:4px;">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.5 18V8.5L12.5 3.5C13.3284 2.67157 14.6716 2.67157 15.5 3.5C16.3284 4.32843 16.3284 5.67157 15.5 6.5L12 10H16C17.1046 10 18 10.8954 18 12V16C18 17.1046 17.1046 18 16 18H7.5Z" stroke="#1877F2" stroke-width="2" fill="{{ (auth()->check() && in_array(auth()->id(), $post->likes)) ? '#1877F2' : 'none' }}"/>
                                    </svg>
                                    <span class="like-text" style="color:{{ (auth()->check() && in_array(auth()->id(), $post->likes)) ? '#1877F2' : '#333' }};font-weight:600;">Like</span>
                                    <span class="like-count" style="margin-left:2px;">{{ $post->like_count }}</span>
                                </div>
                              
                               
                             
                                <script>
                                    function toggleRepostMenu(event) {
                                        event.stopPropagation();
                                        const menu = event.currentTarget.nextElementSibling;
                                
                                        // Close all other dropdowns before opening a new one
                                        document.querySelectorAll(".repost-dropdown").forEach(m => {
                                            if (m !== menu) {
                                                m.style.display = "none";
                                            }
                                        });
                                
                                        // Toggle current menu visibility
                                        menu.style.display = (menu.style.display === "block") ? "none" : "block";
                                    }
                                
                                    // Close dropdown when clicking outside
                                    window.addEventListener("click", () => {
                                        document.querySelectorAll(".repost-dropdown").forEach(menu => {
                                            menu.style.display = "none";
                                        });
                                    });
                                </script>
                               
                           
                        </div>

                       
                    </div>
                    <!-- cmnts -->
                    <div>
                        @if($post->comments_count > 0)
                            <div class="comments-container" id="commentsContainer{{ $post->id }}">
                                @php
                                    $recentComments = $post->comments->take(3);
                                    $remainingCount = $post->comments_count - 3;
                                @endphp
                                
                                @foreach ($recentComments as $comment)
                                    <div class="d-flex align-items-start gap-2 mb-2 comment-item">
                                        <div class="comment-avatar">
                                            @if($comment->user->profile_picture)
                                                <img src="{{ asset('storage/' . $comment->user->profile_picture) }}" alt="{{ $comment->user->first_name }}" style="width: 24px; height: 24px; border-radius: 50%; object-fit: cover;">
                                            @else
                                                <img src="./img/avatars/avatar-{{ rand(2,5) }}.jpg" alt="{{ $comment->user->first_name }}" style="width: 24px; height: 24px; border-radius: 50%;">
                                            @endif
                                        </div>
                                        <div class="comment-content">
                            <p class="cmnt-person-name mb-0">
                                {{ $comment->user->first_name }} {{ $comment->user->last_name }}
                                <span class="cmnt-person-name1">{{ $comment->content }}</span>
                            </p>
                                        </div>
                                    </div>
                        @endforeach
                                
                                @if($remainingCount > 0)
                                    <p class="mb-0 see-all-txt mt-2" style="cursor: pointer; color: #666;" onclick="openCommentsModal({{ $post->id }}, {{ $post->comments_count }})">
                                        View all {{ $post->comments_count }} comments
                                    </p>
                                @else
                                    <p class="mb-0 see-all-txt mt-2" style="color: #666;">
                                        {{ $post->comments_count }} comment{{ $post->comments_count > 1 ? 's' : '' }}
                                    </p>
                                @endif
                            </div>
                        @endif
                        
                        <!-- cmnt sec -->
                        <section>
                            <form action="{{ route('comments.store') }}" method="POST" class="comment-form" id="commentForm{{ $post->id }}">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <div class="d-flex justify-content-center align-items-center gap-1 gap-sm-2 my-4">
                                    <div class="pf_cont">
                                        @if(auth()->check() && auth()->user()->profile_picture)
                                            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile" class="profile-img" style="object-fit: cover;">
                                        @else
                                            <img src="./img/avatars/avatar-{{ rand(2,5) }}.jpg" alt="Profile" class="profile-img">
                                        @endif
                                    </div>

                                    <div class="comment-container flex-shrink-1" id="commentContainer{{ $post->id }}">
                                        <textarea class="comment-input" name="content" placeholder="Comment" id="commentInput{{ $post->id }}"
                                            style="font-size: 12.5px;" required></textarea>

                                        <!-- Send button with icon, positioned fixed within the container -->
                                        <button type="submit" class="green-subscribed-bg d-flex align-items-center justify-content-center" id="sendButton{{ $post->id }}" style="display:none; min-width:40px; min-height:40px; background:#28a745; border:none; border-radius:50%; box-shadow:0 2px 4px rgba(0,0,0,0.1);">
                                            <img src="/img/Home/white-send.svg" alt="Send" style="width:20px; height:20px; display:block;">
                                            <span style="color:white; font-size:12px; margin-left:6px;">Send</span>
                                        </button>
                                    </div>

                                    
                                </div>
                            </form>

                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    const commentInput = document.getElementById("commentInput{{ $post->id }}");
                                    const sendButton = document.getElementById("sendButton{{ $post->id }}");
                                    const commentContainer = document.getElementById("commentContainer{{ $post->id }}");

                                    if (commentInput && sendButton && commentContainer) {
                                        // Hide the button initially if textarea is empty
                                        sendButton.style.display = commentInput.value.trim().length > 0 ? 'inline-flex' : 'none';

                                        // Show/hide button based on input
                                        commentInput.addEventListener("input", () => {
                                            sendButton.style.display = commentInput.value.trim().length > 0 ? 'inline-flex' : 'none';
                                            commentInput.style.height = "30px"; // Reset height
                                            commentInput.style.height = commentInput.scrollHeight + "px"; // Grow as per content
                                            if (commentInput.scrollHeight > 100) {
                                                commentContainer.style.overflowY = "scroll";
                                                commentInput.style.height = "100px"; // Set to max-height
                                            } else {
                                                commentContainer.style.overflowY = "hidden";
                                            }
                                        });
                                        // Optional: Only add a border effect on focus
                                        commentInput.addEventListener("focus", () => {
                                            commentContainer.classList.add("active");
                                        });
                                        commentInput.addEventListener("blur", () => {
                                            commentContainer.classList.remove("active");
                                        });
                                    }
                                });
                            </script>
                        </section>

                        <!-- cmnt sec -->
                    </div>
                </div>
                <!--  Donation Posts Section ended from here-->


                @endif
@endforeach

           
           
                  
                     


                          
                                 

                


                  
                   


                       
                             


          
   </div>

           <!-- simple post modal started from here -->
           <div class="modal fade simplepost_modal" id="simplePostModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <form action="{{route('simple.post')}}" method="POST" class="modal-content">
                @csrf
                <div class="modal-header">
                  <h5 class="modal-title">Create Post</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <textarea name="description" class="form-control postDescription" rows="4" placeholder="Write at least 10 characters..." required></textarea>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary postButton" disabled >Post</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
              </form>
            </div>
          </div>
           <!-- simple post modal ended from here -->

   
   <!-- photo post modal started from here -->
   <div class="modal fade photopost_modal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('image.post') }}" method="POST" class="modal-content" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="postModalLabel">Create Photo Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea class="form-control postDescription" name="description" placeholder="Write your post..."></textarea>
                    <input type="file" class="form-control mt-2 postImage" name="image" accept="image/*">

                    <div class="image-preview-container mt-2" style="position: relative; display: none;">
                        <img class="imagePreview w-100" style="height: 500px; object-fit: cover;" alt="Image Preview">
                        <button type="button" class="btn btn-danger btn-sm removeImage" style="position: absolute; top: 10px; right: 10px;">&times;</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary postButton" disabled>Post</button>
                </div>
            </form>
        </div>
    </div>
</div>

       <!-- photo post modal ended from here -->
       
       <!-- video post modal started from here -->
       <div class="modal fade videopost_modal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
           <div class="modal-dialog">
               <div class="modal-content">
                <form action="{{route('video.post')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                   <div class="modal-header">
                       <h5 class="modal-title" id="postModalLabel">Create Video Post</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                       <textarea class="form-control postDescription" name="description" placeholder="Write your post..." oninput="validatePost()"></textarea>
                       <input type="file" class="form-control mt-2 postVideo" name='video' accept="video/*" onchange="previewVideo(event)">
                       
                       <div class="video-preview-container mt-2" style="position: relative; display: none;">
                           <video id="videoPreview" class="w-100" style="height: 500px; object-fit: cover;" controls></video>
                           <button type="button" class="btn btn-danger btn-sm" style="position: absolute; top: 10px; right: 10px;" onclick="removeVideo()">&times;</button>
                       </div>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                       <button type="submit" class="btn btn-primary" onclick="submitPost()" disabled>Post</button>
                   </div>
                </form>
               </div>
           </div>
       </div>     
       <!-- video post modal ended from here -->

       <!-- Donation post modal started from here -->
       @if(auth()->check() && auth()->user()->role === 'donor')
       <div class="modal fade" id="donationModal" tabindex="-1" aria-labelledby="donationModalLabel" aria-hidden="true">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="donationModalLabel">Upload Donation Post</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                    <form id="donationForm" action="{{ route('add.donation') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                        <div class="mb-3">
                               <label for="itemName" class="form-label">Item Name</label>
                               <input type="text" class="form-control" id="itemName" name="itemName" required>
                           </div>
                           <div class="mb-3">
                               <label for="quantity" class="form-label">Quantity</label>
                               <input type="number" class="form-control" id="quantity" name="quantity" required>
                           </div>
                           <div class="mb-3">
                               <label for="expiryDate" class="form-label">Expiry Date</label>
                               <input type="date" class="form-control" id="expiryDate" name="expiryDate" required>
                           </div>
                           <div class="mb-3">
                               <label for="category" class="form-label">Category</label>
                               <select class="form-select" id="category" name="category" required>
                                   <option value="">Select category</option>
                                   <option value="cooked food">cooked food</option>
                                   <option value="dry rations">Dry Rations</option>
                                   <option value="packaged food">Packaged Food</option>
                                   <option value="bakery items">Bakery Items</option>
                                   <option value="fresh produce">Fresh Produce</option>
                                   <option value="beverages">Beverages</option>
                               </select>
                           </div>
                           <div class="mb-3">
                               <label for="description" class="form-label">Description</label>
                               <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                           </div>
                           <div class="mb-3">
                               <label for="imageUpload" class="form-label">Upload Image</label>
                               <input type="file" class="form-control" id="imageUpload" name="imageUpload" accept="image/*" required>
                           </div>
                           <div class="text-end">
                               <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Post</button>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
       @endif
       <!-- Donation post modal ended from here -->

        <!-- Donation request modal started from here -->
       <div class="modal fade donation-modal" tabindex="-1" aria-hidden="true">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title">Donation Request Form</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <form action="{{route('request.donation')}}" method='post' id="donationRequestForm">
                    @csrf
                    <input type="hidden" name="donation_post_id" id="donation_post_id" value="">
                   <div class="modal-body">
                       @if($errors->any())
                           <div class="alert alert-danger">
                               <ul class="mb-0">
                                   @foreach($errors->all() as $error)
                                       <li>{{ $error }}</li>
                                   @endforeach
                               </ul>
                           </div>
                       @endif
                           <div class="mb-3">
                               <label class="form-label">First Name <span class="text-danger">*</span></label>
                               <input type="text" class="form-control required-field" name="fname" placeholder="Enter first name" value="{{ old('fname') }}" required>
                           </div>
                           <div class="mb-3">
                               <label class="form-label">Last Name <span class="text-danger">*</span></label>
                               <input type="text" class="form-control required-field" name="lname" placeholder="Enter last name" value="{{ old('lname') }}" required>
                           </div>
                           <div class="mb-3">
                               <label class="form-label">Email <span class="text-danger">*</span></label>
                               <input type="email" class="form-control required-field" name="email" placeholder="Enter email" value="{{ old('email') }}" required>
                           </div>
                           <div class="mb-3">
                               <label class="form-label">Complete Address <span class="text-danger">*</span></label>
                               <textarea class="form-control required-field" rows="3" name="address" placeholder="Enter your complete address" required>{{ old('address') }}</textarea>
                           </div>
                           <div class="mb-3">
                               <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                               <input type="tel" class="form-control required-field" name="number" placeholder="Enter contact number" value="{{ old('number') }}" required>
                           </div>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                       <button type="submit" class="btn btn-primary" id="submit-btn">Submit Request</button>
                   </div>
               </div>
              </form>
           </div>
       </div>
       <!-- Donation request modal ended from here -->

       <!-- Comments modal started from here -->
       <div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="commentsModalLabel" aria-hidden="true">
           <div class="modal-dialog modal-lg">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="commentsModalLabel">Comments</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                       <div id="commentsModalContent">
                           <!-- Comments will be loaded here dynamically -->
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <!-- Comments modal ended from here -->

       <!-- Facebook-style Media Modal -->
       <div class="modal fade" id="mediaViewModal" tabindex="-1" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="mediaViewModalTitle"></h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
             </div>
             <div class="modal-body text-center" id="mediaViewModalBody">
               <!-- Media will be injected here -->
             </div>
             <div class="modal-footer">
               <span id="mediaViewModalDescription" class="text-muted"></span>
             </div>
           </div>
         </div>
       </div>

   </div>

   <script>
       class DropdownMenu {
           constructor() {
               this.init();
           }
   
           init() {
               // Get all menu containers
               const menuContainers = document.querySelectorAll(".menu-container");
   
               menuContainers.forEach(container => {
                   const dotsIcon = container.querySelector(".dots-icon");
                   const menu = container.querySelector(".options-menu");
   
                   // Toggle menu when clicking the dots icon
                   dotsIcon.addEventListener("click", (event) => {
                       event.stopPropagation();
                       this.toggleMenu(menu);
                   });
   
                   // Close menu when clicking outside
                   window.addEventListener("click", (event) => {
                       if (!menu.contains(event.target) && !dotsIcon.contains(event.target)) {
                           menu.style.display = "none"; // Hide menu
                       }
                   });
               });
           }
   
           toggleMenu(menu) {
               // Close all other menus before opening a new one
               document.querySelectorAll(".options-menu").forEach(m => {
                   if (m !== menu) {
                       m.style.display = "none"; // Hide others
                   }
               });
   
               // Toggle current menu visibility
               menu.style.display = (menu.style.display === "block") ? "none" : "block";
           }
       }
   
       // Initialize the dropdown functionality when the page loads
       document.addEventListener("DOMContentLoaded", () => {
           new DropdownMenu();
       });
   </script>
       <!-- video menu toggle js/ -->
       <script>
           function toggleVideoMenu() {
               const menu = document.getElementById("video-menu");
               menu.classList.toggle("show");
           }
       </script>

         <!-- simple post validation started here-->
        - <script>
            document.querySelectorAll('.simplepost_modal').forEach(modal => {
              const textArea = modal.querySelector('.postDescription');
              const postButton = modal.querySelector('.postButton');
          
              textArea.addEventListener('input', () => {
                postButton.disabled = textArea.value.trim().length < 10;
              });
            });
          </script> 
          
       <!-- simple post validation ended here-->
         <!-- photo post validation started here-->
         <script>
            document.querySelectorAll('.photopost_modal').forEach(modal => {
                const textArea = modal.querySelector('.postDescription');
                const imageInput = modal.querySelector('.postImage');
                const postButton = modal.querySelector('.postButton');
                const imagePreviewContainer = modal.querySelector('.image-preview-container');
                const imagePreview = modal.querySelector('.imagePreview');
                const removeImageBtn = modal.querySelector('.removeImage');
        
                // Enable/disable Post button
                function validatePost() {
                    const description = textArea.value.trim();
                    const hasImage = imageInput.files.length > 0;
                    postButton.disabled = !( hasImage);
                }
        
                // Preview image after selection
                function previewImage(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imagePreview.src = e.target.result;
                            imagePreviewContainer.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    }
                    validatePost(); // Also validate after image is added
                }
        
                // Remove image
                function removeImage() {
                    imageInput.value = "";
                    imagePreviewContainer.style.display = 'none';
                    imagePreview.src = "";
                    validatePost(); // Re-validate after image is removed
                }
        
                // Add event listeners
                textArea.addEventListener('input', validatePost);
                imageInput.addEventListener('change', previewImage);
                removeImageBtn.addEventListener('click', removeImage);
            });
        </script>
        
       <!-- photo post validation ended here-->
       <!-- video post validation started here-->
       <script>
           function validatePost() {
               const description = document.querySelector('.videopost_modal .postDescription').value.trim();
               const video = document.querySelector('.videopost_modal .postVideo').files.length > 0;
               const postButton = document.querySelector('.videopost_modal .btn-primary');
               
               // Enable button only if description is at least 10 characters and video is uploaded
               postButton.disabled = !(video);
           }
       
           function previewVideo(event) {
               const file = event.target.files[0];
               const videoPreviewContainer = document.querySelector('.video-preview-container');
               const videoPreview = document.querySelector('#videoPreview');
       
               if (file) {
                   const fileURL = URL.createObjectURL(file);
                   videoPreview.src = fileURL;
                   videoPreviewContainer.style.display = "block";
               }
       
               validatePost(); // Recheck validation when video is added
           }
       
           function removeVideo() {
               const videoInput = document.querySelector('.videopost_modal .postVideo');
               const videoPreviewContainer = document.querySelector('.video-preview-container');
               const videoPreview = document.querySelector('#videoPreview');
       
               videoInput.value = "";  // Clear the file input
               videoPreview.src = "";  // Clear the preview
               videoPreviewContainer.style.display = "none";
       
               validatePost(); // Recheck validation after removing video
           }
       
           function submitPost() {
               const description = document.querySelector('.videopost_modal .postDescription').value.trim();
               const videoInput = document.querySelector('.videopost_modal .postVideo');
       
               if (description.length >= 10 && videoInput.files.length > 0) {
                   const videoFile = videoInput.files[0];
                   console.log("Post submitted:", { description, videoFile });
       
                   // Reset input fields
                   document.querySelector('.videopost_modal .postDescription').value = "";
                   videoInput.value = "";
                   removeVideo(); // Hide video preview
       
                   validatePost(); // Revalidate to disable button
       
                   // Close modal
                   var postModal = bootstrap.Modal.getInstance(document.querySelector('.videopost_modal'));
                   postModal.hide();
               }
           }
       </script>
       <!-- video post validation ended here-->

       <!-- donation post validation started here-->
       <script>
           const form = document.getElementById('donationForm');
           const submitBtn = document.getElementById('submitBtn');
   
           form.addEventListener('input', function() {
               let isValid = true;
               document.querySelectorAll('#donationForm input, #donationForm select, #donationForm textarea').forEach(input => {
                   if (!input.value) {
                       isValid = false;
                   }
               });
               submitBtn.disabled = !isValid;
           });
   
           form.addEventListener('submit', function(event) {
               event.preventDefault();
               let isValid = true;
               
               document.querySelectorAll('#donationForm input, #donationForm select, #donationForm textarea').forEach(input => {
                   if (!input.value) {
                       input.classList.add('is-invalid');
                       isValid = false;
                   } else {
                       input.classList.remove('is-invalid');
                   }
               });
               
               if (isValid) {
                   alert('Donation post submitted successfully!');
                   this.submit();
               }
           });
           </script>
       <!-- Donation post validation ended here-->

        <!-- Donation request form validation -->
        <script>
           // Simple function to set donation post ID when modal opens
           function setDonationPostId(id) {
               document.getElementById('donation_post_id').value = id;
           }
       </script>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.like-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var postId = this.getAttribute('data-post-id');
            var postType = this.getAttribute('data-post-type');
            var likeCountSpan = this.querySelector('.like-count');
            var self = this;
            fetch('/posts/' + postId + '/like', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ post_type: postType })
            })
            .then(response => response.json())
            .then(data => {
                if (data.liked) {
                    self.classList.add('liked');
                } else {
                    self.classList.remove('liked');
                }
                if (likeCountSpan) {
                    likeCountSpan.textContent = data.count;
                }
            });
        });
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.comment-form').forEach(function(form) {
        const textarea = form.querySelector('.comment-input');
        const button = form.querySelector('button[type="submit"]');
        if (textarea && button) {
            // Initial state
            button.style.display = textarea.value.trim().length > 0 ? 'inline-flex' : 'none';
            // On input
            textarea.addEventListener('input', function() {
                button.style.display = textarea.value.trim().length > 0 ? 'inline-flex' : 'none';
                textarea.style.height = "30px";
                textarea.style.height = textarea.scrollHeight + "px";
                if (textarea.scrollHeight > 100) {
                    textarea.style.overflowY = "scroll";
                    textarea.style.height = "100px";
                } else {
                    textarea.style.overflowY = "hidden";
                }
            });
            // Optional: Only add a border effect on focus
            textarea.addEventListener("focus", function() {
                textarea.classList.add("active");
            });
            textarea.addEventListener("blur", function() {
                textarea.classList.remove("active");
            });
        }
    });
});
</script>
@endpush

<style>
.fb-like-btn {
    transition: color 0.2s, fill 0.2s;
    user-select: none;
}
.fb-like-btn.liked .like-text {
    color: #1877F2 !important;
}
.fb-like-btn.liked svg path {
    fill: #1877F2 !important;
    stroke: #1877F2 !important;
}
.fb-like-btn svg path {
    transition: fill 0.2s, stroke 0.2s;
}
/* For post images and videos in the feed */
.post-media {
    width: 100%;
    max-width: 500px;
    max-height: 400px;
    object-fit: cover;
    border-radius: 12px;
    margin: 0 auto;
    display: block;
    background: #f5f5f5;
}
/* For modal view (enlarged) */
#mediaViewModalBody img,
#mediaViewModalBody video {
    width: 100%;
    max-width: 700px;
    max-height: 70vh;
    object-fit: contain;
    margin: 0 auto;
    display: block;
    border-radius: 12px;
    background: #000;
}
</style>

<script>
// Function to open comments modal
function openCommentsModal(postId, totalComments) {
    const modal = document.getElementById('commentsModal');
    const modalContent = document.getElementById('commentsModalContent');
    const modalTitle = document.getElementById('commentsModalLabel');
    
    // Show loading state
    modalContent.innerHTML = '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
    
    // Show modal first
    const bootstrapModal = new bootstrap.Modal(modal);
    bootstrapModal.show();
    
    // Fetch all comments via AJAX
    fetch(`/posts/${postId}/comments`)
        .then(response => response.json())
        .then(data => {
            // Update modal title
            modalTitle.textContent = data.count + ' Comments';
            
            // Build HTML for all comments
            let commentsHTML = '';
            data.comments.forEach(comment => {
                const profilePic = comment.user.profile_picture 
                    ? `/storage/${comment.user.profile_picture}` 
                    : `/img/avatars/avatar-${Math.floor(Math.random() * 4) + 2}.jpg`;
                
                const timeAgo = getTimeAgo(comment.created_at);
                
                commentsHTML += `
                    <div class="d-flex align-items-start gap-3 mb-3 p-2 border-bottom">
                        <div class="comment-avatar">
                            <img src="${profilePic}" alt="${comment.user.first_name}" style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
                        </div>
                        <div class="comment-content flex-grow-1">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <strong class="comment-author">${comment.user.first_name} ${comment.user.last_name}</strong>
                                <small class="text-muted">• ${timeAgo}</small>
                            </div>
                            <p class="mb-0 comment-text">${comment.content}</p>
                        </div>
                    </div>
                `;
            });
            
            // Load comments into modal
            modalContent.innerHTML = commentsHTML;
        })
        .catch(error => {
            console.error('Error fetching comments:', error);
            modalContent.innerHTML = '<div class="text-center text-danger">Error loading comments. Please try again.</div>';
        });
}

// Helper function to format time ago
function getTimeAgo(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffInSeconds = Math.floor((now - date) / 1000);
    
    if (diffInSeconds < 60) {
        return 'Just now';
    } else if (diffInSeconds < 3600) {
        const minutes = Math.floor(diffInSeconds / 60);
        return `${minutes} minute${minutes > 1 ? 's' : ''} ago`;
    } else if (diffInSeconds < 86400) {
        const hours = Math.floor(diffInSeconds / 3600);
        return `${hours} hour${hours > 1 ? 's' : ''} ago`;
    } else {
        const days = Math.floor(diffInSeconds / 86400);
        return `${days} day${days > 1 ? 's' : ''} ago`;
    }
}
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.post-media').forEach(function (media) {
        media.addEventListener('click', function () {
            const type = this.getAttribute('data-type');
            const src = this.getAttribute('data-src');
            const modalTitle = document.getElementById('mediaViewModalTitle');
            const modalBody = document.getElementById('mediaViewModalBody');
            const modalDescription = document.getElementById('mediaViewModalDescription');

            if (type === 'image' || type === 'video') {
                const description = this.getAttribute('data-description');
                const user = this.getAttribute('data-user');
                modalTitle.textContent = user;
                modalDescription.textContent = description;
                if (type === 'image') {
                    modalBody.innerHTML = `<img src="${src}" class="img-fluid" style="max-height:70vh;">`;
                } else if (type === 'video') {
                    modalBody.innerHTML = `<video src="${src}" controls class="img-fluid" style="max-height:70vh;"></video>`;
                }
            } else if (type === 'donation') {
                // Gather donation info
                const item = this.getAttribute('data-item');
                const description = this.getAttribute('data-description');
                const quantity = this.getAttribute('data-quantity');
                const category = this.getAttribute('data-category');
                const expiry = this.getAttribute('data-expiry');
                const user = this.getAttribute('data-user');
                modalTitle.textContent = user + ' (Donation)';
                modalBody.innerHTML = `
                    <img src="${src}" class="img-fluid" style="max-height:70vh;">
                    <div class="mt-3 text-start">
                        <h5><strong>Item:</strong> ${item}</h5>
                        <p><strong>Description:</strong> ${description}</p>
                        <p><strong>Quantity:</strong> ${quantity}</p>
                        <p><strong>Category:</strong> ${category}</p>
                        <p><strong>Expiry Date:</strong> ${expiry}</p>
                    </div>
                `;
                modalDescription.textContent = '';
            }

            const modal = new bootstrap.Modal(document.getElementById('mediaViewModal'));
            modal.show();
        });
    });
});
</script>