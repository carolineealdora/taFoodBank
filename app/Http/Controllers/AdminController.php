<?php

namespace App\Http\Controllers;

use App\Models\NGO;
use App\Models\Kota;
use App\Models\User;
use App\Helpers\File;
use App\Models\Admin;
use App\Models\Donasi;
use App\Models\DonasiKonsumsi;
use App\Models\Satuan;
use App\Models\Donatur;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;

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
        return view('admin/admin_dashboard');
    }

    public function profile()
    {
        return view('admin/admin_profile');
    }

    public function donasi()
    {
        return view('admin/admin_donasi');
    }

    public function detailDonasi()
    {
        return view('admin/admin_detail_donasi');
    }

    public function donatur()
    {
        return view('admin/admin_donatur');
    }

    public function detailDonatur()
    {
        return view('admin/admin_detail_donatur');
    }

    public function ngo()
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
                    <button id="' . $query->id . '" class="action-edit text-secondary font-weight-bold text-xs edit-item" data-toggle="tooltip" data-original-title="Edit user">
                      Detail
                    </button>
                    </div>
                    <div>
                    <button id="' . $query->id . '" class="action-hapus text-secondary font-weight-bold text-xs edit-item" data-toggle="tooltip" data-original-title="Edit user">
                      Hapus
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
        return view('admin/admin_kota');
    }

    public function detailKota()
    {
        return view('admin/admin_detail_kota');
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

    public function detailKategori()
    {
        return view('admin/admin_detail_kategori');
    }

    public function createKategori()
    {
        return view('admin/admin_create_kategori');
    }

    public function satuan()
    {
        return view('admin/admin_satuan');
    }

    public function detailSatuan()
    {
        return view('admin/admin_detail_satuan');
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
            $getNGO = NGO::find($id)->delete();
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
                'response' => $e,
            ], 500);
        }
    }

    public function getListNGO()
    {
        try {
            $getList = NGO::with('user')->get();
            return $getList;
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'list-ngo',
                'response' => $e,
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
            $donatur_photo = Donatur::where('id', $id)->get();
            if ($request['foto'] !== null) { //kondisi saat foto berubah
                unlink($request->foto);
                $path = "images/donatur";
                $requestFile = $request->foto;
                // return $requestFile;
                $insertImage = File::fileUpload($requestFile, $path);
                $data = [
                    "foto"  => $request->foto
                ];

                NGO::find($id)->update($data);

                return response()->json([
                    'status'    => 'ok',
                    'response'  => 'updated',
                    'message'   => 'Selamat! Data donatur telah diubah.',
                    // 'route'     => route('donatur/donasi')
                ], 200);
            }

            $data = [
                "nama"              => $request->nama,
                "email"             => $request->email,
                "password"          => $request->password,
                "alamat"            => $request->alamat,
                "no_identitas"      => $request->no_identitas,
                "tanggal_lahir"     => $request->tanggal_lahir,
                "no_telp"           => $request->no_telp,

            ];

            $update_donatur = Donasi::with('users')->find($id)->update($data);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'update-donatur',
                'message' => $e,
            ], 500);
        }
    }

    public function deleteDonatur($id)
    {
        try {
            $delete = User::with('donatur')->find($id)->delete();
            return $delete;
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'delete-donatur',
                'message' => $e,
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

    public function deleteDonasi($id)
    {
        try {
            $delete = Donasi::find($id)->delete();
            return $delete;
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'delete-donasi',
                'response' => $e,
            ], 500);
        }
    }

    public function getListDonasi()
    {
        try {
            $getList = Donasi::get();
            return $getList;
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'list-kota',
                'response' => $e,
            ], 500);
        }
    }

    public function storeKota(Request $request)
    {
        try {
            $data = [
                "nama"  => $request->nama
            ];

            $data_master = Kota::create($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'created',
                'message'   => 'Selamat! Kota telah tersimpan.',
                // 'route'     => route('donatur/donasi')
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'create-kota',
                'message' => $e,
            ], 500);
        }
    }

    public function getKota($id)
    {
        try {
            $getKota = Kota::find($id);
            return $getKota;
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'detail-kota',
                'message' => $e,
            ], 500);
        }
    }

    public function editKota(Request $request, $id)
    {
        try {
            $data = [
                "nama"  => $request->nama
            ];

            $update_data_master = Kota::find($id)->update($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'updated',
                'message'   => 'Selamat! Data kota telah diperbarui.',
                // 'route'     => route('donatur/donasi')
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
            $used = count(Donasi::where('kota', $id)->get());
            // return $used;
            //check donasi yang memiliki value kota
            if ($used > 0) {
                $delete = Kota::find($id)->delete();
                return response()->json([
                    'status'    => 'ok',
                    'response'  => 'deleted',
                    'message'   => 'Data kota berhasil dihapus.',
                    // 'route'     => route('donatur/donasi')
                ], 200);
            } else {
                return response()->json([
                    'status'    => 'ok',
                    'response'  => 'error',
                    'message'   => 'Tidak dapat menghapus data kota. Data digunakan dalam data lain',
                    // 'route'     => route('donatur/donasi')
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

    public function getListKota()
    {
        try {
            $getList = Kota::get();
            return $getList;
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'list-kota',
                'response' => $e,
            ], 500);
        }
    }

    //kategori
    public function storeKategori(Request $request)
    {
        try {
            // return $request;
            //$email = Auth::user()->email;
            // $user = User::with('admin')->where('email', $request->email)->first();
            // $id_admin = $user->admin->id;
            $data = [
                "nama"  => $request->nama
            ];

            $data_master = Kategori::create($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'created',
                'message'   => 'Selamat! Kategori telah tersimpan.',
                // 'route'     => route('donatur/donasi')
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
                'response' => 'detail-Kategori',
                'message' => $e,
            ], 500);
        }
    }

    public function editKategori(Request $request, $id)
    {
        try {
            $data = [
                "nama"  => $request->nama
            ];

            $update_data_master = Kategori::find($id)->update($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'updated',
                'message'   => 'Selamat! Data kategori telah diperbarui.',
                // 'route'     => route('donatur/donasi')
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'update-Kategori',
                'message' => $e,
            ], 500);
        }
    }

    public function deleteKategori($id)
    {
        try {
            $used = count(DonasiKonsumsi::where('kategori', $id)->get());

            //check donasi yang memiliki value kategori
            if ($used > 0) {
                $delete = Kategori::find($id)->delete();
                return response()->json([
                    'status'    => 'ok',
                    'response'  => 'deleted',
                    'message'   => 'Data kategori berhasil dihapus.',
                    // 'route'     => route('donatur/donasi')
                ], 200);
            } else {
                return response()->json([
                    'status'    => 'ok',
                    'response'  => 'error',
                    'message'   => 'Tidak dapat menghapus data kategori. Data digunakan dalam data lain',
                    // 'route'     => route('donatur/donasi')
                ], 200);
            }
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'delete-Kategori',
                'response' => $e,
            ], 500);
        }
    }

    public function getListKategori()
    {
        try {
            $getList = Kategori::get();
            return $getList;
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'list-Kategori',
                'response' => $e,
            ], 500);
        }
    }

    //satuan
    public function storeSatuan(Request $request)
    {
        try {
            // return $request;
            //$email = Auth::user()->email;
            // $user = User::with('admin')->where('email', $request->email)->first();
            // $id_admin = $user->admin->id;
            $data = [
                "nama"  => $request->nama
            ];

            $data_master = Satuan::create($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'created',
                'message'   => 'Selamat! Satuan telah tersimpan.',
                // 'route'     => route('donatur/donasi')
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'create-Satuan',
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

            $update_data_master = Satuan::find($id)->update($data);

            return response()->json([
                'status'    => 'ok',
                'response'  => 'updated',
                'message'   => 'Selamat! Data satuan telah diperbarui.',
                // 'route'     => route('donatur/donasi')
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
            $used = count(DonasiKonsumsi::where('satuan', $id)->get());

            //check donasi yang memiliki value satuan
            if ($used > 0) {
                $delete = Satuan::find($id)->delete();
                return response()->json([
                    'status'    => 'ok',
                    'response'  => 'deleted',
                    'message'   => 'Data satuan berhasil dihapus.',
                    // 'route'     => route('donatur/donasi')
                ], 200);
            } else {
                return response()->json([
                    'status'    => 'ok',
                    'response'  => 'error',
                    'message'   => 'Tidak dapat menghapus data satuan. Data digunakan dalam data lain',
                    // 'route'     => route('donatur/donasi')
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

    public function getListSatuan()
    {
        try {
            $getList = Satuan::get();
            return $getList;
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'response' => 'list-Satuan',
                'response' => $e,
            ], 500);
        }
    }
}
