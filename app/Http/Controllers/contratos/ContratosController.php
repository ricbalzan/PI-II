<?php

namespace App\Http\Controllers\contratos;

use App\Http\Controllers\Controller;
use App\model\Contratos;
use App\model\Numeros;
use App\User;
use Illuminate\Support\Facades\DB;
use Session;
use Request;

class ContratosController extends Controller
{
    private $listarView = 'contratos.listar';
    private $cadastroView = 'contratos.cadastro';
    private $editarView = 'contratos.editar';
    private $imprimirView = 'contratos.imprimir';

    public function listar()
    {
        if (view()->exists($this->listarView)) {

            $contratos = Contratos::withTrashed()->with('user')->get();

            return view($this->listarView, compact('contratos'));
        } else {
            return "";
        }
    }

    public function cadastro()
    {
        if (view()->exists($this->cadastroView)) {

            $nomes = User::get(['id', 'name']);
            $id1 = DB::table('contratos')->max('id');
            $id = ($id1 == null) ? $id = '1' : $id1 + 1;

            return view($this->cadastroView, compact('nomes', 'id'));
        }
    }

    public function verContrato()
    {

        $id = Request::input('id');
        // dd($id);
        $contrato = Contratos::where('id', $id)->with('user')->get();

        return response()->json(['contrato' => $contrato]);
    }

    public function editar($id)
    {

        $id = intval($id);
        if (view()->exists($this->editarView) && $id != 0) {

            $contratos = Contratos::where('id', $id)->with('user')->get();
            // dd($id, $contratos[0]->user->name);
            $nomes = User::get('name');

            if (!is_null($contratos)) {

                return view($this->editarView, compact('nomes'));
                return response()->json(json_encode(['contrato' => $contratos]));
            } else {

                return redirect()->route('contratos.listar');
            }
        } else {
            Session::flash('error', 'Página não encontrada!');
            return redirect()->route('contratos.listar');
        }
    }

    public function imprimir($id)
    {
        $id = intval($id);
        // dd($id);
        if (view()->exists($this->imprimirView) && $id != 0) {

            $contratos = Contratos::where('id', $id)->with('user')->get();
            // dd($contratos[0]->user->name);

            if (!is_null($contratos)) {

                return view($this->imprimirView, compact('contratos'));
            } else {

                return redirect()->route('contratos.listar');
            }
        } else {
            Session::flash('error', 'Página não encontrada!');
            return redirect()->route('contratos.listar');
        }
    }

    public function buscaNomes()
    {
        $nome = Request::input('nome');
        // dd($nome);
        $numeroCpf = User::where('id', $nome)->with('numeros')->get();

        foreach ($numeroCpf as $num) {
        }
        // dd($numeroCpf);
        return response()->json(json_encode(['numeroCpf' => $num]));
    }

    public function salvar()
    {

        $contrato = Request::input('contrato');
        $cpf = Request::input('cpf');
        $numero = Request::input('numero');
        // dd($numero);
        $user_id = User::where(trim('cpf'), $cpf)->get('id');
        $numero_id = Numeros::where('id', $numero)->where('cpf', $cpf)->get(['id', 'numero']);
        // dd($contrato, $cpf, $numero, $user_id[0]->id, $numero_id[0]->id);
        // dd($cpf);
        Contratos::create([
            'contrato' => $contrato,
            'cpf' => $cpf,
            'numero' => $numero_id[0]->numero,
            'user_id' => $user_id[0]->id,
            'numero_id' => $numero_id[0]->id
        ]);

        Session::flash('success', "Contrato criado com sucesso !");
        return redirect()->route('contratos.listar');
    }

    public function remover($id)
    {

        $contrato = Contratos::find($id);

        if (!is_null($contrato)) {

            $contrato->delete();

            Session::flash('error', "Contrato {$contrato->id} removido !");
            return redirect()->route('contratos.listar');
        } else {

            Session::flash('error', "Contrato não encontrado !");
            return redirect()->route('contratos.listar');
        }
    }
}
