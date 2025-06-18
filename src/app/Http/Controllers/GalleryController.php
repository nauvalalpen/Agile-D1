<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class GalleryController extends Controller
{
    public function index()
    {
        // For demonstration purposes, we'll create mock TikTok data
        // In a real application, you would integrate with TikTok's API
        
        // Check if we have cached data
        $tiktokPosts = Cache::remember('tiktok_lubuk_hitam', 3600, function () {
            // This would be replaced with actual API call in production
            return $this->getMockTikTokData();
        });
        
        // Get local gallery images
        $localImages = $this->getLocalGalleryImages();
        
        return view('gallery', [
            'tiktokPosts' => $tiktokPosts,
            'localImages' => $localImages
        ]);
    }
    
    private function getMockTikTokData()
    {
        // Mock data to simulate TikTok posts with #airterjunlubukhitam
        return [
            [
                'id' => 'tiktok1',
                'username' => 'traveler123',
                'avatar' => 'https://randomuser.me/api/portraits/women/1.jpg',
                'video_thumbnail' => 'https://picsum.photos/400/600?random=1',
                'video_url' => 'https://example.com/video1',
                'caption' => 'Amazing waterfall at #airterjunlubukhitam! The water is so clear! 😍',
                'likes' => '1.2K',
                'comments' => '45',
                'shares' => '67',
                'posted_at' => '2023-10-15'
            ],
            [
                'id' => 'tiktok2',
                'username' => 'nature_explorer',
                'avatar' => 'https://randomuser.me/api/portraits/men/2.jpg',
                'video_thumbnail' => 'https://picsum.photos/400/600?random=2',
                'video_url' => 'https://example.com/video2',
                'caption' => 'Hiking to #airterjunlubukhitam was worth it! Look at this view! 🌊',
                'likes' => '3.5K',
                'comments' => '120',
                'shares' => '230',
                'posted_at' => '2023-09-28'
            ],
            [
                'id' => 'tiktok3',
                'username' => 'adventure_time',
                'avatar' => 'https://randomuser.me/api/portraits/women/3.jpg',
                'video_thumbnail' => 'https://picsum.photos/400/600?random=3',
                'video_url' => 'https://example.com/video3',
                'caption' => 'Swimming in the natural pool at #airterjunlubukhitam 💦 So refreshing!',
                'likes' => '5.7K',
                'comments' => '210',
                'shares' => '189',
                'posted_at' => '2023-11-05'
            ],
            [
                'id' => 'tiktok4',
                'username' => 'backpacker_id',
                'avatar' => 'https://randomuser.me/api/portraits/men/4.jpg',
                'video_thumbnail' => 'https://picsum.photos/400/600?random=4',
                'video_url' => 'https://example.com/video4',
                'caption' => 'The trek to #airterjunlubukhitam is challenging but so rewarding! 🥾',
                'likes' => '2.3K',
                'comments' => '78',
                'shares' => '56',
                'posted_at' => '2023-10-22'
            ],
            [
                'id' => 'tiktok5',
                'username' => 'travel_with_me',
                'avatar' => 'https://randomuser.me/api/portraits/women/5.jpg',
                'video_thumbnail' => 'https://picsum.photos/400/600?random=5',
                'video_url' => 'https://example.com/video5',
                'caption' => 'Local guide showing us the hidden spots at #airterjunlubukhitam 🌴',
                'likes' => '4.1K',
                'comments' => '132',
                'shares' => '95',
                'posted_at' => '2023-11-12'
            ],
            [
                'id' => 'tiktok6',
                'username' => 'nature_lover',
                'avatar' => 'https://randomuser.me/api/portraits/men/6.jpg',
                'video_thumbnail' => 'https://picsum.photos/400/600?random=6',
                'video_url' => 'https://example.com/video6',
                'caption' => 'The biodiversity around #airterjunlubukhitam is incredible! 🦋🌿',
                'likes' => '3.8K',
                'comments' => '95',
                'shares' => '112',
                'posted_at' => '2023-09-15'
            ],
        ];
    }
    
    private function getLocalGalleryImages()
    {
        // In a real application, you might fetch these from a database
        // For now, we'll use mock data
        return [
            [
                'id' => 1,
                'title' => 'Waterfall Panorama',
                'description' => 'Panoramic view of Air Terjun Lubuk Hitam',
                'image_url' => 'https://picsum.photos/800/600?random=10',
                'uploaded_at' => '2023-10-10'
            ],
            [
                'id' => 2,
                'title' => 'Natural Pool',
                'description' => 'The crystal clear natural pool at the base of the waterfall',
                'image_url' => 'https://picsum.photos/800/600?random=11',
                'uploaded_at' => '2023-09-25'
            ],
            [
                'id' => 3,
                'title' => 'Hiking Trail',
                'description' => 'The scenic hiking trail leading to the waterfall',
                'image_url' => 'https://picsum.photos/800/600?random=12',
                'uploaded_at' => '2023-11-02'
            ],
            [
                'id' => 4,
                'title' => 'Local Flora',
                'description' => 'Unique plant species found around the waterfall area',
                'image_url' => 'https://picsum.photos/800/600?random=13',
                'uploaded_at' => '2023-10-18'
            ],
            [
                'id' => 5,
                'title' => 'Sunset at Lubuk Hitam',
                'description' => 'Beautiful sunset view from the waterfall viewpoint',
                'image_url' => 'https://picsum.photos/800/600?random=14',
                'uploaded_at' => '2023-09-30'
            ],
            [
                'id' => 6,
                'title' => 'Visitor Activities',
                'description' => 'Visitors enjoying various activities at the waterfall',
                'image_url' => 'https://picsum.photos/800/600?random=15',
                'uploaded_at' => '2023-11-08'
            ],
        ];
    }
}
