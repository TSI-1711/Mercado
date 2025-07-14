<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Funcionario;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $funcionarios = [
            [
                'nome' => 'João Silva Santos',
                'cpf' => '123.456.789-00',
                'rg' => '12.345.678-9',
                'data_nascimento' => '1985-03-15',
                'telefone' => '(11) 99999-9999',
                'email' => 'joao.silva@empresa.com',
                'cargo' => 'Vendedor',
                'salario_base' => 2500.00,
                'valor_hora_extra' => 15.00,
                'banco' => 'Banco do Brasil',
                'agencia' => '1234',
                'conta' => '12345-6',
                'data_admissao' => '2023-01-15',
                'ativo' => true,
            ],
            [
                'nome' => 'Maria Oliveira Costa',
                'cpf' => '987.654.321-00',
                'rg' => '98.765.432-1',
                'data_nascimento' => '1990-07-22',
                'telefone' => '(11) 88888-8888',
                'email' => 'maria.oliveira@empresa.com',
                'cargo' => 'Caixa',
                'salario_base' => 2200.00,
                'valor_hora_extra' => 12.00,
                'banco' => 'Itaú',
                'agencia' => '5678',
                'conta' => '98765-4',
                'data_admissao' => '2023-03-10',
                'ativo' => true,
            ],
            [
                'nome' => 'Pedro Santos Lima',
                'cpf' => '456.789.123-00',
                'rg' => '45.678.912-3',
                'data_nascimento' => '1988-11-08',
                'telefone' => '(11) 77777-7777',
                'email' => 'pedro.santos@empresa.com',
                'cargo' => 'Estoquista',
                'salario_base' => 2000.00,
                'valor_hora_extra' => 10.00,
                'banco' => 'Santander',
                'agencia' => '9012',
                'conta' => '54321-0',
                'data_admissao' => '2023-02-20',
                'ativo' => true,
            ],
            [
                'nome' => 'Ana Paula Ferreira',
                'cpf' => '789.123.456-00',
                'rg' => '78.912.345-6',
                'data_nascimento' => '1992-05-14',
                'telefone' => '(11) 66666-6666',
                'email' => 'ana.ferreira@empresa.com',
                'cargo' => 'Gerente',
                'salario_base' => 3500.00,
                'valor_hora_extra' => 20.00,
                'banco' => 'Bradesco',
                'agencia' => '3456',
                'conta' => '67890-1',
                'data_admissao' => '2022-12-01',
                'ativo' => true,
            ],
            [
                'nome' => 'Carlos Eduardo Martins',
                'cpf' => '321.654.987-00',
                'rg' => '32.165.498-7',
                'data_nascimento' => '1987-09-30',
                'telefone' => '(11) 55555-5555',
                'email' => 'carlos.martins@empresa.com',
                'cargo' => 'Auxiliar Administrativo',
                'salario_base' => 1800.00,
                'valor_hora_extra' => 8.00,
                'banco' => 'Caixa Econômica',
                'agencia' => '7890',
                'conta' => '23456-7',
                'data_admissao' => '2023-04-05',
                'ativo' => false,
            ],
        ];

        foreach ($funcionarios as $funcionario) {
            Funcionario::create($funcionario);
        }
    }
} 