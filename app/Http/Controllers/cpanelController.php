<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Helper;

class cpanelController extends Controller
{
    public function cpanelindex(Request $request) {
        if (!empty($request->input('keyword'))) {
            $data = \App\Models\Cpanel::where('domain', 'like', "%".$request->input('keyword')."%")
            ->orWhere('username', 'like', "%".$request->input('keyword')."%")
            ->paginate(1000);

            return view('cpanel.cpanel_index', [
                'data' => $data
            ]);
        } else {
            $data = \App\Models\Cpanel::orderBy('id', 'DESC')->paginate(10);
            if (count($data) > 0) {
                return view('cpanel.cpanel_index', [
                    'data' => $data
                ]);
            } else {
                return redirect('/cpanel/new');
            }
        }
    }

    public function cpanelview($id) {
        $data = \App\Models\Cpanel::where('id', Crypt::decryptString($id))->first();
        return view('cpanel.cpanel_detail', [
            'data' => $data
        ]);
    }

    public function cpanelinput() {
        return view('cpanel.cpanel_input');
    }

    public function cpanelinputpost(Request $request) {
        date_default_timezone_set('Asia/Jakarta');
        $data = Helper::cpanelCheck($request->domain, $request->port, $request->username, $request->password);

        if ($data['status'] == 0) {
            $act = \App\Models\Cpanel::insert([
                'domain' => $request->domain,
                'port' => $request->port,
                'username' => $request->username,
                'password' => $request->password,
                'status' => 'inactive',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            if ($act) {
                return redirect('/cpanel')->with(['alert' => 'Insert cPanel Success!']);
            } else {
                return redirect('/cpanel')->with(['alert' => 'Error!']);
            }
        } else {
            $act = \App\Models\Cpanel::insert([
                'domain' => $request->domain,
                'port' => $request->port,
                'username' => $request->username,
                'password' => $request->password,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            if ($act) {
                return redirect('/cpanel')->with(['alert' => 'Insert cPanel Success!']);
            } else {
                return redirect('/cpanel')->with(['alert' => 'Error!']);
            }
        }
    }

    public function cpanelupdate(Request $request) {
        date_default_timezone_set('Asia/Jakarta');
        $data = \App\Models\Cpanel::where('id', Crypt::decryptString($request->id))->first();
        
        $cek = Helper::cpanelCheck($data->domain, $data->port, $data->username, $data->password);
        if ($cek['status'] == 0) {
            \App\Models\Cpanel::where('id', Crypt::decryptString($request->id))->update([
                'status' => 'inactive',
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->back()->with(['alert' => 'Recheck cPanel Success!']);
        } else {
            \App\Models\Cpanel::where('id', Crypt::decryptString($request->id))->update([
                'status' => 'active',
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->back()->with(['alert' => 'Recheck cPanel Success!']);
        }
    }

    public function cpaneldelete(Request $request) {
        $act = \App\Models\Cpanel::where('id', Crypt::decryptString($request->id))->delete();
        if ($act) {
            return redirect('/cpanel')->with(['alert' => 'Delete cPanel Success!']);
        } else {
            return redirect('/cpanel')->with(['alert' => 'Error!']);
        }
    }
}
