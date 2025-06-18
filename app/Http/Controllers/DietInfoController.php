<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DietInfoController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'diet');

        $user = Auth::user();
        $questionnaire = $user->questionnaire;
        $recommendedDiets = $questionnaire ? json_decode($questionnaire->recommended_diets, true) : [];

        // Ensure $recommendedDiets is always an array
        if (!is_array($recommendedDiets)) {
            $recommendedDiets = [];
        }

        $dietPrograms = [
            [
                'id' => 'dash',
                'title' => 'Diet DASH',
                'description' => 'Fokus pada rendah natrium untuk mengelola hipertensi dan mendukung kesehatan jantung.',
                'image' => asset('images/dash.jpg'),
                'details' => [
                    [
                        'title' => 'Prinsip Dasar',
                        'content' => 'Mengurangi asupan natrium dan meningkatkan konsumsi kalium, magnesium, dan serat. Cocok untuk hipertensi.',
                    ],
                    [
                        'title' => 'Pola Makan',
                        'content' => 'Konsumsi sayuran, buah-buahan, biji-bijian utuh, produk susu rendah lemak, dan protein tanpa lemak. Batasi garam, daging merah, dan gula.',
                    ],
                    [
                        'title' => 'Frekuensi Makan',
                        'content' => 'Makan 3-4 kali sehari dengan porsi kecil untuk menjaga tekanan darah stabil.',
                    ],
                    [
                        'title' => 'Hidrasi',
                        'content' => 'Minum 2-3 liter air per hari. Hindari minuman tinggi natrium atau gula.',
                    ],
                ],
            ],
            [
                'id' => 'mediterranean',
                'title' => 'Diet Mediterania',
                'description' => 'Mendukung kesehatan jantung dan umur panjang dengan lemak sehat dan makanan nabati.',
                'image' => asset('images/mediterranean.jpg'),
                'details' => [
                    [
                        'title' => 'Prinsip Dasar',
                        'content' => 'Fokus pada lemak sehat (minyak zaitun, kacang), serat tinggi, dan protein moderat. Cocok untuk penyakit jantung atau usia lanjut.',
                    ],
                    [
                        'title' => 'Pola Makan',
                        'content' => 'Konsumsi sayuran, buah, biji-bijian, ikan, dan minyak zaitun. Batasi daging merah dan makanan olahan.',
                    ],
                    [
                        'title' => 'Frekuensi Makan',
                        'content' => 'Makan 3 kali sehari dengan camilan sehat seperti kacang atau buah.',
                    ],
                    [
                        'title' => 'Catatan',
                        'content' => 'Konsultasikan dengan ahli gizi jika tujuannya adalah peningkatan massa otot.',
                    ],
                ],
            ],
            [
                'id' => 'low_fat',
                'title' => 'Diet Rendah Lemak',
                'description' => 'Mengurangi lemak untuk mengelola dislipidemia dan mendukung penurunan berat badan.',
                'image' => asset('images/low_fat.jpg'),
                'details' => [
                    [
                        'title' => 'Prinsip Dasar',
                        'content' => 'Mengurangi lemak total, terutama lemak jenuh, untuk menurunkan kadar lipid darah.',
                    ],
                    [
                        'title' => 'Pola Makan',
                        'content' => 'Pilih daging tanpa lemak, produk susu rendah lemak, sayuran, dan karbohidrat kompleks. Hindari gorengan.',
                    ],
                    [
                        'title' => 'Frekuensi Makan',
                        'content' => 'Makan 3-4 kali sehari dengan porsi seimbang.',
                    ],
                    [
                        'title' => 'Hidrasi',
                        'content' => 'Minum banyak air untuk membantu metabolisme.',
                    ],
                ],
            ],
            [
                'id' => 'low_carb',
                'title' => 'Diet Rendah Karbohidrat',
                'description' => 'Mengurangi karbohidrat untuk mendukung penurunan berat badan pada obesitas.',
                'image' => asset('images/low_carb.jpg'),
                'details' => [
                    [
                        'title' => 'Prinsip Dasar',
                        'content' => 'Mengurangi karbohidrat sederhana untuk meningkatkan pembakaran lemak.',
                    ],
                    [
                        'title' => 'Pola Makan',
                        'content' => 'Fokus pada protein (daging, ikan, telur), lemak sehat (alpukat), dan sayuran rendah karbohidrat. Hindari gula dan roti putih.',
                    ],
                    [
                        'title' => 'Frekuensi Makan',
                        'content' => 'Konsumsi 3 makanan utama dan 1 camilan rendah karbohidrat.',
                    ],
                    [
                        'title' => 'Suplemen',
                        'content' => 'Pertimbangkan serat tambahan jika asupan sayuran kurang.',
                    ],
                ],
            ],
            [
                'id' => 'balanced',
                'title' => 'Pola Makan Seimbang',
                'description' => 'Pendekatan seimbang untuk kesehatan umum tanpa batasan ketat.',
                'image' => asset('images/balanced.jpg'),
                'details' => [
                    [
                        'title' => 'Prinsip Dasar',
                        'content' => 'Menggabungkan semua kelompok makanan dalam proporsi seimbang untuk nutrisi optimal.',
                    ],
                    [
                        'title' => 'Pola Makan',
                        'content' => 'Konsumsi karbohidrat kompleks, protein, lemak sehat, sayuran, dan buah dalam porsi seimbang.',
                    ],
                    [
                        'title' => 'Frekuensi Makan',
                        'content' => 'Makan 3 kali sehari dengan 1-2 camilan sehat.',
                    ],
                    // [
                    //     'title' => 'Referensi',
                    //     'content' => 'Berdasarkan DIETDUCATE (Iqbal et al., 2020, Systematic Reviews in Pharmacy, Vol 11, Issue 8).',
                    // ],
                ],
            ],
            // [
            //     'id' => 'medical_consultation',
            //     'title' => 'Konsultasi Medis',
            //     'description' => 'Konsultasi dengan dokter diperlukan untuk rekomendasi diet spesifik.',
            //     'image' => asset('images/consultation.jpg'),
            //     'details' => [
            //         [
            //             'title' => 'Prinsip Dasar',
            //             'content' => 'Kondisi Anda memerlukan evaluasi medis sebelum menentukan diet.',
            //         ],
            //         [
            //             'title' => 'Langkah Selanjutnya',
            //             'content' => 'Segera konsultasikan dengan dokter atau ahli gizi untuk penyesuaian diet.',
            //         ],
            //         [
            //             'title' => 'Catatan',
            //             'content' => 'Hindari perubahan diet drastis tanpa bimbingan profesional.',
            //         ],
            //     ],
            // ],
        ];

        $otherDiets = array_filter($dietPrograms, function ($program) use ($recommendedDiets) {
            return !in_array($program['title'], $recommendedDiets);
        });

        $notes = $questionnaire ? json_decode($questionnaire->notes, true) : [];

        $exerciseRecommendations = [
            [
                'id' => 'cardio',
                'title' => 'Latihan Kardio',
                'description' => 'Meningkatkan kesehatan jantung, membakar kalori, dan meningkatkan stamina.',
                'image' => asset('images/cardio.jpg'),
                'details' => [
                    [
                        'title' => 'Jenis Latihan',
                        'content' => 'Berjalan cepat, jogging, bersepeda, berenang, aerobik, HIIT.',
                    ],
                    [
                        'title' => 'Durasi',
                        'content' => '20-60 menit per sesi, 3-5 kali per minggu.',
                    ],
                    [
                        'title' => 'Tips',
                        'content' => 'Mulai perlahan dan tingkatkan intensitas secara bertahap.',
                    ],
                ],
            ],
            [
                'id' => 'strength',
                'title' => 'Latihan Kekuatan',
                'description' => 'Membangun otot, meningkatkan metabolisme, dan memperkuat tulang.',
                'image' => asset('images/strength.jpg'),
                'details' => [
                    [
                        'title' => 'Jenis Latihan',
                        'content' => 'Angkat beban, resistance band, bodyweight (push-up, squat, plank).',
                    ],
                    [
                        'title' => 'Durasi',
                        'content' => '20-45 menit per sesi, 2-4 kali per minggu.',
                    ],
                    [
                        'title' => 'Tips',
                        'content' => 'Fokus pada teknik yang benar dan istirahat cukup antar set.',
                    ],
                ],
            ],
            [
                'id' => 'flexibility',
                'title' => 'Latihan Fleksibilitas',
                'description' => 'Meningkatkan rentang gerak dan mencegah cedera.',
                'image' => asset('images/flexibility.jpg'),
                'details' => [
                    [
                        'title' => 'Jenis Latihan',
                        'content' => 'Stretching, yoga, pilates.',
                    ],
                    [
                        'title' => 'Durasi',
                        'content' => '10-20 menit per sesi, setiap hari atau setelah latihan utama.',
                    ],
                    [
                        'title' => 'Tips',
                        'content' => 'Lakukan peregangan setelah pemanasan atau olahraga.',
                    ],
                ],
            ],
        ];

        return view('user.diet-info', compact('tab', 'dietPrograms', 'recommendedDiets', 'otherDiets', 'exerciseRecommendations'));
    }
}