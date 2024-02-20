<?php

namespace App\Http\Controllers;

use Illuminate\Http\{Request, Response};
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\{Mail};
use App\Mail\ContactMail;
use App\Models\{Ciudad, Estado};

class LandingController extends Controller
{
    public function contact(ContactRequest $request) {
        try {
            $emailCloe = 'support.cloe@gmail.com';
            $data = $request->validated();
            Mail::to($emailCloe)->send(new ContactMail($data));
    
            return response()->json([
                'success' => true,
                'message' => 'Mensaje enviado exitosamente.',
                'code' => Response::HTTP_OK
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    public function states() {
        try {
            $estados = Estado::pluck('estado','id');
    
            return response()->json([
                'success' => true,
                'message' => 'Recurso obtenido con éxito.',
                'data' => $estados
            ],Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }

    public function cities(Request $request) {
        try {
            $ciudades = Ciudad::filterByState($request->filters)->pluck('ciudad','id');
    
            return response()->json([
                'success' => true,
                'message' => 'Recurso obtenido con éxito.',
                'data' => $ciudades
            ],Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }
}
