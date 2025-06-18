<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // judul halaman
        $data['title'] = '';

        // tampilkan halaman home
        return view('landing', compact('data'));
    }

    public function indexQuestionnaire()
    {
        $data['title'] = 'Questionnaire';
        // tampilkan halaman questionnaire
        return view('questionnaire.step1', compact('data'));
    }
}
