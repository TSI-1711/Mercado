# Módulo de Compras - Sistema Mercado

Este módulo implementa um sistema completo de gestão de compras com as seguintes funcionalidades:

## Funcionalidades Implementadas

### 1. Cadastro de Produtos
- **CRUD completo** de produtos
- Controle de estoque automático
- Preço de custo
- Descrição detalhada
- Relacionamento com fornecedores

**Rotas:**
- `GET /produtos` - Lista todos os produtos
- `GET /produtos/create` - Formulário de cadastro
- `POST /produtos` - Salva novo produto
- `GET /produtos/{id}` - Visualiza produto
- `GET /produtos/{id}/edit` - Formulário de edição
- `PUT /produtos/{id}` - Atualiza produto
- `DELETE /produtos/{id}` - Remove produto

### 2. Orçamentos
- Criação de orçamentos com múltiplos itens
- Seleção de fornecedor
- Cálculo automático de valores
- Status: pendente, aprovado, rejeitado
- Aprovação/rejeição de orçamentos

**Rotas:**
- `GET /orcamentos` - Lista todos os orçamentos
- `GET /orcamentos/create` - Formulário de criação
- `POST /orcamentos` - Salva novo orçamento
- `GET /orcamentos/{id}` - Visualiza orçamento
- `GET /orcamentos/{id}/edit` - Formulário de edição
- `PUT /orcamentos/{id}` - Atualiza orçamento
- `DELETE /orcamentos/{id}` - Remove orçamento

### 3. Ordens de Compra
- Criação de ordens de compra baseadas em orçamentos aprovados
- Múltiplos itens por ordem
- Status: em_aberto, recebido, cancelado
- Cálculo automático de totais
- Integração com entrada de produtos

**Rotas:**
- `GET /compras` - Lista todas as ordens
- `GET /compras/create` - Formulário de criação
- `POST /compras` - Salva nova ordem
- `GET /compras/{id}` - Visualiza ordem
- `GET /compras/{id}/edit` - Formulário de edição
- `PUT /compras/{id}` - Atualiza ordem
- `DELETE /compras/{id}` - Remove ordem
- `GET /compras/{id}/itens` - Retorna itens (AJAX)

### 4. Entrada de Produtos
- Registro de entrada de produtos
- Atualização automática do estoque
- Vinculação com ordens de compra
- Controle de quantidades recebidas
- Observações detalhadas

**Rotas:**
- `GET /entradas` - Lista todas as entradas
- `GET /entradas/create` - Formulário de criação
- `POST /entradas` - Salva nova entrada
- `GET /entradas/{id}` - Visualiza entrada
- `GET /entradas/{id}/edit` - Formulário de edição
- `PUT /entradas/{id}` - Atualiza entrada
- `DELETE /entradas/{id}` - Remove entrada

## Estrutura do Banco de Dados

### Tabelas Principais:

1. **produtos**
   - id, nome, descricao, preco_custo, estoque, timestamps

2. **orcamentos**
   - id, fornecedor_id, data_orcamento, valor_total, status, timestamps

3. **item_orcamentos**
   - id, orcamento_id, produto_id, quantidade, preco_unitario, timestamps

4. **compras**
   - id, fornecedor_id, data_compra, valor_total, status, timestamps

5. **item_compras**
   - id, compra_id, produto_id, quantidade, preco_unitario, timestamps

6. **entradas**
   - id, compra_id, data_entrada, observacoes, timestamps

7. **item_entradas**
   - id, entrada_id, produto_id, quantidade_recebida, timestamps

## Fluxo de Trabalho

1. **Cadastro de Produtos**: Primeiro, cadastre os produtos que serão comprados
2. **Criação de Orçamentos**: Solicite orçamentos aos fornecedores
3. **Aprovação de Orçamentos**: Aprove os orçamentos desejados
4. **Criação de Ordens de Compra**: Gere ordens de compra baseadas nos orçamentos aprovados
5. **Registro de Entradas**: Quando os produtos chegarem, registre as entradas para atualizar o estoque

## Características Técnicas

### Controllers
- `ProdutoController` - Gerencia produtos
- `OrcamentoController` - Gerencia orçamentos
- `CompraController` - Gerencia ordens de compra
- `EntradaController` - Gerencia entradas de produtos

### Models
- `Produto` - Modelo de produtos
- `Orcamento` - Modelo de orçamentos
- `ItemOrcamento` - Modelo de itens de orçamento
- `Compra` - Modelo de ordens de compra
- `ItemCompra` - Modelo de itens de compra
- `Entrada` - Modelo de entradas
- `ItemEntrada` - Modelo de itens de entrada

### Views
- Interface moderna com Bootstrap 5
- Formulários dinâmicos com JavaScript
- Validação client-side e server-side
- Mensagens de feedback para o usuário
- Paginação nas listagens

### Funcionalidades Avançadas
- **Controle de Estoque Automático**: O estoque é atualizado automaticamente quando uma entrada é registrada
- **Cálculos Automáticos**: Subtotais e totais são calculados automaticamente
- **Validações**: Validação completa de dados em todos os formulários
- **Relacionamentos**: Todos os relacionamentos entre entidades estão implementados
- **Interface Responsiva**: Interface adaptável para diferentes tamanhos de tela

## Como Usar

1. **Acesse o sistema** e navegue para o menu "Compra"
2. **Cadastre produtos** através do menu "Produtos"
3. **Crie orçamentos** selecionando fornecedores e produtos
4. **Aprove orçamentos** desejados
5. **Gere ordens de compra** baseadas nos orçamentos aprovados
6. **Registre entradas** quando os produtos chegarem

## Observações Importantes

- O sistema atualiza automaticamente o estoque quando uma entrada é registrada
- Orçamentos podem ser aprovados, rejeitados ou mantidos como pendentes
- Ordens de compra podem ser canceladas se necessário
- Todas as operações são registradas com timestamps
- O sistema mantém a integridade referencial entre as tabelas

## Próximas Melhorias Sugeridas

1. **Relatórios**: Adicionar relatórios de compras, orçamentos e entradas
2. **Notificações**: Sistema de notificações para produtos com estoque baixo
3. **Histórico**: Histórico completo de movimentações de estoque
4. **Backup**: Sistema de backup automático dos dados
5. **Auditoria**: Log de todas as operações realizadas 