<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use PDF;
use Illuminate\Support\Carbon;
class ReportController extends Controller
{
    /**
     * Show report page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $user = Auth::user();
        $years = Transaction::selectRaw('YEAR(created_at) as Tahun')->distinct()->get();

        $data = Transaction::whereYear('created_at', now()->year)
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m');
        });

        $dataChartMonthly = [];
        foreach ($data as $month => $transactions) {
            $dataChartMonthly[$month] = count($transactions);
        }


        // Chart per hari
        $dataChartDaily = Transaction::selectRaw('DATE(created_at) as Tanggal, COUNT(*) as jumlah')
            ->groupBy('Tanggal')
            ->whereMonth('created_at', now()->month)
            ->pluck('jumlah', 'Tanggal');

            $dateLabelsMonthly = [];

            $currentMonth = now();

            for ($i = 0; $i < 12; $i++) {
                $dateLabelsMonthly[] = $currentMonth->format('Y-m');
                $currentMonth = $currentMonth->subMonth();
            }
            $dateLabelsMonthly = array_reverse($dateLabelsMonthly);

        $dateLabelsDaily = [];
        for ($day = 1; $day <= now()->daysInMonth; $day++) {
            $dateLabelsDaily[] = date('Y-m-d', strtotime(now()->year . '-' . now()->month . '-' . $day));
        }

        return view('admin.report', compact('user', 'years', 'dataChartMonthly', 'dateLabelsMonthly', 'dataChartDaily', 'dateLabelsDaily'));
    }



    /**
     * Print report as pdf
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function print(Request $request): Response
    {
        $monthInput = $request->input('month');
        $yearInput = $request->input('year');
        $dateObj = DateTime::createFromFormat('!m', $monthInput);

        if ($dateObj) {
            $month = $dateObj->format('F');
        } else {
            abort(500);
        }

        $transactions = Transaction::whereMonth('created_at', $monthInput)
        ->whereYear('created_at', $yearInput)
        ->with('member')
        ->get();

        $groupedData = [];
        foreach ($transactions as $transaction) {
            $memberId = $transaction->member->id;
            $date = $transaction->created_at->format('Y-m-d');

            if (!isset($groupedData[$memberId][$date])) {
                $groupedData[$memberId][$date] = [
                    'total_amount' => 0,
                    'transactions_count' => 0
                ];
            }

            $groupedData[$memberId][$date]['total_amount'] += $transaction->total;
            $groupedData[$memberId][$date]['transactions_count']++;
        }



        $revenue = Transaction::whereMonth('created_at', $monthInput)
            ->whereYear('created_at', $yearInput)->sum('total');
        $transactionsCount = Transaction::whereMonth('created_at', $monthInput)
            ->whereYear('created_at', $yearInput)->count();
        $totalRows = 0;
        $pdf = PDF::loadview(
            'admin.report_pdf',
            compact(
                'monthInput',
                'yearInput',
                'revenue',
                'transactionsCount',
                'transactions',
                'groupedData',
                'totalRows'
            )
        );


        return $pdf->stream();
    }
    public function printYearly(Request $request): Response
    {
    $yearInput = $request->input('year');

    $transactions = Transaction::whereYear('created_at', $yearInput)
        ->with('member')
        ->get();

    $groupedData = [];
    foreach ($transactions as $transaction) {
        $memberId = $transaction->member->id;
        $month = $transaction->created_at->format('F');

        if (!isset($groupedData[$memberId][$month])) {
            $groupedData[$memberId][$month] = [
                'total_amount' => 0,
                'transactions_count' => 0
            ];
        }

        $groupedData[$memberId][$month]['total_amount'] += $transaction->total;
        $groupedData[$memberId][$month]['transactions_count']++;
    }

    $revenue = $transactions->sum('total');
    $transactionsCount = $transactions->count();

    // Membuat PDF
    $pdf = PDF::loadview(
        'admin.report_pdf_tahunan',
        compact(
            'yearInput',
            'revenue',
            'transactionsCount',
            'groupedData',
            'transactions'
        )
    );

    return $pdf->stream();
}



    /**
     * Get month by year report
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMonth(Request $request): JsonResponse
    {
        $year = $request->input('year', now()->year);
        $month = Transaction::whereYear('created_at', $year)
            ->selectRaw('MONTH(created_at) as Bulan')
            ->distinct()
            ->get();

        return response()->json($month);
    }
}
