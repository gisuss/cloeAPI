<?php

namespace App\Responsable\Dashboard;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use App\Helpers\StandardResponse;
use App\Http\Resources\{DashboardResource};
use App\Models\{Component, Raee};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};

class DashboardIndexResponsable implements Responsable
{
    use StandardResponse;
    public Request $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function toResponse($request) {
        $productCounts = Raee::select('line_id', DB::raw('count(*) as line_count'))
            ->groupBy('line_id')
            ->get();

        dd($productCounts);

        // return response()->json($productCounts);
        // return $this->showResponse(DashboardResource::make($res));
    }
}
