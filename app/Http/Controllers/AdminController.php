<?php

namespace App\Http\Controllers;

use App\Models\NGO;
use App\Models\Kota;
use App\Models\User;
use App\Helpers\File;
use App\Models\Admin;
use App\Models\Donasi;
use App\Models\DonasiKonsumsi;
use App\Models\Pickup;
use App\Models\Satuan;
use App\Models\Donatur;
use App\Models\Kategori;
use App\Models\LogStatus;
use Illuminate\Http\Request;
use App\Models\LaporanDonasi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    protected $table = 'admin';

    public function showLoginForm()
    {
        return view('admin.admin_login');
    }

    public function login()
    {
        return view('admin/admin_login');
    }

    public function dashboard()
    {
        $userId = Auth::user()->id;
        $getDataAdmin = Admin::where("user_id", $userId)->first();
        $admminId = $getDataAdmin->id;
        $countSubmitted = Donasi::where("status_donasi", 1)->count();
        $countApproved = Donasi::where("status_donasi", 2)->count();
        $countRejected = Donasi::where("status_donasi", 3)->count();
        $countPickedUp = Donasi::where("status_donasi", 4)->count();
        $countFinished = Donasi::where("status_donasi", 5)->count();
        $data = [
            'submited' => $countSubmitted,
            'approved' => $countApproved,
            'rejected' => $countRejected,
            'pickedup' => $countPickedUp,
            'finished' => $countFinished,
        ];
        return view('admin/admin_dashboard', $data);
        $userId = Auth::user()->id;
        $getDataAdmin = Admin::where("user_id", $userId)->first();
        $admminId = $getDataAdmin->id;
        $countSubmitted = Donasi::where("status_donasi", 1)->count();
        $countApproved = Donasi::where("status_donasi", 2)->count();
        $countRejected = Donasi::where("status_donasi", 3)->count();
        $countPickedUp = Donasi::where("status_donasi", 4)->count();
        $countFinished = Donasi::where("status_donasi", 5)->count();
        $data = [
            'submited' => $countSubmitted,
            'approved' => $countApproved,
            'rejected' => $countRejected,
            'pickedup' => $countPickedUp,
            'finished' => $countFinished,
        ];
        return view('admin/admin_dashboard', $data);
    }

    public function profile()
    {
        return view('admin/admin_profile');
    }

    // public function detailDonasi($id){
    //     try{
    //         //Current Status
    //         $dataCurrentLog = LogStatus::where("donasi_id", $id)->orderBy('created_at', 'desc')->first();
    //         //log donasi
    //         $dataLog = LogStatus::where("donasi_id", $id)->orderBy('created_at', 'asc')->get();
    //         $dataDonasi = Donasi::with("donaturData", "ngo", "kotaData")->where("id", $id)->first();
    //         //informasi donatur
    //         $donaturId = $dataDonasi->donaturData->user_id;
    //         $donaturData = User::where("id", $donaturId)->first();
    //         //informasi ngo
    //         $ngoId = $dataDonasi->ngo->user_id;
    //         $ngoData = User::where("id", $ngoId)->first();
    //         $dataNgoKota = Kota::where('id', $dataDonasi->ngo->ngo_kota)->first();
    //         //informasi donasi konsumsi
    //         $dataDonasiKonsumsi = DonasiKonsumsi::with("donasi", "dataKategori", "dataSatuan")->where("donasi_id", $id)->get();
    //         //informasi data pickup
    //         $dataPickup = Pickup::with("donasiData", "dataKategori", "dataSatuan")->where("donasi_id", $id)->get();
    // }

    public function detailDonasi($id)
    {
        try{
            //Current Status
            $dataCurrentLog = LogStatus::where("donasi_id", $id)->orderBy('created_at', 'desc')->first();
            //log donasi
            $dataLog = LogStatus::where("donasi_id", $id)->orderBy('created_at', 'asc')->get();
            $dataDonasi = Donasi::with("donaturData", "ngo", "kotaData")->where("id", $id)->first();
            //informasi donatur
            $donaturId = $dataDonasi->donaturData->user_id;
            $donaturData = User::where("id", $donaturId)->first();
            //informasi ngo
            $ngoId = $dataDonasi->ngo->user_id;
            $ngoData = User::where("id", $ngoId)->first();
            $dataNgoKota = Kota::where('id', $dataDonasi->ngo->ngo_kota)->first();
            //informasi donasi konsumsi
            $dataDonasiKonsumsi = DonasiKonsumsi::with("donasi", "dataKategori", "dataSatuan")->where("donasi_id", $id)->get();
            //informasi data pickup
            $dataPickup = Pickup::with("donasiData", "dataKategori", "dataSatuan")->where("donasi_id", $id)->get();

            //Get Data Report Donasi
            $dataReport = LaporanDonasi::where('donasi_id', $id)->get();

            //constanta untuk form
            $kategori = Kategori::get();
            $satuan = Satuan::get();
            $kota = Kota::get();
            $ngos = NGO::get();
            $data = [
                "dataCurrentLog" => $dataCurrentLog,
                "dataLog" => $dataLog,
                "dataDonasi" => $dataDonasi,
                "dataDonatur" => $donaturData,
                "dataNgo" => $ngoData,
                "dataNgoKota" => $dataNgoKota,
                "dataDonKom" => $dataDonasiKonsumsi,
                "dataPickup" => $dataPickup,
                "dataReport" => $dataReport,
                "kategori" => $kategori,
                "satuan" => $satuan,
                "kota" => $kota,
                "ngos" => $ngos
            ];

            return view('admin/admin_detail_donasi', $data);
        }catch(Throwable $e){
            return response()->json([
                'status' => 'error',
                'response' => $e,
            ], 500);
        }
    }

    public function donatur()
    {
        $getDataTable = Donatur::with("userData");
        if (request()->ajax()) {
            return DataTables()->eloquent($getDataTable)
                ->addColumn('donatur_nama', function ($query) {
                    $nama_donatur = $query->userData->nama;

                    return $nama_donatur;
                })
                ->addColumn('no_telp', function ($query) {
                    $no_telp = $query->no_telp;

                    return $no_telp;
                })
                ->addColumn('action', function ($query) {
                    $button = '
                    <div>
                    <button id="' . $query->id . '" class="action-detail btn btn-primary btn-sm text-secondary font-weight-bold text-xs edit-item" data-toggle="tooltip" data-original-title="Detail">
                        <span style="color : white">Detail</span>
                    </button>
                    </div>
                    ';

                    return $button;
                })
                ->rawColumns(['doantur_nama', 'no_telp', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin/admin_donatur');
    }

    public function detailDonatur($id)
    {
        $getData = Donatur::with("userData")->where("id", $id)->first();
        $data = [
            'getData' => $getData
        ];
        return view('admin/admin_detail_donatur', $data);
    }

    public function getListNgo()
    {
        $getDataTable = NGO::with("userData", "kotaData");
        if (request()->ajax()) {
            return DataTables()->eloquent($getDataTable)
                ->addColumn('nama_ngo', function ($query) {
                    $nama_ngo = $query->ngo_nama;

                    return $nama_ngo;
                })
                ->addColumn('nama_user', function ($query) {
                    $nama_user = $query->userData->nama;

                    return $nama_user;
                })
                ->addColumn('kota', function ($query) {
                    $kota = $query->kotaData->nama;

                    return $kota;
                })
                ->addColumn('status', function ($query) {
                    $status = $query->ngo_status;
                    if ($status == 0) {
                        $badge = '<span class="badge badge-sm bg-gradient-warning">Submitted</span>';
                    } elseif ($status == 1) {
                        $badge = '<span class="badge badge-sm bg-gradient-success">Approved</span>';
                    } elseif ($status == 2) {
                        $badge = '<span class="badge badge-sm bg-gradient-danger">Rejected</span>';
                    }
                    return $badge;
                })
                ->addColumn('action', function ($query) {
                    $button = '
                    <div>
                    <button id="' . $query->id . '" class="action-detail btn btn-primary btn-sm text-secondary font-weight-bold text-xs edit-item" data-toggle="tooltip" data-original-title="Detail">
                        <span style="color : white">Detail</span>
                    </button>
                    </div>
                    <div>
                    <button id="' . $query->id . '" class="action-hapus btn btn-danger btn-sm text-secondary font-weight-bold text-xs edit-item" data-toggle="tooltip" data-original-title="Edit">
                        <span style="color : white">Hapus</span>
                    </button>
                    </div>
                    ';

                    return $button;
                })
                ->rawColumns(['nama_ngo', 'nama_user', 'kota', 'status', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin/admin_ngo');
    }

    public function detailNgo($id)
    {
        //current ngo data
        $dataUser = NGO::with("userData", "kotaData")->where("id", $id)->first();
        //get kota content
        $dataKota = Kota::get();
        $data = [
            'dataUser' => $dataUser,
            'kotaData' => $dataKota
        ];
        return view('admin/admin_detail_ngo', $data);
    }

    public function admin()
    {
        return view('admin/admin_admins');
    }

    public function detailAdmin()
    {
        return view('admin/admin_detail_admin');
    }

    public function kota()
    {
        $getData = Kota::get();
        return view('admin/admin_kota', ['data' => $getData]);
    }

    public function createKota()
    {
        return view('admin/admin_create_kota');
    }

    public function jenis()
    {
        return view('admin/admin_jenis');
    }

    public function detailJenis()
    {
        return view('admin/admin_detail_jenis');
    }

    public function createJenis()
    {
        return view('admin/admin_create_jenis');
    }

    public function kategori()
    {
        return view('admin/admin_kategori');
    }

    public function detailKategori($id)
    {
        $getKategori = Kategori::where('id', $id)->first();

        $data = [
            "dataKategori" => $getKategori,
        ];

        return view('admin/admin_detail_kategori', $data);
    }

    public function createKategori()
    {
        return view('admin/admin_create_kategori');
    }

    public function satuan()
    {
        return view('admin/admin_satuan');
    }

    public function detailSatuan($id)
    {
        $getSatuan = Satuan::where('id', $id)->first();

        $data = [
            "dataSatuan" => $getSatuan
        ];

        return view('admin/admin_detail_satuan', $data);
    }

    public function createSatuan()
    {
        return view('admin/admin_create_satuan');
    }

    public function statusDonasi()
    {
        return view('admin/admin_statusDonasi');
    }

    public function detailStatusDonasi()
    {
        return view('admin/admin_detail_status_donasi');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('admin/show-login');
    }

    public function getProfile()
    {
        try {
            //check user logged in
            $user = Auth::user();

            // get data donatur berdasarkan id user logged in
            $getUser = User::with('admin')->where('email', $user->email)->first();

            return view('admin/admin_profile', ['data' => $getUser]);
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
            //check user logged in
            $user = Auth::user();

            // get data donatur berdasarkan id user logged in
            $getData = User::where('email', $request->email)->first();
            $getAdmin = Admin::where('user_id', $getData['id'])->first();

            //edit
            if ($request->password == null) {
                $data_credentials = [
                    "nama"      => $request->nama,
                    "email"     => $request->email
                ];
            } else {
                $data_credentials = [
                    "nama"      => $request->nama,
                    "email"     => $request->email,
                    "password"  => Hash::make($request->password)
                ];
            }

            User::find($getData['id'])->update($data_credentials);

            if ($request['foto_profil'] !== null && $request['foto_profil'] !== 'undefined') { //kondisi saat foto berubah
                File::delete($getAdmin->foto_profil);

                $path = "images/admin";
                $requestFile = $request['foto_profil'];
                $insertImage = File::fileUpload($requestFile, $path);

                $data = [
                    "foto_profil"       => $insertImage,
                    "no_identitas"      => $request->no_identitas
                ];
            } else {
                $data = [
                    "no_identitas"      => $request->no_identitas
                ];
            }

            Admin::find($getAdmin['id'])->update($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'created',
                'message'   => 'Selamat! Data profile telah diubah.',
                'route'     => route('admin.profile')
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status'    => 'failed',
                'message'   => 'Terdapat kesalahan!'
            ], 500);
        }
    }

    public function approveNGO($id)
    {
        try {
            NGO::where("id", $id)->update(['ngo_status' => 1]);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'approve-ngo',
                'message'   => 'Status Berhasil Diubah!',
                'route'     => route('admin.detail-ngo', $id)
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Status Gagal Diubah',
            ], 500);
        }
    }

    public function cancelNGO($id)
    {
        try {
            NGO::where("id", $id)->update(['ngo_status' => 2]);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'approve-ngo',
                'message'   => 'Status Berhasil Diubah!',
                'route'     => route('admin.detail-ngo', $id)
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Status Gagal Diubah',
            ], 500);
        }
    }

    public function getNGO($id)
    {
        try {
            $getNGO = NGO::with('user')->find($id);
            return $getNGO;
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'detail-ngo',
                'message' => $e,
            ], 500);
        }
    }

    public function editNGO(Request $request, $id)
    {
        try {
            $data = [
                "ngo_nama" => $request->ngo_nama,
                "ngo_kota" => $request->ngo_kota,
                "ngo_no_telp" => $request->ngo_no_telp,
                "ngo_alamat" => $request->ngo_alamat
            ];
            $updateNGO = NGO::find($id)->update($data);
            return response()->json([
                'status'    => 'ok',
                'response'  => 'updated',
                'message'   => 'Selamat! Data NGO telah diubah.',
                'route'     => route('admin.detail-ngo', $id)
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => "Data Gagal di update!",
            ], 500);
        }
    }

    public function editPIC(Request $request, $id)
    {
        try {
            $db_ngo = NGO::find($id)->first();
            $photo = $db_ngo->pic_foto;
            if ($request['pic_foto'] !== null) { //kondisi saat foto berubah
                File::delete($photo);
                $path = "images/pic";
                $requestFile = $request->pic_foto;
                // return $requestFile;
                $insertImage = File::fileUpload($requestFile, $path);
                $dataNGO = [
                    "no_identitas" => $request->no_identitas,
                    "pic_foto"  => $insertImage
                ];

                NGO::find($id)->update($dataNGO);

                if ($request->password !== null) {
                    $dataUser = [
                        "nama" => $request->nama_user,
                        "email" => $request->email,
                        "password" => Hash::make($request->password),
                    ];
                    User::find($db_ngo->user_id)->update($dataUser);
                } else {
                    $dataUser = [
                        "nama" => $request->nama_user,
                        "email" => $request->email,
                    ];
                    User::find($db_ngo->user_id)->update($dataUser);
                }
            } else {
                $dataNGO = [
                    "no_identitas" => $request->no_identitas,
                ];

                NGO::find($id)->update($dataNGO);

                if ($request->password !== null) {
                    $dataUser = [
                        "nama" => $request->nama_user,
                        "email" => $request->email,
                        "password" => Hash::make($request->password),
                    ];
                    User::find($db_ngo->user_id)->update($dataUser);
                } else {
                    $dataUser = [
                        "nama" => $request->nama_user,
                        "email" => $request->email,
                    ];
                    User::find($db_ngo->user_id)->update($dataUser);
                }
            }
            return response()->json([
                'status'    => 'ok',
                'response'  => 'updated',
                'message'   => 'Selamat! Data PIC telah diubah.',
                'route'     => route('admin.detail-ngo', $id)
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => "Data Gagal di update!",
            ], 500);
        }
    }

    public function deleteNGO($id)
    {
        try {
            NGO::find($id)->delete();
            return response()->json([
                'status'    => 'ok',
                'response'  => 'updated',
                'message'   => 'Data Berhasil Dihapus!',
                'route'     => route('admin.ngo')
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'delete-ngo',
                'message'   => 'Data Gagal Dihapus!',
            ], 500);
        }
    }

    public function getDonatur($id)
    {
        try {
            $getDonatur = Donatur::with('user')->find($id);
            return $getDonatur;
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'detail-ngo',
                'message' => $e,
            ], 500);
        }
    }

    public function editDonatur(Request $request, $id)
    {
        try {
            $db_donatur = Donatur::where('id', $id)->first();
            $db_user = User::where('id', $db_donatur->user_id)->first();
            $photo = $db_donatur->foto;
            if ($request['foto'] !== null) { //kondisi saat foto berubah
                File::delete($photo);
                $path = "images/donatur";
                $requestFile = $request->foto;
                $insertImage = File::fileUpload($requestFile, $path);
                $dataDonatur = [
                    "no_telp" => $request->no_telp,
                    "tanggal_lahir" => $request->tanggal_lahir,
                    "alamat" => $request->alamat,
                    "no_identitas" => $request->no_identitas,
                    "foto"  => $insertImage
                ];

                Donatur::find($id)->update($dataDonatur);

                if ($request->password !== null) {
                    $dataUser = [
                        "nama" => $request->nama,
                        "email" => $request->email,
                        "password" => Hash::make($request->password),
                    ];
                    User::find($db_donatur->user_id)->update($dataUser);
                } else {
                    $dataUser = [
                        "nama" => $request->nama,
                        "email" => $request->email,
                    ];
                    User::find($db_donatur->user_id)->update($dataUser);
                }
            } else {
                $dataDonatur = [
                    "foto"  => $db_donatur->foto,
                    "no_telp" => $request->no_telp,
                    "tanggal_lahir" => $request->tanggal_lahir,
                    "alamat" => $request->alamat,
                    "no_identitas" => $request->no_identitas,
                ];
                Donatur::find($id)->update($dataDonatur);

                if ($request->password !== null) {
                    $dataUser = [
                        "nama" => $request->nama,
                        "email" => $request->email,
                        "password" => Hash::make($request->password),
                    ];
                    User::find($db_donatur->user_id)->update($dataUser);
                } else {
                    $dataUser = [
                        "nama" => $request->nama,
                        "email" => $request->email,
                    ];
                    User::find($d->user_id)->update($dataUser);
                }
            }
            return response()->json([
                'status'    => 'ok',
                'response'  => 'updated',
                'message'   => 'Selamat! Data Donatur telah diubah.',
                'route'     => route('admin.detail-donatur', $id)
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => "Data Gagal di update!",
            ], 500);
        }
    }

    public function deleteDonatur($id)
    {
        try {
            Donatur::find($id)->delete();

            return response()->json([
                'status'    => 'ok',
                'response'  => 'updated',
                'message'   => 'Data Berhasil Dihapus!',
                'route'     => route('admin.donatur')
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'delete-ngo',
                'message'   => 'Data Gagal Dihapus!',
            ], 500);
        }
    }

    public function getListDonatur()
    {
        try {
            $getList = Donatur::get();
            return $getList;
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'list-donatur',
                'response' => $e,
            ], 500);
        }
    }

    public function getDonasi($id)
    {
        try {
            $getDonasi = Donasi::with('donasi_konsumsi')->find($id);
            return $getDonasi;
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'detail-donasi',
                'message' => $e,
            ], 500);
        }
    }

    public function deleteDonasi($id){
        try{
            // return 'masuk sini';
            //get all data donasi konsumsi with the same donasi id
            $dataDonasiKonsumsi = DonasiKonsumsi::where('donasi_id', $id)->get();

            foreach($dataDonasiKonsumsi as $donasi_konsumsi){
                File::delete($donasi_konsumsi->photo);
            }

            Donasi::find($id)->delete();

            return response()->json([
                'status'    => 'ok',
                'response'  => 'deleted-donasi',
                'message'   => 'Delete data Telah Berhasil!',
                'route'     => route('admin.donasi')
            ], 200);
        }catch (Throwable $e){
            return response()->json([
                'status' => 'error',
                'response' => $e,
            ], 500);
        }
    }

    public function getListDonasi(){
        try{
            $getDataTable = DB::table("views_donasi");

            //generate datatable
            if(request()->ajax()){
                return DataTables()->queryBuilder($getDataTable)
                    ->addColumn('nama_user', function ($query){
                        $nama_user = $query->nama_user;

                        return $nama_user;
                    })
                    ->addColumn('ngo_nama', function ($query){
                        $ngo_nama = $query->ngo_nama;

                        return $ngo_nama;
                    })
                    ->addColumn('donasi_konsumsi', function ($query){
                        $donasi_konsumsi = $query->donasi_konsumsi;

                        return $donasi_konsumsi;
                    })
                    ->addColumn('status_donasi', function ($query){
                        $status_donasi = $query->status_donasi;
                        if($status_donasi == "submitted"){
                            $badge = '<span class="badge badge-sm bg-gradient-warning">Submitted</span>';
                        }elseif($status_donasi == "approved"){
                            $badge = '<span class="badge badge-sm bg-gradient-success">Approved</span>';
                        }elseif($status_donasi == "rejected"){
                            $badge = '<span class="badge badge-sm bg-gradient-danger">Rejected</span>';
                        }elseif($status_donasi == "pickedup"){
                            $badge = '<span class="badge badge-sm bg-gradient-info">Picked Up</span>';
                        }elseif($status_donasi == "finished"){
                            $badge = '<span class="badge badge-sm bg-gradient-primary">Finished</span>';
                        }
                        return $badge;
                    })
                    ->addColumn('tanggal_waktu', function ($query){
                        $tanggal = $query->tanggal;

                        return $tanggal;
                    })
                    ->addColumn('action', function ($query){
                        $button = '
                        <div>
                        <button id="' . $query->donasi . '" class="action-detail btn btn-primary btn-sm text-secondary font-weight-bold text-xs edit-item" data-toggle="tooltip" data-original-title="Detail">
                          <span style="color : white">Detail</span>
                        </button>
                        </div>
                        ';

                        return $button;
                    })
                    ->rawColumns(['nama_user', 'donasi_konsumsi', 'status_donasi', 'tanggal_wwaktu', 'action'])
                    ->addIndexColumn()
                    ->make(true);
            }
            return view('admin/admin_donasi');
        }catch (Throwable $e){
            return response()->json([
                'status' => 'error',
                'response' => 'list-kota',
                'response' => $e,
            ], 500);
        }
    }

    //kota
    public function getListKota(){
        $getDataTable = Kota::with('donasi');
        if (request()->ajax()) {
            return DataTables()->eloquent($getDataTable)
                ->addColumn('kota', function ($query) {
                    $kota = $query->nama;

                    return $kota;
                })
                ->addColumn('action', function ($query) {
                    $button = '
                    <div>
                    <button id="' . $query->id . '" class="action-detail btn btn-primary btn-sm text-secondary font-weight-bold text-xs edit-item" data-toggle="tooltip" data-original-title="Detail">
                        <span style="color : white">Detail</span>
                    </button>
                    </div>
                    <div>
                    <button id="' . $query->id . '" class="action-hapus btn btn-danger btn-sm text-secondary font-weight-bold text-xs edit-item" data-toggle="tooltip" data-original-title="Edit">
                        <span style="color : white">Hapus</span>
                    </button>
                    </div>
                    ';

                    return $button;
                })
                ->rawColumns(['kota', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin/admin_kota');
    }

    public function storeKota(Request $request){
        try{
            // return $request;
            $data = [
                "nama"  => $request->nama
            ];

            Kota::create($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'created',
                'message'   => 'Selamat! Kota telah tersimpan.',
                'route'     => route('admin.kota')
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'create-kota',
                'message' => $e,
            ], 500);
        }
    }

    public function getKota($id){
        try{
            $getKota = Kota::find($id);
            return $getKota;
        }catch(Throwable $e){
            return response()->json([
                'status' => 'error',
                'response' => 'detail-kota',
                'message' => $e,
            ], 500);
        }
    }

    public function editKota(Request $request, $id){
        try{
            $data = [
                "nama"  => $request->nama
            ];

            Kota::find($id)->update($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'updated',
                'message'   => 'Selamat! Data kota telah diperbarui.',
                'route'     => route('admin.kota')
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'update-kota',
                'message' => $e,
            ], 500);
        }
    }

    public function deleteKota($id)
    {
        try {
            $used = Donasi::where('kota', $id)->count();
            // return $used;
            //check donasi yang memiliki value kota
            if($used == 0){
                $delete = Kota::find($id)->delete();
                return response()->json([
                    'status'    => 'ok',
                    'response'  => 'deleted',
                    'message'   => 'Data kota berhasil dihapus.',
                    'route'     => route('admin.kota')
                ], 200);
            } else {
                return response()->json([
                    'status'    => 'error',
                    'response'  => 'error',
                    'message'   => 'Tidak dapat menghapus data kota. Data digunakan dalam data lain',
                    'route'     => route('admin.kota')
                ], 200);
            }
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'delete-kota',
                'response' => $e,
            ], 500);
        }
    }

    public function detailKota($id)
    {
        $getKota = Kota::where('id', $id)->first();

        $data = [
            "dataKota" => $getKota,
        ];

        return view('admin/admin_detail_kota', $data);
    }

    //kategori
    public function getListKategori(){
        $getDataTable = Kategori::with('donasiKonsumsi');
        if (request()->ajax()) {
            return DataTables()->eloquent($getDataTable)
                ->addColumn('kategori', function ($query) {
                    $kategori = $query->nama;

                    return $kategori;
                })
                ->addColumn('action', function ($query) {
                    $button = '
                    <div>
                    <button id="' . $query->id . '" class="action-detail btn btn-primary btn-sm text-secondary font-weight-bold text-xs edit-item" data-toggle="tooltip" data-original-title="Detail">
                        <span style="color : white">Detail</span>
                    </button>
                    </div>
                    <div>
                    <button id="' . $query->id . '" class="action-hapus btn btn-danger btn-sm text-secondary font-weight-bold text-xs edit-item" data-toggle="tooltip" data-original-title="Edit">
                        <span style="color : white">Hapus</span>
                    </button>
                    </div>
                    ';

                    return $button;
                })
                ->rawColumns(['kategori', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin/admin_kategori');
    }

    public function storeKategori(Request $request){
        try{
            $data = [
                "nama"  => $request->nama
            ];

            $data_master = Kategori::create($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'created',
                'message'   => 'Selamat! Kategori telah tersimpan.',
                'route'     => route('admin.kategori')
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'create-Kategori',
                'message' => $e,
            ], 500);
        }
    }

    public function getKategori($id)
    {
        try {
            $getKategori = Kategori::find($id);
            return $getKategori;
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'error',
                'message' => $e,
            ], 500);
        }
    }

    public function editKategori(Request $request, $id)
    {
        try {
            // return $request;
            $data = [
                "nama"  => $request->nama
            ];

            Kategori::find($id)->update($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'updated',
                'message'   => 'Selamat! Data kategori telah diperbarui.',
                'route'     => route('admin.kategori')
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'error',
                'message' => $e,
            ], 500);
        }
    }

    public function deleteKategori($id)
    {
        try {
            $used = DonasiKonsumsi::where('kategori', $id)->count();
            //check donasi yang memiliki value kategori
            if ($used == 0) {
                $delete = Kategori::find($id)->delete();
                return response()->json([
                    'status'    => 'ok',
                    'response'  => 'deleted',
                    'message'   => 'Data kategori berhasil dihapus.',
                    'route'     => route('admin.kategori')
                ], 200);
            }else{
                return response()->json([
                    'status'    => 'failed',
                    'response'  => 'error',
                    'message'   => 'Tidak dapat menghapus data kategori. Data digunakan dalam data lain',
                    'route'     => route('admin.kategori')
                ], 500);
            }
        } catch (Throwable $e) {
            return response()->json([
                'status'    => 'failed',
                'response'  => 'error',
                'message'   => 'error',
                'route'     => route('admin.kategori')
            ], 500);
        }
    }

    //satuan
    public function getListSatuan(){
        $getDataTable = Satuan::with('donasiKonsumsi');
        if (request()->ajax()) {
            return DataTables()->eloquent($getDataTable)
                ->addColumn('satuan', function ($query) {
                    $satuan = $query->nama;

                    return $satuan;
                })
                ->addColumn('action', function ($query) {
                    $button = '
                    <div>
                    <button id="' . $query->id . '" class="action-detail btn btn-primary btn-sm text-secondary font-weight-bold text-xs edit-item" data-toggle="tooltip" data-original-title="Detail">
                        <span style="color : white">Detail</span>
                    </button>
                    </div>
                    <div>
                    <button id="' . $query->id . '" class="action-hapus btn btn-danger btn-sm text-secondary font-weight-bold text-xs edit-item" data-toggle="tooltip" data-original-title="Edit">
                        <span style="color : white">Hapus</span>
                    </button>
                    </div>
                    ';

                    return $button;
                })
                ->rawColumns(['satuan', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin/admin_satuan');
    }

    public function storeSatuan(Request $request)
    {
        try {
            $data = [
                "nama"  => $request->nama
            ];

            Satuan::create($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'created',
                'message'   => 'Selamat! Satuan telah tersimpan.',
                'route'     => route('admin.satuan')
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'create-satuan',
                'message' => $e,
            ], 500);
        }
    }

    public function getSatuan($id)
    {
        try {
            $getSatuan = Satuan::find($id);
            return $getSatuan;
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'detail-Satuan',
                'message' => $e,
            ], 500);
        }
    }

    public function editSatuan(Request $request, $id)
    {
        try {
            $data = [
                "nama"  => $request->nama
            ];

            Satuan::find($id)->update($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'updated',
                'message'   => 'Selamat! Data satuan telah diperbarui.',
                'route'     => route('admin.satuan')
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'update-Satuan',
                'message' => $e,
            ], 500);
        }
    }

    public function deleteSatuan($id)
    {
        try {
            $used = DonasiKonsumsi::where('satuan', $id)->count();

            //check donasi yang memiliki value satuan
            if ($used == 0) {
                $delete = Satuan::find($id)->delete();
                return response()->json([
                    'status'    => 'ok',
                    'response'  => 'deleted',
                    'message'   => 'Data satuan berhasil dihapus.',
                    'route'     => route('admin.satuan')
                ], 200);
            } else {
                return response()->json([
                    'status'    => 'ok',
                    'response'  => 'error',
                    'message'   => 'Tidak dapat menghapus data satuan. Data digunakan dalam data lain',
                    'route'     => route('admin.satuan')
                ], 200);
            }
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'delete-Satuan',
                'response' => $e,
            ], 500);
        }
    }


}
