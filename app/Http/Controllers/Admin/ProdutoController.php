<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Produto;
use App\Models\ProdutoImagem;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class ProdutoController extends Controller
{

	public function index()
	{
		$produtos = Produto::with('categoria', 'marca')->get();
		$marcas = Marca::get();
		$categorias = Categoria::get();

		return Inertia::render('Admin/Produtos/Index', [
			'produtos' => $produtos,
			'marcas' => $marcas,
			'categorias' => $categorias
		]);
	}

	public function store(Request $request)
	{
		
		$produto = new Produto;
		$produto->titulo = $request->titulo;
		$produto->preco = $request->preco;
		$produto->quantidade = $request->quantidade;
		$produto->descricao = $request->descricao;
		$produto->categoria_id = $request->categoria_id;
		$produto->marca_id = $request->marca_id;
		$produto->save();

		if ($request->hasFile('produto_imagens')) {
			$produtoImagens = $request->file('produto_imagens');
			foreach ($produtoImagens as $imagem) {
				$nomeUnico = time() . '-' . Str::random(10) . '.' . $imagem->getClientOriginalExtension();

				$imagem->move('produto_imagens', $nomeUnico);

				ProdutoImagem::create([
					'produto_id' => $produto->id,
					'imagem' => 'produto_imagens/' . $nomeUnico
				]);
			}
		}

		return redirect()->route('admin.produtos.index')->with('Sucesso', 'Produto foi criado com sucesso.');
	}
}
