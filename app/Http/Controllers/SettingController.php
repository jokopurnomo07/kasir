<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class SettingController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.setting.index', [
            'licenses' => "Ahmad Muzayyin",
            'data' => Setting::all(),
            // 'users' => User::where('status' , '>' , 1)->get(),
            'users' => User::all(),
            'user' => Auth::user(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // try {
        //     $validator = Validator::make($request->all(), [
        //         'nama' => 'required|string',
        //         'alamat' => 'required|max:200',
        //         'logo' => 'required|file|mimes:jpg,jpeg,png|max:10240'
        //     ]);

        //     if ($validator->passes()) {
        //         $file = $request->file('logo');
        //         $fileName = Auth::user()->name.'_'.date('h:i:s').'_'.'logo-toko'.'.'.$file->extension();
        //         Setting::create([
        //             'nama' => $request->nama,
        //             'alamat' => $request->alamat,
        //             'logo' => $fileName,
        //             'nota' => $request->nota
        //         ]);
        //         $file->move(public_path('uploads'), $fileName);

        //         return redirect()->back()->with('success', 'Gambar berhasil diupload!');
        //     }else{
        //         return redirect()->back()->with('error', 'Ekstensi file harus .jpg .jpeg .png!');
        //     }
        // } catch (\Throwable $th) {
        //     $th->getmessage();
        // }
    }

    public function storeUser(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:50',
                'username' => 'required|max:50|unique:user,username',
                'password' => 'required|max:50',
                'alamat' => 'required|max:50',
                'jenis_kelamin' => 'required|max:50',
                'no_telepon' => 'required|max:50',
                'status' => 'required|max:50',
            ]);

            if ($validator->passes()) {
                // User::create([
                //     'kategori' => ucfirst($request->kategori),
                //     'jenis' => ucfirst($request->jenis),
                // ]);
                return response()->json(['success' => 'Data berhasil ditambahkan.']);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        } catch (\Throwable $th) {
            $th->getmessage();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting) {
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|max:255',
                'alamat' => 'required|max:255',
                'nota' => 'required',
                // 'logo' => 'required|file|mimes:jpg,jpeg,png|max:10240'
            ]);

            if ($validator->passes()) {
                $setting = Setting::find($setting->id);
                // $file = $request->file()->logo;
                // $fileName = Auth::user()->name.'_'.date('h:i:s').'_'.'logo-toko'.'.'.$file->extension();
                // dd($fileName);
                // $file->move(public_path('uploads'), $fileName);

                $setting->nama = $request->nama;
                $setting->alamat = $request->alamat;
                $setting->logo = 'logo-toko.png';
                $setting->nota = $request->nota;
                $setting->save();

                return response()->json(['success' => 'Data berhasil disimpan!']);
            } else {
                return response()->json(['error' => $request->file('logo')]);
            }
        } catch (\Throwable $th) {
            $th->getmessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting) {
        //
    }
}
