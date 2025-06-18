@extends('admin.layouts.app')

@section('title', 'Detail Rekomendasi Makanan')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-purple-600 rounded-lg flex items-center justify-center mr-4">
                    <i data-lucide="eye" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Detail Rekomendasi Makanan</h1>
                    <p class="text-gray-600">Informasi lengkap rekomendasi makanan</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.food-recommendations.edit', $foodRecommendation) }}" 
                   class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-medium transition-colors flex items-center">
                    <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                    Edit
                </a>
                <a href="{{ route('admin.food-recommendations.index') }}" 
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium transition-colors flex items-center">
                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="border-b border-gray-200 p-4">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i data-lucide="info" class="w-5 h-5 mr-2 text-orange-500"></i>
                        Informasi Dasar
                    </h3>
                </div>
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $foodRecommendation->name }}</h2>
                        @if($foodRecommendation->is_active)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <i data-lucide="check-circle" class="w-4 h-4 mr-1"></i>
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <i data-lucide="x-circle" class="w-4 h-4 mr-1"></i>
                                Tidak Aktif
                            </span>
                        @endif
                    </div>

                    @if($foodRecommendation->image)
                    <div class="mb-6">
                        <img src="{{ asset('storage/' . $foodRecommendation->image) }}" 
                             alt="{{ $foodRecommendation->name }}" 
                             class="w-full h-64 object-cover rounded-lg shadow">
                    </div>
                    @endif

                    <div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700 leading-relaxed">{{ $foodRecommendation->description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diet & Meal Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="border-b border-gray-200 p-4">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i data-lucide="heart" class="w-5 h-5 mr-2 text-orange-500"></i>
                        Diet & Waktu Makan
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Diet Types -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Jenis Diet</label>
                            <div class="flex flex-wrap gap-2">
                                @if(is_array($foodRecommendation->diet_types))
                                    @foreach($foodRecommendation->diet_types as $dietType)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $dietType }}
                                        </span>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <!-- Meal Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Waktu Makan</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                {{ $mealTypes[$foodRecommendation->meal_type] ?? $foodRecommendation->meal_type }}
                            </span>
                        </div>

                        <!-- Day -->
                        @if($foodRecommendation->day)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-2">Hari</label>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                {{ $dayTypes[$foodRecommendation->day] ?? $foodRecommendation->day }}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Calorie Information -->
            @if($foodRecommendation->calories_per_serving)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="border-b border-gray-200 p-4">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i data-lucide="zap" class="w-5 h-5 mr-2 text-orange-500"></i>
                        Informasi Kalori
                    </h3>
                </div>
                <div class="p-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Kalori per Porsi</label>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                            {{ $foodRecommendation->calories_per_serving }} kcal
                        </span>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Diet Types -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="border-b border-gray-200 p-4">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i data-lucide="tag" class="w-5 h-5 mr-2 text-orange-500"></i>
                        Jenis Diet
                    </h3>
                </div>
                <div class="p-6">
                    <div class="flex flex-wrap gap-2">
                        @if(is_array($foodRecommendation->diet_types))
                            @foreach($foodRecommendation->diet_types as $dietType)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $dietType }}
                                </span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <!-- Meal Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="border-b border-gray-200 p-4">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i data-lucide="clock" class="w-5 h-5 mr-2 text-orange-500"></i>
                        Informasi Waktu
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Waktu Makan</label>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            {{ $mealTypes[$foodRecommendation->meal_type] ?? $foodRecommendation->meal_type }}
                        </span>
                    </div>

                    @if($foodRecommendation->day)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Hari</label>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ $dayTypes[$foodRecommendation->day] ?? $foodRecommendation->day }}
                        </span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Calorie Information -->
            @if($foodRecommendation->calories_per_serving)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="border-b border-gray-200 p-4">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i data-lucide="zap" class="w-5 h-5 mr-2 text-orange-500"></i>
                        Informasi Kalori
                    </h3>
                </div>
                <div class="p-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-2">Kalori per Porsi</label>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                            {{ $foodRecommendation->calories_per_serving }} kcal
                        </span>
                    </div>
                </div>
            </div>
            @endif

            <!-- Status -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="border-b border-gray-200 p-4">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i data-lucide="activity" class="w-5 h-5 mr-2 text-orange-500"></i>
                        Status
                    </h3>
                </div>
                <div class="p-6">
                    @if($foodRecommendation->is_active)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i>
                            Aktif
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <i data-lucide="x-circle" class="w-3 h-3 mr-1"></i>
                            Tidak Aktif
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced JavaScript with Animations -->
<script>
    // Initialize Lucide Icons
    lucide.createIcons();
    
    // Add smooth scroll animations
    document.addEventListener('DOMContentLoaded', function() {
        // Animate cards on scroll
        const cards = document.querySelectorAll('.group');
        
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        cards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
        
        // Add loading animation for nutrition cards
        const nutritionCards = document.querySelectorAll('.group\\/card');
        nutritionCards.forEach((card, index) => {
            setTimeout(() => {
                card.style.animation = 'slideInUp 0.6s ease forwards';
            }, index * 100);
        });
    });
    
    // Add hover sound effect (optional)
    document.querySelectorAll('button, a').forEach(element => {
        element.addEventListener('mouseenter', () => {
            // Optional: Add subtle hover sound
            // new Audio('/sounds/hover.mp3').play().catch(() => {});
        });
    });
</script>

<style>
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Custom scrollbar for recipe sections */
    .whitespace-pre-wrap::-webkit-scrollbar {
        width: 6px;
    }
    
    .whitespace-pre-wrap::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    
    .whitespace-pre-wrap::-webkit-scrollbar-thumb {
        background: linear-gradient(45deg, #f97316, #a855f7);
        border-radius: 10px;
    }
    
    .whitespace-pre-wrap::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(45deg, #ea580c, #9333ea);
    }
    
    /* Enhanced glass morphism */
    .backdrop-blur-xl {
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
    }
    
    /* Improved focus states */
    button:focus,
    a:focus {
        outline: 2px solid #f97316;
        outline-offset: 2px;
    }
</style>
@endsection
