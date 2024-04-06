<template>
	<section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
		<el-dialog v-model="modalAberta" :title="modoEdicao ? 'Editar produto' : 'Adicionar produto'" width="500"
			:before-close="handleClose">
			<form class="max-w-md mx-auto"  @submit.prevent="modoEdicao ? editarProduto() : AddProduto()">
				<div class="relative z-0 w-full mb-5 group">
					<input v-model="titulo" type="text" name="floating_titulo" id="floating_titulo"
						class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
						placeholder=" " required />
					<label for="floating_titulo"
						class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Titulo
						de produto</label>
				</div>
				<div class="relative z-0 w-full mb-5 group">
					<input v-model="preco" v-type="preco" name="floating_preco" id="floating_preco"
						class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
						placeholder=" " required />
					<label for="floating_preco"
						class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Preço</label>
				</div>
				<div class="relative z-0 w-full mb-5 group">
					<input v-model="quantidade" type="text" name="floating_quantidade" id="floating_quantidade"
						class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
						placeholder=" " required />
					<label for="floating_quantidade"
						class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Quantidade</label>
				</div>
				<div>
					<label for="countries " class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoria</label>
					<select id="countries" v-model="categoria_id"
						class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
						<option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id"> {{
							categoria.nome }} </option>
					</select>
				</div>
				<div>
					<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Marca</label>
					<select id="countries" v-model="marca_id"
						class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
						<option v-for="marca in marcas" :key="marca.id" :value="marca.id"> {{ marca.nome }} </option>
					</select>

				</div>
				<div class="relative z-0 w-full mb-5 group">
					<label for="floating_descricao"
						class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
					<textarea v-model="descricao" name="floating_descricao" id="floating_descricao" rows="4"
						class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
						placeholder="Write your thoughts here..."></textarea>
				</div>
				<div class="grid md:gap-6">
					<div class="relative z-0 w-full mb-6 group">
						<el-upload v-model:file-list="produtoImagens" multiple list-type="picture-card" :on-preview="previaImagem"
							:on-remove="tratarRemocaoImagem" :on-change="tratarMudancaArquivo">
							<el-icon>
								<Plus />
							</el-icon>
						</el-upload>
					</div>
				</div>
				<div class="grid grid-cols-4 gap-4 mb-5">
					<div class="relative" v-for="(imagemUrl, index) in produto_imagens" :key="imagemUrl.id">
						<img class="rounded w-24 h-24" :src="`/${imagemUrl.imagem}`" alt="Large avatar">
						<button @click="excluirImagemEdicao(imagemUrl, index)" type="button"
							class="absolute w-6 h-6 font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 ">-</button>

					</div>

				</div>
				<button type="submit"
					class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
			</form>

			<template #footer>
				<div class="dialog-footer">
					<el-button @click="modalAberta = false">Cancelar</el-button>
					<el-button type="primary" @click="modalAberta = false">
						Confirmar
					</el-button>
				</div>
			</template>
		</el-dialog>
		<div class="mx-auto max-w-screen-xl px-4 lg:px-12">
			<!-- Start coding here -->
			<div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
				<div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
					<div class="w-full md:w-1/2">
						<form class="flex items-center">
							<label for="simple-search" class="sr-only">Search</label>
							<div class="relative w-full">
								<div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
									<svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
										viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd"
											d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
											clip-rule="evenodd" />
									</svg>
								</div>
								<input type="text" id="simple-search"
									class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
									placeholder="Search">
							</div>
						</form>
					</div>
					<div
						class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
						<button type="button" @click="abrirAddModal"
							class="flex items-center justify-center text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80  font-medium rounded-lg text-sm px-4 py-2  ">
							<svg class="h-4 w-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="26" height="26"
								fill="currentColor" viewBox="0 0 24 24">
								<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M5 12h14m-7 7V5" />
							</svg>
							Adicionar produtos
						</button>
						<div class="flex items-center space-x-3 w-full md:w-auto">
							<button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown"
								class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
								type="button">
								<svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
									xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
									<path clip-rule="evenodd" fill-rule="evenodd"
										d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
								</svg>
								Ações
							</button>
							<div id="actionsDropdown"
								class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
								<ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="actionsDropdownButton">
									<li>
										<a href="#"
											class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Editar</a>
									</li>
								</ul>
								<div class="py-1">
									<a href="#"
										class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Deletar
										Tudo</a>
								</div>
							</div>
							<button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
								class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
								type="button">
								<svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400"
									viewbox="0 0 20 20" fill="currentColor">
									<path fill-rule="evenodd"
										d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
										clip-rule="evenodd" />
								</svg>
								Filtro
								<svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
									xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
									<path clip-rule="evenodd" fill-rule="evenodd"
										d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
								</svg>
							</button>
							<div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
								<h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Choose brand</h6>
								<ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
									<li class="flex items-center">
										<input id="apple" type="checkbox" value=""
											class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
										<label for="apple" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Apple
											(56)</label>
									</li>
									<li class="flex items-center">
										<input id="fitbit" type="checkbox" value=""
											class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
										<label for="fitbit" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Microsoft
											(16)</label>
									</li>
									<li class="flex items-center">
										<input id="razor" type="checkbox" value=""
											class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
										<label for="razor" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Razor
											(49)</label>
									</li>
									<li class="flex items-center">
										<input id="nikon" type="checkbox" value=""
											class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
										<label for="nikon" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Nikon
											(12)</label>
									</li>
									<li class="flex items-center">
										<input id="benq" type="checkbox" value=""
											class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
										<label for="benq" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">BenQ
											(74)</label>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="overflow-x-auto">
					<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
						<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
							<tr>
								<th scope="col" class="px-4 py-3">Nome de produto</th>
								<th scope="col" class="px-4 py-3">Categoria</th>
								<th scope="col" class="px-4 py-3">Marca</th>
								<!-- <th scope="col" class="px-4 py-3">Descrição</th> -->
								<th scope="col" class="px-4 py-3">Preço</th>
								<th scope="col" class="px-4 py-3">Quantidade</th>
								<th scope="col" class="px-4 py-3">Em estoque</th>
								<th scope="col" class="px-4 py-3">Publicado</th>
								<th scope="col" class="px-4 py-3">
									<span class="sr-only">Ações</span>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="produto in produtos" :key="produto.id" class="border-b dark:border-gray-700">
								<th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{
									produto.titulo }}</th>
								<td class="px-4 py-3">{{ produto.categoria.nome }}</td>
								<td class="px-4 py-3">{{ produto.marca.nome }}</td>
								<!-- <td class="px-4 py-3">{{  produto.descricao }}</td> -->
								<td class="px-4 py-3">{{ produto.preco }}</td>
								<td class="px-4 py-3">{{ produto.quantidade }}</td>
								<td class="px-4 py-3">
									<span v-if="produto.emEstoque == 1"
										class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">Disponivel</span>
									<span v-else
										class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">Indisponivel</span>

								</td>
								<td class="px-4 py-3">
									<button v-if="produto.publicacao == 1" type="button"
										class="px-3 py-2 text-xs font-medium text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 shadow-lg shadow-cyan-500/50 dark:shadow-lg dark:shadow-cyan-800/80 rounded-lg  text-center me-2 mb-2">Ativo</button>
									<button v-else type="button"
										class="px-3 py-2 text-xs font-medium text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80  rounded-lg text-center me-2 mb-2 ">Inativo</button>

								</td>
								<td class="px-4 py-3 flex items-center justify-end">
									<button :id="`${produto.id}-button`" :data-dropdown-toggle="`${produto.id}`"
										class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
										type="button">
										<svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
										</svg>
									</button>
									<div :id="`${produto.id}`"
										class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
										<ul class="py-1 text-sm text-gray-700 dark:text-gray-200" :aria-labelledby="`${produto.id}-button`">
											<li>
												<a href="#" @click="abrirEdicaoModal(produto)"
													class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Editar</a>
											</li>
										</ul>
										<div class="py-1">
											<a href="#"
												class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Deletar</a>
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<!-- <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
					aria-label="Table navigation">
					<span class="text-sm font-normal text-gray-500 dark:text-gray-400">
						Showing
						<span class="font-semibold text-gray-900 dark:text-white">1-10</span>
						of
						<span class="font-semibold text-gray-900 dark:text-white">1000</span>
					</span>
					<ul class="inline-flex items-stretch -space-x-px">
						<li>
							<a href="#"
								class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
								<span class="sr-only">Proximo</span>
								<svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
									xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd"
										d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
										clip-rule="evenodd" />
								</svg>
							</a>
						</li>
						<li>
							<a href="#"
								class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
						</li>
						<li>
							<a href="#"
								class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
						</li>
						<li>
							<a href="#" aria-current="page"
								class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
						</li>
						<li>
							<a href="#"
								class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
						</li>
						<li>
							<a href="#"
								class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">100</a>
						</li>
						<li>
							<a href="#"
								class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
								<span class="sr-only">Next</span>
								<svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
									xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd"
										d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
										clip-rule="evenodd" />
								</svg>
							</a>
						</li>
					</ul>
				</nav> -->
			</div>
		</div>
	</section>
