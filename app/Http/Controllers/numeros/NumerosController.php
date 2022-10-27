<?php

namespace App\Http\Controllers\numeros;

use App\Http\Controllers\Controller;
use App\model\Numeros;
use App\User;
use Session;
use Request;

class NumerosController extends Controller
{
    private $listarView = 'numeros.listar';
    private $cadastroView = 'numeros.cadastro';
    private $editarView = 'numeros.editar';

    public function listar()
    {
        if (view()->exists($this->listarView)) {

            // $numeros = Numeros::whereNull('deleted_at')->get();
            $numeros = Numeros::withTrashed()->with('user')->get();
            // dd($numeros);
            return view($this->listarView, compact('numeros'));
        } else {
            return "";
        }
    }

    public function cadastro()
    {
        if (view()->exists($this->cadastroView)) {

            // $cpfs = User::where('cpf', '<>', '')->get('cpf');
            $nomes = User::get(['id', 'name']);

            return view($this->cadastroView, compact('nomes'));
        }
    }

    public function verNumero()
    {

        $id = Request::input('id');

        $numero = Numeros::find($id);
        // dd($numero);
        return response()->json(['numero' => $numero]);
    }

    public function editar($id)
    {

        $id = intval($id);
        if (view()->exists($this->editarView) && $id != 0) {

            $numeros = Numeros::find($id);
            $nums = Numeros::whereNull('deleted_at')->get();

            if (!is_null($numeros)) {

                return view($this->editarView, compact('numeros', 'nums'));
            } else {

                return redirect()->route('numeros.listar');
            }
        } else {
            Session::flash('error', 'Página não encontrada!');
            return redirect()->route('numeros.listar');
        }
    }

    public function buscaNomes()
    {
        $nome = Request::input('nome');
        // dd($nome);
        $cpf = User::where('id', $nome)->get();

        // foreach ($numeroCpf as $num) {
        // }
        // dd($numeroCpf);
        return response()->json(json_encode(['cpf' => $cpf]));
    }

    public function atualizar($id)
    {

        $numero = Request::input('numero');
        $sim = Request::input('sim');
        $cpf = Request::input('cpf');
        $dtcadastro = Request::input('dtcadastro');
        $numeros = Numeros::find($id);
        $num = Numeros::whereNull('deleted_at')->where(trim('numero'), trim($numero))->first();

        if($num == null) {
            $numeros->update([

                'numero' => $numero,
                'sim' => $sim,
                'cpf' => $cpf,
                'data_cadastro' => $dtcadastro

            ]);
            Session::flash('success', "Cadstro do Nº {$numero} Atualizado com sucesso!");
            return redirect()->route('numeros.listar');
        } else {
            Session::flash('error', "Número já existente !");
            return redirect()->route('numeros.listar');
        }
    }

    public function salvar()
    {
        $numero = Request::input('numero');
        $dtcadastro = Request::input('dtcadastro');
        $sim = Request::input('sim');
        $cpf = Request::input('cpf');
        $user_id = User::where(trim('cpf'), $cpf)->get('id');
        $num = Numeros::whereNull('deleted_at')->where(trim('numero'), trim($numero))->first();
        // dd($num);
        // dd($numero, $dtcadastro, $sim, $cpf, $user_id[0]->id);
        if($num == null) {
            Numeros::create([
                'numero' => $numero,
                'sim' => $sim,
                'cpf' => $cpf,
                'user_id' => $user_id[0]->id,
                'dt_cadastro' => $dtcadastro
            ]);

            Session::flash('success', "Número cadastrado com sucesso !");
            return redirect()->route('numeros.listar');
        } else {
            Session::flash('error', "Número já existente !");
            return redirect()->route('numeros.listar');
        }
    }

    public function remover($id)
    {

        $numero = Numeros::find($id);

        if (!is_null($numero)) {

            $numero->delete();

            Session::flash('error', "Número {$numero->numero} removido !");
            return redirect()->route('numeros.listar');
        } else {

            Session::flash('error', "Número não encontrado !");
            return redirect()->route('numeros.listar');
        }
    }
}
