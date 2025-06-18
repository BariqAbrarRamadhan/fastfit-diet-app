@extends('user.layouts.app')

@section('title', 'Petunjuk Penggunaan')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-purple-50">
        <!-- Header Section -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 mb-8">
            <div class="text-center">
                <div
                    class="w-20 h-20 bg-gradient-to-r from-orange-400 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="help-circle" class="w-10 h-10 text-white"></i>
                </div>
                <h1
                    class="text-4xl font-bold bg-gradient-to-r from-orange-500 to-purple-600 bg-clip-text text-transparent mb-4">
                    Petunjuk Penggunaan FastFit
                </h1>
                <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                    Panduan lengkap untuk memulai perjalanan diet dan fitness Anda dengan aplikasi FastFit.
                    Ikuti langkah-langkah berikut untuk mendapatkan hasil maksimal dari program yang dipersonalisasi.
                </p>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
            <div class="flex flex-wrap justify-center gap-4">
                <button onclick="showSection('guide')" id="guide-tab"
                    class="tab-button px-6 py-3 rounded-lg font-medium transition-all duration-300 bg-gradient-to-r from-orange-500 to-purple-600 text-white">
                    <i data-lucide="map" class="w-4 h-4 mr-2 inline"></i>
                    Panduan Langkah
                </button>
                <!-- <button onclick="showSection('tips')" id="tips-tab"
                        class="tab-button px-6 py-3 rounded-lg font-medium transition-all duration-300 text-gray-600 hover:bg-gray-100">
                        <i data-lucide="lightbulb" class="w-4 h-4 mr-2 inline"></i>
                        Tips & Trik
                    </button>
                    <button onclick="showSection('faq')" id="faq-tab"
                        class="tab-button px-6 py-3 rounded-lg font-medium transition-all duration-300 text-gray-600 hover:bg-gray-100">
                        <i data-lucide="help-circle" class="w-4 h-4 mr-2 inline"></i>
                        FAQ
                    </button> -->
            </div>
        </div>

        <!-- Guide Steps Section -->
        <div id="guide-section" class="section-content">
            <div class="space-y-8">
                @foreach($guideSteps as $index => $step) <div
                        class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 step-card">
                        <div class="bg-gradient-to-r {{ $step['color'] }} p-6">
                            <div class="flex items-center text-white step-header"> <!-- Image Section -->
                                <div class="w-24 h-24 rounded-xl overflow-hidden mr-6 bg-white/20 backdrop-blur-sm flex-shrink-0 shadow-lg step-image-container"
                                    onclick="openImageModal('{{ asset($step['image']) }}', '{{ $step['title'] }}')">
                                    <img src="{{ asset($step['image']) }}"
                                        alt="Ilustrasi {{ $step['title'] }} - Langkah {{ $index + 1 }}"
                                        class="w-full h-full object-cover step-image" loading="lazy">
                                </div>

                                <div
                                    class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mr-4 shadow-md">
                                    <i data-lucide="{{ $step['icon'] }}" class="w-6 h-6"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <span
                                            class="bg-white/20 backdrop-blur-sm px-3 py-2 rounded-full text-sm font-medium mr-3 shadow-sm">
                                            Langkah {{ $index + 1 }}
                                        </span>
                                    </div>
                                    <h2 class="text-2xl font-bold">{{ $step['title'] }}</h2>
                                    <p class="text-white/90 mt-2">{{ $step['description'] }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="space-y-4">
                                @foreach($step['steps'] as $stepIndex => $stepDetail)
                                    <div class="flex items-start space-x-4 group">
                                        <div
                                            class="w-8 h-8 bg-gradient-to-r {{ $step['color'] }} rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                            <span class="text-white text-sm font-bold">{{ $stepIndex + 1 }}</span>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-gray-700 leading-relaxed group-hover:text-gray-900 transition-colors">
                                                {{ $stepDetail }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Tips Section -->
        <div id="tips-section" class="section-content hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($tips as $tip)
                    <div
                        class="bg-white rounded-xl shadow-lg border border-gray-100 p-6 hover:shadow-xl transition-all duration-300 group">
                        <div
                            class="w-12 h-12 bg-gradient-to-r from-orange-400 to-purple-500 rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <i data-lucide="{{ $tip['icon'] }}" class="w-6 h-6 text-white"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors">
                            {{ $tip['title'] }}
                        </h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $tip['description'] }}
                        </p>
                    </div>
                @endforeach
            </div>

            <!-- Additional Tips Section -->
            <div class="mt-12 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-6">
                    <div class="flex items-center text-white">
                        <i data-lucide="star" class="w-8 h-8 mr-3"></i>
                        <div>
                            <h2 class="text-2xl font-bold">Tips Sukses Jangka Panjang</h2>
                            <p class="text-green-100 mt-1">Kunci untuk mencapai dan mempertahankan hasil yang optimal</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Buat Rutinitas Harian</h4>
                                    <p class="text-gray-600 text-sm">Tetapkan waktu khusus untuk check-in, makan, dan
                                        olahraga</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Fokus pada Progress, Bukan Perfeksi</h4>
                                    <p class="text-gray-600 text-sm">Kemajuan kecil yang konsisten lebih baik dari target
                                        besar yang tidak tercapai</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Bangun Support System</h4>
                                    <p class="text-gray-600 text-sm">Libatkan keluarga dan teman untuk mendukung perjalanan
                                        Anda</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Rayakan Pencapaian Kecil</h4>
                                    <p class="text-gray-600 text-sm">Berikan reward untuk diri sendiri saat mencapai
                                        milestone</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Evaluasi dan Sesuaikan</h4>
                                    <p class="text-gray-600 text-sm">Lakukan review mingguan dan sesuaikan strategi jika
                                        diperlukan</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Jaga Motivasi</h4>
                                    <p class="text-gray-600 text-sm">Ingat alasan awal Anda memulai dan visualisasikan
                                        tujuan akhir</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div id="faq-section" class="section-content hidden">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6">
                    <div class="flex items-center text-white">
                        <i data-lucide="help-circle" class="w-8 h-8 mr-3"></i>
                        <div>
                            <h2 class="text-2xl font-bold">Frequently Asked Questions</h2>
                            <p class="text-indigo-100 mt-1">Pertanyaan yang sering diajukan pengguna</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        @foreach($faqs as $index => $faq)
                            <div class="border border-gray-200 rounded-xl overflow-hidden">
                                <button onclick="toggleFaq({{ $index }})"
                                    class="w-full text-left p-4 bg-gray-50 hover:bg-gray-100 transition-colors flex items-center justify-between group">
                                    <h3 class="font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors">
                                        {{ $faq['question'] }}
                                    </h3>
                                    <i data-lucide="chevron-down"
                                        class="w-5 h-5 text-gray-500 transform transition-transform duration-200"
                                        id="faq-icon-{{ $index }}"></i>
                                </button>
                                <div id="faq-answer-{{ $index }}" class="hidden p-4 bg-white border-t border-gray-200">
                                    <p class="text-gray-700 leading-relaxed">{{ $faq['answer'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Contact Support Section -->
            <div class="mt-8 bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                <div class="text-center">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-orange-400 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="mail" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Butuh Bantuan Lebih Lanjut?</h3>
                    <p class="text-gray-600 mb-4">
                        Jika Anda memiliki pertanyaan yang tidak terjawab di FAQ, jangan ragu untuk menghubungi tim support
                        kami.
                    </p>
                    <a href="mailto:support@fastfit.com"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-purple-600 text-white font-medium rounded-lg hover:from-orange-600 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i data-lucide="mail" class="w-4 h-4 mr-2"></i>
                        Hubungi Support
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Start CTA -->
        <div class="mt-12 bg-gradient-to-r from-orange-500 to-purple-600 rounded-xl shadow-xl p-8 text-center">
            <div class="text-white">
                <h2 class="text-3xl font-bold mb-4">Siap Memulai Perjalanan Anda?</h2>
                <p class="text-orange-100 mb-6 text-lg">
                    Sekarang Anda sudah memahami cara menggunakan FastFit. Saatnya memulai perjalanan diet dan fitness yang
                    lebih sehat!
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ url('/dashboard') }}"
                        class="inline-flex items-center px-8 py-4 bg-white text-orange-600 font-bold rounded-lg hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i data-lucide="arrow-right" class="w-5 h-5 mr-2"></i>
                        Mulai Sekarang
                    </a>
                    <a href="{{ url('/articles') }}"
                        class="inline-flex items-center px-8 py-4 bg-white/20 backdrop-blur-sm text-white font-bold rounded-lg hover:bg-white/30 transition-all duration-300 border border-white/30">
                        <i data-lucide="book-open" class="w-5 h-5 mr-2"></i>
                        Baca Artikel
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal"
        class="fixed inset-0 bg-black/75 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-[90vh] w-full">
            <button onclick="closeImageModal()"
                class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors">
                <i data-lucide="x" class="w-8 h-8"></i>
            </button>
            <div class="bg-white rounded-xl p-4 shadow-2xl">
                <img id="modalImage" src="" alt="" class="w-full h-auto max-h-[70vh] object-contain rounded-lg">
                <div class="mt-4 text-center">
                    <h3 id="modalTitle" class="text-xl font-bold text-gray-900"></h3>
                    <p class="text-gray-600 mt-1">Klik di luar gambar untuk menutup</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .tab-button.active {
            background: linear-gradient(to right, #f97316, #9333ea);
            color: white;
        }

        .section-content {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .step-image {
            transition: transform 0.3s ease, filter 0.3s ease;
        }

        .step-image:hover {
            transform: scale(1.05);
            filter: brightness(1.1);
        }

        .step-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .step-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .step-image-container {
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .step-image-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            z-index: 1;
            transition: opacity 0.3s ease;
        }

        .step-image-container:hover::before {
            opacity: 0;
        }

        .step-image-container::after {
            content: '🔍';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 2;
        }

        .step-image-container:hover::after {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .step-header {
                flex-direction: column;
                text-align: center;
            }

            .step-header .w-24 {
                width: 20rem;
                height: 12rem;
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .step-image-container {
                width: 100%;
                max-width: 200px;
                height: 120px;
                margin: 0 auto 1rem;
            }
        }
    </style>
    <script>
        function openImageModal(imageSrc, title) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const modalTitle = document.getElementById('modalTitle');

            modalImage.src = imageSrc;
            modalImage.alt = title;
            modalTitle.textContent = title;

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            // Close modal when clicking outside the image
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    closeImageModal();
                }
            });
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });

        function showSection(section) {
            // Hide all sections
            document.querySelectorAll('.section-content').forEach(el => {
                el.classList.add('hidden');
            });

            // Remove active class from all tabs
            document.querySelectorAll('.tab-button').forEach(el => {
                el.classList.remove('bg-gradient-to-r', 'from-orange-500', 'to-purple-600', 'text-white');
                el.classList.add('text-gray-600', 'hover:bg-gray-100');
            });

            // Show selected section
            document.getElementById(section + '-section').classList.remove('hidden');

            // Add active class to selected tab
            const activeTab = document.getElementById(section + '-tab');
            activeTab.classList.add('bg-gradient-to-r', 'from-orange-500', 'to-purple-600', 'text-white');
            activeTab.classList.remove('text-gray-600', 'hover:bg-gray-100');
        }

        function toggleFaq(index) {
            const answer = document.getElementById(`faq-answer-${index}`);
            const icon = document.getElementById(`faq-icon-${index}`);

            if (answer.classList.contains('hidden')) {
                answer.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                answer.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }

        // Initialize Lucide icons when page loads
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
@endsection