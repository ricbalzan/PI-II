<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables, Auth;
use Session;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('users');
    }

    public function getUserList(Request $request)
    {

        $data  = User::get();
        // dd($data);


        return Datatables::of($data)
            ->addColumn('roles', function ($data) {
                $roles = $data->getRoleNames()->toArray();
                $badge = '';
                if ($roles) {
                    $badge = implode(' , ', $roles);
                }

                return $badge;
            })
            ->addColumn('permissions', function ($data) {
                $roles = $data->getAllPermissions();
                $badges = '';
                foreach ($roles as $key => $role) {
                    $badges .= '<span class="badge badge-dark m-1">' . $role->name . '</span>';
                }

                return $badges;
            })
            ->addColumn('action', function ($data) {
                if ($data->name == 'Super Admin') {
                    return '';
                }
                if (Auth::user()->can('manage_user')) {
                    return '<div class="table-actions">
                                <a href="' . url('user/' . $data->id) . '" ><i class="ik ik-edit-2 f-16 mr-15 text-green"></i></a>
                                <a href="' . url('user/delete/' . $data->id) . '"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                            </div>';
                } else {
                    return '';
                }
            })
            ->rawColumns(['roles', 'permissions', 'action'])
            ->make(true);
    }

    public function create()
    {
        try {
            $roles = Role::pluck('name', 'id');
            return view('create-user', compact('roles'));
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function store(Request $request)
    {
        // create user 
        $validator = Validator::make($request->all(), [
            'name'     => 'required | string ',
            'email'    => 'required | email | unique:users',
            'password' => 'required | confirmed',
            'role'     => 'required'
        ]);

        $validator2 = User::where(trim('num_func'), trim($request->numfunc))
            ->orWhere(trim('cpf'), trim($request->cpf))
            ->orWhere(trim('rg'), trim($request->rg))
            ->first();

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }


        try {
            // store user information
            if ($validator2 == null) {
                $user = User::create([
                    'name'     => $request->name,
                    'email'    => $request->email,
                    'endereco'  => $request->endereco,
                    'password' => Hash::make($request->password),
                    'cidade'    => $request->cidade,
                    'data_nasc' => $request->data_inicial,
                    'cpf'       => $request->cpf,
                    'rg'        => $request->rg,
                    'situacao'   => $request->situacao,
                    'tipo'       => $request->role,
                    'num_func'  => $request->numfunc,
                ]);

                return redirect('users')->with('success', 'Novo usuário criado!');
            } else {
                // assign new role to the user
                // $user->syncRoles($request->role);

                // if ($user) {

                // } else {
                return redirect('users')->with('error', 'Cpf, Número de Fucionário ou Rg já existente! Tente novamente.');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function edit($id)
    {
        try {
            $user  = User::with('roles', 'permissions')->find($id);

            if ($user) {
                $user_role = $user->roles->first();
                $roles     = Role::pluck('name', 'id');

                return view('user-edit', compact('user', 'user_role', 'roles'));
            } else {
                return redirect('404');
            }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }

    public function update(Request $request)
    {

        // update user info
        $validator = Validator::make($request->all(), [
            'id'       => 'required',
            'name'     => 'required | string ',
            'email'    => 'required | email',
            'role'     => 'required'
        ]);

        // check validation for password match
        if (isset($request->password)) {
            $validator = Validator::make($request->all(), [
                'password' => 'required | confirmed'
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('error', $validator->messages()->first());
        }


        // dd($request->role);
        // $validator2 = User::where(trim('num_func'), trim($request->num_func))
        //     ->orWhere(trim('cpf'), trim($request->cpf))
        //     ->orWhere(trim('rg'), trim($request->rg))
        //     ->first();
        // dd($validator2);
        try {

            $user = User::find($request->id);
            if ($request->role == 1) {
                $request->role = 'Super Admin';
            }
            if ($request->role == 2) {
                $request->role = 'Funcionario';
            }
            if ($request->role == 3) {
                $request->role = 'Terceiro';
            }
            // dd($request->role);
            $update = $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'endereco'  => $request->endereco,
                'cidade'    => $request->cidade,
                'data_nasc' => $request->data_inicial,
                'cpf'       => $request->cpf,
                'rg'        => $request->rg,
                'situacao'   => $request->situacao,
                'tipo'       => $request->role,
                'num_func'  => $request->num_func,
            ]);

            // update password if user input a new password
            if (isset($request->password)) {
                $update = $user->update([
                    'password' => Hash::make($request->password)
                ]);
            }

            // sync user role
            $user->syncRoles($request->role);

            // Session::flash('success', 'Informações do usuário atualizadas com sucesso!');
            // return redirect()->route('usuarios');
            return redirect('users')->with('success', 'Informações do usuário atualizadas com sucesso!');
            // } else {
            //     Session::flash('error', 'Erro!');
            //     return redirect()->route('usuarios');
            // }
        } catch (\Exception $e) {
            $bug = $e->getMessage();
            return redirect()->back()->with('error', $bug);
        }
    }


    public function delete($id)
    {
        $user   = User::find($id);
        if ($user) {
            $user->delete();
            return redirect('users')->with('success', 'Usuário removido!');
        } else {
            return redirect('users')->with('error', 'Usuário não encontrado');
        }
    }
}