</template>


<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue'
import { Plus } from '@element-plus/icons-vue'

const produtos = usePage().props.produtos
const marcas = usePage().props.marcas
const categorias = usePage().props.categorias


const isAddProduto = ref(false)
const modoEdicao = ref(false)

const modalAberta = ref(false)


const produtoImagens = ref([])
const modalImagemUrl = ref('')

const tratarMudancaArquivo = (file) => {
	produtoImagens.value.push(file)
}

const previaImagem = (file) => {
	modalImagemUrl.value = file.url
	modalAberta.value = true
}




const id = ref('')
const titulo = ref('')
const preco = ref('')
const quantidade = ref('')
const descricao = ref('')
const produto_imagens = ref([])
const publicado = ref('')
const categoria_id = ref('')
const marca_id = ref('')
const emEstoque = ref('')

const AddProduto = async () => {
	const formData = new FormData();
	formData.append('titulo', titulo.value)
	formData.append('preco', preco.value)
	formData.append('quantidade', quantidade.value)
	formData.append('descricao', descricao.value)
	formData.append('marca_id', marca_id.value)
	formData.append('categoria_id', categoria_id.value)

	for (const imagem of produtoImagens.value) {
		formData.append('produto_imagens[]', imagem.raw)
	}

	try {
		await router.post('produtos/store', formData, 
			modalAberta.value = false,
			resetarDadosFormulario(), {
			onSuccess: page => {
				Swal.fire({
					toast: true,
					icon: "success",
					position: "top-end",
					showConfirmButton: false,
					title: page.props.flash.success
				})
				
			},
			
		})
		window.location.reload();
	} catch (err) {
		console.log(err)
	}
}
const excluirProduto = (produto, id) => {
	console.log(produto, id)
}

