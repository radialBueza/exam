<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamAttempt;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;


class TakeExam extends Controller
{
    public function index(Request $request, Exam $exam)
    {
        // $refreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
        $refreshed = $request->hasHeader('CACHE_CONTROL') && $request->header('CACHE_CONTROL') === 'max-age=0';
        // session()->flush();

        if (!$refreshed) {
            $entered = true;

            $attempt = $exam->examAttempts()->where('user_id', Auth::id())->count();

            // dd($attempt);
            if ($attempt != 0 /*|| $request->session()->get('ongoingExam')*/) {
                return redirect(RouteServiceProvider::HOME);
            }

            $newAttempt = ExamAttempt::create([
                'user_id' => Auth::id(),
                'exam_id' => $exam->id
            ]);
            // session([
            //     // 'ongoingExam' => true,
            //     'ongoingExamObject' => $newAttempt
            // ]);
            return view('takeExam.index',
            [
                'info' => $exam,
                'questions' => $exam->questions()->select('id', 'question', 'question_file', 'a', 'a_file', 'b', 'b_file', 'c', 'c_file', 'd', 'd_file')->get(),
                'attempt' => $newAttempt->id,
                'entered' => $entered
            ]);
        }

        $entered = false;

        return view('takeExam.index',
        [
            'info' => $exam,
            'questions' => $exam->questions()->select('id', 'question', 'question_file', 'a', 'a_file', 'b', 'b_file', 'c', 'c_file', 'd', 'd_file')->get(),
            // 'attempt' => session('ongoingExamObject'),
            'entered' => $entered
        ]);
    }

    // add ExamAttempt
    public function gradeExam(Request $request, Exam $exam, ExamAttempt $attempt)
    {
        // session()->forget(['ongoingExamObject', 'ongoingExam']);
        $correctAns = $exam->questions()->select('id','correct_answer')->get();
        $ans = $request->all();
        $totalScore = 0;
        // dd($request);
        $correctAns->each(function ($item) use($ans, &$totalScore){
            if ($item->correct_answer == $ans[(string)$item->id]) {
                $totalScore++;
            }
        });


        $percent = ($totalScore / ($exam->num_of_questions) * 100);
        $percent = number_format($percent, 1, '.','');
        $grade = 0;
        // dd($percent);
        switch ($percent) {
            case ($percent == 100):
                $grade = 100;
                break;
            case ($percent >= 98.4 && $percent < 100):
                $grade = 99;
                break;
            case ($percent >= 96.8 && $percent < 98.4):
                $grade = 98;
                break;
            case ($percent >= 95.2 && $percent < 96.8):
                $grade = 97;
                break;
            case ($percent >= 93.6 && $percent < 95.2):
                $grade = 96;
                break;
            case ($percent >= 92 && $percent < 93.6):
                $grade = 95;
                break;
            case ($percent >= 90.4 && $percent < 92):
                $grade = 94;
                break;
            case ($percent >= 88.8 && $percent < 90.4):
                $grade = 93;
                break;
            case ($percent >= 87.2 && $percent < 88.8):
                $grade = 92;
                break;
            case ($percent >= 85.6 && $percent < 87.2):
                $grade = 91;
                break;
            case ($percent >= 84 && $percent < 85.6):
                $grade = 90;
                break;
            case ($percent >= 82.4 && $percent < 84):
                $grade = 89;
                break;
            case ($percent >= 80 && $percent < 82.4):
                $grade = 88;
                break;
            case ($percent >= 79.2 && $percent < 80):
                $grade = 87;
                break;
            case ($percent >= 77.6 && $percent < 79.2):
                $grade = 86;
                break;
            case ($percent >= 76 && $percent < 77.6):
                $grade = 85;
                break;
            case ($percent >= 74.4 && $percent < 76):
                $grade = 84;
                break;
            case ($percent >= 72.8 && $percent < 74.4):
                $grade = 83;
                break;
            case ($percent >= 71.2 && $percent < 72.8):
                $grade = 82;
                break;
            case ($percent >= 69.6 && $percent < 71.2):
                $grade = 81;
                break;
            case ($percent >= 68 && $percent < 69.6):
                $grade = 80;
                break;
            case ($percent >= 66.4 && $percent < 68):
                $grade = 79;
                break;
            case ($percent >= 64.8 && $percent < 66.4):
                $grade = 78;
                break;
            case ($percent >= 63.2 && $percent < 64.8):
                $grade = 77;
                break;
            case ($percent >= 61.6 && $percent < 63.2):
                $grade = 76;
                break;
            case ($percent >= 60 && $percent < 61.6):
                $grade = 75;
                break;
            case ($percent >= 56 && $percent < 60):
                $grade = 74;
                break;
            case ($percent >= 52 && $percent < 56):
                $grade = 73;
                break;
            case ($percent >= 48 && $percent < 52):
                $grade = 72;
                break;
            case ($percent >= 44 && $percent < 48):
                $grade = 71;
                break;
            case ($percent >= 40 && $percent < 44):
                $grade = 70;
                break;
            case ($percent >= 36 && $percent < 40):
                $grade = 69;
                break;
            case ($percent >= 32 && $percent < 36):
                $grade = 68;
                break;
            case ($percent >= 28 && $percent < 32):
                $grade = 67;
                break;
            case ($percent >= 24 && $percent < 28):
                $grade = 66;
                break;
            case ($percent >= 20 && $percent < 24):
                $grade = 65;
                break;
            case ($percent >= 16 && $percent < 20):
                $grade = 64;
                break;
            case ($percent >= 12 && $percent < 16):
                $grade = 63;
                break;
            case ($percent >= 8 && $percent < 12):
                $grade = 62;
                break;
            case ($percent >= 4 && $percent < 8):
                $grade = 61;
                break;
            case ($percent >= 0 && $percent < 4):
                $grade = 60;
                break;
        }

        $attempt->score = $totalScore;
        $attempt->percent = $percent;
        $attempt->grade = $grade;

        $attempt->save();

        if ($request->is('api/*')) {
            return response(200);
        }

        return view('takeExam.result',
        [
            'score' => $totalScore
        ]);
    }
}
