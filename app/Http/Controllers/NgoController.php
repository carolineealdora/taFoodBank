<?php

namespace App\Http\Controllers;

use App\Helpers\File;
use App\Models\Donasi;
use App\Models\DonasiKonsumsi;
use App\Models\Kategori;
use App\Models\Kota;
use App\Models\LaporanDonasi;
use App\Models\LogStatus;
use App\Models\NGO;
use App\Models\Pickup;
use App\Models\Satuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Throwable;

class NgoController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::user()->id;
        $getDataNGO = NGO::where("user_id", $userId)->first();
        $ngoId = $getDataNGO->id;
        $countSubmitted = Donasi::where("ngo_tujuan", $ngoId)->where("status_donasi", 1)->count();
        $countApproved = Donasi::where("ngo_tujuan", $ngoId)->where("status_donasi", 2)->count();
        $countRejected = Donasi::where("ngo_tujuan", $ngoId)->where("status_donasi", 3)->count();
        $countPickedUp = Donasi::where("ngo_tujuan", $ngoId)->where("status_donasi", 4)->count();
        $countFinished = Donasi::where("ngo_tujuan", $ngoId)->where("status_donasi", 5)->count();
        $data = [
            'submited' => $countSubmitted,
            'approved' => $countApproved,
            'rejected' => $countRejected,
            'pickedup' => $countPickedUp,
            'finished' => $countFinished,
        ];
        return view('ngo/ngo_dashboard', $data);
    }

    public function showLoginForm()
    {
        return view('ngo.ngo_login');
    }

    public function showRegisterForm()
    {
        $kota = Kota::all();
        return view('ngo.ngo_register', ["kota" => $kota]);
    }

    public function approveDonasi($id)
    {
        try {
            Donasi::where("id", $id)->update(['status_donasi' => 2]);
            //insert to log
            $logData = [
                'donasi_id' => $id,
                'status_message' => "Disetujui Oleh NGO",
            ];
            LogStatus::create($logData);

            $getData = Donasi::with("donasi_konsumsi")->where("id", $id)->first();
            $getDataKonsumsi = $getData->donasi_konsumsi;
            foreach ($getDataKonsumsi as $item) {
                $data = [
                    'donasi' => $item['donasi']->id,
                    'nama' => $item['nama'],
                    'photo' => "default",
                    'deskripsi' => $item['deskripsi'],
                    'kategori' => $item['kategori'],
                    'satuan' => $item['satuan'],
                    'kuantitas' => $item['kuantitas'],
                    'expired' => $item['expired'],
                ];
                Pickup::create($data);
            }
            return response()->json([
                'status'    => 'ok',
                'response'  => 'approve-donasi',
                'message'   => 'Status Berhasil Diubah!',
                'route'     => route('ngo.detailDonasi', $id)
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Status Gagal Diubah',
            ], 500);
        }
    }

    public function cancelDonasi($id)
    {
        try {
            Donasi::where("id", $id)->update(['status_donasi' => 3]);
            return response()->json([
                'status'    => 'ok',
                'response'  => 'reject-donasi',
                'message'   => 'Status Berhasil Diubah!',
                'route'     => route('ngo.detailDonasi', $id)
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Status Gagal Diubah',
            ], 500);
        }
    }

    public function editPickup(Request $request, $id)
    {
        try {
            // Validation
            $rules = [
                'donasiFoto' => 'mimes:jpg,jpeg,png,svg',
            ];

            $messages = [
                'donasiFoto.mimes' => 'Hanya menerima extensi JPG, JPEG, PNG, SVG !',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => $validator->errors()->first()
                ], 400);
            }

            $dataPickup = Pickup::find($id)->first();
            $photo = $dataPickup->photo;
            $requestFile = $request->donasiFoto;
            if ($requestFile !== null && $requestFile !== 'undefined') {
                File::delete($photo);
                $path = "images/pickup";
                $insertImage = File::fileUpload($requestFile, $path);

                $data = [
                    'nama' => $request->nama,
                    'photo' => $insertImage,
                    'deskripsi' => $request->deskripsi,
                    'kategori' => $request->kategori,
                    'satuan' => $request->satuan,
                    'kuantitas' => $request->kuantitas,
                    'expired' => $request->expired,
                ];
            } else {
                $data = [
                    'nama' => $request->nama,
                    'deskripsi' => $request->deskripsi,
                    'kategori' => $request->kategori,
                    'satuan' => $request->satuan,
                    'kuantitas' => $request->kuantitas,
                    'expired' => $request->expired,
                ];
            }
            Pickup::find($id)->update($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'updated-donkom',
                'message'   => 'Update Data Telah Berhasil!',
                'route'     => route('ngo.detailDonasi', $dataPickup->donasi)
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Update Data Gagal!'
            ], 500);
        }
    }
    public function showDonasi()
    {
        //check user logged in
        $user = Auth::user();

        // get data ngo berdasarkan id user logged in
        $getUser = User::with("ngo")->where('email', $user->email)->first();

        //get list donasi berdasarkan id ngo
        $getDataTable = DB::table('views_donasi')->where('ngo_tujuan', $getUser->ngo->id);

        //generate datatable
        if(request()->ajax()){
            return DataTables()->queryBuilder($getDataTable)
                ->addColumn('nama_user', function ($query) {
                    $nama_user = $query->nama_user;

                    return $nama_user;
                })
                ->addColumn('donasi_konsumsi', function ($query) {
                    $donasi_konsumsi = $query->donasi_konsumsi;

                    return $donasi_konsumsi;
                })
                ->addColumn('status_donasi', function ($query) {
                    $status_donasi = $query->status_donasi;
                    if ($status_donasi == "submitted") {
                        $badge = '<span class="badge badge-sm bg-gradient-warning">Submitted</span>';
                    } elseif ($status_donasi == "approved") {
                        $badge = '<span class="badge badge-sm bg-gradient-success">Approved</span>';
                    } elseif ($status_donasi == "rejected") {
                        $badge = '<span class="badge badge-sm bg-gradient-danger">Rejected</span>';
                    } elseif ($status_donasi == "pickedup") {
                        $badge = '<span class="badge badge-sm bg-gradient-info">Picked Up</span>';
                    } elseif ($status_donasi == "finished") {
                        $badge = '<span class="badge badge-sm bg-gradient-primary">Finished</span>';
                    }
                    return $badge;
                })
                ->addColumn('tanggal_waktu', function ($query) {
                    $tanggal = $query->tanggal;

                    return $tanggal;
                })
                ->addColumn('action', function ($query) {
                    $button = '<button id="' . $query->id . '" class="action-edit btn btn-primary font-weight-bold text-xs edit-item" data-toggle="tooltip" data-original-title="Edit user">
                      Detail
                    </button>';

                    return $button;
                })
                ->rawColumns(['nama_user', 'donasi_konsumsi', 'status_donasi', 'tanggal_wwaktu', 'action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('ngo/ngo_donasi');
    }

    public function detailDonasi($id)
    {
        //Current Status
        $dataCurrentLog = LogStatus::where("donasi_id", $id)->orderBy('created_at', 'desc')->first();
        //log donasi
        $dataLog = LogStatus::where("donasi_id", $id)->orderBy('created_at', 'asc')->get();
        $dataDonasi = Donasi::with("donaturData", "ngo", "kotaData")->where("id", $id)->first();
        //informasi user
        $userId = $dataDonasi->donaturData->user_id;
        $userData = User::where("id", $userId)->first();
        //informasi donasi konsumsi
        $dataDonasiKonsumsi = DonasiKonsumsi::with("donasi", "dataKategori", "dataSatuan")->where("donasi_id", $id)->get();
        //informasi data pickup
        $dataPickup = Pickup::with("donasiData", "dataKategori", "dataSatuan")->where("donasi", $id)->get();
        //Get Data Report Donasi
        $dataReport = LaporanDonasi::where("donasi_id", $id)->count();
        //constanta untuk form
        $kategori = Kategori::get();
        $satuan = Satuan::get();
        $data = [
            "dataCurrentLog" => $dataCurrentLog,
            "dataLog" => $dataLog,
            "dataDonasi" => $dataDonasi,
            "dataUser" => $userData,
            "dataDonKom" => $dataDonasiKonsumsi,
            "dataPickup" => $dataPickup,
            "dataReport" => $dataReport,
            "kategori" => $kategori,
            "satuan" => $satuan
        ];
        return view('ngo/ngo_detail_donasi', $data);
    }

    public function addTimePickup(Request $request, $id)
    {
        try {
            $data = [
                "waktu_pickup" => $request->WaktuPembuatan,
            ];
            Pickup::where("donasi", $id)->update($data);
            //update status to pickedup
            Donasi::where("id", $id)->update(['status_donasi' => 4]);
            //insert to log
            $logData = [
                'donasi_id' => $id,
                'status_message' => "Picked Up",
            ];

            LogStatus::create($logData);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'updated-donkom',
                'message'   => 'Update Data Telah Berhasil!',
                'route'     => route('ngo.detailDonasi', $id)
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Update Data Gagal!'
            ], 500);
        }
    }

    public function deletePickup($id)
    {
        try {
            Pickup::find($id)->delete();
            return response()->json([
                'status'    => 'ok',
                'response'  => 'delete-pickup',
                'message'   => 'Data Berhasil Dihapus!',
                'route'     => route('ngo.detailDonasi', $id)
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Data Gagal Dihapus!'
            ], 500);
        }
    }

    public function reportDonasi(Request $request, $id)
    {
        try {
            // Validation
            $rules = [
                'photo' => 'required|mimes:jpg,jpeg,png,svg',
            ];

            $messages = [
                'photo.mimes' => 'Hanya menerima extensi JPG, JPEG, PNG, SVG !',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => $validator->errors()->first()
                ], 400);
            }

            $path = "images/report";
            $requestFile = $request->photo;
            $insertImage = File::fileUpload($requestFile, $path);

            $data = [
                'donasi_id' => $id,
                'foto_laporan' => $insertImage,
                'deskripsi' => $request->deskripsi,
            ];
            LaporanDonasi::create($data);
            //update status to finished
            Donasi::where("id", $id)->update(['status_donasi' => 5]);
            //insert to log
            $logData = [
                'donasi_id' => $id,
                'status_message' => "Berhasil Dikirim",
            ];
            LogStatus::create($logData);
            return response()->json([
                'status'    => 'ok',
                'response'  => 'add-report',
                'message'   => 'Data Berhasil Ditambahkan!',
                'route'     => route('ngo.detailDonasi', $id)
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Data Gagal Ditambahkan!'
            ], 500);
        }
    }

    public function createDonasi()
    {
        return view('ngo/ngo_create_donasi');
    }

    public function register(Request $request)
    {
        try {
            // Validation
            $rules = [
                'pic_foto' => 'required|mimes:jpg,jpeg,png,svg',
                'password' => 'required|min:8',
            ];

            $messages = [
                'pic_foto.mimes' => 'Hanya menerima extensi JPG, JPEG, PNG, SVG !',
                'password.min' => 'Password minimal 8 karakter!',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => $validator->errors()->first()
                ], 400);
            }

            $data_user = [
                'nama'  => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ];

            $user =  User::firstOrCreate($data_user);
            $user->assignRole('ngo');
            $path = "images/ngo";
            $requestFile = $request->pic_foto;
            $insertImage = File::fileUpload($requestFile, $path);
            $data_ngo = [
                'ngo_status'        => 0,
                'user_id'           => $user->id,
                'ngo_nama'          => $request->ngo_nama,
                'ngo_alamat'        => $request->ngo_alamat,
                'ngo_kota'          => $request->ngo_kota,
                'ngo_no_telp'       => $request->ngo_no_telp,
                'no_identitas'      => $request->no_identitas,
                'pic_foto'          => $insertImage
            ];

            NGO::create($data_ngo);
            return response()->json([
                'status'    => 'ok',
                'response'  => 'register-ngo',
                'message'   => 'Register telah berhasil',
                'route'     => route('ngo.showLogin')
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'terjadi kesalahan pada sistem'
            ], 500);
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('ngo/show-login');
    }

    public function showProfile()
    {
        try {
            //check user logged in
            $user = Auth::user();

            // get data donatur berdasarkan id user logged in
            $getUser = User::where('email', $user->email)->first();

            $getNgo = NGO::where('user_id', $getUser->id)->first();

            $getKota = Kota::where('id', $getNgo->ngo_kota)->first();

            $data = [
                'pic' => $getUser,
                'ngo' => $getNgo,
                'kota' => $getKota->nama
            ];

            return view('ngo/ngo_profile', ['data' => $data]);
        } catch (Throwable $e) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Terdapat kesalahan!'
            ], 500);
        }
    }

    public function editProfile(Request $request)
    {
        try {
            // Validation
            $rules = [
                'pic_foto' => 'mimes:jpg,jpeg,png,svg',
                'password' => 'min:8',
            ];

            $messages = [
                'pic_foto.mimes' => 'Hanya menerima extensi JPG, JPEG, PNG, SVG !',
                'password.min' => 'Password minimal 8 karakter!',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => $validator->errors()->first()
                ], 400);
            }
            //check user logged in
            $user = Auth::user();

            // get data donatur berdasarkan id user logged in
            $getData = User::where('email', $user->email)->first();

            $getNgo = NGO::where('user_id', $getData['id'])->first();

            //edit
            if ($request->password == null) {
                $data_credentials = [
                    "nama"      => $request->nama,
                ];
            } else {
                $data_credentials = [
                    "nama"      => $request->nama,
                    "password"  => Hash::make($request->password)
                ];
            }

            User::find($getData['id'])->update($data_credentials);

            if ($request['pic_foto'] !== null && $request['pic_foto'] !== 'undefined') { //kondisi saat foto berubah
                File::delete($getNgo->pic_foto);

                $path = "images/ngo";
                $requestFile = $request['pic_foto'];
                $insertImage = File::fileUpload($requestFile, $path);

                $data = [
                    "no_identitas"      => $request->no_identitas,
                    "pic_foto"          => $insertImage
                ];
            } else {
                $data = [
                    "no_identitas"      => $request->no_identitas
                ];
            }

            NGO::find($getNgo['id'])->update($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'created',
                'message'   => 'Selamat! Data profile telah diubah.',
                'route'     => route('ngo.profile')
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Terdapat kesalahan!'
            ], 500);
        }
    }
}
