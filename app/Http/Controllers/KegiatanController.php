<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Kegiatandetail;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $title = 'Data Departments';
        $departements = Kegiatan::orderBy('id','Asc')->paginate(15);
        $managers = User::where('position','1')->get();
        return view('kegiatans.index', compact('departements','managers', 'title'));
    }

    public function create()
    {
        $title = "Tambah data";
        $managers = User::where('position', 'manager')->get();
        return view('kegiatans.create', compact('managers', 'title'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'location' => 'nullable',
            'manager_id' => 'required',
        ]);

        Kegiatan::create($validatedData);

        return redirect()->route('departements.index')->with('success', 'Departement created successfully.');
    }


    public function show(Kegiatans $kegiatan)
    {
        return view('kegiatans.show', compact('departement'));
    }


    public function edit(Kegiatans $kegiatan)
    {
        $title = 'Edit Departments';
        $managers = User::where('position','1')->get();
        return view('kegiatans.edit',compact('departement' ,'managers', 'title'));
    }

    public function update(Request $request, Kegiatans $kegiatan)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'manager_id' => 'required',
        ]);
        
        $departement->fill($request->post())->save();

        return redirect()->route('departements.index')->with('success','Departement Has Been updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Departements  $departements
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kegiatans $kegiatan)
    {
        $departement->delete();
        return redirect()->route('departements.index')->with('success', 'departements has been deleted successfully');
    }

    public function exportPdf()
    {
        $title = 'Laporan Data Departments';
        $kegiatans = Kegiatan::orderBy('id','asc')->get();
        $managers = User::where('position','1')->get();
        $pdf = PDF::loadview('departements.pdf', compact('departements','managers', 'title'));
        return $pdf->stream('laporan-departement-pdf');
    }
}
