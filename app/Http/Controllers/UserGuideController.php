<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserGuideController extends Controller
{
    /**
     * Display the user guide page.
     */
    public function index()
    {
        $guideSteps = [
            [
                'title' => 'Membuat Akun dan Login',
                'description' => 'Langkah pertama untuk memulai perjalanan diet dan fitness Anda',
                'icon' => 'user-plus',
                'color' => 'from-blue-500 to-cyan-600',
                'image' => '/images/guide-step-1.svg',
                'steps' => [
                    'Daftar akun baru dengan email dan password yang valid',
                    'Login ke aplikasi menggunakan email dan password yang telah dibuat',
                    'Pastikan informasi akun Anda sudah lengkap dan benar'
                ]
            ],
            [
                'title' => 'Mengisi Kuesioner Awal',
                'description' => 'Informasi penting untuk mendapatkan rekomendasi yang tepat',
                'icon' => 'clipboard-list',
                'color' => 'from-green-500 to-emerald-600',
                'image' => '/images/guide-step-2.svg',
                'steps' => [
                    'Isi kuesioner dengan data diri yang akurat (tinggi, berat badan, usia)',
                    'Pilih tujuan diet Anda (menurunkan berat badan, memantau berat badan, menambah massa otot)',
                    'Tentukan tingkat aktivitas harian Anda',
                    'Pilih preferensi makanan dan pantangan yang Anda miliki',
                    'Jawab pertanyaan kesehatan umum dengan jujur'
                ]
            ],
            [
                'title' => 'Memahami Dashboard Utama',
                'description' => 'Pusat kontrol untuk memantau progress harian Anda',
                'icon' => 'layout-dashboard',
                'color' => 'from-orange-500 to-red-500',
                'image' => '/images/guide-step-3.svg',
                'steps' => [
                    'Check-in harian: Catat berat badan setiap pagi',
                    'Progress harian: Lihat perkembangan dari hari ke hari',
                    'Pelacakan air minum: Catat konsumsi air dengan target harian',
                    'Rekomendasi makanan: Lihat menu yang disarankan untuk hari ini',
                    'Rekomendasi olahraga: Pilih dan catat aktivitas fisik',
                    'Metrik kesehatan: Monitor statistik kesehatan Anda',
                    'Artikel terbaru: Baca tips dan informasi berguna'
                ]
            ],
            [
                'title' => 'Menggunakan Fitur Pelacakan',
                'description' => 'Cara efektif memantau asupan dan aktivitas harian',
                'icon' => 'activity',
                'color' => 'from-purple-500 to-indigo-600',
                'image' => '/images/guide-step-4.svg',
                'steps' => [
                    'Catat berat badan setiap pagi di waktu yang sama',
                    'Tandai makanan yang sudah dikonsumsi sesuai rekomendasi',
                    'Tambahkan asupan air minum sepanjang hari',
                    'Log aktivitas olahraga dengan durasi dan intensitas',
                    'Gunakan navigasi hari untuk melihat progress di rentang tujuh hari',
                ]
            ],
            [
                'title' => 'Mengikuti Rekomendasi Program Diet',
                'description' => 'Mendapatkan hasil maksimal dari program yang dipersonalisasi',
                'icon' => 'target',
                'color' => 'from-pink-500 to-rose-600',
                'image' => '/images/mediterranean.jpg',
                'steps' => [
                    'Ikuti rekomendasi makanan yang diberikan sistem',
                    'Patuhi jadwal makan (sarapan, makan siang, makan malam, snack)',
                    'Perhatikan porsi dan kalori yang disarankan',
                    'Konsumsi air sesuai target harian (biasanya 8-10 gelas)',
                    'Lakukan olahraga sesuai rekomendasi dan kemampuan',
                    'Catat semua aktivitas untuk tracking yang akurat'
                ]
            ],
            [
                'title' => 'Membaca dan Memahami Informasi Diet',
                'description' => 'Mendalami pengetahuan tentang nutrisi dan diet sehat',
                'icon' => 'book-open',
                'color' => 'from-cyan-500 to-blue-600',
                'image' => '/images/guide-step-6.svg',
                'steps' => [
                    'Baca artikel-artikel yang disediakan di menu Artikel',
                    'Pelajari informasi detail tentang berbagai jenis diet',
                    'Pahami prinsip-prinsip diet yang Anda jalani',
                    'Terapkan tips dan saran yang diberikan dalam artikel',
                    'Konsultasikan dengan ahli gizi jika diperlukan'
                ]
            ],
            [
                'title' => 'Monitoring Progress dan Evaluasi',
                'description' => 'Memantau kemajuan dan melakukan penyesuaian jika diperlukan',
                'icon' => 'trending-up',
                'color' => 'from-emerald-500 to-green-600',
                'image' => '/images/guide-step-7.svg',
                'steps' => [
                    'Pantau grafik berat badan mingguan dan bulanan',
                    'Evaluasi konsistensi dalam mengikuti program',
                    'Perhatikan perubahan BMI dan kategori kesehatan',
                    'Catat perasaan dan energi harian',
                    'Lakukan penyesuaian program jika tidak ada progress setelah 2-3 minggu',
                    'Konsultasikan hasil dengan profesional kesehatan'
                ]
            ]
        ];

        $tips = [
            [
                'title' => 'Konsistensi adalah Kunci',
                'description' => 'Lakukan tracking setiap hari pada waktu yang sama untuk hasil terbaik',
                'icon' => 'clock'
            ],
            [
                'title' => 'Jangan Terlalu Ketat',
                'description' => 'Berikan ruang untuk fleksibilitas dan jangan stres jika sesekali melenceng',
                'icon' => 'heart'
            ],
            [
                'title' => 'Hidrasi yang Cukup',
                'description' => 'Air putih adalah kunci utama dalam program diet dan kesehatan',
                'icon' => 'droplets'
            ],
            [
                'title' => 'Olahraga Bertahap',
                'description' => 'Mulai dengan intensitas ringan dan tingkatkan secara bertahap',
                'icon' => 'trending-up'
            ],
            [
                'title' => 'Tidur yang Berkualitas',
                'description' => 'Pastikan tidur 7-8 jam per hari untuk mendukung program diet',
                'icon' => 'moon'
            ],
            [
                'title' => 'Catat Kemajuan',
                'description' => 'Dokumentasikan perjalanan Anda untuk motivasi dan evaluasi',
                'icon' => 'edit-3'
            ]
        ];

        $faqs = [
            [
                'question' => 'Berapa lama program diet ini harus dijalankan?',
                'answer' => 'Program diet sebaiknya dijalankan minimal 4-6 minggu untuk melihat hasil yang signifikan. Namun, perubahan gaya hidup sehat sebaiknya dilakukan secara permanen.'
            ],
            [
                'question' => 'Apakah boleh skip makanan yang direkomendasikan?',
                'answer' => 'Sebaiknya ikuti rekomendasi yang diberikan. Jika ada makanan yang tidak disukai, Anda bisa berkonsultasi atau mencari alternatif dengan kalori yang serupa.'
            ],
            [
                'question' => 'Bagaimana jika berat badan tidak turun setelah 2 minggu?',
                'answer' => 'Hal ini normal karena tubuh membutuhkan waktu untuk beradaptasi. Pastikan Anda konsisten dalam mengikuti program dan tidak lupa mencatat semua aktivitas.'
            ],
            [
                'question' => 'Apakah perlu olahraga setiap hari?',
                'answer' => 'Tidak harus setiap hari. Ikuti rekomendasi yang diberikan sistem berdasarkan kondisi dan tujuan Anda. Istirahat juga penting untuk recovery otot.'
            ],
            [
                'question' => 'Bagaimana jika lupa mencatat makanan atau air minum?',
                'answer' => 'Tidak masalah jika sesekali lupa. Yang penting adalah konsistensi jangka panjang. Usahakan untuk mencatat secara real-time agar tidak lupa.'
            ]
        ];

        return view('user.user-guide', compact('guideSteps', 'tips', 'faqs'));
    }
}