const resetarDadosFormulario = () => {
	id.value = '';
	titulo.value = '';
	preco.value = '';
	quantidade.value = '';
	descricao.value = '';
	produtoImagens.value = [];
	modalImagemUrl.value = ''
};

const abrirAddModal = () => {
	isAddProduto.value = true
	modalAberta.value = true
	modoEdicao.value = false
}

const abrirEdicaoModal = (produto) => {
	modoEdicao.value = true
	isAddProduto.value = false
	modalAberta.value = true

	id.value = produto.id
	titulo.value = produto.titulo;
	preco.value = produto.preco;
	quantidade.value = produto.quantidade;
	descricao.value = produto.descricao;
	produto_imagens.value = produto.produto_imagens;
	categoria_id.value = produto.categoria_id;
	marca_id.value = produto.marca_id;
}

const excluirImagemEdicao = async (imagem, index) => {
	console.log(imagem, 'funcionou a exclusão')
	
	try {
		await router.delete('/admin/produtos/imagem/' + imagem.id),
		produto_imagens.value.splice(index, 1), {
			onSuccess: (page) => {
				Swal.fire({
					toast: true,
					icon: "success",
					position: "top-end",
					showConfirmButton: false,
					title: page.props.flash.success,
				})
			}
		}
	} catch {
		console.log(err)
	}
}

const editarProduto = async () => {
	const formData = new FormData();
	formData.append('titulo', titulo.value)
	formData.append('preco', preco.value)
	formData.append('quantidade', quantidade.value)
	formData.append('descricao', descricao.value)
	formData.append('marca_id', marca_id.value)
	formData.append('categoria_id', categoria_id.value)
	formData.append('_method', 'PUT')

	for (const imagem of produtoImagens.value) {
		formData.append('produto_imagens[]', imagem.raw)
	}

	try {
		await router.post('produtos/update/' + id.value, formData, {
			onSuccess: (page) => {
				modalAberta.value = false;
				resetarDadosFormulario();
				Swal.fire({
					toast: true,
					icon: "success",
					position: "top-end",
					showConfirmButton: false,
					title: page.props.flash.success,
				})
			}
		})
		window.location.reload();
	} catch {

		console.log(err)
	}
}

</script>