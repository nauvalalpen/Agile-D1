@extends('layouts.app')

@section('title', 'Gallery - Air Terjun Lubuk Hitam')

@section('styles')
    <style>
        .gallery-tabs .nav-link {
            color: #495057;
            border-radius: 0;
            padding: 1rem 1.5rem;
        }

        .gallery-tabs .nav-link.active {
            color: #007bff;
            border-bottom: 3px solid #007bff;
            background-color: transparent;
        }

        .tiktok-card {
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
            margin-bottom: 20px;
        }

        .tiktok-card:hover {
            transform: translateY(-5px);
        }

        .tiktok-thumbnail {
            position: relative;
            overflow: hidden;
            padding-top: 177.78%;
            /* 16:9 Aspect Ratio */
        }

        .tiktok-thumbnail img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .tiktok-play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 3rem;
            opacity: 0.8;
        }

        .tiktok-user {
            display: flex;
            align-items: center;
            padding: 10px;
        }

        .tiktok-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .gallery-image {
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }

        .gallery-image:hover {
            transform: scale(1.03);
        }

        .gallery-image img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Gallery - Air Terjun Lubuk Hitam</h1>

        <!-- Gallery Tabs -->
        <ul class="nav nav-tabs gallery-tabs mb-4" id="galleryTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button"
                    role="tab" aria-controls="all" aria-selected="true">
                    All Photos
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tiktok-tab" data-bs-toggle="tab" data-bs-target="#tiktok" type="button"
                    role="tab" aria-controls="tiktok" aria-selected="false">
                    <i class="fab fa-tiktok me-2"></i>TikTok #airterjunlubukhitam
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="official-tab" data-bs-toggle="tab" data-bs-target="#official" type="button"
                    role="tab" aria-controls="official" aria-selected="false">
                    Official Gallery
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="galleryTabsContent">
            <!-- All Photos Tab -->
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                <div class="row">
                    <!-- TikTok Posts -->
                    @foreach ($tiktokPosts as $post)
                        <div class="col-md-4 col-lg-3 mb-4">
                            <div class="tiktok-card shadow-sm">
                                <div class="tiktok-thumbnail">
                                    <img src="{{ $post['video_thumbnail'] }}" alt="TikTok video thumbnail">
                                    <div class="tiktok-play-button">
                                        <i class="fab fa-tiktok"></i>
                                    </div>
                                </div>
                                <div class="tiktok-user">
                                    <img src="{{ $post['avatar'] }}" alt="{{ $post['username'] }}" class="tiktok-avatar">
                                    <div>
                                        <p class="mb-0 fw-bold">{{ $post['username'] }}</p>
                                        <small class="text-muted">{{ $post['posted_at'] }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Local Gallery Images -->
                    @foreach ($localImages as $image)
                        <div class="col-md-4 col-lg-3 mb-4">
                            <div class="gallery-image shadow-sm">
                                <img src="{{ $image['image_url'] }}" alt="{{ $image['title'] }}">
                                <div class="p-3">
                                    <h5 class="mb-1">{{ $image['title'] }}</h5>
                                    <p class="text-muted small mb-0">{{ $image['description'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- TikTok Tab -->
            <div class="tab-pane fade" id="tiktok" role="tabpanel" aria-labelledby="tiktok-tab">
                <div class="row">
                    @foreach ($tiktokPosts as $post)
                        <div class="col-md-4 col-lg-3 mb-4">
                            <div class="tiktok-card shadow-sm">
                                <div class="tiktok-thumbnail">
                                    <img src="{{ $post['video_thumbnail'] }}" alt="TikTok video thumbnail">
                                    <div class="tiktok-play-button">
                                        <i class="fab fa-tiktok"></i>
                                    </div>
                                </div>
                                <div class="p-3">
                                    <div class="tiktok-user mb-2">
                                        <img src="{{ $post['avatar'] }}" alt="{{ $post['username'] }}"
                                            class="tiktok-avatar">
                                        <div>
                                            <p class="mb-0 fw-bold">{{ $post['username'] }}</p>
                                            <small class="text-muted">{{ $post['posted_at'] }}</small>
                                        </div>
                                    </div>
                                    <p class="mb-2">{{ $post['caption'] }}</p>
                                    <div class="d-flex justify-content-between text-muted">
                                        <small><i class="fas fa-heart me-1"></i> {{ $post['likes'] }}</small>
                                        <small><i class="fas fa-comment me-1"></i> {{ $post['comments'] }}</small>
                                        <small><i class="fas fa-share me-1"></i> {{ $post['shares'] }}
                                            <small><i class="fas fa-share me-1"></i> {{ $post['shares'] }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-4">
                    <p class="mb-3">Want to see your content here?</p>
                    <div class="d-flex justify-content-center align-items-center">
                        <i class="fab fa-tiktok me-2 fs-4"></i>
                        <h4 class="mb-0">Use the hashtag #airterjunlubukhitam on TikTok</h4>
                    </div>
                </div>
            </div>

            <!-- Official Gallery Tab -->
            <div class="tab-pane fade" id="official" role="tabpanel" aria-labelledby="official-tab">
                <div class="row">
                    @foreach ($localImages as $image)
                        <div class="col-md-4 mb-4">
                            <div class="gallery-image shadow-sm">
                                <img src="{{ $image['image_url'] }}" alt="{{ $image['title'] }}">
                                <div class="p-3">
                                    <h5 class="mb-1">{{ $image['title'] }}</h5>
                                    <p class="text-muted small mb-2">{{ $image['description'] }}</p>
                                    <small class="text-muted">Added on {{ $image['uploaded_at'] }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Information Section -->
        <div class="mt-5">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">About Our Gallery</h3>
                    <p>Our gallery showcases the natural beauty of Air Terjun Lubuk Hitam from various perspectives. We
                        feature both official photos taken by our team and user-generated content from social media
                        platforms like TikTok.</p>

                    <h5 class="mt-4">Photo Submission</h5>
                    <p>Would you like to contribute to our gallery? Here's how:</p>
                    <ul>
                        <li>Share your photos or videos on TikTok with the hashtag #airterjunlubukhitam</li>
                        <li>Email your high-quality photos to gallery@agile-d1.com</li>
                        <li>Tag us on social media platforms</li>
                    </ul>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i> By submitting your photos, you grant us permission to
                        display them in our gallery. We always provide proper attribution to the original creators.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // This would be replaced with actual TikTok embed code in a production environment
        document.addEventListener('DOMContentLoaded', function() {
            const tiktokCards = document.querySelectorAll('.tiktok-card');

            tiktokCards.forEach(card => {
                card.addEventListener('click', function() {
                    // In a real implementation, this would open the TikTok video
                    // or embed the TikTok player
                    alert(
                        'In a production environment, this would open the TikTok video or embed the TikTok player.'
                        );
                });
            });
        });
    </script>
@endsection
