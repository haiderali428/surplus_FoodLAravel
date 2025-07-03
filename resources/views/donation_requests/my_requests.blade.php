@extends('layout.app')
@extends('header.main_header')
@section('content')
<div class="">

    <div class="main">

        <main class="content mt-0">
            <div class="container-fluid p-sm-2">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <h1 class="dashboard-heading-2 fw-bolder">
                    <i class="fas fa-hand-holding-heart me-2"></i>My Donation Posts
                </h1>

                @if($posts->count() > 0)
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card donation-card h-100" style="border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.1); border: none;">
                                    <div class="card-body p-4">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <h5 class="card-title mb-0" style="color: #2c3e50; font-weight: bold;">
                                                <i class="fas fa-gift me-2" style="color: #e74c3c;"></i>
                                                {{ $post->item_name ?? 'Donation Post' }}
                                            </h5>
                                            <span class="badge rounded-pill" style="background: linear-gradient(45deg, #667eea, #764ba2); font-size: 0.8rem;">
                                                {{ $post->requests_count }} Requests
                                            </span>
                                        </div>
                                        
                                        <p class="card-text text-muted mb-3" style="font-size: 0.9rem;">
                                            <i class="fas fa-info-circle me-1"></i>
                                            {{ Str::limit($post->description ?? 'No description available', 80) }}
                                        </p>
                                        
                                        <div class="row text-center mb-3">
                                            <div class="col-6">
                                                <div class="stat-item">
                                                    <i class="fas fa-boxes" style="color: #3498db; font-size: 1.2rem;"></i>
                                                    <div class="stat-value">{{ $post->quantity ?? 'N/A' }}</div>
                                                    <div class="stat-label">Quantity</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="stat-item">
                                                    <i class="fas fa-calendar-alt" style="color: #e67e22; font-size: 1.2rem;"></i>
                                                    <div class="stat-value">{{ $post->expire_date ? \Carbon\Carbon::parse($post->expire_date)->format('M d') : 'N/A' }}</div>
                                                    <div class="stat-label">Expires</div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="d-grid">
                                            <a href="{{ route('donation.requests', $post->id) }}" 
                                               class="btn btn-primary btn-sm" 
                                               style="background: linear-gradient(45deg, #ff6b35, #f7931e); border: none; border-radius: 10px; padding: 10px 20px; font-weight: 600;">
                                                <i class="fas fa-eye me-2"></i>View Requests
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-hand-holding-heart" style="font-size: 4rem; color: #bdc3c7; margin-bottom: 1rem;"></i>
                            <h3 style="color: #7f8c8d; margin-bottom: 1rem;">No Donation Posts Yet</h3>
                            <p style="color: #95a5a6; margin-bottom: 2rem;">You haven't created any donation posts yet. Start helping others by creating your first donation post!</p>
                            <a href="{{ route('post') }}" class="btn btn-primary" style="background: linear-gradient(45deg, #667eea, #764ba2); border: none; border-radius: 10px; padding: 12px 30px; font-weight: 600;">
                                <i class="fas fa-plus me-2"></i>Create Donation Post
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>

<style>
.donation-card {
    transition: all 0.3s ease;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
}

.donation-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;
}

.stat-item {
    padding: 10px;
    border-radius: 8px;
    background: rgba(102, 126, 234, 0.1);
}

.stat-value {
    font-weight: bold;
    color: #2c3e50;
    font-size: 1.1rem;
    margin: 5px 0 2px 0;
}

.stat-label {
    color: #7f8c8d;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
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
</style>
@endsection 