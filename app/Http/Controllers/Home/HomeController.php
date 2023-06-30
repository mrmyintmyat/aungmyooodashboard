<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $sitename = Auth::user()->siteName;
        $timezone = 'Asia/Yangon';
        $todayDate = Carbon::now($timezone)->toDateString();
        $date = Carbon::now($timezone)
            ->subDays(6)
            ->toDateString();

        $inputStartDate = Carbon::createFromFormat('Y-m-d', $date);
        $inputEndDate = Carbon::createFromFormat('Y-m-d', $todayDate);
        $dateInput = $inputStartDate->format('m/d/Y') . ' - ' . $inputEndDate->format('m/d/Y');
        return view('index', ['date' => $dateInput]);
    }

    public function post_date(Request $request)
    {
        $dateRange = $request->input('input');
        [$startDateString, $endDateString] = explode(' - ', $dateRange);
        $sitename = Auth::user()->siteName;

        $startDate = Carbon::createFromFormat('m/d/Y', $startDateString);
        $endDate = Carbon::createFromFormat('m/d/Y', $endDateString);
        $response = Http::post('http://139.180.188.161/report?startDate=' . $startDate->format('Y-m-d') . '&endDate=' . $endDate->format('Y-m-d') . '&total=true', [
            'siteName' => "$sitename",
        ]);
        $response_for_chart = Http::post('http://139.180.188.161/report?startDate=' . $startDate->format('Y-m-d') . '&endDate=' . $endDate->format('Y-m-d') . '', [
            'siteName' => "$sitename",
        ]);
        $data_api = json_decode($response->getBody(), true);
        $data_for_chart = json_decode($response_for_chart->getBody(), true);
        if ($data_api['status'] == false) {
            $error = $data_api['error'];
            return response()->json(['error' => $error], 500);
        }

        if ($data_for_chart['status'] == false) {
            $error = $data_for_chart['error'];
            return response()->json(['error' => $error], 500);
        }

        if (isset($data_api['error'])) {
            $error = $data_api['error'];
            return response()->json(['error' => $error], 500);
        }
        if (isset($data_for_chart['error'])) {
            $error = $data_for_chart['error'];
            return response()->json(['error' => $error], 500);
        }

        $revenueData = [];
        $dateData = [];

        foreach ($data_for_chart['data'] as $item) {
            $revenueData[] = $item['revenue'];
            $dateData[] = $item['date'];
        }

        
        $combinedData = [
            'total_data' => $data_api,
            'revenueData' => $revenueData,
            'dateData' => $dateData,
        ];

        return response()->json($combinedData);
    }

    public function lastsevendays()
    {
        $timezone = 'Asia/Yangon';
        try {
            $todaydate = Carbon::now($timezone)->toDateString();
            $date = Carbon::now($timezone)
                ->subDays(6)
                ->toDateString();

            $response = Http::post('http://139.180.188.161/report?startDate=' . $date . '&endDate=' . $todaydate . '', [
                'siteName' => Auth::user()->siteName,
            ]);
            $responseData = json_decode($response->getBody(), true);

            if ($responseData['status'] == false) {
                return view('error');
            }
            if (isset($responseData['error'])) {
                $error = $responseData['error'];
                return view('error', compact('error'));
            }

            return [
                'data' => $responseData,
            ];
        } catch (\Throwable $th) {
            return view('error');
        }
    }

    public function report()
    {
        $sitename = Auth::user()->siteName;
        $timezone = 'Asia/Yangon';
        $todayDate = Carbon::now($timezone)->toDateString();
        $date = Carbon::now($timezone)
            ->subDays(6)
            ->toDateString();

        $inputStartDate = Carbon::createFromFormat('Y-m-d', $date);
        $inputEndDate = Carbon::createFromFormat('Y-m-d', $todayDate);
        $dateInput = $inputStartDate->format('m/d/Y') . ' - ' . $inputEndDate->format('m/d/Y');
        return view('report', ['date' => $dateInput]);
    }

    public function post_date_reports(Request $request)
    {
        $dateRange = $request->input('input');
        [$startDateString, $endDateString] = explode(' - ', $dateRange);
        $sitename = Auth::user()->siteName;

        $startDate = Carbon::createFromFormat('m/d/Y', $startDateString);
        $endDate = Carbon::createFromFormat('m/d/Y', $endDateString);
        try {
            $response = Http::post('http://139.180.188.161/report?startDate=' . $startDate->format('Y-m-d') . '&endDate=' . $endDate->format('Y-m-d') . '', [
                'siteName' => "$sitename",
            ]);

            $total = Http::post('http://139.180.188.161/report?startDate=' . $startDate->format('Y-m-d') . '&endDate=' . $endDate->format('Y-m-d') . '&total=true', [
                'siteName' => "$sitename",
            ]);

            $datas = json_decode($response->getBody(), true);
            $totalDatas = json_decode($total->getBody(), true);

            if ($datas['status'] == false) {
                $error = $datas['error'];
                return response()->json(['error' => $error], 500);
            }

            if ($totalDatas['status'] == false) {
                $error = $totalDatas['error'];
                return response()->json(['error' => $error], 500);
            }

            if (isset($datas['error'])) {
                $error = $datas['error'];
                return response()->json(['error' => $error], 500);
            }
            if (isset($totalDatas['error'])) {
                $error = $totalDatas['error'];
                return response()->json(['error' => $error], 500);
            }

            $combinedData = [
                'total_data' => $totalDatas,
                'datas' => $datas,
            ];

            return response()->json($combinedData);
        } catch (\Exception $e) {
            return response()->json(['error' => 'API error occurred'], 500);
        }
    }

    public function pw_change_show_form()
    {
        return view('auth.passwords.password_change');
    }

    public function pw_change(Request $request)
    {
        $user = Auth::user();
        $currentPassword = $request->input('org_pw');

        if (!Hash::check($currentPassword, $user->password)) {
            return back()->withErrors(['org_pw' => 'The current password is incorrect.']);
        }

        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return back()->with('success', 'Password change successfully.');
    }
}
