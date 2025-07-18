<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fornecedor;
use App\Models\Orcamento;
use App\Models\Compra;
use App\Models\Produto;
use App\Models\ItemCompra;
use App\Models\ItemOrcamento;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Fornecedor::create([
            'nome' => 'Fornecedor Alpha',
            'cnpj' => '12345678000101',
            'endereco' => 'Rua Alfa, 100',
            'telefone' => '11999990001',
            'email' => 'alpha@fornecedor.com',
        ]);
        Fornecedor::create([
            'nome' => 'Fornecedor Beta',
            'cnpj' => '22345678000102',
            'endereco' => 'Rua Beta, 200',
            'telefone' => '11999990002',
            'email' => 'beta@fornecedor.com',
        ]);
        Fornecedor::create([
            'nome' => 'Fornecedor Gama',
            'cnpj' => '32345678000103',
            'endereco' => 'Rua Gama, 300',
            'telefone' => '11999990003',
            'email' => 'gama@fornecedor.com',
        ]);

        $fornecedor1 = Fornecedor::first();
        $fornecedor2 = Fornecedor::skip(1)->first();
        $produto1 = Produto::first();
        $produto2 = Produto::skip(1)->first();
        $produto3 = Produto::skip(2)->first();

        // Orçamentos
        $orcamento1 = Orcamento::create([
            'fornecedor_id' => $fornecedor1 ? $fornecedor1->id : 1,
            'data_orcamento' => now()->subDays(5),
            'valor_total' => 1500.00,
            'status' => 'pendente',
        ]);
        $orcamento2 = Orcamento::create([
            'fornecedor_id' => $fornecedor2 ? $fornecedor2->id : 1,
            'data_orcamento' => now()->subDays(2),
            'valor_total' => 2500.00,
            'status' => 'aprovado',
        ]);

        // Itens para orçamentos
        if ($produto1 && $orcamento1) {
            ItemOrcamento::create([
                'orcamento_id' => $orcamento1->id,
                'produto_id' => $produto1->id,
                'quantidade' => 5,
                'preco_unitario' => 100.00,
            ]);
        }
        if ($produto2 && $orcamento2) {
            ItemOrcamento::create([
                'orcamento_id' => $orcamento2->id,
                'produto_id' => $produto2->id,
                'quantidade' => 10,
                'preco_unitario' => 200.00,
            ]);
        }

        // Ordens de Compra
        $compra1 = Compra::create([
            'fornecedor_id' => $fornecedor1 ? $fornecedor1->id : 1,
            'data_compra' => now()->subDays(3),
            'valor_total' => 1000.00,
            'status' => 'em_aberto',
        ]);
        $compra2 = Compra::create([
            'fornecedor_id' => $fornecedor2 ? $fornecedor2->id : 1,
            'data_compra' => now()->subDays(1),
            'valor_total' => 2000.00,
            'status' => 'recebido',
        ]);
        $compra3 = Compra::create([
            'fornecedor_id' => $fornecedor1 ? $fornecedor1->id : 1,
            'data_compra' => now(),
            'valor_total' => 3000.00,
            'status' => 'em_aberto',
        ]);

        // Itens para compras
        if ($produto1 && $compra1) {
            ItemCompra::create([
                'compra_id' => $compra1->id,
                'produto_id' => $produto1->id,
                'quantidade' => 3,
                'preco_unitario' => 100.00,
            ]);
        }
        if ($produto2 && $compra2) {
            ItemCompra::create([
                'compra_id' => $compra2->id,
                'produto_id' => $produto2->id,
                'quantidade' => 7,
                'preco_unitario' => 200.00,
            ]);
        }
        if ($produto3 && $compra3) {
            ItemCompra::create([
                'compra_id' => $compra3->id,
                'produto_id' => $produto3->id,
                'quantidade' => 2,
                'preco_unitario' => 300.00,
            ]);
        }
    }
}
