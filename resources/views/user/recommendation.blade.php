@extends('user.layouts.app')

@section('title', 'Rekomendasi Program')

@section('content')
    <div class="min-h-screen">
        <div class="mx-auto px-6 lg:px-6 py-8">
            <!-- Enhanced Header with Back Button -->
            <div class="flex items-center mb-8">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center justify-center w-12 h-12 bg-white/70 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 text-gray-600 hover:text-orange-500 transition-all duration-300 mr-4 group">
                    <i data-lucide="arrow-left" class="w-6 h-6 group-hover:scale-110 transition-transform"></i>
                </a>
                <div>
                    <h1
                        class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent">
                        Rekomendasi Program Anda
                    </h1>
                    <p class="text-gray-600 mt-1">Program diet dan olahraga yang dipersonalisasi untuk Anda</p>
                </div>
            </div>

            <!-- Success Animation & Content -->
            <div class="max-w-4xl mx-auto">
                <!-- Success Icon with Animation -->
                <div class="text-center mb-8">
                    <div class="relative inline-block">
                        <div
                            class="w-32 h-32 bg-gradient-to-r from-green-400 to-emerald-500 rounded-full mx-auto flex items-center justify-center shadow-2xl transform hover:scale-105 transition-all duration-300">
                            <i data-lucide="check-circle-2" class="w-16 h-16 text-white"></i>
                        </div>
                        <!-- Floating particles animation -->
                        <div class="absolute -top-2 -right-2 w-4 h-4 bg-yellow-400 rounded-full animate-bounce"></div>
                        <div class="absolute -bottom-2 -left-2 w-3 h-3 bg-blue-400 rounded-full animate-pulse"></div>
                        <div class="absolute top-4 -left-4 w-2 h-2 bg-pink-400 rounded-full animate-ping"></div>
                    </div>
                    <div class="mt-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Selamat! Analisis Selesai</h2>
                        <p class="text-gray-600 max-w-2xl mx-auto leading-relaxed">
                            Berdasarkan data kuesioner Anda, berikut adalah rekomendasi program diet dan olahraga yang telah
                            dipersonalisasi untuk mencapai tujuan kesehatan Anda.
                        </p>
                    </div>
                </div> @if (session('success'))
                    <div
                        class="bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200 text-green-800 px-6 py-4 rounded-2xl max-w-2xl mx-auto mb-8 shadow-lg">
                        <div class="flex items-center">
                            <i data-lucide="check-circle" class="w-6 h-6 text-green-600 mr-3"></i>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Recommendations Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Rekomendasi Diet Card -->
                    <div
                        class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
                        <div class="bg-gradient-to-r from-orange-500 to-red-500 p-6">
                            <div class="flex items-center text-white">
                                <div
                                    class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-4">
                                    <i data-lucide="utensils" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold">Program Diet</h3>
                                    <p class="text-orange-100 text-sm">Nutrisi yang tepat untuk tubuh Anda</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            @if (!empty($recommendations['diets']))
                                <div class="space-y-4">
                                    <div class="flex items-start">
                                        <div
                                            class="w-8 h-8 bg-gradient-to-r from-orange-400 to-red-500 rounded-full flex items-center justify-center mr-3 mt-1">
                                            <i data-lucide="star" class="w-4 h-4 text-white"></i>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="text-lg font-bold text-gray-800 mb-2">{{ $recommendations['diets'][0] }}
                                            </h4>
                                            <div class="text-gray-600 text-sm leading-relaxed">
                                                @if ($recommendations['diets'][0] == 'Diet DASH')
                                                    <p>Rendah natrium dengan fokus pada sayuran, buah-buahan, biji-bijian utuh, dan
                                                        protein rendah lemak. Sangat efektif untuk mengelola hipertensi dan
                                                        mendukung kesehatan jantung.</p>
                                                @elseif ($recommendations['diets'][0] == 'Diet Mediterania')
                                                    <p>Kaya akan lemak sehat seperti minyak zaitun dan kacang-kacangan, sayuran
                                                        segar, ikan, dan biji-bijian. Terbukti mendukung kesehatan jantung dan umur
                                                        panjang.</p>
                                                @elseif ($recommendations['diets'][0] == 'Diet Rendah Lemak')
                                                    <p>Mengurangi asupan lemak jenuh, cocok untuk mengelola dislipidemia.
                                                        Mengutamakan daging tanpa lemak, susu rendah lemak, dan makanan rendah
                                                        kolesterol.</p>
                                                @elseif ($recommendations['diets'][0] == 'Diet Rendah Karbohidrat')
                                                    <p>Mengurangi karbohidrat sederhana dan mengoptimalkan protein serta lemak sehat
                                                        untuk mendukung penurunan berat badan yang efektif.</p>
                                                @elseif ($recommendations['diets'][0] == 'Pola Makan Seimbang')
                                                    <p>Kombinasi seimbang dari semua kelompok makanan - karbohidrat, protein, lemak
                                                        sehat, sayuran, dan buah-buahan untuk kesehatan optimal.</p>
                                                @elseif ($recommendations['diets'][0] == 'Konsultasi Medis')
                                                    <p>Kondisi kesehatan Anda memerlukan evaluasi medis profesional sebelum memulai
                                                        program diet tertentu.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <i data-lucide="info" class="w-12 h-12 text-gray-400 mx-auto mb-4"></i>
                                    <p class="text-gray-600">Tidak ada rekomendasi diet spesifik berdasarkan data Anda saat ini.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Rekomendasi Olahraga Card -->
                    <div
                        class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden transform hover:scale-[1.02] transition-all duration-300">
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-6">
                            <div class="flex items-center text-white">
                                <div
                                    class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-4">
                                    <i data-lucide="dumbbell" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold">Program Olahraga</h3>
                                    <p class="text-purple-100 text-sm">Aktivitas fisik untuk mencapai tujuan Anda</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            @if (!empty($recommendations['exercise']))
                                <div class="space-y-3">
                                    @foreach ($recommendations['exercise'] as $index => $item)
                                        <div class="flex items-start">
                                            <div
                                                class="w-6 h-6 bg-gradient-to-r from-purple-400 to-purple-600 rounded-full flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                                <span class="text-white text-xs font-bold">{{ $index + 1 }}</span>
                                            </div>
                                            <p class="text-gray-600 text-sm leading-relaxed">{{ $item }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <i data-lucide="activity" class="w-12 h-12 text-gray-400 mx-auto mb-4"></i>
                                    <p class="text-gray-600">Tidak ada rekomendasi olahraga spesifik saat ini.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div> <!-- Catatan Penting -->
                @if (!empty($recommendations['notes']))
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 overflow-hidden mb-8">
                        <div class="bg-gradient-to-r from-amber-500 to-orange-500 p-6">
                            <div class="flex items-center text-white">
                                <div
                                    class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-4">
                                    <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold">Catatan Penting</h3>
                                    <p class="text-orange-100 text-sm">Hal-hal yang perlu diperhatikan</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                @foreach ($recommendations['notes'] as $index => $note)
                                    <div class="flex items-start">
                                        <div
                                            class="w-6 h-6 bg-gradient-to-r from-amber-400 to-orange-500 rounded-full flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                            <i data-lucide="info" class="w-3 h-3 text-white"></i>
                                        </div>
                                        <p class="text-gray-600 text-sm leading-relaxed">{{ $note }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('dashboard') }}"
                        class="group px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-2xl text-lg font-semibold hover:from-orange-600 hover:to-red-600 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-2xl flex items-center">
                        <i data-lucide="home" class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform"></i>
                        Ke Dashboard
                    </a>

                    <a href="{{ route('diet.info') }}"
                        class="group px-8 py-4 bg-white border-2 border-orange-300 text-orange-600 rounded-2xl text-lg font-semibold hover:bg-orange-50 hover:border-orange-400 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center">
                        <i data-lucide="book-open" class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform"></i>
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>

        <!-- Enhanced Footer -->
        <footer class="bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-200 py-8 mt-16">
            <div class="container mx-auto px-4 lg:px-6">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="flex items-center mb-4 md:mb-0">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-orange-500 to-purple-600 rounded-xl flex items-center justify-center mr-3">
                            <i data-lucide="heart" class="w-5 h-5 text-white"></i>
                        </div>
                        <div>
                            <p class="text-gray-800 font-semibold">Platform Diet & Olahraga</p>
                            <p class="text-gray-600 text-sm">Tugas Akhir {{ now()->year }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-6 text-sm text-gray-600">
                        <span class="flex items-center">
                            <i data-lucide="shield-check" class="w-4 h-4 mr-2 text-green-500"></i>
                            Data Terlindungi
                        </span>
                        <span class="flex items-center">
                            <i data-lucide="award" class="w-4 h-4 mr-2 text-blue-500"></i>
                            Rekomendasi Terpercaya
                        </span>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Add smooth scroll animation for better UX
        document.addEventListener('DOMContentLoaded', function () {
            // Animate cards on load
            const cards = document.querySelectorAll('.transform');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease-out';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 200);
            });
        });
    </script>
@endsection