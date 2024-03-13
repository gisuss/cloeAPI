<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Responsable\Components\{ ComponentStoreResponsable, ComponentShowResponsable };

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
