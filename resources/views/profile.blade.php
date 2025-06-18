@extends('user.layouts.app')

@section('title', 'Profil')

@section('content')    <div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-purple-50 py-8">
        <div class="mx-auto px-6 lg:px-6">
            <!-- Enhanced Header -->
            <div class="mb-8">
                <h1 class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent mb-2">
                    Profil Saya
                </h1>
                <p class="text-gray-600">Kelola informasi pribadi dan pantau progres kesehatan Anda</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - User Info Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-xl p-6 border border-white/20 sticky top-24">
                        <div class="flex flex-col items-center">
                            <!-- Enhanced Profile Image -->
                            <div class="w-32 h-32 relative mb-6">
                                <div class="w-full h-full rounded-full bg-gradient-to-r from-orange-400 to-purple-500 p-1">
                                    <img src="{{ $user['image'] ?? asset('images/placeholder.svg') }}"
                                        alt="{{ $user['name'] }}"
                                        class="rounded-full object-cover w-full h-full bg-white" />
                                </div>
                                <div
                                    class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-4 border-white flex items-center justify-center">
                                    <i data-lucide="check" class="w-4 h-4 text-white"></i>
                                </div>
                            </div>

                            <h2 class="text-2xl font-bold text-gray-900 mb-1">{{ $user['name'] }}</h2>
                            <p class="text-gray-500 text-sm mb-6">{{ $user['email'] }}</p>

                            <!-- Enhanced Stats Grid -->
                            <div class="grid grid-cols-2 gap-4 w-full mb-6">
                                <div
                                    class="bg-gradient-to-r from-orange-50 to-orange-100 p-4 rounded-xl border border-orange-200">
                                    <div class="flex items-center mb-2">
                                        <i data-lucide="scale" class="w-4 h-4 text-orange-500 mr-2"></i>
                                        <p class="text-xs text-orange-600 font-medium">Berat Badan</p>
                                    </div>
                                    <p class="text-lg font-bold text-orange-700">{{ ($user['stats']['weight']) }}</p>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-purple-50 to-purple-100 p-4 rounded-xl border border-purple-200">
                                    <div class="flex items-center mb-2">
                                        <i data-lucide="ruler" class="w-4 h-4 text-purple-500 mr-2"></i>
                                        <p class="text-xs text-purple-600 font-medium">Tinggi Badan</p>
                                    </div>
                                    <p class="text-lg font-bold text-purple-700">{{ $user['stats']['height'] }}</p>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-green-50 to-green-100 p-4 rounded-xl border border-green-200">
                                    <div class="flex items-center mb-2">
                                        <i data-lucide="activity" class="w-4 h-4 text-green-500 mr-2"></i>
                                        <p class="text-xs text-green-600 font-medium">BMI</p>
                                    </div>
                                    <p class="text-lg font-bold text-green-700">{{ $user['stats']['bmi'] }}</p>
                                </div>
                                <div
                                    class="bg-gradient-to-r from-blue-50 to-blue-100 p-4 rounded-xl border border-blue-200">
                                    <div class="flex items-center mb-2">
                                        <i data-lucide="target" class="w-4 h-4 text-blue-500 mr-2"></i>
                                        <p class="text-xs text-blue-600 font-medium">Tujuan</p>
                                    </div>
                                    <p class="text-sm font-bold text-blue-700">{{ $user['stats']['goal'] }}</p>
                                </div>
                            </div>

                            <!-- Enhanced Logout Button -->
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white flex items-center justify-center py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <i data-lucide="log-out" class="w-5 h-5 mr-2"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Detailed Info -->
                <div class="lg:col-span-2">
                    <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden">
                        <!-- Enhanced Tab Navigation -->
                        <div class="border-b border-gray-200/50 bg-white/50 px-6 py-4">
                            <div class="flex space-x-1">
                                @foreach (['profile' => ['label' => 'Profil', 'icon' => 'user'], 'recommendations' => ['label' => 'Rekomendasi', 'icon' => 'heart'], 'progress' => ['label' => 'Progres', 'icon' => 'trending-up']] as $tab => $data)
                                    <a href="{{ route('profile.index', ['tab' => $tab]) }}"
                                        class="px-4 py-2 rounded-xl font-medium transition-all duration-300 flex items-center space-x-2 {{ ($activeTab ?? 'profile') === $tab ? 'bg-gradient-to-r from-orange-500 to-purple-600 text-white shadow-lg' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-800' }}">
                                        <i data-lucide="{{ $data['icon'] }}" class="w-4 h-4"></i>
                                        <span>{{ $data['label'] }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="p-6">
                            @if(session('success'))
                                <div
                                    class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center">
                                    <i data-lucide="check-circle" class="w-5 h-5 mr-2 text-green-500"></i>
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (($activeTab ?? 'profile') === 'profile')
                                <!-- Profile Tab Content -->
                                <div>
                                    <div class="flex items-center mb-6">
                                        <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-xl flex items-center justify-center mr-4">
                                            <i data-lucide="users" class="w-6 h-6 text-white"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-2xl font-bold text-gray-900">Edit Profil</h3>
                                            <p class="text-gray-600">Perbarui informasi pribadi dan data kesehatan Anda</p>
                                        </div>
                                    </div>

                                    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                                        @csrf
                                        @method('PUT')

                                        <!-- Personal Information Section -->
                                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-xl border border-blue-200">
                                            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                                <i data-lucide="user" class="w-5 h-5 mr-2 text-blue-500"></i>
                                                Informasi Pribadi
                                            </h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                                    <input type="text" name="name" id="name" value="{{ old('name', $user['name']) }}" 
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors" 
                                                        required>
                                                    @error('name')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                                    <input type="email" name="email" id="email" value="{{ old('email', $user['email']) }}" 
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors" 
                                                        required>
                                                    @error('email')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label for="age" class="block text-sm font-medium text-gray-700 mb-1">Usia</label>
                                                    <input type="number" name="age" id="age" value="{{ old('age', Auth::user()->questionnaire->age ?? '') }}" 
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors" 
                                                        min="10" max="120">
                                                    @error('age')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                                    <select name="gender" id="gender" 
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                                                        <option value="">Pilih jenis kelamin</option>
                                                        <option value="male" {{ old('gender', Auth::user()->questionnaire->gender ?? '') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                                        <option value="female" {{ old('gender', Auth::user()->questionnaire->gender ?? '') == 'female' ? 'selected' : '' }}>Perempuan</option>
                                                        <option value="other" {{ old('gender', Auth::user()->questionnaire->gender ?? '') == 'other' ? 'selected' : '' }}>Lainnya</option>
                                                    </select>
                                                    @error('gender')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Physical Data Section -->
                                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-xl border border-green-200">
                                            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                                <i data-lucide="activity" class="w-5 h-5 mr-2 text-green-500"></i>
                                                Data Fisik
                                            </h4>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div>
                                                    <label for="height" class="block text-sm font-medium text-gray-700 mb-1">Tinggi Badan (cm)</label>
                                                    <input type="number" name="height" id="height" value="{{ old('height', Auth::user()->questionnaire->height ?? '') }}" 
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors" 
                                                        min="100" max="250" step="0.1">
                                                    @error('height')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label for="weight" class="block text-sm font-medium text-gray-700 mb-1">Berat Badan Saat Ini (kg)</label>
                                                    <input type="number" name="weight" id="weight" value="{{ old('weight', Auth::user()->questionnaire->weight ?? '') }}" 
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors" 
                                                        min="30" max="200" step="0.1">
                                                    @error('weight')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label for="target_weight" class="block text-sm font-medium text-gray-700 mb-1">Target Berat Badan (kg)</label>
                                                    <input type="number" name="target_weight" id="target_weight" value="{{ old('target_weight', Auth::user()->questionnaire->target_weight ?? '') }}" 
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors" 
                                                        min="30" max="200" step="0.1">
                                                    @error('target_weight')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <label for="activity_level" class="block text-sm font-medium text-gray-700 mb-1">Tingkat Aktivitas</label>
                                                    <select name="activity_level" id="activity_level" 
                                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                                                        <option value="">Pilih tingkat aktivitas</option>
                                                        <option value="sedentary" {{ old('activity_level', Auth::user()->questionnaire->activity_level ?? '') == 'sedentary' ? 'selected' : '' }}>Sangat Rendah (Duduk/tidak berolahraga)</option>
                                                        <option value="lightly_active" {{ old('activity_level', Auth::user()->questionnaire->activity_level ?? '') == 'lightly_active' ? 'selected' : '' }}>Ringan (Olahraga ringan 1-3x/minggu)</option>
                                                        <option value="moderately_active" {{ old('activity_level', Auth::user()->questionnaire->activity_level ?? '') == 'moderately_active' ? 'selected' : '' }}>Sedang (Olahraga 3-5x/minggu)</option>
                                                        <option value="very_active" {{ old('activity_level', Auth::user()->questionnaire->activity_level ?? '') == 'very_active' ? 'selected' : '' }}>Tinggi (Olahraga 6-7x/minggu)</option>
                                                        <option value="extra_active" {{ old('activity_level', Auth::user()->questionnaire->activity_level ?? '') == 'extra_active' ? 'selected' : '' }}>Sangat Tinggi (Olahraga 2x/hari)</option>
                                                    </select>
                                                    @error('activity_level')
                                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Goals Section -->
                                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-6 rounded-xl border border-purple-200">
                                            <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                                <i data-lucide="target" class="w-5 h-5 mr-2 text-purple-500"></i>
                                                Tujuan Kesehatan
                                            </h4>
                                            <div>
                                                <label for="goal" class="block text-sm font-medium text-gray-700 mb-2">Tujuan Utama</label>
                                                <select name="goal" id="goal" 
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-colors">
                                                    <option value="">Pilih tujuan kesehatan</option>
                                                    <option value="Weight loss" {{ old('goal', Auth::user()->questionnaire->goal ?? '') == 'Weight loss' ? 'selected' : '' }}>Menurunkan Berat Badan</option>
                                                    <option value="Muscle gain" {{ old('goal', Auth::user()->questionnaire->goal ?? '') == 'Muscle gain' ? 'selected' : '' }}>Menambah Massa Otot</option>
                                                    <option value="Maintain weight" {{ old('goal', Auth::user()->questionnaire->goal ?? '') == 'Maintain weight' ? 'selected' : '' }}>Mempertahankan Berat Badan</option>
                                                    <option value="Improve fitness" {{ old('goal', Auth::user()->questionnaire->goal ?? '') == 'Improve fitness' ? 'selected' : '' }}>Meningkatkan Kebugaran</option>
                                                </select>
                                                @error('goal')
                                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="flex justify-end">
                                            <button type="submit" 
                                                class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center">
                                                <i data-lucide="save" class="w-5 h-5 mr-2"></i>
                                                Simpan Perubahan
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            @elseif ($activeTab === 'recommendations')
                                <!-- <div>
                                    <div class="flex items-center mb-6">
                                        <div class="w-12 h-12 bg-gradient-to-r from-pink-400 to-red-500 rounded-xl flex items-center justify-center mr-4">
                                            <i data-lucide="heart" class="w-6 h-6 text-white"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-2xl font-bold text-gray-900">Rekomendasi Pribadi</h3>
                                            <p class="text-gray-600">Program diet dan olahraga yang disesuaikan dengan profil Anda</p>
                                        </div>
                                    </div>

                                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-xl border border-green-200 mb-6">
                                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                            <i data-lucide="utensils" class="w-5 h-5 mr-2 text-green-500"></i>
                                            Rekomendasi Nutrisi Harian
                                        </h4>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                                            <div class="bg-white p-4 rounded-lg border border-green-200">
                                                <div class="flex items-center justify-between mb-2">
                                                    <span class="text-sm font-medium text-gray-600">Kalori Harian</span>
                                                    <i data-lucide="flame" class="w-4 h-4 text-orange-500"></i>
                                                </div>
                                                <p class="text-2xl font-bold text-green-600">{{ $user['nutritionRecommendations']['calories'] }}</p>
                                                <p class="text-xs text-gray-500">kalori/hari</p>
                                            </div>

                                            <div class="bg-white p-4 rounded-lg border border-green-200">
                                                <div class="flex items-center justify-between mb-2">
                                                    <span class="text-sm font-medium text-gray-600">Protein</span>
                                                    <i data-lucide="beef" class="w-4 h-4 text-red-500"></i>
                                                </div>
                                                <p class="text-2xl font-bold text-green-600">{{ $user['nutritionRecommendations']['protein']['grams'] }}g</p>
                                                <p class="text-xs text-gray-500">{{ $user['nutritionRecommendations']['protein']['percentage'] }} dari kalori</p>
                                            </div>

                                            <div class="bg-white p-4 rounded-lg border border-green-200">
                                                <div class="flex items-center justify-between mb-2">
                                                    <span class="text-sm font-medium text-gray-600">Karbohidrat</span>
                                                    <i data-lucide="wheat" class="w-4 h-4 text-yellow-500"></i>
                                                </div>
                                                <p class="text-2xl font-bold text-green-600">{{ $user['nutritionRecommendations']['carbs']['grams'] }}g</p>
                                                <p class="text-xs text-gray-500">{{ $user['nutritionRecommendations']['carbs']['percentage'] }} dari kalori</p>
                                            </div>

                                            <div class="bg-white p-4 rounded-lg border border-green-200">
                                                <div class="flex items-center justify-between mb-2">
                                                    <span class="text-sm font-medium text-gray-600">Lemak</span>
                                                    <i data-lucide="droplet" class="w-4 h-4 text-blue-500"></i>
                                                </div>
                                                <p class="text-2xl font-bold text-green-600">{{ $user['nutritionRecommendations']['fats']['grams'] }}g</p>
                                                <p class="text-xs text-gray-500">{{ $user['nutritionRecommendations']['fats']['percentage'] }} dari kalori</p>
                                            </div>
                                        </div>

                                        <div class="bg-white p-4 rounded-lg border border-green-200">
                                            <h5 class="font-semibold text-gray-800 mb-2">Tips Nutrisi:</h5>
                                            <ul class="space-y-1 text-sm text-gray-600">
                                                <li class="flex items-start"><span class="text-green-500 mr-2">•</span>Konsumsi protein di setiap waktu makan untuk menjaga massa otot</li>
                                                <li class="flex items-start"><span class="text-green-500 mr-2">•</span>Pilih karbohidrat kompleks seperti nasi merah, oatmeal, dan quinoa</li>
                                                <li class="flex items-start"><span class="text-green-500 mr-2">•</span>Sertakan lemak sehat dari alpukat, kacang-kacangan, dan minyak zaitun</li>
                                                <li class="flex items-start"><span class="text-green-500 mr-2">•</span>Makan dalam porsi kecil tapi sering (5-6x sehari)</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-6 rounded-xl border border-purple-200 mb-6">
                                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                            <i data-lucide="dumbbell" class="w-5 h-5 mr-2 text-purple-500"></i>
                                            Rekomendasi Olahraga
                                        </h4>
                                        
                                        <div class="bg-white p-4 rounded-lg border border-purple-200 mb-4">
                                            <div class="flex items-center mb-3">
                                                <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center mr-3">
                                                    <i data-lucide="calendar" class="w-4 h-4 text-white"></i>
                                                </div>
                                                <div>
                                                    <h5 class="font-semibold text-gray-800">Program Mingguan Anda</h5>
                                                    <p class="text-sm text-gray-600">Berdasarkan tujuan: {{ $user['stats']['goal'] }}</p>
                                                </div>
                                            </div>                                            <p class="text-gray-700 bg-purple-50 p-3 rounded-lg">{{ $user['exerciseRecommendation'] }}</p>
                                        </div>

                                        @if($user['detailedExerciseRecommendations']->isNotEmpty())
                                            <div class="bg-white p-4 rounded-lg border border-purple-200 mb-4">
                                                <h5 class="font-semibold text-gray-800 mb-3 flex items-center">
                                                    <i data-lucide="target" class="w-4 h-4 text-purple-500 mr-2"></i>
                                                    Rekomendasi Latihan Spesifik
                                                </h5>
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                    @foreach($user['detailedExerciseRecommendations'] as $exercise)
                                                        <div class="bg-purple-50 p-4 rounded-lg border border-purple-100">
                                                            <div class="flex items-start justify-between mb-2">
                                                                <h6 class="font-semibold text-gray-800 text-sm">{{ $exercise->name }}</h6>
                                                                <span class="text-xs bg-purple-200 text-purple-700 px-2 py-1 rounded-full">
                                                                    {{ $exercise->category_label }}
                                                                </span>
                                                            </div>
                                                            <p class="text-xs text-gray-600 mb-3">{{ Str::limit($exercise->description, 80) }}</p>
                                                              <div class="grid grid-cols-2 gap-2 text-xs">
                                                                <div class="text-center">
                                                                    <p class="font-semibold text-purple-600">{{ $exercise->activity_level_label }}</p>
                                                                    <p class="text-gray-500">level</p>
                                                                </div>
                                                                <div class="text-center">
                                                                    <p class="font-semibold text-purple-600">{{ $exercise->calories_burned_per_hour }}</p>
                                                                    <p class="text-gray-500">kalori/jam</p>
                                                                </div>
                                                            </div>
                                                          </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        <div class="bg-white p-4 rounded-lg border border-purple-200">
                                            <h5 class="font-semibold text-gray-800 mb-2">Tips Olahraga:</h5>
                                            <ul class="space-y-1 text-sm text-gray-600">
                                                <li class="flex items-start"><span class="text-purple-500 mr-2">•</span>Lakukan pemanasan 5-10 menit sebelum olahraga utama</li>
                                                <li class="flex items-start"><span class="text-purple-500 mr-2">•</span>Istirahat 48 jam antara latihan kekuatan untuk grup otot yang sama</li>
                                                <li class="flex items-start"><span class="text-purple-500 mr-2">•</span>Tingkatkan intensitas secara bertahap setiap minggu</li>
                                                <li class="flex items-start"><span class="text-purple-500 mr-2">•</span>Jangan lupa melakukan pendinginan dan stretching setelah olahraga</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 p-6 rounded-xl border border-blue-200 mb-6">
                                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                            <i data-lucide="droplets" class="w-5 h-5 mr-2 text-blue-500"></i>
                                            Rekomendasi Hidrasi
                                        </h4>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="bg-white p-4 rounded-lg border border-blue-200">
                                                <div class="flex items-center mb-2">
                                                    <i data-lucide="glass-water" class="w-5 h-5 text-blue-500 mr-2"></i>
                                                    <span class="font-semibold text-gray-800">Target Harian</span>
                                                </div>
                                                <p class="text-2xl font-bold text-blue-600">{{ number_format($user['waterIntake']['goal']) }} ml</p>
                                                <p class="text-sm text-gray-600">≈ {{ ceil($user['waterIntake']['goal'] / 250) }} gelas</p>
                                            </div>
                                            <div class="bg-white p-4 rounded-lg border border-blue-200">
                                                <h5 class="font-semibold text-gray-800 mb-2">Tips Hidrasi:</h5>
                                                <ul class="space-y-1 text-sm text-gray-600">
                                                    <li class="flex items-start"><span class="text-blue-500 mr-2">•</span>Minum 1-2 gelas saat bangun tidur</li>
                                                    <li class="flex items-start"><span class="text-blue-500 mr-2">•</span>Minum sebelum, selama, dan setelah olahraga</li>
                                                    <li class="flex items-start"><span class="text-blue-500 mr-2">•</span>Gunakan reminder untuk minum rutin</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 p-6 rounded-xl border border-yellow-200">
                                        <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                            <i data-lucide="lightbulb" class="w-5 h-5 mr-2 text-yellow-500"></i>
                                            Tips Kesehatan Umum
                                        </h4>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="space-y-2">
                                                <h5 class="font-medium text-gray-700 flex items-center">
                                                    <i data-lucide="moon" class="w-4 h-4 mr-2 text-indigo-500"></i>
                                                    Tidur & Istirahat
                                                </h5>
                                                <ul class="space-y-1 text-sm text-gray-600">
                                                    <li class="flex items-start"><span class="text-yellow-500 mr-2">•</span>Tidur 7-9 jam setiap malam</li>
                                                    <li class="flex items-start"><span class="text-yellow-500 mr-2">•</span>Buat jadwal tidur yang konsisten</li>
                                                    <li class="flex items-start"><span class="text-yellow-500 mr-2">•</span>Hindari gadget 1 jam sebelum tidur</li>
                                                </ul>
                                            </div>
                                            <div class="space-y-2">
                                                <h5 class="font-medium text-gray-700 flex items-center">
                                                    <i data-lucide="brain" class="w-4 h-4 mr-2 text-purple-500"></i>
                                                    Kesehatan Mental
                                                </h5>
                                                <ul class="space-y-1 text-sm text-gray-600">
                                                    <li class="flex items-start"><span class="text-yellow-500 mr-2">•</span>Lakukan meditasi 10-15 menit/hari</li>
                                                    <li class="flex items-start"><span class="text-yellow-500 mr-2">•</span>Kelola stress dengan baik</li>
                                                    <li class="flex items-start"><span class="text-yellow-500 mr-2">•</span>Jaga hubungan sosial yang positif</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                @elseif ($activeTab === 'progress')
                                <!-- Enhanced Progress Tab with Interactive Charts -->
                                <div class="py-4">
                                    <div class="flex items-center justify-between mb-6">
                                        <div class="flex items-center">
                                            <div
                                                class="w-12 h-12 bg-gradient-to-r from-purple-400 to-indigo-500 rounded-xl flex items-center justify-center mr-4">
                                                <i data-lucide="trending-up" class="w-6 h-6 text-white"></i>
                                            </div>
                                            <div>
                                                <h3 class="text-2xl font-bold text-gray-900">Progress Kesehatan</h3>
                                                <p class="text-gray-600">Pantau perkembangan berat badan, hidrasi, dan aktivitas Anda</p>
                                            </div>
                                        </div>
                                          <!-- Date Filter Controls -->
                                        <div class="flex items-center space-x-2">
                                            <label class="text-sm font-medium text-gray-700">Periode:</label>
                                            <div class="relative">
                                                <select id="dateFilter" onchange="applyDateFilter()" 
                                                    class="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm font-medium text-gray-700 hover:border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors">
                                                    <option value="7" {{ ($user['filterDays'] ?? 7) == 7 ? 'selected' : '' }}>7 Hari Terakhir</option>
                                                    <option value="14" {{ ($user['filterDays'] ?? 7) == 14 ? 'selected' : '' }}>14 Hari Terakhir</option>
                                                    <option value="30" {{ ($user['filterDays'] ?? 7) == 30 ? 'selected' : '' }}>30 Hari Terakhir</option>
                                                    <option value="90" {{ ($user['filterDays'] ?? 7) == 90 ? 'selected' : '' }}>90 Hari Terakhir</option>
                                                </select>
                                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                                    <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    <!-- Filter Info Banner -->
                                    <div class="mb-6 bg-gradient-to-r from-purple-50 to-indigo-50 border border-purple-200 rounded-lg p-4">
                                        <div class="flex items-center">
                                            <i data-lucide="info" class="w-5 h-5 text-purple-500 mr-2"></i>
                                            <span class="text-sm text-purple-700">
                                                Menampilkan data untuk <strong>{{ $user['filterDays'] ?? 7 }} hari terakhir</strong>
                                                ({{ \Carbon\Carbon::now()->subDays(($user['filterDays'] ?? 7) - 1)->format('d M') }} - {{ \Carbon\Carbon::now()->format('d M Y') }})
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Period Summary Statistics -->
                                    <!-- <div class="mb-6 bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-200 rounded-lg p-4">
                                        <h4 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                            <i data-lucide="bar-chart-3" class="w-5 h-5 text-blue-500 mr-2"></i>
                                            Ringkasan Periode
                                        </h4>
                                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                            @php
                                                $totalCalories = collect($user['mealHistory'] ?? [])->sum('calories');
                                                $avgCalories = count($user['mealHistory'] ?? []) > 0 ? round($totalCalories / count($user['mealHistory'])) : 0;
                                                $totalExercise = collect($user['exerciseHistory'] ?? [])->sum('duration');
                                                $avgExercise = count($user['exerciseHistory'] ?? []) > 0 ? round($totalExercise / count($user['exerciseHistory'])) : 0;
                                                $totalWater = collect($user['waterIntake']['history'] ?? [])->sum('amount');
                                                $avgWater = count($user['waterIntake']['history'] ?? []) > 0 ? round($totalWater / count($user['waterIntake']['history'])) : 0;
                                                $activeDays = collect($user['exerciseHistory'] ?? [])->where('duration', '>', 0)->count();
                                            @endphp
                                            
                                            <div class="text-center bg-white p-3 rounded-lg border border-blue-100">
                                                <p class="text-2xl font-bold text-blue-600">{{ number_format($avgCalories) }}</p>
                                                <p class="text-xs text-gray-600">Rata-rata Kalori/hari</p>
                                            </div>
                                            
                                            <div class="text-center bg-white p-3 rounded-lg border border-blue-100">
                                                <p class="text-2xl font-bold text-blue-600">{{ $avgExercise }}</p>
                                                <p class="text-xs text-gray-600">Rata-rata Olahraga/hari</p>
                                            </div>
                                            
                                            <div class="text-center bg-white p-3 rounded-lg border border-blue-100">
                                                <p class="text-2xl font-bold text-blue-600">{{ number_format($avgWater) }}</p>
                                                <p class="text-xs text-gray-600">Rata-rata Air/hari (ml)</p>
                                            </div>
                                            
                                            <div class="text-center bg-white p-3 rounded-lg border border-blue-100">
                                                <p class="text-2xl font-bold text-blue-600">{{ $activeDays }}</p>
                                                <p class="text-xs text-gray-600">Hari Aktif Berolahraga</p>
                                            </div>
                                        </div>
                                    </div> -->

                                    <!-- Progress Summary Cards -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                                        <!-- Weight Progress Card -->
                                        <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-4 rounded-xl border border-orange-200">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-orange-600 text-sm font-semibold mb-1">Berat Saat Ini</p>                                                    <p class="text-2xl font-bold text-orange-700">{{ number_format($user['weightStats']['current'] ?? 0, 1) }}</p>
                                                    <p class="text-xs text-orange-600">
                                                        Target: {{ number_format($user['weightStats']['target'] ?? 0, 1) }}kg
                                                    </p>
                                                </div>
                                                <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center shadow-lg">
                                                    <i data-lucide="scale" class="w-6 h-6 text-white"></i>
                                                </div>
                                            </div>
                                            <!-- <div class="mt-3">
                                                <div class="flex items-center text-xs">
                                                    @php $change = $user['weightStats']['change'] ?? 0; @endphp                                                    @if($change < 0)
                                                        <i data-lucide="trending-down" class="w-3 h-3 text-green-500 mr-1"></i>
                                                        <span class="text-green-600 font-medium">{{ number_format(abs($change), 1) }} kg turun</span>
                                                    @elseif($change > 0)
                                                        <i data-lucide="trending-up" class="w-3 h-3 text-red-500 mr-1"></i>
                                                        <span class="text-red-600 font-medium">{{ number_format($change, 1) }} kg naik</span>
                                                    @else
                                                        <i data-lucide="minus" class="w-3 h-3 text-gray-500 mr-1"></i>
                                                        <span class="text-gray-600 font-medium">Tidak berubah</span>
                                                    @endif
                                                </div>
                                            </div> -->
                                        </div>                                        <!-- Water Intake Card -->
                                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-xl border border-blue-200">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-blue-600 text-sm font-semibold mb-1">Air Hari Ini</p>
                                                    @php
                                                        // Get today's water intake
                                                        $todayWater = 0;
                                                        $today = now()->toDateString();
                                                        
                                                        // Find today's data in water history
                                                        foreach ($user['waterIntake']['history'] ?? [] as $water) {
                                                            if ($water['date'] === $today) {
                                                                $todayWater = $water['amount'];
                                                                break;
                                                            }
                                                        }
                                                        
                                                        $waterGoal = $user['waterIntake']['goal'] ?? 2000;
                                                    @endphp
                                                    <p class="text-2xl font-bold text-blue-700">{{ number_format($todayWater) }} ml</p>
                                                    <p class="text-xs text-blue-600">
                                                        Target: {{ number_format($waterGoal) }} ml
                                                    </p>
                                                </div>
                                                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                                                    <i data-lucide="droplets" class="w-6 h-6 text-white"></i>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                @php 
                                                    $percentage = $waterGoal > 0 ? min(($todayWater / $waterGoal) * 100, 100) : 0;
                                                @endphp
                                                <div class="w-full bg-blue-200 rounded-full h-2">
                                                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                                </div>
                                                <p class="text-xs text-blue-600 mt-1">{{ round($percentage) }}% tercapai</p>
                                            </div>
                                        </div><!-- Meal Calories Card -->
                                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-xl border border-green-200">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-green-600 text-sm font-semibold mb-1">Kalori Hari Ini</p>
                                                    @php
                                                        // Get today's calories from the meal history
                                                        $todayCalories = 0;
                                                        $today = now()->toDateString();
                                                        
                                                        // Find today's data in meal history
                                                        foreach ($user['mealHistory'] ?? [] as $meal) {
                                                            if ($meal['date'] === $today) {
                                                                $todayCalories = $meal['calories'];
                                                                break;
                                                            }
                                                        }
                                                        
                                                        // Use nutrition recommendations for target or default
                                                        $targetCalories = 1800; // Default
                                                        if (isset($user['nutritionRecommendations']['calories'])) {
                                                            // Extract numeric value from string like "1,800 - 2,000"
                                                            $caloriesStr = $user['nutritionRecommendations']['calories'];
                                                            preg_match('/(\d+,?\d*)/', $caloriesStr, $matches);
                                                            if (!empty($matches[1])) {
                                                                $targetCalories = (int) str_replace(',', '', $matches[1]);
                                                            }
                                                        }
                                                    @endphp
                                                    <p class="text-2xl font-bold text-green-700">{{ number_format($todayCalories) }}</p>
                                                    <p class="text-xs text-green-600">Target: {{ number_format($targetCalories) }} kal</p>
                                                </div>
                                                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center shadow-lg">
                                                    <i data-lucide="utensils" class="w-6 h-6 text-white"></i>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                @php $calPercentage = $targetCalories > 0 ? min(($todayCalories / $targetCalories) * 100, 100) : 0; @endphp
                                                <div class="w-full bg-green-200 rounded-full h-2">
                                                    <div class="bg-green-500 h-2 rounded-full" style="width: {{ $calPercentage }}%"></div>
                                                </div>
                                                <p class="text-xs text-green-600 mt-1">{{ round($calPercentage) }}% dari target</p>
                                            </div>
                                        </div>                                        <!-- Exercise Card -->
                                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-xl border border-purple-200">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="text-purple-600 text-sm font-semibold mb-1">Olahraga Hari Ini</p>
                                                    @php
                                                        // Get today's exercise duration from the exercise history
                                                        $todayExercise = 0;
                                                        $today = now()->toDateString();
                                                        
                                                        // Find today's data in exercise history
                                                        foreach ($user['exerciseHistory'] ?? [] as $exercise) {
                                                            if ($exercise['date'] === $today) {
                                                                $todayExercise = $exercise['duration'];
                                                                break;
                                                            }
                                                        }
                                                        
                                                        $targetExercise = 30; // Default 30 minutes target
                                                    @endphp
                                                    <p class="text-2xl font-bold text-purple-700">{{ $todayExercise }} min</p>
                                                    <p class="text-xs text-purple-600">Target: {{ $targetExercise }} min</p>
                                                </div>
                                                <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center shadow-lg">
                                                    <i data-lucide="dumbbell" class="w-6 h-6 text-white"></i>
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                @php $exPercentage = $targetExercise > 0 ? min(($todayExercise / $targetExercise) * 100, 100) : 0; @endphp
                                                <div class="w-full bg-purple-200 rounded-full h-2">
                                                    <div class="bg-purple-500 h-2 rounded-full" style="width: {{ $exPercentage }}%"></div>
                                                </div>
                                                <p class="text-xs text-purple-600 mt-1">{{ round($exPercentage) }}% tercapai</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Charts Section -->
                                    <div class="grid grid-cols-1 lg:grid-cols-1 gap-6">
                                        <!-- Weight Progress Chart -->
                                        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                                            <div class="flex items-center justify-between mb-4">
                                                <h4 class="text-lg font-semibold text-gray-800">Tren Berat Badan</h4>
                                                <div class="flex items-center space-x-2">
                                                    <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                                                    <span class="text-sm text-gray-600">
                                                        @switch($user['dateFilter'] ?? '7_days')
                                                            @case('7_days')
                                                                7 hari terakhir
                                                                @break
                                                            @case('14_days')
                                                                14 hari terakhir
                                                                @break
                                                            @case('30_days')
                                                                30 hari terakhir
                                                                @break
                                                            @case('90_days')
                                                                90 hari terakhir
                                                                @break
                                                            @default
                                                                7 hari terakhir
                                                        @endswitch
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="h-64">
                                                <canvas id="weightChart"></canvas>
                                            </div>
                                        </div>

                                        <!-- Water Intake Chart -->
                                        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                                            <div class="flex items-center justify-between mb-4">
                                                <h4 class="text-lg font-semibold text-gray-800">Asupan Air Harian</h4>
                                                <div class="flex items-center space-x-2">
                                                    <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                                    <span class="text-sm text-gray-600">Target: {{ number_format($user['waterIntake']['goal'] ?? 2000) }}ml</span>
                                                </div>
                                            </div>
                                            <div class="h-64">
                                                <canvas id="waterChart"></canvas>
                                            </div>
                                        </div>

                                        <!-- Meal Calories Chart -->
                                        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                                            <div class="flex items-center justify-between mb-4">
                                                <h4 class="text-lg font-semibold text-gray-800">Konsumsi Kalori</h4>
                                                <div class="flex items-center space-x-2">
                                                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                                    <span class="text-sm text-gray-600">Target: {{ $targetCalories }}kal</span>
                                                </div>
                                            </div>
                                            <div class="h-64">
                                                <canvas id="mealChart"></canvas>
                                            </div>
                                        </div>

                                        <!-- Exercise Chart -->
                                        <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                                            <div class="flex items-center justify-between mb-4">
                                                <h4 class="text-lg font-semibold text-gray-800">Aktivitas Olahraga</h4>
                                                <div class="flex items-center space-x-2">
                                                    <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                                                    <span class="text-sm text-gray-600">Durasi & Kalori</span>
                                                </div>
                                            </div>
                                            <div class="h-64">
                                                <canvas id="exerciseChart"></canvas>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Weekly Summary -->
                                    <div class="mt-8 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200">
                                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Ringkasan Mingguan</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div class="text-center">
                                                <div class="text-2xl font-bold text-orange-500">
                                                    @php
                                                        $weeklyWeightChange = $user['weightStats']['change'] ?? 0;
                                                    @endphp
                                                    {{ abs($weeklyWeightChange) }} kg
                                                </div>
                                                <div class="text-sm text-gray-600">
                                                    {{ $weeklyWeightChange < 0 ? 'Turun' : ($weeklyWeightChange > 0 ? 'Naik' : 'Stabil') }}
                                                </div>
                                                <div class="text-xs text-gray-500">Berat Badan</div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-2xl font-bold text-blue-500">
                                                    @php
                                                        $weeklyWater = 0;
                                                        if (isset($user['waterIntake']['history'])) {
                                                            $weeklyWater = array_sum(array_column($user['waterIntake']['history'], 'amount'));
                                                        }
                                                    @endphp
                                                    {{ number_format($weeklyWater / 1000, 1) }}L
                                                </div>
                                                <div class="text-sm text-gray-600">Total Air</div>
                                                <div class="text-xs text-gray-500">7 Hari</div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-2xl font-bold text-purple-500">
                                                    @php
                                                        $weeklyExercise = 0;
                                                        if (isset($user['exerciseHistory'])) {
                                                            $weeklyExercise = array_sum(array_column($user['exerciseHistory'], 'duration'));
                                                        }
                                                    @endphp
                                                    {{ $weeklyExercise }} min
                                                </div>
                                                <div class="text-sm text-gray-600">Total Olahraga</div>
                                                <div class="text-xs text-gray-500">7 Hari</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tips Section -->
                                    <div class="mt-8 bg-white border border-gray-200 rounded-xl p-6">
                                        <h4 class="font-semibold text-gray-800 mb-4 flex items-center">
                                            <i data-lucide="lightbulb" class="w-5 h-5 mr-2 text-yellow-500"></i>
                                            Tips Kesehatan
                                        </h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="space-y-2">
                                                <h5 class="font-medium text-gray-700">Berat Badan</h5>
                                                <ul class="space-y-1 text-sm text-gray-600">
                                                    <li class="flex items-start"><span class="text-orange-500 mr-2">•</span>Target penurunan 0.5-1kg per minggu</li>
                                                    <li class="flex items-start"><span class="text-orange-500 mr-2">•</span>Konsistensi lebih penting dari kecepatan</li>
                                                </ul>
                                            </div>
                                            <div class="space-y-2">
                                                <h5 class="font-medium text-gray-700">Hidrasi</h5>
                                                <ul class="space-y-1 text-sm text-gray-600">
                                                    <li class="flex items-start"><span class="text-blue-500 mr-2">•</span>Minum air sebelum merasa haus</li>
                                                    <li class="flex items-start"><span class="text-blue-500 mr-2">•</span>Tingkatkan asupan saat berolahraga</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>            <script>
                // Initialize Lucide icons
                document.addEventListener('DOMContentLoaded', function() {
                    if (window.lucide && window.lucide.createIcons) {
                        window.lucide.createIcons();
                    }
                });

                // Initialize Charts when the progress tab is visible
                document.addEventListener('DOMContentLoaded', function() {
                    // Check if we're on the progress tab by looking at active tab
                    const activeTab = '{{ $activeTab ?? 'profile' }}';
                    
                    if (activeTab === 'progress') {
                        // Wait for Chart.js to be available
                        if (typeof Chart !== 'undefined') {
                            setTimeout(() => {
                                initializeCharts();
                            }, 100);
                        } else {
                            console.error('Chart.js is not loaded');
                        }
                    }
                });

                function initializeCharts() {
                    console.log('Initializing charts...');
                    initWeightChart();
                    initWaterChart();
                    initMealChart();
                    initExerciseChart();
                }                function initWeightChart() {
                    const ctx = document.getElementById('weightChart');
                    if (!ctx) {
                        console.log('Weight chart canvas not found');
                        return;
                    }

                    // Weight data from backend
                    const weightData = @json($user['weightHistory'] ?? []);
                    console.log('Weight data:', weightData);
                    
                    const filterDays = {{ $user['filterDays'] ?? 7 }};
                    const labels = Array.from({length: filterDays}, (_, i) => {
                        const date = new Date();
                        date.setDate(date.getDate() - (filterDays - 1 - i));
                        return date.toLocaleDateString('id-ID', { month: 'short', day: 'numeric' });
                    });
                    
                    // Map weight data to chart dates with proper null handling
                    const weights = Array.from({length: filterDays}, (_, i) => {
                        const date = new Date();
                        date.setDate(date.getDate() - (filterDays - 1 - i));
                        const dateStr = date.toISOString().split('T')[0];
                        
                        // Find weight for this specific date
                        const weightEntry = weightData.find(item => item.date === dateStr);
                        return weightEntry ? parseFloat(weightEntry.weight) : null;
                    });
                    
                    // Fill missing data with last known weight or questionnaire weight
                    let lastKnownWeight = null;
                    const finalWeights = weights.map(weight => {
                        if (weight !== null) {
                            lastKnownWeight = weight;
                            return weight;
                        }
                        return lastKnownWeight;
                    });
                    
                    // If no weights at all, use questionnaire weight
                    if (finalWeights.every(w => w === null)) {
                        const questionnaireWeight = {{ Auth::user()->questionnaire->weight ?? 'null' }};
                        if (questionnaireWeight) {
                            finalWeights.fill(questionnaireWeight);
                        }
                    }

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Berat Badan (kg)',
                                data: finalWeights,
                                borderColor: '#f97316',
                                backgroundColor: 'rgba(249, 115, 22, 0.1)',
                                borderWidth: 3,
                                tension: 0.4,
                                fill: true,
                                pointBackgroundColor: '#f97316',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 2,
                                pointRadius: 6,
                                pointHoverRadius: 8,
                                spanGaps: true
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                    titleColor: '#ffffff',
                                    bodyColor: '#ffffff',
                                    borderColor: '#f97316',
                                    borderWidth: 1,
                                    cornerRadius: 8,
                                    callbacks: {
                                        label: function(context) {
                                            return `Berat: ${context.parsed.y} kg`;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: false,
                                    grid: {
                                        color: '#f3f4f6',
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: '#6b7280',
                                        font: {
                                            size: 12
                                        },
                                        callback: function(value) {
                                            return value + ' kg';
                                        }
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: '#6b7280',
                                        font: {
                                            size: 12
                                        }
                                    }
                                }
                            },
                            animation: {
                                duration: 2000,
                                easing: 'easeOutQuart'
                            }
                        }
                    });
                    console.log('Weight chart initialized');
                }

                function initWaterChart() {
                    const ctx = document.getElementById('waterChart');
                    if (!ctx) {
                        console.log('Water chart canvas not found');
                        return;
                    }                    // Water data from backend
                    const waterData = @json($user['waterIntake']['history'] ?? []);
                    const goal = @json($user['waterIntake']['goal'] ?? 2000);
                    
                    const filterDays = {{ $user['filterDays'] ?? 7 }};
                    const labels = Array.from({length: filterDays}, (_, i) => {
                        const date = new Date();
                        date.setDate(date.getDate() - (filterDays - 1 - i));
                        return date.toLocaleDateString('id-ID', { month: 'short', day: 'numeric' });
                    });
                    
                    // Map water data to chart dates
                    const amounts = Array.from({length: filterDays}, (_, i) => {
                        const date = new Date();
                        date.setDate(date.getDate() - (filterDays - 1 - i));
                        const dateStr = date.toISOString().split('T')[0];
                        
                        // Find water intake for this specific date
                        const waterEntry = waterData.find(item => item.date === dateStr);
                        return waterEntry ? waterEntry.amount : 0;
                    });

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Asupan Air (ml)',
                                data: amounts,
                                backgroundColor: 'rgba(59, 130, 246, 0.8)',
                                borderColor: '#3b82f6',
                                borderWidth: 1,
                                borderRadius: 8,
                                borderSkipped: false,                            }, {
                                label: 'Target',
                                data: Array(filterDays).fill(goal),
                                type: 'line',
                                borderColor: '#ef4444',
                                backgroundColor: 'transparent',
                                borderWidth: 2,
                                borderDash: [5, 5],
                                pointRadius: 0,
                                tension: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                    titleColor: '#ffffff',
                                    bodyColor: '#ffffff',
                                    borderColor: '#3b82f6',
                                    borderWidth: 1,
                                    cornerRadius: 8,
                                    callbacks: {
                                        label: function(context) {
                                            if (context.datasetIndex === 0) {
                                                return `Air: ${context.parsed.y.toLocaleString()} ml`;
                                            } else {
                                                return `Target: ${context.parsed.y.toLocaleString()} ml`;
                                            }
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: '#f3f4f6',
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: '#6b7280',
                                        font: {
                                            size: 12
                                        },
                                        callback: function(value) {
                                            return (value / 1000).toFixed(1) + 'L';
                                        }
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: '#6b7280',
                                        font: {
                                            size: 12
                                        }
                                    }
                                }
                            },
                            animation: {
                                duration: 2000,
                                easing: 'easeOutQuart'
                            }
                        }
                    });
                    console.log('Water chart initialized');
                }                function initMealChart() {
                    const ctx = document.getElementById('mealChart');
                    if (!ctx) {
                        console.log('Meal chart canvas not found');
                        return;
                    }                    // Meal data from backend
                    const mealData = @json($user['mealHistory'] ?? []);
                    
                    // Get target calories from nutrition recommendations
                    let targetCalories = 1800; // Default fallback
                    const nutritionData = @json($user['nutritionRecommendations'] ?? []);
                    if (nutritionData && nutritionData.calories) {
                        // Extract numeric value from string like "1,800 - 2,000"
                        const match = nutritionData.calories.match(/(\d+,?\d*)/);
                        if (match && match[1]) {
                            targetCalories = parseInt(match[1].replace(',', ''));
                        }
                    }
                    
                    const filterDays = {{ $user['filterDays'] ?? 7 }};
                    const labels = Array.from({length: filterDays}, (_, i) => {
                        const date = new Date();
                        date.setDate(date.getDate() - (filterDays - 1 - i));
                        return date.toLocaleDateString('id-ID', { month: 'short', day: 'numeric' });
                    });                    // Map meal data to chart dates
                    const calories = Array.from({length: filterDays}, (_, i) => {
                        const date = new Date();
                        date.setDate(date.getDate() - (filterDays - 1 - i));
                        const dateStr = date.toISOString().split('T')[0];
                        
                        // Find meal calories for this specific date
                        const mealEntry = mealData.find(item => item.date === dateStr);
                        return mealEntry ? mealEntry.calories : 0;
                    });

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Kalori Dikonsumsi',
                                data: calories,
                                backgroundColor: 'rgba(34, 197, 94, 0.8)',
                                borderColor: '#22c55e',
                                borderWidth: 1,
                                borderRadius: 8,
                                borderSkipped: false,                            }, {
                                label: 'Target Kalori',
                                data: Array(filterDays).fill(targetCalories),
                                type: 'line',
                                borderColor: '#ef4444',
                                backgroundColor: 'transparent',
                                borderWidth: 2,
                                borderDash: [5, 5],
                                pointRadius: 0,
                                tension: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                    titleColor: '#ffffff',
                                    bodyColor: '#ffffff',
                                    borderColor: '#22c55e',
                                    borderWidth: 1,
                                    cornerRadius: 8,
                                    callbacks: {
                                        label: function(context) {
                                            if (context.datasetIndex === 0) {
                                                return `Kalori: ${context.parsed.y} kal`;
                                            } else {
                                                return `Target: ${context.parsed.y} kal`;
                                            }
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: '#f3f4f6',
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: '#6b7280',
                                        font: {
                                            size: 12
                                        },
                                        callback: function(value) {
                                            return value + ' kal';
                                        }
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: '#6b7280',
                                        font: {
                                            size: 12
                                        }
                                    }
                                }
                            },
                            animation: {
                                duration: 2000,
                                easing: 'easeOutQuart'
                            }
                        }
                    });
                    console.log('Meal chart initialized');
                }                function initExerciseChart() {
                    const ctx = document.getElementById('exerciseChart');
                    if (!ctx) {
                        console.log('Exercise chart canvas not found');
                        return;
                    }                    // Exercise data from backend
                    const exerciseData = @json($user['exerciseHistory'] ?? []);
                    
                    const filterDays = {{ $user['filterDays'] ?? 7 }};
                    const labels = Array.from({length: filterDays}, (_, i) => {
                        const date = new Date();
                        date.setDate(date.getDate() - (filterDays - 1 - i));
                        return date.toLocaleDateString('id-ID', { month: 'short', day: 'numeric' });
                    });                    // Map exercise data to chart dates
                    const durations = Array.from({length: filterDays}, (_, i) => {
                        const date = new Date();
                        date.setDate(date.getDate() - (filterDays - 1 - i));
                        const dateStr = date.toISOString().split('T')[0];
                        
                        // Find exercise duration for this specific date
                        const exerciseEntry = exerciseData.find(item => item.date === dateStr);
                        return exerciseEntry ? exerciseEntry.duration : 0;
                    });
                    
                    const calories = Array.from({length: filterDays}, (_, i) => {
                        const date = new Date();
                        date.setDate(date.getDate() - (filterDays - 1 - i));
                        const dateStr = date.toISOString().split('T')[0];
                        
                        // Find exercise calories for this specific date
                        const exerciseEntry = exerciseData.find(item => item.date === dateStr);
                        return exerciseEntry ? exerciseEntry.calories : 0;
                    });

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Durasi (menit)',
                                data: durations,
                                backgroundColor: 'rgba(147, 51, 234, 0.8)',
                                borderColor: '#9333ea',
                                borderWidth: 1,
                                borderRadius: 8,
                                borderSkipped: false,
                                yAxisID: 'y'
                            }, {
                                label: 'Kalori Terbakar',
                                data: calories,
                                type: 'line',
                                borderColor: '#f59e0b',
                                backgroundColor: 'rgba(245, 158, 11, 0.1)',
                                borderWidth: 3,
                                tension: 0.4,
                                fill: true,
                                pointBackgroundColor: '#f59e0b',
                                pointBorderColor: '#ffffff',
                                pointBorderWidth: 2,
                                pointRadius: 5,
                                yAxisID: 'y1'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            interaction: {
                                mode: 'index',
                                intersect: false,
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                    titleColor: '#ffffff',
                                    bodyColor: '#ffffff',
                                    borderColor: '#9333ea',
                                    borderWidth: 1,
                                    cornerRadius: 8,
                                    callbacks: {
                                        label: function(context) {
                                            if (context.datasetIndex === 0) {
                                                return `Durasi: ${context.parsed.y} menit`;
                                            } else {
                                                return `Kalori: ${context.parsed.y} kal`;
                                            }
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    type: 'linear',
                                    display: true,
                                    position: 'left',
                                    beginAtZero: true,
                                    grid: {
                                        color: '#f3f4f6',
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: '#6b7280',
                                        font: {
                                            size: 12
                                        },
                                        callback: function(value) {
                                            return value + ' min';
                                        }
                                    }
                                },
                                y1: {
                                    type: 'linear',
                                    display: true,
                                    position: 'right',
                                    beginAtZero: true,
                                    grid: {
                                        drawOnChartArea: false,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: '#6b7280',
                                        font: {
                                            size: 12
                                        },
                                        callback: function(value) {
                                            return value + ' kal';
                                        }
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: '#6b7280',
                                        font: {
                                            size: 12
                                        }
                                    }
                                }
                            },
                            animation: {
                                duration: 2000,
                                easing: 'easeOutQuart'
                            }
                        }
                    });
                    console.log('Exercise chart initialized');                }
                
                // Profile tab enhancements
                function initProfileEnhancements() {
                    const heightInput = document.getElementById('height');
                    const weightInput = document.getElementById('weight');
                    const targetWeightInput = document.getElementById('target_weight');
                    
                    if (heightInput && weightInput) {
                        // BMI Calculator
                        function calculateBMI() {
                            const height = parseFloat(heightInput.value);
                            const weight = parseFloat(weightInput.value);
                            
                            if (height && weight && height > 0) {
                                const heightInMeters = height / 100;
                                const bmi = weight / (heightInMeters * heightInMeters);
                                
                                // Show BMI info
                                let bmiText = document.getElementById('bmi-info');
                                if (!bmiText) {
                                    bmiText = document.createElement('div');
                                    bmiText.id = 'bmi-info';
                                    bmiText.className = 'mt-2 p-2 bg-blue-50 rounded-lg text-sm';
                                    weightInput.parentNode.appendChild(bmiText);
                                }
                                
                                let category = '';
                                let categoryColor = '';
                                
                                if (bmi < 18.5) {
                                    category = 'Kekurangan berat badan';
                                    categoryColor = 'text-yellow-600';
                                } else if (bmi < 25) {
                                    category = 'Normal';
                                    categoryColor = 'text-green-600';
                                } else if (bmi < 30) {
                                    category = 'Kelebihan berat badan';
                                    categoryColor = 'text-orange-600';
                                } else {
                                    category = 'Obesitas';
                                    categoryColor = 'text-red-600';
                                }
                                
                                bmiText.innerHTML = `
                                    <div class="flex items-center justify-between">
                                        <span>BMI: <strong>${bmi.toFixed(1)}</strong></span>
                                        <span class="${categoryColor} font-medium">${category}</span>
                                    </div>
                                `;
                            }
                        }
                        
                        heightInput.addEventListener('input', calculateBMI);
                        weightInput.addEventListener('input', calculateBMI);
                        
                        // Initial calculation
                        calculateBMI();
                    }
                    
                    // Goal-based recommendations
                    const goalSelect = document.getElementById('goal');
                    if (goalSelect) {
                        goalSelect.addEventListener('change', function() {
                            const goal = this.value;
                            let recommendationText = '';
                            
                            switch(goal) {
                                case 'Weight loss':
                                    recommendationText = 'Disarankan: Defisit kalori 300-500 kkal/hari dengan kombinasi diet dan olahraga kardio.';
                                    break;
                                case 'Muscle gain':
                                    recommendationText = 'Disarankan: Surplus kalori 200-300 kkal/hari dengan fokus pada latihan kekuatan dan protein tinggi.';
                                    break;
                                case 'Maintain weight':
                                    recommendationText = 'Disarankan: Menjaga keseimbangan kalori dengan pola makan sehat dan olahraga rutin.';
                                    break;
                                case 'Improve fitness':
                                    recommendationText = 'Disarankan: Kombinasi kardio dan latihan kekuatan dengan peningkatan intensitas bertahap.';
                                    break;
                            }
                            
                            if (recommendationText) {
                                let recText = document.getElementById('goal-recommendation');
                                if (!recText) {
                                    recText = document.createElement('div');
                                    recText.id = 'goal-recommendation';
                                    recText.className = 'mt-2 p-3 bg-purple-50 rounded-lg text-sm text-purple-700';
                                    goalSelect.parentNode.appendChild(recText);
                                }
                                recText.textContent = recommendationText;
                            }
                        });
                    }                }
                
                // Function to apply date filter
                function applyDateFilter() {
                    const filterValue = document.getElementById('dateFilter').value;
                    const currentUrl = new URL(window.location.href);
                    currentUrl.searchParams.set('filter', filterValue);
                    currentUrl.searchParams.set('tab', 'progress');
                    
                    // Add loading state
                    const filterSelect = document.getElementById('dateFilter');
                    filterSelect.disabled = true;
                    filterSelect.style.opacity = '0.6';
                    
                    // Redirect with new filter
                    window.location.href = currentUrl.toString();
                }
                
                // Initialize all enhancements based on active tab
                document.addEventListener('DOMContentLoaded', function() {
                    const activeTab = '{{ $activeTab ?? 'profile' }}';
                    
                    if (activeTab === 'progress') {
                        setTimeout(() => {
                            initializeCharts();
                        }, 100);
                    } else if (activeTab === 'profile') {
                        setTimeout(() => {
                            initProfileEnhancements();
                        }, 100);
                    }
                    
                    // Initialize Lucide icons
                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }
                });
            </script>
        </div>
    </div>
@endsection