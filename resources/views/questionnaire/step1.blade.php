<!-- @extends('layouts.app')

@section('content')
<form action="{{ route('questionnaire.step2') }}" method="GET" class="w-full max-w-4xl mx-auto mt-8">
  <h1 class="text-2xl font-bold mb-4 text-center">Kondisi tubuh kamu saat ini?</h1>
  <p class="text-gray-500 mb-6 text-center">Berikan informasi terkini tentang kondisi tubuh kamu</p>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    @foreach ([
      'Terlalu kurus',
      'Kurus',
      'Berat badan ideal',
      'Gemuk',
      'Terlalu gemuk (obesitas)'
    ] as $value)
      <label class="flex items-center px-4 py-3 border rounded-lg cursor-pointer hover:bg-blue-50">
        <input type="radio" name="step1" value="{{ $value }}" class="form-radio mr-3" required>
        <span class="text-sm">{{ $value }}</span>
      </label>
    @endforeach
  </div>

  <div class="flex justify-between mt-8">
    <a href="" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">Kembali</a>
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">Selanjutnya</button>
  </div>

  <div class="w-full bg-gray-200 h-2 mt-6 rounded-full">
    <div class="bg-blue-600 h-2 rounded-full" style="width: 20%"></div>
  </div>
</form>
@endsection -->
@extends('user.layout.app')

