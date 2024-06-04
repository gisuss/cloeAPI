<?php

namespace App\Http\Controllers\Components;

use App\Exports\SplitComponentExport;
use App\Http\Controllers\Controller;
use App\Models\{Component, Raee, User};
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Responsable\Componentes\{ NewComponentRIndexResponsable, ComponentStoreResponsable, ComponentShowResponsable };
use Illuminate\Support\Facades\Auth;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(NewComponentRIndexResponsable $componentIndexResponsable)
    {
        return $componentIndexResponsable;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param mixed $componentStoreResponsable
     * @return void
     */
    public function store(ComponentStoreResponsable $componentStoreResponsable)
    {
        return $componentStoreResponsable;
    }

    /**
     * Display the specified resource.
     * 
     * @param int $raee_id
     * @return void
     */
    public function show(int $raee_id)
    {
        return new ComponentShowResponsable($raee_id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $raee_id)
    {
        // return new ComponentUpdateResponsable($raee_id, $request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function reportPDF(Request $request) {
        $isAdmin = false;
        $centro = '';
        $userAuth = User::where('id', Auth::user()->id)->first();

        if ($userAuth->getRoleNames()[0] === 'Admin') {
            if ($request->type == 1) {
                $raees = Raee::all();
            }else{
                if ($request->type == 2) {
                    $raees = Raee::type('Clasificado')->get();
                }else{
                    $raees = Raee::type('Separado')->get();
                }
            }
            $isAdmin = true;
        }else{
            if ($request->type == 1) {
                $raees = Raee::where('centro_id', $userAuth->centro_id)->get();
            }else{
                if ($request->type == 2) {
                    $raees = Raee::where('centro_id', $userAuth->centro_id)->type('Clasificado')->get();
                }else{
                    $raees = Raee::where('centro_id', $userAuth->centro_id)->type('Separado')->get();
                }
            }
            $centro = $userAuth->centro->name;
        }

        $pdf = Pdf::loadView('exports.PDFRaeeFilter', compact('raees', 'isAdmin', 'centro'));
        return $pdf->download('reporte_de_separaciones.pdf');
    }

    public function reportExcel(Request $request) {
        return Excel::download(new SplitComponentExport($request), 'reporte_de_separaciones.xlsx');
    }
}
