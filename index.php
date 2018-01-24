<?php 

session_start();

require_once("vendor/autoload.php");

use \Slim\Slim;
use \ismael\Page;
use \ismael\pageAdmin;
use \ismael\pageErro;
use \ismael\Model\User;
use \ismael\Model\Category;

$app = new Slim();

$app->config('debug', true);

/*------- home ---------*/

$app->get('/', function() {

	$page = new Page();

	$page->setTpl("index");
});

/*------- page - login ---------*/

$app->get('/login', function() {

	$page = new page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login");
});

$app->get('/login/erro', function() {

	$page = new pageErro([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login");
});
/*------- regra - login ---------*/

$app->post('/login', function(){

	User::login($_POST["login"], $_POST["password"]);

	header("Location: /admin");

	exit;
});

/*------- page - admin ---------*/

$app->get('/admin/', function() {

	User::verifyLogin();

	$user = new User();

	$page = new pageAdmin();

	$page->setTpl("index");
});

$app->get('/admin/logout', function() {

	User::logout();

	header("Location: /login");

	exit;
});

/*------- page - admin - list ---------*/

$app->get('/admin/users', function(){

	User::verifyLogin();

	$users = User::listAll();

	$page = new pageAdmin();

	$page->setTpl("users", array(
		"users"=> $users));
});

/*------- page - admin - create ---------*/

$app->get('/admin/users/create', function(){

	User::verifyLogin();

	$user = new User();

	$page = new pageAdmin();

	$page->setTpl("users-create");

});

/*------- page - admin - delete ---------*/

$app->get('/admin/users/:iduser/delete', function($iduser){

	User::verifyLogin();
	
	$user = new User();

	$user->get((int)$iduser);

	$user->delete();

	header("Location: /admin/users");
	exit;
});

/*------- page - admin - update ---------*/

$app->get('/admin/users/:iduser', function($iduser){

	User::verifyLogin();

	$user = new User();

	$user->get((int)$iduser);

	$page = new pageAdmin();

	$page->setTpl("users-update", array(
		"user"=>$user->getValues()
	));

});

/*------- regras - admin - create, update ---------*/

$app->post('/admin/users/create', function(){

	User::verifyLogin();

	$user = new User();

	$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;

	$_POST['despassword'] = password_hash($_POST["despassword"], PASSWORD_DEFAULT, [
    "cost"=>12
	]);

	$user->setData($_POST);

	$user->save();

	header("Location: /admin/users");
	exit;

});

$app->post('/admin/users/:iduser', function($iduser){

	User::verifyLogin();
	
	$user = new User();

	$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;

	$user->get((int)$iduser);

	$user->setData($_POST);

	$user->update();

	header("Location: /admin/users");
	exit;

});

/*------- page - recuperação de senha ---------*/

$app->get('/forgot', function(){

	$page = new page([
		"header"=>false,
		"footer"=>false	
	]);

	$page->setTpl('forgot');

});

$app->get('/forgot/erro', function() {

	$page = new pageErro([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot");
});

/*------- regras - recuperação de senha ---------*/

$app->post('/forgot', function(){

	$_POST["email"];

	$user = User::getForgot($_POST["email"]);

	header("Location: /forgot/send");
	exit;
});

/*------- page - envio de recuperação de senha ---------*/

$app->get('/forgot/send', function(){

	$page = new page([
		"header"=>false,
		"footer"=>false	
	]);

	$page->setTpl('forgot-send');

});

/*------- page - troca de senha ---------*/

$app->get('/forgot/reset', function(){
	
	$user = User::validForgotDecrypt($_GET["code"]);

	$page = new page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl('forgot-reset', array(

		"name"=>$user["desperson"],
		"code"=>$_GET["code"]
	));

});

$app->post('/forgot/reset', function(){

	$forgot = User::validForgotDecrypt($_POST["code"]);

	User::setForgotUser($forgot["idrecovery"]);

	$user = new User();

	$user->get((int)$forgot["iduser"]);

	$_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT, [
    "cost"=>12
	]);

	$user->setPassword($_POST["password"]);

	$page = new page([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl('forgot-reset-success');
});

/*------- page - categoria ---------*/

$app->get('/admin/categories', function(){

	User::verifyLogin();
	
	$categories = Category::listAll();

	$page =  new pageAdmin();

	$page->setTpl('categories', array(

		"categories"=>$categories
	));

});

$app->get('/admin/categories/create', function(){

	User::verifyLogin();
	
	$page =  new pageAdmin();

	$page->setTpl('categories-create');

});

$app->post('/admin/categories/create', function(){

	User::verifyLogin();
	
	$category = new Category();

	$category->setData($_POST);

	$category->save();

	header("Location: /admin/categories");
	exit;	
});

$app->get('/admin/categories/:idcategory/delete', function($idcategory){

	User::verifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);

	$category->delete();

	header("Location: /admin/categories");
	exit;
});

$app->get('/admin/categories/:idcategory', function($idcategory){

	User::verifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);

	$page = new pageAdmin();

	$page->setTpl('categories-update', array(

		"category"=>$category->getValues()
	));

});

$app->post('/admin/categories/:idcategory', function($idcategory){

	User::verifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);

	$category->setData($_POST);

	$category->save();

	header("Location: /admin/categories");
	exit;
});

$app->get("/categories/:idcategory", function($idcategory){

	$categories = new Category();

	$categories->get((int)$idcategory);

	$page = new Page();

	$page->setTpl("category",[

		"category"=>$categories->getValues(),
		"produts"=>[]
	]);

});

/*------- page - 404 ---------*/

$app->notFound(function () use ($app) {
  http_response_code(404);
  echo "Página não encontrada.";
  exit;
});

$app->run();

 ?>