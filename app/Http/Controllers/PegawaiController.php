<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get pegawai
        $pegawais = Pegawai::latest()->paginate(5);

        //render view with pegawai
        return view('pegawais.index', compact('pegawais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawais.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request ->all());
        $this->validate($request, [
            'nama'           => 'required',
            'alamat'         => 'required',
            'tempatlahir'    => 'required',
            'tanggallahir'   => 'required',
            'jeniskelamin'   => 'required',
            'nomorrekening'  => 'required'
        ]);

        // //upload image
        // $image = $request->file('image');
        // $image->storeAs('public/pegawais', $image->hashName());

        //create post
        $pegawai= Pegawai::create([
            
            'nama'              => $request->nama,
            'alamat'            => $request->alamat,
            'tempatlahir'       => $request->tempatlahir,
            'tanggallahir'      => $request->tanggallahir,
            'jeniskelamin'      => $request->jeniskelamin,
            'nomorrekening'     => $request->nomorrekening,
        ]);

        $rekening = new Rekening;
        $rekening->id_pegawai = $pegawai->id;
        $rekening->nomorrekening = $request->nomorrekening;
        $rekening->save();

        //redirect to index
        return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Disimpan!']);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        return view('pegawais.edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        //validate form
        $this->validate($request, [
            'nama'           => 'required',
            'alamat'         => 'required',
            'tempatlahir'    => 'required',
            'tanggallahir'   => 'required',
            'jeniskelamin'   => 'required',
            'nomorrekening'  => 'required'
        ]);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            // //upload new image
            // $image = $request->file('image');
            // $image->storeAs('public/posts', $image->hashName());

            // //delete old image
            // Storage::delete('public/posts/'.$post->image);

            //update post with new image
            $pegawai->update([
            'nama'              => $request->nama,
            'alamat'            => $request->alamat,
            'tempatlahir'       => $request->tempatlahir,
            'tanggallahir'      => $request->tanggallahir,
            'jeniskelamin'      => $request->jeniskelamin,
            'nomorrekening'     => $request->nomorrekening,
            ]);

        } else {

            //update post without image
            $pegawai->update([
            'nama'              => $request->nama,
            'alamat'            => $request->alamat,
            'tempatlahir'       => $request->tempatlahir,
            'tanggallahir'      => $request->tanggallahir,
            'jeniskelamin'      => $request->jeniskelamin,
            'nomorrekening'     => $request->nomorrekening,
            ]);
        }

        $rekening = Rekening::where('id_pegawai', $pegawai->id)->update([
            'nomorrekening' => $request->nomorrekening,
        ]);

        //redirect to index
        return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        //delete post
        $pegawai->delete();

        //redirect to index
        return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
