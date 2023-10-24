<?php
$proyectos = json_decode(file_get_contents('mysql/proyecto1.json'),true);
// UD4.3 RA4.f 4.3.4.f Creamos una variable donde almacenamos la decodificación del json de usuarios. 
$usuarios = json_decode(file_get_contents('mysql/usuario.json'),true);
/*
$proyectos = [
	//3.3.a Modifico lo arrays para hacerlos "Reales". De momento la descripción la lleno de Lorem ipsu. 
	//3.3.b Incorpor los campos categorias, que es un array, y la fecha que para darle un valor temporal le incorporo el formato. 
	[
		"clave" => "comisaria",
		"titulo" => "Comisaria social",
		"descripcion" => "Lorem fistrum amatomaa sexuarl benemeritaar ese hombree la caidita pecador ese hombree por la gloria de mi madre me cago en tus muelas. Sexuarl hasta luego Lucas ese que llega caballo blanco caballo negroorl fistro al ataquerl va usté muy cargadoo. Ahorarr a wan te va a hasé pupitaa ahorarr pecador sexuarl.",
		"imagen" => "static/images/comisaria.jpg",
		"categorias" => ["php","py",],
		"fecha" => "04/07/1950"
	],

	[
		"clave" => "trenza",
		"titulo" => "Peluqueria Lola",
		"descripcion" => "Lorem fistrum amatomaa sexuarl benemeritaar ese hombree la caidita pecador ese hombree por la gloria de mi madre me cago en tus muelas. Sexuarl hasta luego Lucas ese que llega caballo blanco caballo negroorl fistro al ataquerl va usté muy cargadoo. Ahorarr a wan te va a hasé pupitaa ahorarr pecador sexuarl.",
		"imagen" => "static/images/trenza.jpg",
		"categorias" => [],
		"fecha" => "04/08/1980"
	],

	[
		"clave" => "calamar",
		"titulo" => "Pescaderia",
		"descripcion" => "Lorem fistrum amatomaa sexuarl benemeritaar ese hombree la caidita pecador ese hombree por la gloria de mi madre me cago en tus muelas. Sexuarl hasta luego Lucas ese que llega caballo blanco caballo negroorl fistro al ataquerl va usté muy cargadoo. Ahorarr a wan te va a hasé pupitaa ahorarr pecador sexuarl.",
		"imagen" => "static/images/calamar.jpg",
		"categorias" => [],
		"fecha" => "04/06/1970"
	],

	[
		"clave" => "tenis",
		"titulo" => "Club deportivo",
		"descripcion" => "Lorem fistrum amatomaa sexuarl benemeritaar ese hombree la caidita pecador ese hombree por la gloria de mi madre me cago en tus muelas. Sexuarl hasta luego Lucas ese que llega caballo blanco caballo negroorl fistro al ataquerl va usté muy cargadoo. Ahorarr a wan te va a hasé pupitaa ahorarr pecador sexuarl.",
		"imagen" => "static/images/tenis.jpg",
		"categorias" => [],
		"fecha" => "04/02/1990"
	],

	[
		"clave" => "corso",
		"titulo" => "Una de Piratas",
		"descripcion" => "Lorem fistrum amatomaa sexuarl benemeritaar ese hombree la caidita pecador ese hombree por la gloria de mi madre me cago en tus muelas. Sexuarl hasta luego Lucas ese que llega caballo blanco caballo negroorl fistro al ataquerl va usté muy cargadoo. Ahorarr a wan te va a hasé pupitaa ahorarr pecador sexuarl.",
		"imagen" => "static/images/pirata.jpg",
		"categorias" => [],
		"fecha" => "04/10/1960"
	],
	[
		"clave" => "corso",
		"titulo" => "Una de Piratas",
		"descripcion" => "Lorem fistrum amatomaa sexuarl benemeritaar ese hombree la caidita pecador ese hombree por la gloria de mi madre me cago en tus muelas. Sexuarl hasta luego Lucas ese que llega caballo blanco caballo negroorl fistro al ataquerl va usté muy cargadoo. Ahorarr a wan te va a hasé pupitaa ahorarr pecador sexuarl.",
		"imagen" => "static/images/pirata.jpg",
		"categorias" => [],
		"fecha" => "04/10/1960"
	],
	[
		"clave" => "corso",
		"titulo" => "Una de Piratas",
		"descripcion" => "Lorem fistrum amatomaa sexuarl benemeritaar ese hombree la caidita pecador ese hombree por la gloria de mi madre me cago en tus muelas. Sexuarl hasta luego Lucas ese que llega caballo blanco caballo negroorl fistro al ataquerl va usté muy cargadoo. Ahorarr a wan te va a hasé pupitaa ahorarr pecador sexuarl.",
		"imagen" => "static/images/pirata.jpg",
		"categorias" => [],
		"fecha" => "04/10/1960"
	],

];
$neoProyecto=[];
*/
$categoriasMain = [
	"php" => "PHP", "js" => "JavaScript", "py" => "Python", "mysql" => "MySQL"
];

// UD3.2.c Creo variable para nombreApellidos para cliente. 
$nombreApellidos = "Albert Pérez Baleyto";
//$loggedIn = true;

?>
