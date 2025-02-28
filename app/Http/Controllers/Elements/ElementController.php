<?php

namespace App\Http\Controllers\Elements;

use App\Exports\ComponentExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ElementUpdateRequest;
use App\Models\{Component, User};
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Responsable\Elements\{ ElementIndexResponsable, ElementUpdateResponsable, ElementDestroyResponsable };
use Illuminate\Support\Facades\Auth;

class ElementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ElementIndexResponsable $elementIndexResponsable) {
        return $elementIndexResponsable;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $component_id, ElementUpdateRequest $request)
    {
        // dd($request->validated());
        return new ElementUpdateResponsable($component_id, $request->validated());
    }

    public function destroy(int $component_id)
    {
        return new ElementDestroyResponsable($component_id);
    }

    public function reportPDF() {
        $isAdmin = false;
        $userAuth = User::where('id', Auth::user()->id)->first();

        if ($userAuth->getRoleNames()[0] === 'Admin') {
            $componentes = Component::all();
            $isAdmin = true;
            $pdf = Pdf::loadView('exports.PDFComponentes', compact('componentes', 'isAdmin'));
    
            return $pdf->download('reporte_de_componentes.pdf');
        }else if ($userAuth->getRoleNames()[0] === 'Separador' || $userAuth->getRoleNames()[0] === 'Encargado' || $userAuth->getRoleNames()[0] === 'Clasificador') {
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
        return Excel::download(new ComponentExport($request), 'reporte_de_componentes.xlsx');
    }
}
