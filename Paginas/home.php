<?php #var_dump($produtoEditar);exit; ?>

<main class="container">
	<form action="busca" method="GET">
		<input type="text" name="busca" id="busca" placeholder="Pesquisa ..">
		<button type="submit" class="btn blue">Pesquisar</button>
	</form>
	<h2>Lista de Cursos</h2>
    <table class="bordered">
        <thead>
          <tr>
              <th>Titulo</th>
              <th>Descrição</th>
              <th>Valor</th>
              <th>Ação</th>
          </tr>
        </thead>

        <tbody>

		<?php foreach($produtos as $produto): ?>
          <tr>
            <td><b><?php echo $produto['titulo'] ?></b></td>
            <td><?php echo $produto['descricao'] ?></td>
            <td><?php echo "R$ " . number_format($produto['valor'], 2, ",", ".") ?></td>
			<td>
				<a class="btn blue" href="/produto/editar?id=<?php echo $produto['id'] ?>">Editar</a>
				<a class="btn red" href="/produto/deletar?id=<?php echo $produto['id'] ?>">Deletar</a>
			</td>
          </tr>
		  <?php endforeach; ?>

        </tbody>
      </table>

	<?php if(isset($flagEdit)): ?>
		<h2>Editar Produto</h2>
	<?php else: ?>
		<h2>Adicionar Produto</h2>
	<?php endif; ?>


	<?php if( isset($err) ): ?>
		<hr>
		<b><?php echo $err; ?></b>
		<hr>
		<br>
	<?php endif; ?>

	<?php if( isset($validacao) ): ?>
	<ul>
		<?php echo $validacao ?>
	</ul>
	<?php endif; ?>

	<form action="<?php echo (isset( $flagEdit ) ? "/produto/salvar" : "/produto/adicionar") ?>" method="POST">

		<?php if(isset($flagEdit)): ?>
			<input type="hidden" name="id" value="<?php echo $produtoEditar['id'] ?>">
		<?php endif; ?>

		<input type="text" name="titulo" placeholder="Titulo" value="<?php echo (isset($produtoEditar['titulo']) ? $produtoEditar['titulo'] : "" ) ?>">
		<input type="text" name="descricao"  placeholder="Descrição" value="<?php echo (isset($produtoEditar['descricao']) ? $produtoEditar['descricao'] : "" ) ?>">
		<input type="text" name="valor"  placeholder="Valor" value="<?php echo (isset($produtoEditar['valor']) ? $produtoEditar['valor'] : "" ) ?>">

		<button class="btn blue" type="submit"> <?php echo (isset( $flagEdit ) ? "Salvar" : "Adicionar") ?> </button>
		<?php if( isset($flagEdit) ): ?>
			<a href="/home">Cancelar</a>
		<?php endif; ?>

	</form>
	<br>
	<br>
</main>
