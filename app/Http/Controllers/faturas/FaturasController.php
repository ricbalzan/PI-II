<?php

namespace App\Http\Controllers\faturas;

use App\Http\Controllers\Controller;
use App\model\Faturas;
use App\model\Numeros;
use App\model\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Session;
use Request;

class FaturasController extends Controller
{
    private $listarView = 'faturas.listar';
    private $cadastroView = 'faturas.cadastro';
    private $editarView = 'faturas.editar';

    public function listar()
    {
        if (view()->exists($this->listarView)) {

            // $this->file();
            $mes = date('n');
            $faturas = DB::select("SELECT f.id, name, f.numero, data_insercao, mes, valor FROM faturas f 
            INNER JOIN numeros n ON  n.id = f.numero_id
            INNER JOIN users ON users.id = n.user_id WHERE f.deleted_at IS NULL AND f.mes = '$mes' ");

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

            return view($this->listarView, compact('faturas'));
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

    public function salvar()
    {
        $numero = Request::input('numero');
        $dataInsercao = Request::input('dtinsercao');
        $mes = Request::input('mes');
        $valor = Request::input('valor');
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);
        $numero_id = Numeros::where('id', $numero)->get(['id', 'numero', 'user_id']);
        // $user_id = Numeros::with('user')->whereNull('deleted_at')->get('user_id');
        // dd($numero, $dataInsercao, $mes, $valor, $numero_id[0]->user_id);

        Faturas::create([
            'numero' => $numero_id[0]->numero,
            'data_insercao' => $dataInsercao,
            'mes' => $mes,
            'valor' => $valor,
            'numero_id' => $numero_id[0]->id,
            'user_id' => $numero_id[0]->user_id
        ]);

        Session::flash('success', "Fatura lançada com sucesso !");
        return redirect()->route('faturas.listar');
    }

    public function verFatura()
    {

        $id = Request::input('id');

        $fatura = DB::select("SELECT name, f.numero, data_insercao, mes, valor FROM faturas f 
            INNER JOIN numeros n ON  n.id = f.numero_id
            INNER JOIN users ON users.id = n.user_id 	WHERE f.id = '$id' ");
        // dd($numero);

        return response()->json(['fatura' => $fatura]);
    }

    public function editar($id)
    {

        $id = intval($id);
        if (view()->exists($this->editarView) && $id != 0) {

            $faturas = Faturas::find($id);
            // $nums = Numeros::whereNull('deleted_at')->get();
            if ($faturas->mes == '1') {
                $faturas->mes_novo = 'jan';
            } elseif ($faturas->mes == '2') {
                $faturas->mes_novo = 'fev';
            } elseif ($faturas->mes == '3') {
                $faturas->mes_novo = 'mar';
            } elseif ($faturas->mes == '4') {
                $faturas->mes_novo = 'abr';
            } elseif ($faturas->mes == '5') {
                $faturas->mes_novo = 'mai';
            } elseif ($faturas->mes == '6') {
                $faturas->mes_novo = 'jun';
            } elseif ($faturas->mes == '7') {
                $faturas->mes_novo = 'jul';
            } elseif ($faturas->mes == '8') {
                $faturas->mes_novo = 'ago';
            } elseif ($faturas->mes == '9') {
                $faturas->mes_novo = 'set';
            } elseif ($faturas->mes == '10') {
                $faturas->mes_novo = 'out';
            } elseif ($faturas->mes == '11') {
                $faturas->mes_novo = 'nov';
            } else {
                $faturas->mes_novo = 'dez';
            }

            if (!is_null($faturas)) {

                return view($this->editarView, compact('faturas'));
            } else {

                return redirect()->route('faturas.listar');
            }
        } else {
            Session::flash('error', 'Página não encontrada!');
            return redirect()->route('faturas.listar');
        }
    }

    public function atualizar($id)
    {

        $mes = Request::input('mes');
        $valor = Request::input('valor');
        // $valor = str_replace('.', '', $valor);
        // $valor = str_replace(',', '.', $valor);
        // $valor = floatval($valor);
        // $valor = number_format($valor);
        $dtinsercao = Request::input('data_inicial');
        // dd($dtinsercao);
        $faturas = Faturas::find($id);

        $faturas->update([

            'mes' => $mes,
            'valor' => $valor,
            'data_insercao' => $dtinsercao

        ]);
        Session::flash('success', "Fatura Atualizada com sucesso !");
        return redirect()->route('faturas.listar');
    }

    public function gerarTxtFaturas()                   //GERAR O TXT DAS FATURAS
    {

        $dados = Faturas::with('user')->whereNull('deleted_at')->get();
        $string = "";
        // dd(date('n'));
        foreach ($dados as $dado) {                                     //faz um foreach e seta as variaveis
            if ($dado->mes == date('n') && $dado->user->num_func != '') {
                $id = str_pad($dado->user->id, 4, " ", STR_PAD_RIGHT);
                $valor = str_pad($dado->valor, 10, "0", STR_PAD_LEFT);
                $string = $string . "1  $id 414$valor \n";
            }
        }

        $name = date('YmdH', strtotime(now()));

        Storage::disk('local')->put("txt-faturas/" . date('YmdH', strtotime(now())) . '.txt',   $string);  //Grava na pasta //grava na pasta app/txt-faturas o arquivo como o $nome(data e hora).txt
        return response()->download(storage_path() . "/app/txt-faturas/" .  $name . '.txt');               //faz o download do arquivo na maquina.
    }

   
   
    public function gerarXml()
    {
        $fat = Faturas::whereNull('deleted_at')->pluck('mes')->toArray();
        // dd($fat);
        $dados = Numeros::with('user')->whereNull('deleted_at')->get();
        $vencimento = date('Ymd');
        $mes = date('n');
        $string = "<fatura>";

        foreach ($dados as $dado) {
            if (in_array($mes, $fat)) {
                Session::flash('error', "Fatura para este mês já importada !");
                return redirect()->route('faturas.listar');
            } else {
                $string = $string . "\n
                <notas>\n
                    <name>{$dado->user->name}</name>\n
                    <valor>59.90</valor>\n
                    <data>{$vencimento}</data>\n
                    <numero>{$dado->numero}</numero>\n
                    <mes>{$mes}</mes>\n
                    <numid>{$dado->id}</numid>\n
                    <userid>{$dado->user_id}</userid>\n
                </notas>\n ";
            }
        }


        $name = date('YmdH', strtotime(now()));

        Storage::disk('local')->put("faturas/" . date('YmdH', strtotime(now())) . '.xml',   $string . "</fatura>");
        return response()->download(storage_path() . "/app/faturas/" .  $name . '.xml');
    }

    public function remover($id)
    {

        $fatura = Faturas::find($id);

        if (!is_null($fatura)) {

            $fatura->delete();

            Session::flash('error', "Fatura removida !");
            return redirect()->route('faturas.listar');
        } else {

            Session::flash('error', "Fatura não encontrada !");
            return redirect()->route('faturas.listar');
        }
    }


    //METODO PARA IMPORTAÇÃO DO ARQUIVO XML

    public function file(\Illuminate\Http\Request $request)
    {
        $data = $request->all();
        $fats = Faturas::with('user')->whereNull('deleted_at')->get();

        if ($request->xml) {

            $name = $request->xml->getClientOriginalName();
            $extension = $request->xml->getClientOriginalExtension();
            // dd($extension);
            $data['xml'] = $request->xml->storeAs('xmls', $name);
            // dd($data);
        }

        if ($request->isMethod("POST")) {

            $xmlString = file_get_contents(storage_path() . "/app/xmls/" . $name);  //salva o xml na pasta ->storage/app/xmls
            $xmlObject = simplexml_load_string($xmlString);                         //Interpreta uma string XML e a transforma em um objeto

            $json = json_encode($xmlObject);                                        //transformar valores do objeto para o formato JSON
            $phpDataArray = json_decode($json, true);                               //recebe como entrada uma string codificada no formato JSON e a converte para uma variável PHP.

            if (count($phpDataArray['notas']) > 0) {                                //procura dentro do arquivo se existe pelo menos uma nota

                $dataArray = array();                                               //guardar informações de modo ordenado, ou seja, para cada linha, uma informação                                      

                foreach ($phpDataArray['notas'] as $index => $data) {               //percorre o array
                    // foreach ($fats as $fat) {
                    // if ($fat->mes != $data['mes']) {
                    $dataArray[] = [                                            //porcura os valores dentro das variaveis e estancia
                        "numero" => $data['numero'],
                        "data_insercao" => $data['data'],
                        "mes" => $data['mes'],
                        "valor" => $data['valor'],
                        "numero_id" => $data['numid'],
                        "user_id" => $data['userid']
                    ];
                    // } else {
                    //     Session::flash('error', "Importe Fatura do mês atual !");
                    //     return redirect()->route('faturas.listar');
                    // }
                    // }
                }
            }

            Faturas::insert($dataArray);                                    // grava os valores das variaveis

            Session::flash('success', "Fatura importada com sucesso !");   // Mensagem de sucesso
            return redirect()->route('faturas.listar');                    // retorna para a pagina de listar as faturas
            // return back()->with('success', 'Data saved successfully!');
        }
    }
}
