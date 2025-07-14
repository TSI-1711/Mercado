<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FuncionarioController extends Controller
{

    public function index()
    {
        $funcionarios = Funcionario::orderBy('nome')->paginate(10);
        return view('funcionarios.index', compact('funcionarios'));
    }



    public function create()
    {
        return view('funcionarios.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:funcionarios,cpf',
            'rg' => 'nullable|string|max:20',
            'data_nascimento' => 'required|date',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:funcionarios,email',
            'cargo' => 'required|string|max:100',
            'salario_base' => 'required|numeric|min:0',
            'valor_hora_extra' => 'nullable|numeric|min:0',
            'banco' => 'nullable|string|max:100',
            'agencia' => 'nullable|string|max:20',
            'conta' => 'nullable|string|max:20',
            'data_admissao' => 'required|date',
            'ativo' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $funcionario = Funcionario::create($request->all());

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionário cadastrado com sucesso!');
    }


    public function show(Funcionario $funcionario)
    {
        return view('funcionarios.show', compact('funcionario'));
    }


    public function edit(Funcionario $funcionario)
    {
        return view('funcionarios.edit', compact('funcionario'));
    }


    public function update(Request $request, Funcionario $funcionario)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:funcionarios,cpf,' . $funcionario->id,
            'rg' => 'nullable|string|max:20',
            'data_nascimento' => 'required|date',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:funcionarios,email,' . $funcionario->id,
            'cargo' => 'required|string|max:100',
            'salario_base' => 'required|numeric|min:0',
            'valor_hora_extra' => 'nullable|numeric|min:0',
            'banco' => 'nullable|string|max:100',
            'agencia' => 'nullable|string|max:20',
            'conta' => 'nullable|string|max:20',
            'data_admissao' => 'required|date',
            'ativo' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $funcionario->update($request->all());

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionário atualizado com sucesso!');
    }

    public function destroy(Funcionario $funcionario)
    {
        try {
            $funcionario->delete();
            return redirect()->route('funcionarios.index')
                ->with('success', 'Funcionário excluído com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('funcionarios.index')
                ->with('error', 'Não foi possível excluir o funcionário. Verifique se não há registros relacionados.');
        }
    }
}
