<?php

namespace App\Http\Controllers\Components;

use App\Exports\SplitComponentExport;
use App\Http\Controllers\Controller;
use App\Models\{Component, User};
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

    public function reportPDF() {
        $isAdmin = false;
        $userAuth = User::where('id', Auth::user()->id)->first();

        if ($userAuth->getRoleNames()[0] === 'Admin') {
            $componentes = Component::all();
            $isAdmin = true;
            $pdf = Pdf::loadView('exports.PDFComponentes', compact('componentes', 'isAdmin'));
    
            return $pdf->download('reporte_de_componentes.pdf');
        }else if ($userAuth->getRoleNames()[0] === 'Separador') {
            $componentes = Component::centro($userAuth->centro_id)->get();
            $centro = $userAuth->centro->name;
            $pdf = Pdf::loadView('exports.PDFComponentes', compact('componentes', 'isAdmin', 'centro'));
    
            return $pdf->download('reporte_de_componentes.pdf');
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Acceso no autorizado.',
                'code' => 403
            ], 403);
        }
    }

    public function reportExcel(Request $request) {
        return Excel::download(new SplitComponentExport($request), 'reporte_de_componentes.xlsx');
    }
}
