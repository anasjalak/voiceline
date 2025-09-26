<?php

 
namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Models\VoiceCall;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function getReportData(Request $request)
    {
         $query = DB::table('voice_calls')
            ->join('category', 'voice_calls.category', '=', 'category.id') // الربط مع جدول category
            ->select(
                'category.name as category', 
                DB::raw('COUNT(voice_calls.call_id) as total')
            );

        // فلترة حسب period
        if ($request->filled('period')) {
            $period = $request->period;
            switch ($period) {
                case 'today':
                    $query->whereDate('voice_calls.created_at', Carbon::today());
                    break;
                case 'last7':
                    $query->whereBetween('voice_calls.created_at', [Carbon::today()->subDays(6), Carbon::today()]);
                    break;
                case 'last30':
                    $query->whereBetween('voice_calls.created_at', [Carbon::today()->subDays(29), Carbon::today()]);
                    break;
                case 'thisMonth':
                    $query->whereMonth('voice_calls.created_at', Carbon::now()->month)
                          ->whereYear('voice_calls.created_at', Carbon::now()->year);
                    break;
                case 'lastMonth':
                    $lastMonth = Carbon::now()->subMonth();
                    $query->whereMonth('voice_calls.created_at', $lastMonth->month)
                          ->whereYear('voice_calls.created_at', $lastMonth->year);
                    break;
            }
        }

        // فلترة حسب تاريخ مخصص
        if ($request->filled('startDate') && $request->filled('endDate')) {
            $query->whereBetween('voice_calls.created_at', [$request->startDate, $request->endDate]);
        }

        // تجميع حسب category
        $data = $query->groupBy('category.id', 'category.name')->get();

        return response()->json($data);
    }
     
    
    
 


    public function index()
    {
        return view('dashboard');
    }

    public function getDashboardData(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->subDays(30)->format('Y-m-d'));
        $endDate = $request->input('end_date', Carbon::now()->format('Y-m-d'));

        // as khld request >> report User Performance 
        $userPerformance = VoiceCall::select(
                'handled_by_user_id',
                DB::raw('COUNT(*) as total_calls'),
                DB::raw('SUM(CASE WHEN Final_Status = "Completed" THEN 1 ELSE 0 END) as resolved_calls'),
                DB::raw('SUM(CASE WHEN Final_Status = "In Progress" THEN 1 ELSE 0 END) as in_progress_calls'),
                DB::raw('SUM(CASE WHEN Final_Status = "Pending" THEN 1 ELSE 0 END) as pending_calls'),
                DB::raw('SUM(CASE WHEN Final_Status = "Waiting Approval" THEN 1 ELSE 0 END) as waiting_approval_calls')
            )
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->whereNotNull('handled_by_user_id')
            ->groupBy('handled_by_user_id')
            ->with('handler')
            ->get();

        $statusDistribution = VoiceCall::select(
                'Final_Status',
                DB::raw('COUNT(*) as count')
            )
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->whereNotNull('Final_Status')
            ->groupBy('Final_Status')
            ->get();

         $categoryDistribution = VoiceCall::join('category', 'voice_calls.category', '=', 'category.id')
            ->select(
                'category.name as category_name',
                DB::raw('COUNT(*) as count')
            )
            ->whereBetween('voice_calls.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->groupBy('category.id', 'category.name')
            ->get();

         $dailyCalls = VoiceCall::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as call_count')
            )
            ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'userPerformance' => $userPerformance,
            'statusDistribution' => $statusDistribution,
            'categoryDistribution' => $categoryDistribution,
            'dailyCalls' => $dailyCalls,
            'dateRange' => [
                'start' => $startDate,
                'end' => $endDate
            ]
        ]);
    } 
   
    public function callsPerUser()
{
    $report = DB::table('voice_calls as v')
            ->join('users as u', 'u.id', '=', 'v.handled_by_user_id')
            ->select(
                'u.name',
                DB::raw('COUNT(*) AS Received_Calls'),
                DB::raw("SUM(CASE WHEN v.Final_Status = 'Scheduled' THEN 1 ELSE 0 END) AS Scheduled"),
                DB::raw("SUM(CASE WHEN v.Final_Status = 'Completed' THEN 1 ELSE 0 END) AS Completed"),
                DB::raw("SUM(CASE WHEN v.Final_Status = 'Processing' THEN 1 ELSE 0 END) AS Processing"),
                DB::raw("SUM(CASE WHEN v.Final_Status = 'In Progress' THEN 1 ELSE 0 END) AS In_Progress"),
                DB::raw("SUM(CASE WHEN v.Final_Status = 'Waiting Approval' THEN 1 ELSE 0 END) AS Waiting_Approval"),
                DB::raw("SUM(CASE WHEN v.Final_Status = 'Under Review' THEN 1 ELSE 0 END) AS Under_Review"),
                DB::raw("SUM(CASE WHEN v.Final_Status IS NULL THEN 1 ELSE 0 END) AS No_data"),
                DB::raw("SUM(CASE WHEN v.priority IS NOT NULL AND v.created_at <> v.updated_at THEN 1 ELSE 0 END) AS Priority_Changed")
            )
            ->groupBy('v.handled_by_user_id', 'u.name')
            ->get();
//dd($report);
        // تمرير المتغير للـ view
        return view('reports.dashboard', compact('report'));
    }

    public function dashboardData(Request $request)
{
    $query = DB::table('voice_calls as v')
        ->join('users as u', 'u.id', '=', 'v.handled_by_user_id')
        ->select(
            'u.name',
            DB::raw('COUNT(*) as Received_Calls'),
            DB::raw("SUM(CASE WHEN v.Final_Status = 'Scheduled' THEN 1 ELSE 0 END) as Scheduled"),
            DB::raw("SUM(CASE WHEN v.Final_Status = 'Completed' THEN 1 ELSE 0 END) as Completed"),
            DB::raw("SUM(CASE WHEN v.Final_Status = 'Processing' THEN 1 ELSE 0 END) as Processing"),
            DB::raw("SUM(CASE WHEN v.Final_Status = 'In Progress' THEN 1 ELSE 0 END) as In_Progress"),
            DB::raw("SUM(CASE WHEN v.Final_Status = 'Waiting Approval' THEN 1 ELSE 0 END) as Waiting_Approval"),
            DB::raw("SUM(CASE WHEN v.Final_Status = 'Under Review' THEN 1 ELSE 0 END) as Under_Review"),
            DB::raw("SUM(CASE WHEN v.Final_Status IS NULL THEN 1 ELSE 0 END) as No_data"),
            DB::raw("SUM(CASE WHEN v.Final_Status IS NOT NULL AND v.created_at <> v.updated_at THEN 1 ELSE 0 END) as Priority_Changed")
        );

    if ($request->period == 'week') {
        $query->where('v.created_at', '>=', now()->startOfWeek());
    } elseif ($request->period == 'month') {
        $query->where('v.created_at', '>=', now()->startOfMonth());
    } elseif ($request->period == 'last_month') {
        $query->whereBetween('v.created_at', [
            now()->subMonth()->startOfMonth(),
            now()->subMonth()->endOfMonth()
        ]);
    } elseif ($request->period == 'custom' && $request->from && $request->to) {
        $query->whereBetween('v.created_at', [$request->from, $request->to]);
    }

     $report = $query->groupBy('v.handled_by_user_id', 'u.name')->get();

    return response()->json($report);
}

}
