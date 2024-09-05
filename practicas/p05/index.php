<?php

// Definición de las variables
$_myvar = "\$_myvar VALIDA, porque en PHP las variables comienzan con $,
seguido de un guion bajo y luego cualquier combinación de letras,
guiones o números.";

$_7var = "\$_7var VALIDA, porque en PHP las variables comienzan con $, 
seguido de un guion bajo y luego cualquier combinación de letras, 
guiones o números.";

$myvar0 = "myvar es INVÁLIDA, en PHP requiere $ para
ser válida.";

$myvar = "\$myvar VÁLIDA, porque en PHP las variables comienzan con $,
seguido de una letra y luego cualquier combinación de letras, 
guiones o números.";

$var7 = "\$var7 VÁLIDA, porque en PHP las variables comienzan con $, 
seguido de una letra y luego cualquier combinación de letras,
guiones o números.";

$_element1 = "\$_element1 VÁLIDA, porque en PHP las variables comienzan con $,
seguido de un guion bajo y luego cualquier combinación de letras, 
guiones o números.";

$house = "INVÁLIDA, la variable \$house*5, porque en PHP las 
variables no pueden tener símbolos especiales como *.";

// Impresión de las variables
echo '<h1>Ejercicio 1</h1>';
echo '<br>';
echo $_myvar;
echo '<br>';
echo $_7var;
echo '<br>';
echo $myvar0;
echo '<br>';
echo $myvar;
echo '<br>';
echo $var7;
echo '<br>';
echo $_element1;
echo '<br>';
echo $house;
/////////////////////////////////////////////////////////////////////////////////////
echo '<br>';
echo '<h1>Ejercicio 2</h1>'; ////Para poner Titulos, subtitulos
$a = "ManejadorSQL";
$b = 'MySQL';
$c = &$a; 

$oracion = "Valor de \$a es  $a";
$oracion2 = "Valor de \$b es $b";
$oracion3 = "Valor de \$c es $c"; 

echo $oracion.'<br>';
echo $oracion2.'<br>';
echo $oracion3.'<br>';
echo '<br>';
echo '<br>';
///////////////////////////////////////////////////////////////////////////////////////////////

$a = "PHP server";
$b = &$a;

$oracion4 = "Valor de \$a es $a";
$oracion5 = "Valor de \$b es $b"; 

echo $oracion4.'<br>';
echo $oracion5.'<br>';

echo '<h4>En la segunda asignacion de valores $a cambia a PHP server y $b 
hace referencia a la variable $a, por lo que la salida de los valores cambia 
a lo asignado </h4>';
/////////////////////////////////////////////////////////////////////////////////////////
echo '<h1>Ejercicio 3</h1>';
//
$a = "PHP5";
$oracion6 = "Valor de \$a es $a";
echo $oracion6;
echo '<br>';

$z[] = &$a;
echo $z[0]; //índice donde se almacenó la referencia a $a
echo '<br>';

//
$b = "5a version de PHP";
echo $b;
echo '<br>';

$c = $b * 10; // PHP convertirá la parte numérica inicial de $b a un número 
echo $c;  // Esto imprimirá 50, ya que PHP convierte "5a version de PHP" a 5 y lo multiplica por 10.
echo '<br>';

//

$a = "PHP5";
$b = " y MySQL";

$a .= $b; // Concatenación de cadenas
echo $a;  
echo '<br>';

//
$b = "5a version de PHP";
$c = $b * 10;  // $c será 50, ya que PHP convierte "5a version de PHP" a 5

$b *= $c;  // $b se convierte en 250 (5 * 50)
echo $c;  // Imprime 50

// 
$z[0] = "MySQL";
print_r($z);  // Imprime el contenido del array $z

//////////////////////////////////////////////////////////////////////////////
echo '<h1>Ejercicio 4</h1>';

// Inicialización de variables
$GLOBALS['a'] = "PHP5";
$GLOBALS['oracion6'] = "Valor de \$a es {$GLOBALS['a']}";
echo $GLOBALS['oracion6'];
echo '<br>';

$GLOBALS['z'][] = &$GLOBALS['a'];
echo $GLOBALS['z'][0];  // Imprime el valor en el índice 0 del array $z
echo '<br>';

// Asignación de una nueva cadena
$GLOBALS['b'] = "5a version de PHP";
echo $GLOBALS['b'];
echo '<br>';
 
// Operación de multiplicación
$GLOBALS['c'] = $GLOBALS['b'] * 10;
echo $GLOBALS['c'];  // Imprime el valor de $c
echo '<br>';

// Concatenación
$GLOBALS['a'] .= " y MySQL";
echo $GLOBALS['a'];  // Imprime el nuevo valor de $a
echo '<br>';

// Multiplicación y asignación
$GLOBALS['b'] = "5a version de PHP";
$GLOBALS['c'] = $GLOBALS['b'] * 10;
$GLOBALS['b'] *= $GLOBALS['c'];
echo $GLOBALS['c'];  // Imprime el valor de $c
echo '<br>';

// Actualización del array $z
$GLOBALS['z'][0] = "MySQL";
print_r($GLOBALS['z']);  // Imprime el contenido del array $z


//////////////////////////////////////////////////////////////////////////////
echo '<h1>Ejercicio 5</h1>';

$a = "7 personas";
$b = (integer) $a;
$a = "9E3";
$c = (double) $a;

echo "\$a = " . $a;  
echo '<br>';
echo "\$b = " . $b; 
echo '<br>';
echo "\$c = " . $c; 
echo '<br>'; 


////////////////////////////////////////////////////////////////////////////////
echo '<h1>Ejercicio 6</h1>';
$a = "0";
$b = "TRUE";
$c = FALSE;
$d = ($a OR $b);
$e = ($a AND $c);
$f = ($a XOR $b);


var_dump($a); 
var_dump($b); 
var_dump($c); 
var_dump($d); 
var_dump($e); 
var_dump($f); 


//////////////////////////////////////////////////////////////////////////////
echo '<h1>Ejercicio 7</h1>';
// a. La versión de Apache y PHP
echo "Versión de PHP: " . phpversion() . "\n";
echo "Versión de Apache: " . $_SERVER['SERVER_SOFTWARE'] . "\n";

// b. El nombre del sistema operativo (servidor)
echo "Sistema Operativo del Servidor: " . PHP_OS . "\n";

// c. El idioma del navegador (cliente)
if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    echo "Idioma del Navegador: " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "\n";
} else {
    echo "Idioma del Navegador no disponible\n";
}