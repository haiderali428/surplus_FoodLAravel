@extends('layout.app')
@extends('header.main_header')
@section('content')
   <div class="container">
       <div class="row">
           <div class="col-lg-2 col-12 mt-3">



           </div>
           <div class="col-lg-8 col-12 lefti-brdr px-lg-0" style="margin-top: 10px;">
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
                   <a href="" class="d-flex gap-2 align-items-center" type="button"  data-bs-toggle="modal" data-bs-target="#donationModal"><img src="./img/Home/images.png"  alt=""> Donation</a>
                  </div>

               </div>
               <!-- for post creation head ended here-->
               <!--####### images post started here ########-->
           @foreach ($posts as $post)
    @php $user = $users[$post->user_id] ?? null; @endphp
    @if ($post->post_type == 'text' || $post->post_type == 'image' || $post->post_type == 'video' || $post->post_type == 'donation')
         <div class="images-post  mt-4">
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
                             <p class="mb-1 thanks-p mt-2">{{ $post->post }}</p>
                            <img src="{{ asset('storage/' . $post->image_post) }}" alt="Image Post" class="w-100 mt-2 rounded-1" style="height: 500px">
                        </div>
                    @elseif ($post->post_type == 'video')
                        <div>
                             <p class="mb-1 thanks-p mt-2">{{ $post->post }}</p>
                            <video src="{{ asset('storage/' . $post->video_post) }}" controls class="w-100 mt-2" style="height: 500px;"></video>
                        </div>
                    @elseif ($post->post_type == 'donation')
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-12 ">
                                    <div class="card position-relative mb-0">
                                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top w-100 mt-2" style="height: 500px" alt="Donation Image">
                                        <div class="card-body text-white position-absolute bottom-0 start-0 w-100 p-3 d-flex flex-sm-row flex-column justify-content-between align-items-end" style="background-color: rgba(12, 140, 133, 0.7);">
                                            <div class="d-flex flex-column align-items-start donation-post-detail">
                                                <h5 class="card-title text-white">{{$post->item_name}}</h5>
                                                <p class="card-text text-white mb-0">{{$post->description}}</p>
                                                <p class="card-text text-white mb-0"><small>Quantity: {{$post->quantity}}</small></p>
                                                <p class="card-text text-white mb-0"><small>Category: {{$post->category}}</small></p>
                                                <p class="card-text text-white mb-0"><small>Expiry Date: {{$post->expire_date}}</small></p>
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-primary request-btn" data-bs-toggle="modal" data-bs-target=".donation-modal" onclick="setDonationPostId({{ $post->id }})">Request Donation</button>
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
                            <div class="d-flex gap-1 mb-2">
                                <div class="fb-like-btn like-btn reaction1 d-flex align-items-center {{ (auth()->check() && in_array(auth()->id(), $post->likes)) ? 'liked' : '' }}" data-post-id="{{ $post->id }}" data-post-type="{{ $post->source_table }}" style="cursor:pointer;gap:4px;">
                                    <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_160_109672)">
                                            <path
                                                d="M14.3219 12.2375L14.25 12.1656L13.7313 11.6469C14.0781 11.2125 14.2094 10.6656 14.1313 10.1438C14.1313 10.1344 14.1281 10.125 14.125 10.1156C14.1219 10.1031 14.1219 10.0938 14.1188 10.0813C14.1156 10.0406 14.1 9.97815 14.075 9.8969C14.0625 9.85627 14.05 9.81877 14.0375 9.77815C13.7594 8.96252 12.8969 6.86877 13.0469 4.80627C13.05 4.34377 12.7406 3.92502 12.3031 3.95002C11.8656 3.97502 11.0688 4.20315 11.025 6.26565C11.0188 6.6469 10.9656 6.83127 10.9813 7.14377L5.99063 2.15315C5.66563 1.82815 5.15001 1.8219 4.82501 2.1469C4.50001 2.4719 4.50001 3.00002 4.82188 3.3219L7.77501 6.27502C7.77813 6.27815 7.77813 6.28127 7.78126 6.28127C8.05626 6.55627 7.72501 6.93752 7.43438 6.7719L3.90001 3.24065C3.57501 2.91565 3.05938 2.9094 2.73438 3.2344C2.40938 3.56252 2.40626 4.08752 2.73126 4.41252L6.27501 7.95627C6.44688 8.21565 6.11876 8.52815 5.86251 8.31877L2.76876 5.22502C2.44376 4.90002 1.92813 4.89377 1.60313 5.21877C1.27813 5.54377 1.27501 6.06877 1.60001 6.39377L4.64688 9.44065C4.65001 9.4469 4.65626 9.45627 4.66563 9.46565C4.93126 9.73127 4.61563 10.0969 4.33438 9.94377L2.15313 7.76252C1.82813 7.43752 1.31251 7.43127 0.987506 7.75627C0.662506 8.08127 0.659381 8.60627 0.984381 8.93127L6.11251 14.0625C7.15626 15.1063 8.66563 15.3906 9.96563 14.9219L10.125 15.0813L10.8 15.7563C11.125 16.0813 11.65 16.0813 11.975 15.7563L14.3219 13.4094C14.6469 13.0875 14.6469 12.5594 14.3219 12.2375Z"
                                                fill="#CC824C" />
                                            <path
                                                d="M12.3094 1.03027C12.3 1.00215 12.2812 0.980273 12.2531 0.970898L11.3187 0.630273C11.2906 0.620898 11.2625 0.624023 11.2375 0.639648C11.2125 0.655273 11.2 0.680273 11.1969 0.708398L11.0531 2.5584C11.05 2.59902 11.075 2.63652 11.1125 2.64902C11.1219 2.65215 11.1344 2.65527 11.1437 2.65527C11.1719 2.65527 11.2 2.64277 11.2187 2.61777L12.2969 1.1084C12.3156 1.08652 12.3187 1.0584 12.3094 1.03027Z"
                                                fill="#B46D39" />
                                            <path
                                                d="M14.2188 2.83125L13.8 1.93125C13.7875 1.90625 13.7656 1.8875 13.7375 1.88125C13.7094 1.875 13.6813 1.88125 13.6594 1.9L12.25 3.10625C12.2188 3.13125 12.2094 3.175 12.2281 3.2125C12.2438 3.24375 12.275 3.26562 12.3094 3.26562H12.325L14.1531 2.9625C14.1813 2.95938 14.2063 2.94063 14.2188 2.91563C14.2313 2.8875 14.2313 2.85625 14.2188 2.83125Z"
                                                fill="#B46D39" />
                                            <path
                                                d="M9.81249 2.35864L9.50936 0.530511C9.50624 0.502386 9.48749 0.477386 9.46249 0.464886C9.43749 0.452386 9.40936 0.452386 9.38124 0.461761L8.48124 0.880511C8.45624 0.893011 8.43749 0.914886 8.43124 0.943011C8.42499 0.971136 8.43124 0.999261 8.44999 1.02114L9.65624 2.43364C9.67499 2.45551 9.69999 2.46489 9.72499 2.46489C9.73749 2.46489 9.74999 2.46176 9.76249 2.45551C9.79999 2.43989 9.81874 2.39926 9.81249 2.35864Z"
                                                fill="#B46D39" />
                                            <path
                                                d="M16.1375 12.2375L15.5469 11.6469C15.8937 11.2125 16.025 10.6656 15.9469 10.1438C15.9469 10.1344 15.9437 10.125 15.9406 10.1156C15.9375 10.1031 15.9375 10.0938 15.9344 10.0813C15.9312 10.0406 15.9156 9.97815 15.8906 9.8969C15.8781 9.85627 15.8656 9.81877 15.8531 9.77815C15.575 8.96252 14.7125 6.86877 14.8625 4.80627C14.8656 4.34377 14.5562 3.92502 14.1187 3.95002C13.6812 3.97502 12.8844 4.20315 12.8406 6.26565C12.8344 6.6469 12.7812 6.83127 12.7969 7.14377L7.80624 2.15315C7.48124 1.82815 6.96562 1.8219 6.64062 2.1469C6.31562 2.4719 6.31562 3.00002 6.63749 3.3219L9.59062 6.27502C9.59374 6.27815 9.59374 6.28127 9.59687 6.28127C9.87187 6.55627 9.54062 6.93752 9.24999 6.7719L5.71562 3.24065C5.39062 2.91565 4.87499 2.9094 4.54999 3.2344C4.22499 3.5594 4.22187 4.0844 4.54687 4.4094L8.09062 7.95315C8.26249 8.21252 7.93437 8.52502 7.67812 8.31565L4.58437 5.2219C4.25937 4.8969 3.74374 4.89065 3.41874 5.21565C3.09374 5.54065 3.09062 6.06565 3.41562 6.39065L6.46249 9.43752C6.46562 9.44377 6.47187 9.45315 6.48124 9.46252C6.74687 9.72815 6.43124 10.0938 6.14999 9.94065L3.96874 7.7594C3.64374 7.4344 3.12812 7.42815 2.80312 7.75315C2.47812 8.07815 2.47499 8.60315 2.79999 8.92815L7.92812 14.0625C8.97187 15.1063 10.4812 15.3906 11.7812 14.9219L12.6156 15.7563C12.9406 16.0813 13.4656 16.0813 13.7906 15.7563L16.1375 13.4094C16.4625 13.0875 16.4625 12.5594 16.1375 12.2375Z"
                                                fill="#B46D39" />
                                            <path
                                                d="M15.5406 11.6367C15.4937 11.7023 15.4469 11.7617 15.4 11.8086L13.6125 13.593V13.5836L13.1375 14.0617C12.7406 14.4586 12.2781 14.743 11.7844 14.9211L12.5281 15.6648C12.6906 15.6148 12.8281 15.5461 12.9156 15.4586L15.85 12.5242C15.9344 12.4398 16.0062 12.3117 16.0656 12.1617L15.5406 11.6367Z"
                                                fill="#B46D39" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_160_109672">
                                                <rect width="16" height="16" fill="white"
                                                    transform="translate(0.5)" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    {{-- <span class="like-text" style="color:{{ (auth()->check() && in_array(auth()->id(), $post->likes)) ? '#1877F2' : '#333' }};font-weight:600;">Like</span> --}}
                                    <span class="like-count" style="margin-left:2px;">{{ $post->like_count }}</span>
                                </div>

                                 <div class="reaction1" >
                                    <!-- Replace with your refresh SVG -->
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.52042 1.21548C7.49193 1.1509 8.50739 1.15076 9.48088 1.21548C12.5253 1.41785 14.9408 3.87538 15.1394 6.94856C15.1766 7.5235 15.1766 8.11821 15.1394 8.69316C14.9408 11.7663 12.5253 14.2239 9.48088 14.4262C8.50739 14.491 7.49193 14.4908 6.52042 14.4262C6.1438 14.4012 5.73383 14.3122 5.37291 14.1635C5.21419 14.0981 5.10643 14.0539 5.02759 14.025C4.97338 14.0623 4.90137 14.1152 4.79652 14.1925C4.26823 14.5821 3.60126 14.8553 2.65477 14.8323L2.62428 14.8316C2.44168 14.8272 2.24706 14.8226 2.08833 14.7918C1.89715 14.7549 1.66063 14.6624 1.51259 14.41C1.35147 14.1353 1.41607 13.8575 1.47857 13.6826C1.53756 13.5175 1.63981 13.3238 1.74427 13.126L1.75859 13.0989C2.06947 12.5097 2.15608 12.0283 1.98985 11.7073C1.43497 10.8697 0.935801 9.8374 0.861852 8.69316C0.824695 8.11821 0.824695 7.5235 0.861852 6.94856C1.06046 3.87538 3.47599 1.41785 6.52042 1.21548ZM5.16732 6.33366C5.16732 6.6098 5.39117 6.83366 5.66732 6.83366H8.00065C8.27679 6.83366 8.50065 6.6098 8.50065 6.33366C8.50065 6.05752 8.27679 5.83366 8.00065 5.83366H5.66732C5.39117 5.83366 5.16732 6.05752 5.16732 6.33366ZM5.16732 9.66699C5.16732 9.94313 5.39117 10.167 5.66732 10.167H10.334C10.6101 10.167 10.834 9.94313 10.834 9.66699C10.834 9.39085 10.6101 9.16699 10.334 9.16699H5.66732C5.39117 9.16699 5.16732 9.39085 5.16732 9.66699Z"
                                            fill="#71747F" />
                                    </svg>
                                    {{ $post->comments_count }}
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
                    </div> <!-- Added closing div for position-relative -->
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
                                <div class="d-flex justify-content-left  align-items-center gap-1 gap-sm-3 my-2">
                                    <div class="pf_cont">
                                        @if(auth()->check() && auth()->user()->profile_picture)
                                            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile" class="profile-img" style="object-fit: cover; width:30px; height: 30px;">
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
                                            {{-- <span style="color:white; font-size:12px; margin-left:6px;">Send</span> --}}
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
                    </div> <!-- Added closing div for cmnts section -->
                </div> <!-- Added closing div for images-post -->
                @endif
@endforeach
            </div> <!-- Added closing div for col-lg-8 -->

           {{-- <div class="col-lg-2 col-12 mt-3">
                <div class="contact-us d-flex flex-column gap-2">
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" style="border: 1px solid black !important;">
                    </div>
                </div>
           </div> --}}
       </div>
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






   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
.fb-like-btn.liked{
    background: #F5E6DB !important;
    /* stroke: #1877F2 !important; */
}
.fb-like-btn svg path {
    transition: fill 0.2s, stroke 0.2s;
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
