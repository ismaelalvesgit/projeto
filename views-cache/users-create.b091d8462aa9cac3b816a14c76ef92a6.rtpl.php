<?php if(!class_exists('Rain\Tpl')){exit;}?><script>
  function mascara(telefone){ 
    if(telefone.value.length == 0)
    telefone.value = '(' + telefone.value; //quando começamos a digitar, o script irá inserir um parênteses no começo do campo.
    if(telefone.value.length == 4)
    telefone.value = telefone.value + ') '; //quando o campo já tiver 3 caracteres (um parênteses e 3 números) o script irá inserir mais um parênteses, fechando assim o código de área.
    if(telefone.value.length == 11)
    telefone.value = telefone.value + '-'; //quando o campo já tiver 11 caracteres, o script irá inserir um tracinho, para melhor visualização do telefone. 
  }
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Usuários
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/users">Usuários</a></li>
    <li class="active"><a href="/admin/users/create">Cadastrar</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Novo Usuário</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/users/create" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="desperson">Nome</label>
              <input type="text" class="form-control" id="desperson" name="desperson" placeholder="Digite o nome">
            </div>
            <div class="form-group">
              <label for="deslogin">Login</label>
              <input type="text" class="form-control" id="deslogin" name="deslogin" placeholder="Digite o login">
            </div>
            <div class="form-group">
              <label for="nrphone">Telefone</label>
              <input type="tel" class="form-control" id="nrphone" name="nrphone" onkeypress="mascara(this)" placeholder="Digite o telefone">
            </div>
            <div class="form-group">
              <label for="desemail">E-mail</label>
              <input type="email" class="form-control" id="desemail" name="desemail" placeholder="Digite o e-mail">
            </div>
            <div class="form-group">
              <label for="despassword">Senha</label>
              <input type="password" class="form-control" id="despassword" name="despassword" placeholder="Digite a senha">
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="inadmin" value="1"> Acesso de Administrador
              </label>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-success">Cadastrar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->