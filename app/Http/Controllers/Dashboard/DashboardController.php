<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Line;
use App\Models\Raee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{    
    public function index()
    {
        /*
        |   Tipos de RAEE - Según su línea
        */

        // $raeesByLine = Raee::select('line_id', DB::raw('count(*) as raees_count'))
        // ->groupBy('line_id')
        // ->get();

        // $response = [];
        // foreach ($raeesByLine as $raeeData) {
        //     $line = Line::find($raeeData->line_id);
        //     if ($line) {
        //         $response['raee_by_line'][] = [
        //             'line_name' => $line->name,
        //             'raees_count' => $raeeData->raees_count,
        //         ];
        //     }
        // }

        // cantidad de RAEE clasificados y separados
        $statuses = ['Clasificado', 'Separado'];
        $raeesByStatus = [];

        foreach ($statuses as $status) {
            $raeesCount = Raee::where('status', $status)->count();
            $raeesByStatus[] = [
                'status' => $status,
                'raees_count' => $raeesCount,
            ];
        }

        $response['raee_by_status'] = $raeesByStatus;

        /* 
        |    cantidad de usuarios por rol
        */

        // $roles = ['Admin', 'Encargado', 'Clasificador', 'Separador'];
        // $usersByRole = [];

        // foreach ($roles as $role) {
        //     $usersCount = User::whereHas('roles', function ($query) use ($role) {
        //         $query->where('name', $role);
        //     })->count();

        //     $usersByRole[] = [
        //         'role' => $role,
        //         'users_count' => $usersCount,
        //     ];
        // }

        $roles = ['Admin', 'Clasificador', 'Encargado', 'Separador'];
        $usersPercentageByRole = [];

        foreach ($roles as $role) {
            $totalUsers = User::count();
            $usersCountForRole = User::whereHas('roles', function ($query) use ($role) {
                $query->where('name', $role);
            })->count();

            $percentage = ($usersCountForRole / $totalUsers) * 100;

            $usersPercentageByRole[] = [
                'role' => $role,
                'users_percentage' => number_format($percentage, 2),
            ];
        }

        $response['users_by_role_percent'] = $usersPercentageByRole;

        /*
        | cantidad de materiales
        */

        $lines = Line::all()->sortBy('name');
        $raeesPercentageByLine = [];

        foreach ($lines as $line) {
            $totalRaees = Raee::count();
            $raeesCountForLine = Raee::where('line_id', $line->id)->count();
            $percentage = ($raeesCountForLine / $totalRaees) * 100;

            $raeesPercentageByLine[] = [
                'line_name' => $line->name,
                'raees_percentage' => number_format($percentage, 2),
            ];
        }

        $response['raee_by_line_percent'] = $raeesPercentageByLine;

        return response()->json($response);
    }
}
