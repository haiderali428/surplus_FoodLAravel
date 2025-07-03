@extends('layout.app')
@include('header.main_header')
@section('content')
<div class="">

    <div class="main">

        <main class="content mt-0">
            <div class="container-fluid p-sm-2">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="dashboard-heading-2 fw-bolder mb-0">
                        <i class="fas fa-users me-2"></i>Requests for: {{ $post->item_name ?? 'Donation Post' }}
                    </h1>
                    <a href="{{ route('my.donation.requests') }}" class="btn btn-outline-primary back-btn" style="border-radius: 10px; padding: 8px 20px;">
                        <i class="fas fa-arrow-left me-2"></i>Back to Posts
                    </a>
                </div>

                <!-- Post Summary Card -->
                <div class="post-summary-card mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h5 class="mb-2" style="color: #2c3e50; font-weight: bold;">
                                <i class="fas fa-gift me-2" style="color: #e74c3c;"></i>
                                {{ $post->item_name ?? 'Donation Post' }}
                            </h5>
                            <p class="mb-2 text-muted">{{ Str::limit($post->description ?? 'No description available', 100) }}</p>
                            <div class="d-flex gap-3">
                                <span class="badge rounded-pill" style="background: linear-gradient(45deg, #3498db, #2980b9);">
                                    <i class="fas fa-boxes me-1"></i>{{ $post->quantity ?? 'N/A' }} items
                                </span>
                                <span class="badge rounded-pill" style="background: linear-gradient(45deg, #e67e22, #d35400);">
                                    <i class="fas fa-calendar me-1"></i>{{ $post->expire_date ? \Carbon\Carbon::parse($post->expire_date)->format('M d, Y') : 'No expiry' }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="request-stats">
                                <div class="stat-number">{{ $requests->count() }}</div>
                                <div class="stat-label">Total Requests</div>
                                <div class="stat-number approved-count">{{ $requests->where('status', 'approved')->count() }}</div>
                                <div class="stat-label">Approved</div>
                            </div>
                        </div>
                    </div>
                </div>

                @if($post->status === 'approved')
                    <div class="alert alert-success completed-alert" style="border-radius: 15px; border: none; background: linear-gradient(45deg, #27ae60, #2ecc71); color: white;">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Donation Completed!</strong> This donation has been successfully completed.
                    </div>
                @endif

                @if($requests->count() > 0)
                    <div class="row" id="requestsContainer">
                        @foreach($requests as $request)
                            <div class="col-md-6 col-lg-4 mb-4 request-item" data-status="{{ $request->status }}">
                                <div class="card request-card h-100" style="border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); border: none;">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="user-avatar me-3">
                                                <img src="{{ $request->user->profile_picture ? asset('storage/' . $request->user->profile_picture) : asset('img/avatars/avatar-2.jpg') }}" 
                                                     alt="User Avatar" 
                                                     style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 3px solid #667eea;">
                                            </div>
                                            <div class="user-info">
                                                <h6 class="mb-1" style="color: #2c3e50; font-weight: bold;">
                                                    {{ $request->user->first_name }} {{ $request->user->last_name }}
                                                </h6>
                                                <span class="badge rounded-pill role-badge" style="background: linear-gradient(45deg, #e74c3c, #c0392b); font-size: 0.7rem;">
                                                    {{ ucfirst($request->user->role) }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="request-message mb-3">
                                            <p class="mb-2" style="color: #7f8c8d; font-size: 0.9rem;">
                                                <i class="fas fa-comment me-1"></i>
                                                <strong>Message:</strong>
                                            </p>
                                            <p class="message-text" style="color: #2c3e50; font-style: italic; background: rgba(102, 126, 234, 0.1); padding: 10px; border-radius: 8px; margin: 0;">
                                                "{{ $request->message ?? 'No message provided' }}"
                                            </p>
                                        </div>
                                        
                                        <div class="request-status mb-3">
                                            @if($request->status === 'approved')
                                                <div class="status-badge approved">
                                                    <i class="fas fa-check-circle me-1"></i>
                                                    Approved
                                                </div>
                                            @elseif($request->status === 'rejected')
                                                <div class="status-badge rejected">
                                                    <i class="fas fa-times-circle me-1"></i>
                                                    Rejected
                                                </div>
                                            @else
                                                <div class="status-badge pending">
                                                    <i class="fas fa-clock me-1"></i>
                                                    Pending
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="request-actions">
                                            @if($request->status === 'pending' && $post->status !== 'completed')
                                                <form action="{{ route('donation.requests.approve', $request->id) }}" method="POST" class="d-inline approve-form">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm approve-btn" type="submit" style="border-radius: 10px; padding: 10px 20px; font-weight: 600; background: linear-gradient(45deg, #27ae60, #2ecc71); border: none;">
                                                        <i class="fas fa-check me-2"></i>Approve Request
                                                    </button>
                                                </form>
                                                <form action="{{ route('donation.requests.reject', $request->id) }}" method="POST" class="d-inline ms-2">
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" type="submit" style="border-radius: 10px; padding: 10px 20px; font-weight: 600; background: linear-gradient(45deg, #e74c3c, #c0392b); border: none;">
                                                        <i class="fas fa-times me-2"></i>Reject
                                                    </button>
                                                </form>
                                            @elseif($request->status === 'approved')
                                                <div class="text-center">
                                                    <span class="text-success" style="font-weight: 600;">
                                                        <i class="fas fa-check-circle me-1"></i>Approved
                                                    </span>
                                                </div>
                                            @elseif($request->status === 'rejected')
                                                <div class="text-center">
                                                    <span class="text-danger" style="font-weight: 600;">
                                                        <i class="fas fa-times-circle me-1"></i>Rejected
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-inbox" style="font-size: 4rem; color: #bdc3c7; margin-bottom: 1rem;"></i>
                            <h3 style="color: #7f8c8d; margin-bottom: 1rem;">No Requests Yet</h3>
                            <p style="color: #95a5a6; margin-bottom: 2rem;">This donation post hasn't received any requests yet. Share it with others to get requests!</p>
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>

<style>
.request-card {
    transition: all 0.3s ease;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    position: relative;
    overflow: hidden;
}

.request-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
    transition: left 0.5s;
}

.request-card:hover::before {
    left: 100%;
}

.request-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;
}

.post-summary-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.request-stats {
    text-align: center;
}

.stat-number {
    font-size: 2rem;
    font-weight: bold;
    color: white;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.8rem;
    color: rgba(255,255,255,0.8);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-align: center;
    display: inline-block;
    width: 100%;
    transition: all 0.3s ease;
}

.status-badge.approved {
    background: linear-gradient(45deg, #27ae60, #2ecc71);
    color: white;
    animation: pulse 2s infinite;
}

.status-badge.pending {
    background: linear-gradient(45deg, #f39c12, #e67e22);
    color: white;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.empty-state {
    padding: 3rem;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.dashboard-heading-2 {
    background: linear-gradient(45deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 30px;
    font-size: 2rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

main.content {
    display: block !important;
    width: 100% !important;
    color: #333 !important;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding: 30px 0;
}

.main {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
}

.container-fluid {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 20px;
    padding: 30px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.user-avatar img {
    transition: transform 0.3s ease;
}

.user-avatar img:hover {
    transform: scale(1.1);
}

.request-message p {
    transition: all 0.3s ease;
}

.request-card:hover .request-message p {
    background: rgba(102, 126, 234, 0.15) !important;
}

.back-btn {
    transition: all 0.3s ease;
}

.back-btn:hover {
    transform: translateX(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.approve-btn {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.approve-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(39, 174, 96, 0.4);
}

.approve-btn:active {
    transform: translateY(0);
}

.completed-alert {
    animation: slideInDown 0.5s ease;
}

@keyframes slideInDown {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.request-item {
    animation: fadeInUp 0.6s ease;
    animation-fill-mode: both;
}

.request-item:nth-child(1) { animation-delay: 0.1s; }
.request-item:nth-child(2) { animation-delay: 0.2s; }
.request-item:nth-child(3) { animation-delay: 0.3s; }
.request-item:nth-child(4) { animation-delay: 0.4s; }
.request-item:nth-child(5) { animation-delay: 0.5s; }
.request-item:nth-child(6) { animation-delay: 0.6s; }

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.role-badge {
    transition: all 0.3s ease;
}

.role-badge:hover {
    transform: scale(1.1);
}

.message-text {
    transition: all 0.3s ease;
    cursor: pointer;
}

.message-text:hover {
    background: rgba(102, 126, 234, 0.2) !important;
    transform: scale(1.02);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide success alert after 5 seconds
    const successAlert = document.getElementById('successAlert');
    if (successAlert) {
        setTimeout(() => {
            successAlert.style.transition = 'opacity 0.5s ease';
            successAlert.style.opacity = '0';
            setTimeout(() => {
                successAlert.remove();
            }, 500);
        }, 5000);
    }

    // Add click effect to approve buttons
    const approveBtns = document.querySelectorAll('.approve-btn');
    approveBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Approving...';
            this.disabled = true;
        });
    });

    // Add hover effect to message text
    const messageTexts = document.querySelectorAll('.message-text');
    messageTexts.forEach(text => {
        text.addEventListener('click', function() {
            this.style.transform = 'scale(1.05)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 200);
        });
    });

    // Add loading animation to forms
    const approveForms = document.querySelectorAll('.approve-form');
    approveForms.forEach(form => {
        form.addEventListener('submit', function() {
            const btn = this.querySelector('.approve-btn');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
            btn.disabled = true;
        });
    });
});
</script>
@endsection