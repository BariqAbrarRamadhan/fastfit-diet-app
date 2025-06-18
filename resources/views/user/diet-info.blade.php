@extends('user.layouts.app')

@section('title', 'Informasi Diet & Olahraga')

@section('content')
    <div class="min-h-screen py-8">
        <div class="mx-auto px-6 lg:px-6">
            <!-- Enhanced Header -->
            <div class="flex items-center mb-8">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center justify-center w-10 h-10 bg-white/70 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 text-gray-600 hover:text-orange-500 transition-all duration-300 mr-4 group">
                    <i data-lucide="arrow-left" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                </a>
                <div>
                    <h1
                        class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent mb-2">
                        Informasi Diet & Olahraga
                    </h1>
                    <p class="text-gray-600">Panduan lengkap untuk mencapai gaya hidup sehat</p>
                </div>
            </div> <!-- Enhanced Tab Navigation -->
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden mb-8">
                <div class="flex border-b border-gray-200/50">
                    <a href="{{ route('diet.info', ['tab' => 'diet']) }}"
                        class="flex-1 px-6 py-4 font-semibold text-center transition-all duration-300 {{ $tab === 'diet' ? 'text-orange-500 bg-gradient-to-r from-orange-50/50 to-orange-100/50 border-b-3 border-orange-500 shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50/50' }}">
                        <div class="flex items-center justify-center">
                            <i data-lucide="utensils" class="w-5 h-5 mr-2"></i>
                            Program Diet
                        </div>
                    </a>
                    <a href="{{ route('diet.info', ['tab' => 'exercise']) }}"
                        class="flex-1 px-6 py-4 font-semibold text-center transition-all duration-300 {{ $tab === 'exercise' ? 'text-purple-600 bg-gradient-to-r from-purple-50/50 to-purple-100/50 border-b-3 border-purple-600 shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50/50' }}"
                        id="exercise">
                        <div class="flex items-center justify-center">
                            <i data-lucide="dumbbell" class="w-5 h-5 mr-2"></i>
                            Rekomendasi Olahraga
                        </div>
                    </a>
                </div>

                @if($tab === 'diet')
                    <div class="p-6">
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Program Diet</h2>
                            <p class="text-gray-600">
                                Berikut adalah rekomendasi diet yang disesuaikan untuk Anda berdasarkan kuesioner, serta program
                                diet lain yang mungkin menarik.
                            </p>
                        </div> <!-- Rekomendasi Pengguna -->
                        <div class="mb-12">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-10 h-10 bg-gradient-to-r from-orange-400 to-orange-500 rounded-xl flex items-center justify-center mr-3">
                                    <i data-lucide="star" class="w-5 h-5 text-white"></i>
                                </div>
                                <h3
                                    class="text-xl font-bold bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent">
                                    Rekomendasi Diet Anda
                                </h3>
                            </div>
                            @if(!empty($recommendedDiets))
                                @foreach($dietPrograms as $program)
                                    @if($program['title'] === $recommendedDiets[0])
                                        <div
                                            class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
                                            <div class="relative h-48 md:h-64 overflow-hidden">
                                                <img src="{{ $program['image'] }}" alt="{{ $program['title'] }}"
                                                    class="object-cover w-full h-full transform hover:scale-110 transition-transform duration-500">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent">
                                                </div>
                                                <div class="absolute top-4 right-4">
                                                    <span
                                                        class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                                        Rekomendasi
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="p-8">
                                                <h4
                                                    class="text-2xl font-bold bg-gradient-to-r from-orange-500 to-orange-600 bg-clip-text text-transparent mb-3">
                                                    {{ $program['title'] }}
                                                </h4>
                                                <p class="text-gray-600 mb-6 leading-relaxed">{{ $program['description'] }}</p>
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                    @foreach($program['details'] as $detail)
                                                        <div
                                                            class="bg-gradient-to-br from-orange-50/50 to-orange-100/30 rounded-xl p-4 border border-orange-200/30">
                                                            <h5 class="font-semibold text-gray-800 mb-2 flex items-center">
                                                                <div
                                                                    class="w-2 h-2 bg-gradient-to-r from-orange-400 to-orange-500 rounded-full mr-2">
                                                                </div>
                                                                {{ $detail['title'] }}
                                                            </h5>
                                                            <p class="text-gray-600 text-sm leading-relaxed">{{ $detail['content'] }}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!-- Catatan Konsultasi -->
                                                @if(!empty($notes))
                                                    <div
                                                        class="mt-6 bg-gradient-to-br from-yellow-50/50 to-amber-50/50 rounded-xl p-4 border border-yellow-200/30">
                                                        <h5 class="font-semibold text-gray-800 mb-3 flex items-center">
                                                            <i data-lucide="lightbulb" class="w-4 h-4 text-amber-500 mr-2"></i>
                                                            Catatan Tambahan
                                                        </h5>
                                                        <ul class="space-y-2">
                                                            @foreach($notes as $note)
                                                                <li class="flex items-start text-gray-600 text-sm">
                                                                    <div class="w-1.5 h-1.5 bg-amber-400 rounded-full mt-2 mr-3 flex-shrink-0">
                                                                    </div>
                                                                    <span class="leading-relaxed">{{ $note }}</span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div
                                    class="bg-gradient-to-br from-orange-50/80 to-orange-100/60 backdrop-blur-sm border-2 border-orange-200/50 rounded-2xl p-8 text-center shadow-lg">
                                    <div
                                        class="w-16 h-16 bg-gradient-to-r from-orange-400 to-orange-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                        <i data-lucide="clipboard-list" class="w-8 h-8 text-white"></i>
                                    </div>
                                    <h4 class="text-xl font-bold text-gray-800 mb-2">Dapatkan Rekomendasi Personal</h4>
                                    <p class="text-gray-600 mb-6">Lengkapi kuesioner untuk mendapatkan rekomendasi diet yang sesuai
                                        dengan kebutuhan dan gaya hidup Anda.</p>
                                    <a href="{{ route('questionnaire.index') }}"
                                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-xl hover:from-orange-600 hover:to-orange-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                        <i data-lucide="arrow-right" class="w-5 h-5 mr-2"></i>
                                        Isi Kuesioner Sekarang
                                    </a>
                                </div>
                            @endif
                        </div>
                        <!-- Lihat Juga -->
                        @if(!empty($otherDiets))
                            <div>
                                <div class="flex items-center mb-6">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-r from-orange-400 to-purple-500 rounded-xl flex items-center justify-center mr-3">
                                        <i data-lucide="grid-3x3" class="w-5 h-5 text-white"></i>
                                    </div>
                                    <h3
                                        class="text-xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent">
                                        Lihat Juga Rekomendasi Jenis Diet Lainnya
                                    </h3>
                                </div>
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                    @foreach($otherDiets as $index => $program)
                                        <div
                                            class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden transform hover:scale-[1.02] transition-all duration-300 group">
                                            <div class="relative h-48 overflow-hidden">
                                                <img src="{{ $program['image'] }}" alt="{{ $program['title'] }}"
                                                    class="object-cover w-full h-full transform group-hover:scale-110 transition-transform duration-500">
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent">
                                                </div>
                                                <div class="absolute top-4 right-4">
                                                    <span
                                                        class="bg-gradient-to-r from-gray-600 to-gray-700 text-white px-3 py-1 rounded-full text-sm font-medium">
                                                        Alternatif {{ $index + 1 }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="p-6">
                                                <h4
                                                    class="text-xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent mb-3">
                                                    {{ $program['title'] }}
                                                </h4>
                                                <p class="text-gray-600 mb-4 leading-relaxed">{{ $program['description'] }}</p>
                                                <div class="space-y-3">
                                                    @foreach($program['details'] as $detail)
                                                        <div
                                                            class="bg-gradient-to-br from-gray-50/50 to-gray-100/30 rounded-xl p-4 border border-gray-200/30">
                                                            <h5 class="font-semibold text-gray-800 mb-2 flex items-center">
                                                                <div
                                                                    class="w-2 h-2 bg-gradient-to-r from-orange-400 to-purple-500 rounded-full mr-2">
                                                                </div>
                                                                {{ $detail['title'] }}
                                                            </h5>
                                                            <p class="text-gray-600 text-sm leading-relaxed">{{ $detail['content'] }}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
                @if($tab === 'exercise')
                    <div class="p-8">
                        <div class="mb-8">
                            <div class="flex items-center mb-4">
                                <div
                                    class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mr-4">
                                    <i data-lucide="dumbbell" class="w-6 h-6 text-white"></i>
                                </div>
                                <div>
                                    <h2
                                        class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-purple-700 bg-clip-text text-transparent">
                                        Rekomendasi Olahraga
                                    </h2>
                                    <p class="text-gray-600 mt-1">Program latihan untuk mencapai tujuan kesehatan Anda</p>
                                </div>
                            </div>
                            <div
                                class="bg-gradient-to-br from-purple-50/50 to-purple-100/30 rounded-xl p-4 border border-purple-200/30">
                                <p class="text-gray-600 leading-relaxed">
                                    Olahraga teratur adalah komponen penting dari gaya hidup sehat. Berikut adalah beberapa
                                    rekomendasi
                                    olahraga yang dapat membantu Anda mencapai tujuan kesehatan dan kebugaran Anda.
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            @foreach($exerciseRecommendations as $index => $exercise)
                                <div
                                    class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden transform hover:scale-[1.02] transition-all duration-300 group">
                                    <div class="relative h-48 overflow-hidden">
                                        <img src="{{ $exercise['image'] }}" alt="{{ $exercise['title'] }}"
                                            class="object-cover w-full h-full transform group-hover:scale-110 transition-transform duration-500">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent">
                                        </div>
                                        <div class="absolute top-4 left-4">
                                            <span
                                                class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                                                #{{ $index + 1 }}
                                            </span>
                                        </div>
                                        <div class="absolute bottom-4 left-4">
                                            <div class="flex items-center space-x-2">
                                                <div
                                                    class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                                    <i data-lucide="clock" class="w-4 h-4 text-white"></i>
                                                </div>
                                                <span class="text-white text-sm font-medium">Recommended</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <h3
                                            class="text-xl font-bold bg-gradient-to-r from-purple-600 to-purple-700 bg-clip-text text-transparent mb-3">
                                            {{ $exercise['title'] }}
                                        </h3>
                                        <p class="text-gray-600 mb-6 leading-relaxed">{{ $exercise['description'] }}</p>

                                        <div class="space-y-4">
                                            @foreach($exercise['details'] as $detail)
                                                <div
                                                    class="bg-gradient-to-br from-purple-50/50 to-purple-100/30 rounded-xl p-4 border border-purple-200/30">
                                                    <h4 class="font-semibold text-gray-800 mb-2 flex items-center">
                                                        <div
                                                            class="w-2 h-2 bg-gradient-to-r from-purple-400 to-purple-500 rounded-full mr-2">
                                                        </div>
                                                        {{ $detail['title'] }}
                                                    </h4>
                                                    <p class="text-gray-600 text-sm leading-relaxed">{{ $detail['content'] }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <!-- Enhanced Important Notes Section -->
            <!-- <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8 mb-8">
                <div class="flex items-center mb-6">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-amber-400 to-orange-500 rounded-2xl flex items-center justify-center mr-4">
                        <i data-lucide="shield-alert" class="w-6 h-6 text-white"></i>
                    </div>
                    <div>
                        <h2
                            class="text-2xl font-bold bg-gradient-to-r from-amber-500 to-orange-600 bg-clip-text text-transparent">
                            Catatan Penting
                        </h2>
                        <p class="text-gray-600 mt-1">Hal-hal yang perlu diperhatikan sebelum memulai program</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gradient-to-br from-red-50/50 to-red-100/30 rounded-xl p-6 border border-red-200/30">
                        <div class="flex items-start">
                            <div
                                class="w-8 h-8 bg-gradient-to-r from-red-400 to-red-500 rounded-lg flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                <i data-lucide="user-check" class="w-4 h-4 text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 mb-2">Konsultasi dengan Profesional</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Sebelum memulai program diet atau olahraga baru, terutama jika Anda memiliki kondisi
                                    kesehatan tertentu, konsultasikan dengan dokter atau ahli gizi.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50/50 to-blue-100/30 rounded-xl p-6 border border-blue-200/30">
                        <div class="flex items-start">
                            <div
                                class="w-8 h-8 bg-gradient-to-r from-blue-400 to-blue-500 rounded-lg flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                <i data-lucide="users" class="w-4 h-4 text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 mb-2">Pendekatan Individual</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Setiap orang memiliki kebutuhan dan respons yang berbeda terhadap diet dan olahraga.
                                    Sesuaikan dengan kondisi tubuh Anda.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-br from-green-50/50 to-green-100/30 rounded-xl p-6 border border-green-200/30">
                        <div class="flex items-start">
                            <div
                                class="w-8 h-8 bg-gradient-to-r from-green-400 to-green-500 rounded-lg flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                <i data-lucide="trending-up" class="w-4 h-4 text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 mb-2">Perubahan Bertahap</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Lakukan perubahan secara bertahap dan berkelanjutan. Perubahan kecil yang konsisten
                                    lebih efektif daripada perubahan drastis.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-br from-purple-50/50 to-purple-100/30 rounded-xl p-6 border border-purple-200/30">
                        <div class="flex items-start">
                            <div
                                class="w-8 h-8 bg-gradient-to-r from-purple-400 to-purple-500 rounded-lg flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                <i data-lucide="balance-scale" class="w-4 h-4 text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 mb-2">Keseimbangan</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Fokus pada keseimbangan dan keberlanjutan, bukan diet ketat jangka pendek. Gaya hidup
                                    sehat adalah marathon, bukan sprint.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- Enhanced Related Articles Section -->
            <!-- <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8">
                <div class="flex items-center mb-6">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mr-4">
                        <i data-lucide="book-open" class="w-6 h-6 text-white"></i>
                    </div>
                    <div>
                        <h2
                            class="text-2xl font-bold bg-gradient-to-r from-indigo-500 to-purple-600 bg-clip-text text-transparent">
                            Artikel Terkait
                        </h2>
                        <p class="text-gray-600 mt-1">Baca artikel menarik untuk menambah wawasan Anda</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <a href="{{ url('/articles/1') }}" class="group block">
                        <div
                            class="bg-gradient-to-br from-orange-50/50 to-orange-100/30 rounded-xl p-6 border border-orange-200/30 hover:border-orange-300/50 transition-all duration-300 transform hover:scale-[1.02]">
                            <div class="flex items-start">
                                <div
                                    class="w-16 h-16 bg-gradient-to-r from-orange-400 to-orange-500 rounded-xl flex-shrink-0 flex items-center justify-center mr-4">
                                    <i data-lucide="apple" class="w-8 h-8 text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <h3
                                        class="font-bold text-gray-900 group-hover:text-orange-600 transition-colors mb-2 leading-tight">
                                        10 Makanan Sehat untuk Menurunkan Berat Badan
                                    </h3>
                                    <p class="text-sm text-gray-600 leading-relaxed mb-3">
                                        Pelajari makanan yang dapat membantu program diet Anda dengan cara yang alami dan
                                        sehat...
                                    </p>
                                    <div class="flex items-center text-orange-500 text-sm font-medium">
                                        <span>Baca Selengkapnya</span>
                                        <i data-lucide="arrow-right"
                                            class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="{{ url('/articles/2') }}" class="group block">
                        <div
                            class="bg-gradient-to-br from-purple-50/50 to-purple-100/30 rounded-xl p-6 border border-purple-200/30 hover:border-purple-300/50 transition-all duration-300 transform hover:scale-[1.02]">
                            <div class="flex items-start">
                                <div
                                    class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl flex-shrink-0 flex items-center justify-center mr-4">
                                    <i data-lucide="zap" class="w-8 h-8 text-white"></i>
                                </div>
                                <div class="flex-1">
                                    <h3
                                        class="font-bold text-gray-900 group-hover:text-purple-600 transition-colors mb-2 leading-tight">
                                        Panduan Latihan HIIT untuk Pemula
                                    </h3>
                                    <p class="text-sm text-gray-600 leading-relaxed mb-3">
                                        Cara memulai latihan intensitas tinggi dengan aman dan efektif untuk hasil
                                        maksimal...
                                    </p>
                                    <div class="flex items-center text-purple-600 text-sm font-medium">
                                        <span>Baca Selengkapnya</span>
                                        <i data-lucide="arrow-right"
                                            class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div> -->
        </div>

        <script>
            lucide.createIcons();
        </script>
@endsection