@section('title', 'Kuesioner')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-white to-orange-50 flex flex-col">
        <div class="container mx-auto px-4 py-8 flex-1 flex flex-col">
            <a href="{{ url('/') }}" class="text-orange-500 hover:underline mb-8 inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
                Kembali ke Beranda
            </a>

            <div class="max-w-3xl mx-auto w-full bg-white rounded-xl shadow-lg p-8">
                @if ($currentStep <= $totalSteps)
                    <!-- Progress Indicator -->
                    <div class="w-full mb-8">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-600">
                                Langkah {{ $currentStep }} dari {{ $totalSteps }}
                            </span>
                            <span class="text-sm font-medium text-orange-500">
                                {{ round(($currentStep / $totalSteps) * 100) }}%
                            </span>
                        </div>
                        <div class="w-full h-2 bg-gray-200 rounded-full">
                            <div
                                class="h-full bg-orange-500 rounded-full transition-all duration-300 ease-in-out"
                                style="width: {{ ($currentStep / $totalSteps) * 100 }}%"
                            ></div>
                        </div>
                    </div>
                @endif

                <!-- Step Content -->
                @if ($currentStep == 1)
                    <!-- Step 1: Tujuan -->
                    <div class="space-y-6">
                        <h2 class="text-2xl font-bold text-center text-gray-800">Apa tujuan utama Anda?</h2>
                        <p class="text-center text-gray-600">Pilih tujuan yang paling sesuai dengan kebutuhan Anda saat ini</p>

                        <div class="grid grid-cols-1 gap-4 mt-6">
                            @foreach (['weight_loss' => 'Penurunan Berat Badan', 'muscle_gain' => 'Penambahan Massa Otot', 'health' => 'Manajemen Kesehatan'] as $value => $label)
                                <form method="POST" action="{{ route('questionnaire.store', 1) }}">
                                    @csrf
                                    <input type="hidden" name="goal" value="{{ $value }}">
                                    <button
                                        type="submit"
                                        class="p-6 border-2 border-gray-200 hover:border-orange-500 rounded-xl text-left transition-all duration-200 hover:shadow-md w-full"
                                    >
                                        <div class="flex items-start">
                                            <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mr-4">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-6 w-6 text-orange-500"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    @if ($value == 'weight_loss')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                                    @elseif ($value == 'muscle_gain')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                    @endif
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-lg mb-1">{{ $label }}</h3>
                                                <p class="text-gray-600 text-sm">
                                                    @if ($value == 'weight_loss')
                                                        Menurunkan berat badan dan lemak tubuh
                                                    @elseif ($value == 'muscle_gain')
                                                        Membangun otot dan meningkatkan kekuatan
                                                    @else
                                                        Mengelola kondisi kesehatan tertentu
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </button>
                                </form>
                            @endforeach
                        </div>
                    </div>

                @elseif ($currentStep == 2)
                    <!-- Step 2: Informasi Pribadi -->
                    <div class="space-y-6">
                        <h2 class="text-2xl font-bold text-center text-gray-800">Informasi Pribadi</h2>
                        <p class="text-center text-gray-600">Informasi ini membantu kami menyesuaikan program dengan kebutuhan Anda</p>

                        <form method="POST" action="{{ route('questionnaire.store', 2) }}" class="space-y-4 mt-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="gender" class="block text-sm font-medium text-gray-800 mb-1">Jenis Kelamin</label>
                                    <select
                                        id="gender"
                                        name="gender"
                                        required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                    >
                                        <option value="" {{ !old('gender', $formData['gender'] ?? '') ? 'selected' : '' }} disabled>Pilih jenis kelamin</option>
                                        <option value="male" {{ old('gender', $formData['gender'] ?? '') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="female" {{ old('gender', $formData['gender'] ?? '') == 'female' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('gender')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="age" class="block text-sm font-medium text-gray-800 mb-1">Usia (tahun)</label>
                                    <input
                                        type="number"
                                        id="age"
                                        name="age"
                                        value="{{ old('age', $formData['age'] ?? '') }}"
                                        required
                                        min="15"
                                        max="80"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                        placeholder="Masukkan usia Anda"
                                    />
                                    @error('age')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="height" class="block text-sm font-medium text-gray-800 mb-1">Tinggi Badan (cm)</label>
                                    <input
                                        type="number"
                                        id="height"
                                        name="height"
                                        value="{{ old('height', $formData['height'] ?? '') }}"
                                        required
                                        min="100"
                                        max="250"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                        placeholder="Masukkan tinggi badan Anda"
                                    />
                                    @error('height')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="weight" class="block text-sm font-medium text-gray-800 mb-1">Berat Badan Saat Ini (kg)</label>
                                    <input
                                        type="number"
                                        id="weight"
                                        name="weight"
                                        value="{{ old('weight', $formData['weight'] ?? '') }}"
                                        required
                                        min="30"
                                        max="200"
                                        step="0.1"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                        placeholder="Masukkan berat badan Anda"
                                    />
                                    @error('weight')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex justify-between mt-8">
                                <form method="POST" action="{{ route('questionnaire.back') }}">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 border border-gray-300 text-gray-600 rounded-md hover:bg-gray-100">Kembali</button>
                                </form>
                                <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">Lanjutkan</button>
                            </div>
                        </form>
                    </div>

                @elseif ($currentStep == 3)
                    <!-- Step 3: Target Berat Badan -->
                    <div class="space-y-6">
                        <h2 class="text-2xl font-bold text-center text-gray-800">Target Berat Badan</h2>
                        <p class="text-center text-gray-600">Tentukan target berat badan yang ingin Anda capai</p>

                        <form method="POST" action="{{ route('questionnaire.store', 3) }}" class="space-y-4 mt-6">
                            @csrf
                            <div>
                                <label for="targetWeight" class="block text-sm font-medium text-gray-800 mb-1">Target Berat Badan (kg)</label>
                                <input
                                    type="number"
                                    id="targetWeight"
                                    name="targetWeight"
                                    value="{{ old('targetWeight', $formData['targetWeight'] ?? '') }}"
                                    required
                                    min="30"
                                    max="150"
                                    step="0.1"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                    placeholder="Masukkan target berat badan Anda"
                                />
                                @error('targetWeight')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-between mt-8">
                                <form method="POST" action="{{ route('questionnaire.back') }}">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 border border-gray-300 text-gray-600 rounded-md hover:bg-gray-100">Kembali</button>
                                </form>
                                <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">Lanjutkan</button>
                            </div>
                        </form>
                    </div>

                @elseif ($currentStep == 4)
                    <!-- Step 4: Tingkat Aktivitas -->
                    <div class="space-y-6">
                        <h2 class="text-2xl font-bold text-center text-gray-800">Tingkat Aktivitas Harian</h2>
                        <p class="text-center text-gray-600">Pilih tingkat aktivitas yang paling mendekati rutinitas harian Anda</p>

                        <div class="space-y-4 mt-6">
                            @foreach ([
                                'sedentary' => ['Tidak Aktif', 'Pekerjaan meja, hampir tidak ada aktivitas fisik'],
                                'lightly_active' => ['Sedikit Aktif', 'Aktivitas ringan 1-3 hari/minggu'],
                                'moderately_active' => ['Cukup Aktif', 'Aktivitas sedang 3-5 hari/minggu'],
                                'very_active' => ['Sangat Aktif', 'Aktivitas berat 6-7 hari/minggu'],
                                'extra_active' => ['Ekstra Aktif', 'Aktivitas sangat berat, pekerjaan fisik, atau latihan 2x sehari']
                            ] as $value => $info)
                                <form method="POST" action="{{ route('questionnaire.store', 4) }}">
                                    @csrf
                                    <input type="hidden" name="activityLevel" value="{{ $value }}">
                                    <button
                                        type="submit"
                                        class="w-full p-4 border-2 border-gray-200 hover:border-purple-500 rounded-xl text-left transition-all duration-200 hover:shadow-md"
                                    >
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 text-purple-500"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    @if ($value == 'sedentary')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                                    @elseif ($value == 'lightly_active')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    @elseif ($value == 'moderately_active')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                    @elseif ($value == 'very_active')
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                                    @endif
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-lg">{{ $info[0] }}</h3>
                                                <p class="text-gray-600 text-sm">{{ $info[1] }}</p>
                                            </div>
                                        </div>
                                    </button>
                                </form>
                            @endforeach
                        </div>

                        <div class="flex justify-start mt-8">
                            <form method="POST" action="{{ route('questionnaire.back') }}">
                                @csrf
                                <button type="submit" class="px-4 py-2 border border-gray-300 text-gray-600 rounded-md hover:bg-gray-100">Kembali</button>
                            </form>
                        </div>
                    </div>

                @elseif ($currentStep == 5)
                    <!-- Step 5: Riwayat Penyakit Ginjal -->
                    <div class="space-y-6">
                        <h2 class="text-2xl font-bold text-center text-gray-800">Apakah Anda memiliki riwayat penyakit ginjal?</h2>
                        <p class="text-center text-gray-600">Pilih opsi yang paling sesuai dengan kondisi kesehatan Anda</p>

                        <div class="space-y-4 mt-6">
                            @foreach ([1 => 'Ya, Saya Memiliki', 0 => 'Tidak, Saya Tidak Memiliki'] as $value => $label)
                                <form method="POST" action="{{ route('questionnaire.store', 5) }}">
                                    @csrf
                                    <input type="hidden" name="isKidneyDisease" value="{{ $value }}">
                                    <button
                                        type="submit"
                                        class="w-full p-4 border-2 border-gray-200 hover:border-{{ $value ? 'green' : 'red' }}-500 rounded-xl text-left transition-all duration-200 hover:shadow-md"
                                    >
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-{{ $value ? 'green' : 'red' }}-100 rounded-full flex items-center justify-center mr-4">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 text-{{ $value ? 'green' : 'red' }}-500"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-lg">{{ $label }}</h3>
                                                <p class="text-gray-600 text-sm">
                                                    {{ $value ? 'Riwayat penyakit ginjal atau sedang dalam pengobatan' : 'Tidak memiliki riwayat penyakit ginjal' }}
                                                </p>
                                            </div>
                                        </div>
                                    </button>
                                </form>
                            @endforeach
                        </div>

                        <div class="flex justify-start mt-8">
                            <form method="POST" action="{{ route('questionnaire.back') }}">
                                @csrf
                                <button type="submit" class="px-4 py-2 border border-gray-300 text-gray-600 rounded-md hover:bg-gray-100">Kembali</button>
                            </form>
                        </div>
                    </div>

                @elseif ($currentStep == 6)
                    <!-- Step 6: Riwayat Penyakit Hati -->
                    <div class="space-y-6">
                        <h2 class="text-2xl font-bold text-center text-gray-800">Apakah Anda memiliki riwayat penyakit hati?</h2>
                        <p class="text-center text-gray-600">Pilih opsi yang paling sesuai dengan kondisi kesehatan Anda</p>

                        <div class="space-y-4 mt-6">
                            @foreach ([1 => 'Ya, Saya Memiliki', 0 => 'Tidak, Saya Tidak Memiliki'] as $value => $label)
                                <form method="POST" action="{{ route('questionnaire.store', 6) }}">
                                    @csrf
                                    <input type="hidden" name="isLiverDisease" value="{{ $value }}">
                                    <button
                                        type="submit"
                                        class="w-full p-4 border-2 border-gray-200 hover:border-{{ $value ? 'green' : 'red' }}-500 rounded-xl text-left transition-all duration-200 hover:shadow-md"
                                    >
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-{{ $value ? 'green' : 'red' }}-100 rounded-full flex items-center justify-center mr-4">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 text-{{ $value ? 'green' : 'red' }}-500"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-lg">{{ $label }}</h3>
                                                <p class="text-gray-600 text-sm">
                                                    {{ $value ? 'Riwayat penyakit hati atau sedang dalam pengobatan' : 'Tidak memiliki riwayat penyakit hati' }}
                                                </p>
                                            </div>
                                        </div>
                                    </button>
                                </form>
                            @endforeach
                        </div>

                        <div class="flex justify-start mt-8">
                            <form method="POST" action="{{ route('questionnaire.back') }}">
                                @csrf
                                <button type="submit" class="px-4 py-2 border border-gray-300 text-gray-600 rounded-md hover:bg-gray-100">Kembali</button>
                            </form>
                        </div>
                    </div>

                @elseif ($currentStep == 7)
                    <!-- Step 7: Riwayat Penyakit Jantung -->
                    <div class="space-y-6">
                        <h2 class="text-2xl font-bold text-center text-gray-800">Apakah Anda memiliki riwayat penyakit jantung?</h2>
                        <p class="text-center text-gray-600">Pilih opsi yang paling sesuai dengan kondisi kesehatan Anda</p>

                        <div class="space-y-4 mt-6">
                            @foreach ([1 => 'Ya, Saya Memiliki', 0 => 'Tidak, Saya Tidak Memiliki'] as $value => $label)
                                <form method="POST" action="{{ route('questionnaire.store', 7) }}">
                                    @csrf
                                    <input type="hidden" name="isHeartDisease" value="{{ $value }}">
                                    <button
                                        type="submit"
                                        class="w-full p-4 border-2 border-gray-200 hover:border-{{ $value ? 'green' : 'red' }}-500 rounded-xl text-left transition-all duration-200 hover:shadow-md"
                                    >
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-{{ $value ? 'green' : 'red' }}-100 rounded-full flex items-center justify-center mr-4">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 text-{{ $value ? 'green' : 'red' }}-500"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-lg">{{ $label }}</h3>
                                                <p class="text-gray-600 text-sm">
                                                    {{ $value ? 'Riwayat penyakit jantung atau sedang dalam pengobatan' : 'Tidak memiliki riwayat penyakit jantung' }}
                                                </p>
                                            </div>
                                        </div>
                                    </button>
                                </form>
                            @endforeach
                        </div>

                        <div class="flex justify-start mt-8">
                            <form method="POST" action="{{ route('questionnaire.back') }}">
                                @csrf
                                <button type="submit" class="px-4 py-2 border border-gray-300 text-gray-600 rounded-md hover:bg-gray-100">Kembali</button>
                            </form>
                        </div>
                    </div>

                @elseif ($currentStep == 8)
                    <!-- Step 8: Sedang Mengandung -->
                    <div class="space-y-6">
                        <h2 class="text-2xl font-bold text-center text-gray-800">Apakah Anda sedang mengandung?</h2>
                        <p class="text-center text-gray-600">Pilih opsi yang paling sesuai dengan kondisi kesehatan Anda</p>

                        <div class="space-y-4 mt-6">
                            @foreach ([1 => 'Ya, Saya Sedang Mengandung', 0 => 'Tidak, Saya Tidak Mengandung'] as $value => $label)
                                <form method="POST" action="{{ route('questionnaire.store', 8) }}">
                                    @csrf
                                    <input type="hidden" name="isPregnant" value="{{ $value }}">
                                    <button
                                        type="submit"
                                        class="w-full p-4 border-2 border-gray-200 hover:border-{{ $value ? 'green' : 'red' }}-500 rounded-xl text-left transition-all duration-200 hover:shadow-md"
                                    >
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-{{ $value ? 'green' : 'red' }}-100 rounded-full flex items-center justify-center mr-4">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 text-{{ $value ? 'green' : 'red' }}-500"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                >
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="font-semibold text-lg">{{ $label }}</h3>
                                                <p class="text-gray-600 text-sm">
                                                    {{ $value ? 'Sedang dalam masa kehamilan' : 'Tidak sedang dalam masa kehamilan' }}
                                                </p>
                                            </div>
                                        </div>
                                    </button>
                                </form>
                            @endforeach
                        </div>

                        <div class="flex justify-start mt-8">
                            <form method="POST" action="{{ route('questionnaire.back') }}">
                                @csrf
                                <button type="submit" class="px-4 py-2 border border-gray-300 text-gray-600 rounded-md hover:bg-gray-100">Kembali</button>
                            </form>
                        </div>
                    </div>

                @elseif ($currentStep == 9)
                    <!-- Completion Page -->
                    <div class="text-center space-y-6">
                        <div class="w-24 h-24 bg-green-100 rounded-full mx-auto flex items-center justify-center">
                            <i data-lucide="check-circle-2" class="w-12 h-12 text-green-500"></i>
                        </div>

                        <h2 class="text-3xl font-bold text-gray-800">Kuesioner Selesai!</h2>
                        <p class="text-gray-600 max-w-md mx-auto">
                            Terima kasih telah mengisi kuesioner. Berdasarkan informasi yang Anda berikan, kami akan menyusun program diet dan olahraga yang sesuai untuk Anda.
                        </p>

                        @if (session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded max-w-md mx-auto">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="mt-8">
                            <form method="POST" action="{{ route('questionnaire.submit') }}">
                                @csrf
                                <button
                                    type="submit"
                                    class="px-8 py-3 bg-green-500 text-white rounded-md text-lg hover:bg-green-600"
                                >
                                    Lihat Program Anda
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <footer class="bg-gray-100 py-4">
            <div class="container mx-auto px-4 text-center text-gray-600">
                <p>© {{ now()->year }} Platform Diet & Olahraga. Tugas Akhir.</p>
            </div>
        </footer>
    </div>

    <script>
        lucide.createIcons();
    </script>
@endsection