<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Cita;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cita::with('dia.estudi')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = NULL;
        if(!Cita::where('email', $request->input('email'))->exists()) {
            $cita = Cita::find($request->input('cita'));
            $cita->email = $request->input('email');
            $cita->estat = 'ple';
            $cita->save();
        } else {
            $status = 'Ja tenies una cita. Si vols canviar-la pots anular-la.';
        }
        return redirect()
          ->route('cita.showByEmail', ['email' => md5($request->input('email'))])
          ->with('status', $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    public function showByEmail($email)
    {
        if(Cita::where(DB::raw('md5(email)'), $email)->exists()) {
          return view('cita', ['cita' => Cita::where(DB::raw('md5(email)'), $email)->first()]);
        } else {
          return redirect()->route('index')->with('buscarStatus', 'Email no trobat!');
        }

    }

    public function searchEmail(Request $request)
    {
        $request->validate([
          'email' => 'required|email'
        ]);

        $email = $request->input('email');
        return redirect()->route('cita.showByEmail', ['email' => md5($email)]);

    }

    public function block(Cita $cita)
    {
        if($cita->estat === 'ple') {
          abort(500, $cita->estat);
        } else {
          $cita->estat = 'bloquejat';
          $cita->save();
          return $cita;
        }
    }

    public function cancel(Cita $cita) {
        $cita->email = '';
        $cita->estat = 'buit';
        $cita->save();
        return $cita;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cita $cita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->estat = 'buit';
        $cita->email = NULL;
        $cita->save();
        return redirect()->route('index')->with('status', 'Cita anulada');
    }
}
