<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuruModel;

class GuruController extends Controller
{

    public function __construct() {
        $this->GuruModel = new GuruModel();
        $this->middleware('auth');
    } 

    public function index() {
        $data = [
            'guru' => $this->GuruModel->allData(),
        ];
        return view('v_guru', $data);
    }

    public function detail($id_guru) {
        if (!$this->GuruModel->detailData($id_guru)) {
            abort(404);
        }

        $data = [
            'guru' => $this->GuruModel->detailData($id_guru),
        ];
        return view('v_detailguru', $data);
    }

    public function add() {
        return view('v_addguru');
    }

    public function insert() {
        Request()->validate([
            'nip' => 'required|unique:tbl_guru,nip|min:4|max:5',
            'nama_guru' => 'required',
            'mapel' => 'required',
            'foto_guru' => 'required|mimes:jpg,jpeg,png,svg|max:1024'
        ], [
            'nip.required' => 'NIP wajib diisi !',
            'nip.unique' => 'NIP ini sudah ada !',
            'nip.min' => 'NIP minimal mesti 4 karakter !',
            'nip.max' => 'NIP maksimal mesti 5 karakter !',
            'nama_guru.require' => 'Nama Guru wajib diisi !',
            'mapel.required' => 'Mata Pelajaran wajib diisi !',
            'foto_guru.required' => 'Foto Guru mesti diisi !',
            'foto_guru.mimes' => 'Foto harus berformat jpg, jpeg, png atau svg. Tidak bisa selain itu !'
        ]);

        // Jika validasi tidak ada maka simpan data
        // Upload gambar/foto
        $file = Request()->foto_guru;
        $fileName = Request()->nip . '.' . $file->extension();
        $file->move(public_path('foto_guru'), $fileName);

        $data = [
            'nip' => Request()->nip,
            'nama_guru' => Request()->nama_guru,
            'mapel' => Request()->mapel,
            'foto_guru' => $fileName,
        ];

        $this->GuruModel->addData($data);
        return redirect()->route('guru')->with('pesan', 'Data berhasil di tambahkan');
    }

    public function edit($id_guru) {
        if (!$this->GuruModel->detailData($id_guru)) {
            abort(404);
        }

        $data = [
            'guru' => $this->GuruModel->detailData($id_guru),
        ];
        return view('v_editguru', $data);
    }

    public function update($id_guru) {
        Request()->validate([
            'nama_guru' => 'required',
            'mapel' => 'required',
            'foto_guru' => 'mimes:jpg,jpeg,png,svg|max:1024'
        ], [
            'nama_guru.require' => 'Nama Guru wajib diisi !',
            'mapel.required' => 'Mata Pelajaran wajib diisi !',
            'foto_guru.required' => 'Foto Guru mesti diisi !',
            'foto_guru.mimes' => 'Foto harus berformat jpg, jpeg, png atau svg. Tidak bisa selain itu !'
        ]);

        // Jika validasi tidak ada maka simpan data
        if (Request()->foto_guru <> "") {
            // Upload gambar/foto
            // Jika ingin ganti foto
            $file = Request()->foto_guru;
            $fileName = Request()->nip . '.' . $file->extension();
            $file->move(public_path('foto_guru'), $fileName);
            $data = [
                'nip' => Request()->nip,
                'nama_guru' => Request()->nama_guru,
                'mapel' => Request()->mapel,
                'foto_guru' => $fileName
            ];

            $this->GuruModel->editData($id_guru, $data);
        } else {
            $data = [
                // Jika tidak ingin ganti foto
                'nip' => Request()->nip,
                'nama_guru' => Request()->nama_guru,
                'mapel' => Request()->mapel,
            ];

            $this->GuruModel->editData($id_guru, $data);
        }
        
        return redirect()->route('guru')->with('pesan', 'Data berhasil di update');
    }

    public function delete($id_guru) {
        // Ini akan menghapus atau mendelete fotonya juga
        $guru = $this->GuruModel->detailData($id_guru);

        if ($guru->foto_guru <> "") {
            @unlink(public_path('foto_guru') . '/' . $guru->foto_guru);
        }

        $this->GuruModel->deleteData($id_guru);
        return redirect()->route('guru')->with('pesan', 'Data berhasil di hapus');
    }
}