<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();


        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }
        if ($request->filled('cpf')) {
            $query->where('cpf', 'like', '%' . $request->input('cpf') . '%');
        }
        if ($request->filled('birthdate')) {
            $query->where('birthdate', $request->input('birthdate'));
        }
        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }
        if ($request->filled('address')) {
            $query->where('address', 'like', '%' . $request->input('address') . '%');
        }
        if ($request->filled('state')) {
            $query->where('state', $request->input('state'));
        }
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->input('city') . '%');
        }

        $users = $query->paginate(2);

        return view('list_user', compact('users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'cpf' => 'required|unique:users,cpf',
            'birthdate' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
        ], [
            'cpf.unique' => 'O CPF informado já está em uso.',
        ]);

        $validatedData['cpf'] = preg_replace('/[^0-9]/', '', $validatedData['cpf']);

        if (!isset($validatedData['email'])) {
            $validatedData['email'] = uniqid() . '@default.com';
        }

        if (!isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt('default_password'); // Valor padrão criptografado para password
        }

        try {
            $user = User::create($validatedData);

            return redirect()->route('users.show', $user["id"]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Erro ao criar usuário: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'cpf' => 'required',
            'birthdate' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
        ]);

        $validatedData['cpf'] = preg_replace('/[^0-9]/', '', $validatedData['cpf']);

        if (!isset($validatedData['email'])) {
            $validatedData['email'] = uniqid() . '@default.com';
        }

        if (!isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt('default_password');
        }

        $user->name = $validatedData['name'];
        $user->cpf = $validatedData['cpf'];
        $user->birthdate = $validatedData['birthdate'];
        $user->gender = $validatedData['gender'];
        $user->address = $validatedData['address'];
        $user->state = $validatedData['state'];
        $user->city = $validatedData['city'];

        // Salve as alterações no banco de dados
        $user->save();

        return redirect()->route('users.show', $user["id"]);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();

            return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso.');
        }

        return redirect()->route('users.index')->with('error', 'Usuário não encontrado.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('user', compact('user'));
    }

    public function create()
    {
        return view('create_user');
    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);

        return view('edit_user', compact('user'));
    }
}
