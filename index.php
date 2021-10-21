<?php

include 'inc.twig.php';
//Il manquait un « e » à « includ ».

$template_index = $twig->loadTemplate('index.tpl');
//Il manquait un point virgule

$n_jours_previsions = 3;

$ville = "Limoges";

//~ Clé API
//~ Si besoin, vous pouvez générer votre propre clé d'API gratuitement, en créant 
//~ votre propre compte ici : https://home.openweathermap.org/users/sign_up
$apikey = "10eb2d60d4f267c79acb4814e95bc7dc";

$data_url = 'http://api.openweathermap.org/data/2.5/forecast/daily?APPID=' . $apikey . '&q=' . $ville . ',fr&lang=fr&units=metric&cnt=' . $n_jours_previsions;

$data_contenu = file_get_contents($data_url);

$_data_array = json_decode($data_contenu, true);

$_ville = $_data_array['city'];

$_journees_meteo = $_data_array['list'];
//il faut afficher les informations structurées d’une variable avec, 
//var_dump($_data_array);
//die();
//Par conséquent, on enlève le “e” de la variable “liste”
for ($i = 0; $i < count($_journees_meteo); $i++) {
	$_meteo = getMeteoImage($_journees_meteo[$i]['weather'][0]['icon']);

	$_journees_meteo[$i]['meteo'] = $_meteo;
}

echo $template_index->render(array(
	//On rajoute la flèche 
	'_journees_meteo' => $_journees_meteo,
	'_ville' => $_ville,
	var_dump($_ville),
	die(),
	'n_jours_previsions' => $n_jours_previsions
	//L’égal n'était pas écrit correctement sur trois variables.
	//Il faut mettre “==” lorsque que l’on veut que deux variables soit égale lorsqu’elle retourne “True”.
));

function getMeteoImage($code)
{
	if (strpos($code, 'n'))
		return 'entypo-moon';


	$_icones_meteo = array(
		'01d' => 'entypo-light-up',
		'02d' => 'entypo-light-up', '03d' => 'entypo-cloud',
		//On rajoute une virgule, pour séparer les valeurs du tableau.
		'04d' => 'entypo-cloud', '09d' => 'entypo-water',
		'10d' => 'entypo-water',
		'11d' => 'entypo-flash',
		'13d' => 'entypo-star',
		'50d' => 'entypo-air'
	);

	if (array_key_exists($code, $_icones_meteo)) {
		//Il manquait l’accolade « { » de la fonction « if () » pour fermer la fonction.
		return $_icones_meteo[$code];
	} else {
		return 'entypo-help';
	}
}
