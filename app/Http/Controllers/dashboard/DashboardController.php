<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\model\Contratos;
use App\model\Faturas;
use App\model\Numeros;
use App\model\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private $dashBoardView = 'pages.dashboard';

    public function dados()
    {
        $user = Auth::id();
        $role = DB::select("SELECT role_id FROM model_has_roles WHERE model_id = '$user' ");
        // dd($role);
        $users = User::count('id');
        $numeros = Numeros::whereNull('deleted_at')->count('id');
        $contratos = Contratos::whereNull('deleted_at')->count('id');
        $faturas = Faturas::whereNull('deleted_at')->sum('valor');

        return view($this->dashBoardView, compact('users', 'numeros', 'contratos', 'faturas', 'role'));
    }
}
