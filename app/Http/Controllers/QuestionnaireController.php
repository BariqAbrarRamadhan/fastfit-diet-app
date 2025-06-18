<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class QuestionnaireController extends Controller
{
    private function checkQuestionnaireCompletion()
    {
        $user = Auth::user();
        if ($user->questionnaire()->exists() && !Session::has('questionnaire_step')) {
            return redirect()->route('dashboard')->with('error', 'Anda sudah mengisi kuesioner.');
        }
        return null;
    }

    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melanjutkan.');
        }

        if ($redirect = $this->checkQuestionnaireCompletion()) {
            return $redirect;
        }

        $currentStep = Session::get('questionnaire_step', 1);
        $formData = Session::get('questionnaire_data', []);
        $currentHeight = $formData['height'] ?? null;
        $beratBadanIdeal = $currentHeight ? ($currentHeight - 100) - (($currentHeight - 100) * 0.1) : null;
        $totalSteps = 7;
        $currentStep = max(1, min($currentStep, $totalSteps + 1));

        return view('user.questionnaire', compact('currentStep', 'formData', 'totalSteps', 'beratBadanIdeal'));
    }

    public function store(Request $request, $step)
    {
        if ($redirect = $this->checkQuestionnaireCompletion()) {
            return $redirect;
        }

        $totalSteps = 7;
        $formData = Session::get('questionnaire_data', []);

        $rules = [];
        if ($step == 1) {
            $rules = ['goal' => 'required|in:weight_loss,maintain_weight,muscle_gain'];
        } elseif ($step == 2) {
            $rules = [
                'gender' => 'required|in:pria,wanita',
                'age' => 'required|integer|min:15|max:80',
                'height' => 'required|numeric|min:100|max:250',
                'weight' => 'required|numeric|min:30|max:200',
            ];
        } elseif ($step == 3) {
            $rules = ['activity_level' => 'required|in:sedentary,moderately_active,extra_active'];
        } elseif ($step == 4) {
            $formData['target_weight'] = $request->input('target_weight');
            $rules = [
                'target_weight' => 'required|numeric|min:30|max:200|different:weight',
            ];
            if ($formData['goal'] == 'weight_loss') {
                $rules['target_weight'] = 'required|numeric|min:30|max:200';
            } elseif ($formData['goal'] == 'muscle_gain') {
                $rules['target_weight'] = 'required|numeric|min:30|max:200';
            } else {
                $rules['target_weight'] = 'required|numeric|min:30|max:200';
            }
        } elseif ($step == 5) {
            $rules = ['is_heart_disease' => 'required|boolean'];
        } elseif ($step == 6) {
            $rules = ['is_hypertension' => 'required|boolean'];
        } elseif ($step == 7) {
            $rules = ['is_dyslipidemia' => 'required|boolean'];
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $formData = array_merge($formData, $request->only(array_keys($rules)));
        Session::put('questionnaire_data', $formData);

        $nextStep = min($step + 1, $totalSteps + 1);
        Session::put('questionnaire_step', $nextStep);

        return redirect()->route('questionnaire.index');
    }

    public function back(Request $request)
    {
        $currentStep = Session::get('questionnaire_step', 1);
        $previousStep = max(1, $currentStep - 1);
        Session::put('questionnaire_step', $previousStep);

        return response()->json([
            'success' => true,
            'redirect' => route('questionnaire.index')
        ]);
    }

    public function submit(Request $request)
    {
        if ($redirect = $this->checkQuestionnaireCompletion()) {
            return $redirect;
        }

        $formData = Session::get('questionnaire_data', []);

        $rules = [
            'goal' => 'required|in:weight_loss,maintain_weight,muscle_gain',
            'gender' => 'required|in:pria,wanita',
            'age' => 'required|integer',
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'activity_level' => 'required|in:sedentary,moderately_active,extra_active',
            'is_heart_disease' => 'required|boolean',
            'is_hypertension' => 'required|boolean',
            'is_dyslipidemia' => 'required|boolean',
        ];

        $validator = Validator::make($formData, $rules);
        if ($validator->fails()) {
            Session::flash('error', 'Data kuesioner tidak lengkap.');
            return redirect()->route('questionnaire.index');
        }

        try {
            $user = Auth::user();
            $recommendations = $this->generateRecommendations((object) $formData);
            $user->questionnaire()->create(array_merge($formData, [
                'recommended_diets' => json_encode($recommendations['diets'])
            ]));

            Session::forget(['questionnaire_step', 'questionnaire_data']);

            return redirect()->route('questionnaire.recommendation')->with('success', 'Kuesioner berhasil disubmit!');
        } catch (\Exception $e) {
            Session::flash('error', 'Terjadi kesalahan saat mengirim kuesioner: ' . $e->getMessage());
            return redirect()->route('questionnaire.index');
        }
    }

    public function recommendation(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk melanjutkan.');
        }

        $user = Auth::user();
        $questionnaire = $user->questionnaire;

        if (!$questionnaire) {
            return redirect()->route('questionnaire.index')->with('error', 'Silakan lengkapi kuesioner terlebih dahulu.');
        }

        $recommendations = [
            'diets' => json_decode($questionnaire->recommended_diets, true) ?? [],
            'exercise' => [],
            'notes' => [],
        ];

        $dynamicRecommendations = $this->generateRecommendations($questionnaire);
        $recommendations['exercise'] = $dynamicRecommendations['exercise'];
        $recommendations['notes'] = $dynamicRecommendations['notes'];

        return view('user.recommendation', compact('questionnaire', 'recommendations'));
    }

    private function generateRecommendations($questionnaire)
    {
        $recommendations = [
            'diets' => [],
            'exercise' => [],
            'notes' => [],
        ];

        // Hitung BMI
        $heightInMeters = $questionnaire->height / 100;
        $bmi = round($questionnaire->weight / ($heightInMeters * $heightInMeters), 1);
        $isOverweight = $bmi >= 25;
        $isObese = $bmi >= 30;
        $isNormalBmi = $bmi < 25;

        // Aturan berdasarkan tabel
        // 1. Hipertensi = Yes, Heart Disease = No, Dyslipidemia = No
        if ($questionnaire->is_hypertension && !$questionnaire->is_heart_disease && !$questionnaire->is_dyslipidemia) {
            if ($isObese && $questionnaire->goal == 'weight_loss') {
                $recommendations['diets'] = ['Diet DASH'];
            } elseif ($isOverweight || $questionnaire->goal == 'weight_loss') {
                $recommendations['diets'] = ['Diet DASH'];
            } else { // BMI < 25 AND Goal ≠ weight_loss
                $recommendations['diets'] = ['Diet DASH'];
                $recommendations['notes'][] = 'Konsultasikan dengan dokter untuk rekomendasi diet spesifik.';
            }
        }
        // 2. Hipertensi = No, Heart Disease = Yes, Dyslipidemia = No
        elseif (!$questionnaire->is_hypertension && $questionnaire->is_heart_disease && !$questionnaire->is_dyslipidemia) {
            if ($questionnaire->age >= 40 || $questionnaire->activity_level == 'sedentary' || $questionnaire->goal == 'maintain_weight') {
                $recommendations['diets'] = ['Diet Mediterania'];
            } elseif ($questionnaire->goal == 'muscle_gain') {
                $recommendations['diets'] = ['Diet Mediterania'];
                $recommendations['notes'][] = 'Konsultasikan dengan ahli gizi untuk penyesuaian nutrisi.';
            } else { // Age < 40 AND Activity ≠ sedentary AND Goal = weight_loss
                $recommendations['diets'] = ['Diet Mediterania'];
                $recommendations['notes'][] = 'Konsultasikan dengan dokter untuk rekomendasi diet spesifik.';
            }
        }
        // 3. Hipertensi = No, Heart Disease = No, Dyslipidemia = Yes
        elseif (!$questionnaire->is_hypertension && !$questionnaire->is_heart_disease && $questionnaire->is_dyslipidemia) {
            $recommendations['diets'] = ['Diet Rendah Lemak'];
        }
        // 4. Hipertensi = Yes, Heart Disease = Yes, Dyslipidemia = No
        elseif ($questionnaire->is_hypertension && $questionnaire->is_heart_disease && !$questionnaire->is_dyslipidemia) {
            if ($isObese && $questionnaire->goal == 'weight_loss') {
                $recommendations['diets'] = ['Diet DASH'];
            } elseif ($isOverweight || $questionnaire->goal == 'weight_loss') {
                $recommendations['diets'] = ['Diet DASH'];
            } elseif ($isNormalBmi && $questionnaire->goal == 'maintain_weight' && ($questionnaire->age >= 40 || $questionnaire->activity_level == 'sedentary')) {
                $recommendations['diets'] = ['Diet Mediterania'];
            } elseif ($questionnaire->goal == 'muscle_gain') {
                $recommendations['diets'] = ['Diet Mediterania'];
                $recommendations['notes'][] = 'Konsultasikan dengan ahli gizi untuk penyesuaian nutrisi.';
            }
        }
        // 5. Hipertensi = Yes, Heart Disease = No, Dyslipidemia = Yes
        elseif ($questionnaire->is_hypertension && !$questionnaire->is_heart_disease && $questionnaire->is_dyslipidemia) {
            if ($isObese && $questionnaire->goal == 'weight_loss') {
                $recommendations['diets'] = ['Diet DASH'];
            } elseif ($isOverweight || $questionnaire->goal == 'weight_loss') {
                $recommendations['diets'] = ['Diet DASH'];
            } else { // BMI < 25 AND Goal ≠ weight_loss
                $recommendations['diets'] = ['Diet Rendah Lemak'];
            }
        }
        // 6. Hipertensi = No, Heart Disease = Yes, Dyslipidemia = Yes
        elseif (!$questionnaire->is_hypertension && $questionnaire->is_heart_disease && $questionnaire->is_dyslipidemia) {
            if ($questionnaire->age >= 40 || $questionnaire->activity_level == 'sedentary' || $questionnaire->goal == 'maintain_weight') {
                $recommendations['diets'] = ['Diet Mediterania'];
            } else { // Age < 40 AND Activity ≠ sedentary AND Goal = weight_loss/muscle_gain
                $recommendations['diets'] = ['Diet Rendah Lemak'];
            }
        }
        // 7. Hipertensi = Yes, Heart Disease = Yes, Dyslipidemia = Yes
        elseif ($questionnaire->is_hypertension && $questionnaire->is_heart_disease && $questionnaire->is_dyslipidemia) {
            if ($isObese && $questionnaire->goal == 'weight_loss') {
                $recommendations['diets'] = ['Diet DASH'];
            } else {
                $recommendations['diets'] = ['Diet Mediterania'];
            }
        }
        // 8. Hipertensi = No, Heart Disease = No, Dyslipidemia = No
        else {
            if ($questionnaire->age >= 60) {
                $recommendations['diets'] = ['Diet Mediterania'];
            } elseif ($isObese && $questionnaire->goal == 'weight_loss') {
                $recommendations['diets'] = ['Diet Rendah Karbohidrat'];
            } elseif ($questionnaire->goal == 'muscle_gain') {
                $recommendations['diets'] = ['Diet Mediterania'];
                $recommendations['notes'][] = 'Konsultasikan dengan ahli gizi untuk penyesuaian nutrisi.';
            } else {
                $recommendations['diets'] = ['Pola Makan Seimbang'];
            }
        }

        return $this->addExerciseAndNotes($recommendations, $questionnaire);
    }

    private function addExerciseAndNotes($recommendations, $questionnaire)
    {
        // Rekomendasi olahraga
        if ($questionnaire->goal == 'weight_loss') {
            $recommendations['exercise'][] = 'Lakukan kardio seperti berjalan cepat atau bersepeda selama 30 menit, 5 hari/minggu.';
        } elseif ($questionnaire->goal == 'muscle_gain') {
            $recommendations['exercise'][] = 'Latihan beban progresif 4-5 hari/minggu, fokus pada latihan compound.';
        } else { // maintain_weight
            $recommendations['exercise'][] = 'Latihan ringan hingga sedang seperti yoga atau jogging, 3-4 hari/minggu.';
        }

        if ($questionnaire->activity_level == 'sedentary') {
            $recommendations['exercise'][] = 'Mulai dengan aktivitas ringan seperti berjalan 10-15 menit setiap hari.';
        } elseif ($questionnaire->activity_level == 'moderately_active') {
            $recommendations['exercise'][] = 'Pertahankan aktivitas dengan menambahkan latihan kekuatan 2-3 kali/minggu.';
        } else { // extra_active
            $recommendations['exercise'][] = 'Fokus pada pemulihan dengan hari istirahat dan peregangan.';
        }

        // Catatan tambahan
        if ($questionnaire->is_heart_disease) {
            $recommendations['notes'][] = 'Konsultasikan dengan dokter sebelum memulai program olahraga intens.';
        }
        if ($questionnaire->is_hypertension) {
            $recommendations['notes'][] = 'Pilih olahraga aerobik ringan seperti berenang.';
        }
        if ($questionnaire->is_dyslipidemia) {
            $recommendations['notes'][] = 'Lakukan pemeriksaan lipid darah secara berkala.';
        }

        return $recommendations;
    }
}