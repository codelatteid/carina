<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Helper;
use DB;

class mainController extends Controller
{
	public function index() {
		$data['shell_count'] =\App\Models\Shell::count();
		$data['shell_count_active'] =\App\Models\Shell::where('status', 'active')->count();
		$data['shell_count_inactive'] =\App\Models\Shell::where('status', 'inactive')->count();
		$data['vps_count'] =\App\Models\Vps::count();
		$data['vps_count_active'] =\App\Models\Vps::where('status', 'active')->count();
		$data['vps_count_inactive'] =\App\Models\Vps::where('status', 'inactive')->count();
		$data['cpanel_count'] =\App\Models\Cpanel::count();
		$data['cpanel_count_active'] =\App\Models\Cpanel::where('status', 'active')->count();
		$data['cpanel_count_inactive'] =\App\Models\Cpanel::where('status', 'inactive')->count();

		return view('home', [
			'data' => $data
		]);
	}
}
