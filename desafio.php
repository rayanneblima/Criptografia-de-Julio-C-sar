<?php
header('Content-type: text/html; charset=UTF-8; application/json');

$jsonurl = "https://api.codenation.dev/v1/challenge/dev-ps/generate-data?token=5eafe4dda4405fa4daf7820c2187d330a37f733f";
$json = file_get_contents($jsonurl);
$json = json_decode($json, true);
echo $json['numero_casas'];
echo '<br>';
echo $json['token'];
echo '<br>';
echo $json['cifrado'];
echo '<br>';
echo $json['decifrado'];
echo '<br>';
echo $json['resumo_criptografico'];
echo '<br>';

$letras = array('a' => 1,
					'b' => 2,
					'c' => 3,
					'd' => 4,
					'e' => 5,
					'f' => 6,
					'g' => 7,
					'h' => 8,
					'i' => 9,
					'j' => 10,
					'k' => 11,
					'l' => 12,
					'm' => 13,
					'n' => 14,
					'o' => 15,
					'p' => 16,
					'q' => 17,
					'r' => 18,
					's' => 19,
					't' => 20,
					'u' => 21,
					'v' => 22,
					'w' => 23,
					'x' => 24,
					'y' => 25,
          'z' => 26,
          ' ' => 27,
          '.' => 28);
	$letraT = array(1 => 'a',
					2 => 'b',
					3 => 'c',
					4 => 'd',
					5 => 'e',
					6 => 'f',
					7 => 'g',
					8 => 'h',
					9 => 'i',
					10 => 'j',
					11 => 'k',
					12 => 'l',
					13 => 'm',
					14 => 'n',
					15 => 'o',
					16 => 'p',
					17 => 'q',
					18 => 'r',
					19 => 's',
					20 => 't',
					21 => 'u',
					22 => 'v',
					23 => 'w',
					24 => 'x',
					25 => 'y',
          26 => 'z',
          27 => ' ',
          28 => '.');
	$q = "";

$array = str_split($json['cifrado']);
$casas = $json['numero_casas'];

for($y = 0; $y < count($array); $y++){
  if($letras[$array[$y]] == 27 || $letras[$array[$y]] == 28){
    $x = ($letras[$array[$y]]);
  }else{
    $x = ($letras[$array[$y]] - $casas);
  }
  $q .= $letraT[$x];
}

$json['decifrado'] = $q;

echo $json['decifrado'];
echo '<br>';

file_put_contents('answer.json', json_encode($json)); // reescreve o arquivo json 

$codificada = sha1($json['decifrado']);
echo "<br><br>Resultado da codificação usando sha1: " . $codificada;
$json['resumo_criptografico'] = $codificada;

file_put_contents('answer.json', json_encode($json)); // reescreve o arquivo json 

?>