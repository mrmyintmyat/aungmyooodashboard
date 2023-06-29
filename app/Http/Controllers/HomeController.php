<?php

namespace App\Http\Controllers;

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
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        //Today datas
        $sitename = Auth::user()->siteName;
        $timezone = 'Asia/Yangon';

        try {
            $date = Carbon::now($timezone)->toDateString();
            $response = Http::post('http://139.180.188.161/report?startDate=' . $date . '&endDate=' . $date . '', [
                'siteName' => "$sitename",
            ]);
            $data = json_decode($response->getBody(), true);
            if ($data['status'] == false) {
                return view('error');
            }

            if (isset($data['error'])) {
                $error = $data['error'];
                return view('error')->with('error', $error);
            }

        } catch (\Throwable $th) {
            return view('error');
        }


        $lastSevenDaysdatas = $this->lastsevendays();
        $lastSevenDaysdata = $lastSevenDaysdatas['data'];
        $lastSevenDaysdatatotal = $lastSevenDaysdatas['total'];
        return view('index', ['data' => $data, 'date' => $date, 'lastsevendaysdatas' => $lastSevenDaysdata, 'lastSevenDaysdatatotal' => $lastSevenDaysdatatotal]);
    }

    public function post_date(Request $request)
    {
        $dateRange = $request->input('date');
        [$startDateString, $endDateString] = explode(' - ', $dateRange);
        $sitename = Auth::user()->siteName;

        $startDate = Carbon::createFromFormat('m/d/Y', $startDateString);
        $endDate = Carbon::createFromFormat('m/d/Y', $endDateString);

        try {
            $response = Http::post('http://139.180.188.161/report?startDate=' . $startDate->format('Y-m-d') . '&endDate=' . $endDate->format('Y-m-d') . '&total=true', [
                'siteName' => "$sitename",
            ]);
            $data = json_decode($response->getBody(), true);
            if ($data['status'] == false) {
                return view('error');
            }
            if (isset($data['error'])) {
                $error = $data['error'];
                return view('error')->with('error', $error);
            }

            if ($data == null) {
                return view('error');
            }

            $lastSevenDaysdatas = $this->lastsevendays();
            $lastSevenDaysdata = $lastSevenDaysdatas['data'];
            $lastSevenDaysdatatotal = $lastSevenDaysdatas['total'];

            return view('index', ['data' => $data, 'date' => $dateRange, 'lastsevendaysdatas' => $lastSevenDaysdata, 'lastSevenDaysdatatotal' => $lastSevenDaysdatatotal]);
        } catch (\Throwable $th) {
            return view('error');
        }
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

            $total = Http::post('http://139.180.188.161/report?startDate=' . $date . '&endDate=' . $todaydate . '&total=true', [
                'siteName' => Auth::user()->siteName,
            ]);
            $responseData = json_decode($response->getBody(), true);
            $totaldata = json_decode($total->getBody(), true);
            if ($response['status'] == false || $totaldata['status'] == false) {
                return view('error');
            }
            if (isset($responseData['error']) || isset($totaldata['error'])) {
                $error = $responseData['error'];
                return view('error', compact('error'));
            }

            return [
                'data' => $responseData,
                'total' => $totaldata,
            ];
        } catch (\Throwable $th) {
            return view('error');
        }
    }

    public function report()
    {
        return view('report');
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
