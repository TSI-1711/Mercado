<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Fornecedor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa; padding-top: 40px;">

    @extends('template')

    <div style="max-width: 800px; margin: 0 auto; padding: 0 15px;">
        <div style="background-color: white; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); margin-bottom: 30px;">
            <div style="background-color: #3490dc; color: white; padding: 15px 20px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                <h2 style="margin: 0; font-size: 1.5rem;">Editar Fornecedor</h2>
            </div>
            
            <div style="padding: 20px;">
                <form action="{{ route('fornecedor.update', $fornecedor->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div style="margin-bottom: 20px;">
                        <label for="nome" style="display: block; margin-bottom: 5px; font-weight: 600;">Nome</label>
                        <input type="text" id="nome" name="nome" value="{{ old('nome', $fornecedor->nome) }}" 
                               style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px;" required>
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label for="cnpj" style="display: block; margin-bottom: 5px; font-weight: 600;">CNPJ</label>
                        <input type="text" id="cnpj" name="cnpj" value="{{ old('cnpj', $fornecedor->cnpj) }}" 
                               style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px;" required>
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label for="endereco" style="display: block; margin-bottom: 5px; font-weight: 600;">Endereço</label>
                        <input type="text" id="endereco" name="endereco" value="{{ old('endereco', $fornecedor->endereco) }}" 
                               style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px;" required>
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <label for="telefone" style="display: block; margin-bottom: 5px; font-weight: 600;">Telefone</label>
                        <input type="text" id="telefone" name="telefone" value="{{ old('telefone', $fornecedor->telefone) }}" 
                               style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px;" required>
                    </div>
                    
                    <div style="margin-bottom: 25px;">
                        <label for="email" style="display: block; margin-bottom: 5px; font-weight: 600;">E-mail</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $fornecedor->email) }}" 
                               style="width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 4px;" required>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <button type="submit" style="background-color: #3490dc; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">
                            Atualizar Fornecedor
                        </button>
                        <a href="{{ route('fornecedor.index') }}" style="background-color: #6c757d; color: white; padding: 10px 20px; border-radius: 4px; text-decoration: none; display: inline-block;">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>