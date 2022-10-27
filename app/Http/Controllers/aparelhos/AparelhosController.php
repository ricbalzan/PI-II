<?php

namespace App\Http\Controllers\aparelhos;

use App\Http\Controllers\Controller;
use App\model\Aparelhos;
use App\model\Numeros;
use Illuminate\Support\Facades\DB;
use Session;
use Request;

class AparelhosController extends Controller
{
    private $listarView = 'aparelhos.listar';
    private $cadastroView = 'aparelhos.cadastro';
    private $estoqueView = 'aparelhos.estoque';
    private $editarView = 'aparelhos.editar';

    public function listar()
    {
        if (view()->exists($this->listarView)) {

            $aparelhos = Aparelhos::withTrashed()->get();

            return view($this->listarView, compact('aparelhos'));
        } else {
            return "";
        }
    }

    public function cadastro()
    {
        if (view()->exists($this->cadastroView)) {

            $numeros = Numeros::whereNull('deleted_at')->get(['id', 'numero']);

            return view($this->cadastroView, compact('numeros'));
        }
    }

    public function estoque()
    {
        if (view()->exists($this->estoqueView)) {

            $aparelhos = Aparelhos::whereNull('deleted_at')->get(['id', 'marca', 'modelo']);
            // dd($aparelhos);
            return view($this->estoqueView, compact('aparelhos'));
        }
    }

    public function buscaEstoque()
    {
        $id = Request::input('aparelho');
        // dd($id);
        $aparelhos = Aparelhos::whereNull('deleted_at')->get(['id', 'marca', 'modelo']);
        $aps = Aparelhos::whereNull('deleted_at')->where('id', $id)->get();
        // dd($id, $aps);
        return view($this->estoqueView, compact('aps', 'aparelhos'));
    }

    public function salvar()
    {
        $marca = Request::input('marca');
        $modelo = Request::input('modelo');
        $numero = Request::input('numero');
        $numSerie = Request::input('num_serie');
        $estoque = Request::input('estoque');
        $dataEntrega = Request::input('dtentrega');
        $numero_id = Numeros::where('id', $numero)->get(['id', 'numero']);
        $aparelhos = Aparelhos::whereNull('deleted_at')
            ->where(trim('numero'), $numero_id[0]->numero)
            ->first();
        // dd($aparelhos);
        // dd($marca, $modelo, $numero_id[0]->numero, $numSerie, $aparelhos);
        if ($aparelhos == null) {
            Aparelhos::create([
                'marca' => $marca,
                'modelo' => $modelo,
                'numero' => $numero_id[0]->numero,
                'num_serie' => $numSerie,
                'estoque' => $estoque,
                'dt_entrega' => $dataEntrega,
                'numero_id' => $numero_id[0]->id
            ]);

            Session::flash('success', "Número cadastrado com sucesso !");
            return redirect()->route('aparelhos.listar');
        } else {
            Session::flash('error', "Núumero de telefone já associado a um aparelho !");
            return redirect()->route('aparelhos.listar');
        }
    }

    public function verAparelho()
    {

        $id = Request::input('id');

        $aparelho = Aparelhos::find($id);
        // dd($numero);
        return response()->json(['aparelho' => $aparelho]);
    }

    public function editar($id)
    {

        $id = intval($id);
        if (view()->exists($this->editarView) && $id != 0) {

            $aparelhos = Aparelhos::find($id);
            $numeros = Numeros::whereNull('deleted_at')->get(['id', 'numero']);

            if (!is_null($aparelhos)) {

                return view($this->editarView, compact('aparelhos', 'numeros'));
            } else {

                return redirect()->route('aparelhos.listar');
            }
        } else {
            Session::flash('error', 'Página não encontrada!');
            return redirect()->route('aparelhos.listar');
        }
    }

    public function atualizar($id)
    {

        $marca = Request::input('marca');
        $modelo = Request::input('modelo');
        // $numero = Request::input('numero');
        // $num_serie = Request::input('num_serie');
        $estoque = Request::input('estoque');
        $dt_entrega = Request::input('data_inicial');
        // $numero_id = Numeros::where(trim('numero'), trim($numero))->get('id');
        $aparelhos = Aparelhos::find($id);
        // dd($marca, $modelo, $numero, $num_serie, $estoque, $dt_entrega, $numero_id[0]->id);
        $aparelhos->update([

            // 'marca' => $marca,
            // 'modelo' => $modelo,
            // 'numero' => $numero,
            // 'numero_id' => $numero_id[0]->id,
            // 'num_serie' => $num_serie,
            'estoque' => $estoque,
            'dt_entrega' => $dt_entrega

        ]);
        Session::flash('success', "Cadstro do Aparelho {$marca}/{$modelo} Atualizado com sucesso!");
        return redirect()->route('aparelhos.listar');
        // }
    }

    public function confirmaEntrega()
    {
        $id = Request::input('confirma_entrega');
        $estoque = Request::input('quantidade');
        $ap_estoque = DB::select("SELECT estoque FROM aparelhos WHERE deleted_at IS NULL AND id = '$id' ");
        $baixa_estoque = intval($ap_estoque[0]->estoque) - intval($estoque);
        $aparelhos = Aparelhos::find($id);

        if ($baixa_estoque < 0) {
            Session::flash('error', "O estoque atual é {$ap_estoque[0]->estoque} tentativa de baixa de {$estoque} o estoque não pode ficar negativo !");
            return redirect()->route('aparelhos.listar');
        } else {
            $aparelhos->update([
                'estoque' => $baixa_estoque
            ]);

            Session::flash('success', "Baixa realizada com sucesso !");
            return redirect()->route('aparelhos.listar');
        }
        // dd($id, $estoque, $ap_estoque[0]->estoque);
    }

    public function remover($id)
    {

        $aparelho = Aparelhos::find($id);

        if (!is_null($aparelho)) {

            $aparelho->delete();

            Session::flash('error', "Aparelho {$aparelho->marca}/{$aparelho->modelo} removido !");
            return redirect()->route('aparelhos.listar');
        } else {

            Session::flash('error', "Número não encontrado !");
            return redirect()->route('aparelhos.listar');
        }
    }
}
