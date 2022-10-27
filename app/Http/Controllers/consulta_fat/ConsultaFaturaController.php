<?php

namespace App\Http\Controllers\consulta_fat;

use App\Http\Controllers\Controller;
use App\model\Faturas;
use App\model\Numeros;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Request;

class ConsultaFaturaController extends Controller
{
    private $listarView = 'consulta-fat.listar';
    // private $consultaView = 'consulta-fat.listar';

    public function listar()
    {
        if (view()->exists($this->listarView)) {
            $user = Auth::id();
            $role = DB::select("SELECT role_id, model_id FROM model_has_roles WHERE model_id = '$user' ");
            // dd($role[0]->model_id);
            if ($role[0]->model_id != 1) {
                $numeros = Numeros::whereNull('deleted_at')->where('user_id', Auth::id())->get();

                return view($this->listarView, compact('numeros'));
            } else {
                $numeros = Numeros::whereNull('deleted_at')->get();

                return view($this->listarView, compact('numeros'));
            }
        } else {
            return "";
        }
    }

    public function buscaFatura()
    {
        $num = Request::input('numero');
        // dd($id);
        $numeros = Numeros::whereNull('deleted_at')->get();
        $faturas = Faturas::with('user')->where('numero', $num)->get();

        foreach ($faturas as $fatura) {
            if ($fatura->mes == '1') {
                $fatura->mes = 'Janeiro';
            } elseif ($fatura->mes == '2') {
                $fatura->mes = 'Fevereiro';
            } elseif ($fatura->mes == '3') {
                $fatura->mes = 'Março';
            } elseif ($fatura->mes == '4') {
                $fatura->mes = 'Abril';
            } elseif ($fatura->mes == '5') {
                $fatura->mes = 'Maio';
            } elseif ($fatura->mes == '6') {
                $fatura->mes = 'Junho';
            } elseif ($fatura->mes == '7') {
                $fatura->mes = 'Julho';
            } elseif ($fatura->mes == '8') {
                $fatura->mes = 'Agosto';
            } elseif ($fatura->mes == '9') {
                $fatura->mes = 'Setembro';
            } elseif ($fatura->mes == '10') {
                $fatura->mes = 'Outubro';
            } elseif ($fatura->mes == '11') {
                $fatura->mes = 'Novembro';
            } else {
                $fatura->mes = 'Dezembro';
            }
        }
        // $aps = Aparelhos::whereNull('deleted_at')->where('id', $id)->get();
        // dd($id, $aps);
        return view($this->listarView, compact('faturas', 'numeros'));
    }
}
