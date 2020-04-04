<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Helper;
use DB;

class vpsController extends Controller
{
    public function vpsindex(Request $request) {
        if (!empty($request->input('keyword'))) {
            $data = \App\Models\Vps::where('ip', 'like', "%".$request->input('keyword')."%")
            ->orWhere('server_info', 'like', "%".$request->input('keyword')."%")
            ->orWhere('user', 'like', "%".$request->input('keyword')."%")
            ->paginate(1000);

            return view('vps.vps_index', [
                'data' => $data
            ]);
        } else {
            $data = \App\Models\Vps::orderBy('id', 'DESC')->paginate(10);
            if (count($data) > 0) {
                return view('vps.vps_index', [
                    'data' => $data
                ]);
            } else {
                return redirect('/vps/new');
            }
        }
    }

    public function vpsview($id) {
        $data = \App\Models\Vps::where('id', Crypt::decryptString($id))->first();
        return view('vps.vps_detail', [
            'data' => $data
        ]);
    }

    public function vpsupdate(Request $request) {
        date_default_timezone_set('Asia/Jakarta');
        $data = \App\Models\Vps::select('ip', 'port', 'user', 'password')->where('id', Crypt::decryptString($request->id))->first();
        
        $cek = Helper::vpsCheck($data->ip, $data->port, $data->user, $data->password);
        if ($cek == false) {
            \App\Models\Vps::where('id', Crypt::decryptString($request->id))->update([
                'status' => 'inactive',
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->back()->with(['alert' => 'Recheck Vps Success!']);
        } else {
            \App\Models\Vps::where('id', Crypt::decryptString($request->id))->update([
                'status' => 'active',
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->back()->with(['alert' => 'Recheck Vps Success!']);
        }
    }

    public function vpsinput() {
        return view('vps.vps_input');
    }

    public function vpsinputpost(Request $request) {
        date_default_timezone_set('Asia/Jakarta');
        $data = Helper::vpsCheck($request->ip, $request->port, $request->user, $request->password);
        
        if (is_null($data)) {
            return redirect('/vps')->with(['alert' => 'Error!']);
        } else {
            if ($data['status'] == 'active') {
                $act = \App\Models\Vps::insert([
                    'ip' => $data['ip'],
                    'port' => $data['port'],
                    'user' => $data['user'],
                    'password' => $data['password'],
                    'server_info' => $data['server_info'],
                    'status' => $data['status'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                if ($act) {
                    return redirect('/vps')->with(['alert' => 'Insert VPS Success!']);
                } else {
                    return redirect('/vps')->with(['alert' => 'Error!']);
                }
            } else {
                return redirect('/vps')->with(['alert' => 'Error!']);
            }
        }
    }

    public function vpsdelete(Request $request) {
        $act = \App\Models\Vps::where('id', Crypt::decryptString($request->id))->delete();
        if ($act) {
            return redirect('/vps')->with(['alert' => 'Delete VPS Success!']);
        } else {
            return redirect('/vps')->with(['alert' => 'Error!']);
        }
    }
}
