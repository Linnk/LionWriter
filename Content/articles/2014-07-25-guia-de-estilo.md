title: Guía de estilo de codificación
author: Juan I. Benavides
email: linnk87@gmail.com
date: 2014-07-25
keywords: lorem, ipsum
epilogue: La objetivo de esta guía es la de reducir la dificultad cuando se lee código de diferentes autores.

# Guía de estilo de codificación

Esta guía está inspirada en el estándar de codificación básica [PSR-0][] y [PSR-1][].

La objetivo de esta guía es la de reducir la dificultad cuando se lee código de diferentes autores. Lo realiza mediante la enumeración de una serie de reglas común y expresiones sobre cómo dar formato al código PHP.

En el documento original se usa el RFC 2119 para el uso de las palabras MUST, MUST NOT, SHOULD, SOULD NOT y MAY. Para que la traducción sea lo más fiel posible, se traducira siempre MUST como el verbo deber en presente (DEBE, DEBEN), SHOULD como el verbo deber en condicional (DEBERÍA, DEBERÍAN) y el verbo MAY como el verbo PODER.

[RFC 2119]: http://www.ietf.org/rfc/rfc2119.txt
[PSR-0]: https://github.com/php-fig/fig-standards/blob/master/accepted/es/PSR-0.md
[PSR-1]: https://github.com/php-fig/fig-standards/blob/master/accepted/es/PSR-1-basic-coding-standard.md


## 1. Visión general

- Los archivos DEBEN utilizar solamente las etiquetas `<?php`; no `<?` y tampoco `<?=`.

- Los archivos DEBEN emplear solamente la codificación UTF-8 sin BOM para el código PHP.

- Los archivos DEBERÍAN declarar *cualquier* estructura (clases, funciones, constantes, etc,...) o realizar partes de la lógica de negocio (por ejemplo, generar una salida, cambio de configuración ini, etc,...), pero NO DEBERÍAN hacer las dos cosas.

- Los nombres de las clases DEBEN declararse en notación `StudlyCaps`. [^1]

- Los nombres de los métodos DEBEN declararse en notación `camelCase`. [^2]

- Los nombres de las constantes DEBEN declararse en mayúsculas con guiones bajos como separadores `CONSTANTE_DE_CLASE`.

- Los nombres de las variables DEBEN declararse en notación `under_score`. [^3]

- El código DEBE usar tabuladores como indentación, no espacios.

- Un tabulador DEBERÍA representar 4 espacios en el editor de texto.

- NO DEBE haber un límite estricto en la longitud de la línea; el límite DEBE estar en 140 caracteres; las líneas DEBERÍAN tener 120 caracteres o menos.

- DEBE haber una línea en blanco después de la declaración del `namespace`, y DEBE haber una línea en blanco después del bloque de declaraciones `use`.

- Las llaves de apertura de las clases DEBEN ir en la línea siguiente, y las llaves de cierre DEBEN ir en la línea siguiente al cuerpo de la clase.

- Las llaves de apertura de los métodos DEBEN ir en la línea siguiente, y las llaves de cierre DEBEN de ir en la línea siguiente al cuerpo del método.

- Si después de una llave de cierre de un método se declarará otro, DEBE haber un salto de línea *vacío* (sin espacios en blanco ni tabuladores) entre ambos.

- La visibilidad DEBE estar declarada en todas las propiedades y métodos; `abstract` y `final` DEBEN estar declaradas antes de la visibilidad; `static` DEBE estar declarada después de la visibilidad.

- Las palabras clave de las estructuras de control DEBEN tener un espacio después de ellas, las llamadas a los métodos y las funciones NO DEBEN tenerlo.

- Las llaves de apertura y cierre de las estructuras de control DEBEN ir en la línea siguiente al cuerpo.

- Los paréntesis de apertura en las estructuras de control NO DEBEN tener un espacio después de ellos, y los paréntesis de cierre NO DEBEN tener un espacio antes de ellos.

### 1.1. Ejemplo

Este ejemplo incluye algunas de las siguientes reglas a modo de visión general rápida:

```php
<?php
namespace Proveedor\Paquete;

use FooInterfaz;
use BarClase as Bar;
use OtroProveedor\OtroPaquete\BazClase;

class Foo extends Bar implements FooInterfaz
{
	public function funcionDeEjemplo($a, $b = null)
	{
		if ($a === $b)
		{
			bar();
		}
		elseif ($a > $b)
		{
			$foo->bar($arg1);
		}
		else
		{
			BazClase::bar($arg2, $arg3);
		}
	}

	final public static function bar()
	{
		// cuerpo del método
	}
}
```

### 1.2. Efectos secundarios

Un archivo DEBERÍA declarar estructuras (clases, funciones, constantes, etc,...) y no causar efectos secundarios, o DEBERÍA ejecutar partes de la lógica de negocio, pero NO DEBERÍA hacer las dos cosas.

La frase "efectos secundarios" significa: que la ejecución de la lógica de negocio no está directamente relacionado con declarar clases, funciones, constantes, etc, *simplemente la de incluir el archivo*.

"Efectos secundarios" incluyen, pero no se limitan a: generar salidas, uso explícito de `requiere` o `include`, conexiones a servicios externos, modificación de configuraciones iniciales, enviar errores o excepciones, modificar variables globales o estáticas, leer o escribir un archivo, etc.

El siguiente ejemplo muestra un archivo que incluye las dos: declaraciones y efectos secundarios; Un ejemplo de lo que debe evitar:

```php
<?php
// efecto secundario: cambiar configuracion inicial
ini_set('error_reporting', E_ALL);

// efecto secundario: cargar ficheros
include "archivo.php";

// efecto secundario: generar salida
echo "<html>\n";

// declaración
function foo()
{
	// cuerpo de la función
}
```

El siguiente ejemplo es el de un archivo que contiene declaraciones sin efectos secundarios; Un ejemplo que puede seguir:

```php
<?php
// declaración
function foo()
{
	// cuerpo de la función
}

// una declaración condicional *no* es un
// efecto secundario
if (!function_exists('bar'))
{
	function bar()
	{
		// cuerpo de la función
	}
}
```

## 2. General

### 2.1 Archivos

Todos los archivos PHP DEBEN usar el final de línea Unix LF.

Todos los archivos PHP DEBEN terminar con una línea en blanco.

La etiqueta de cierre `?>` DEBE ser omitida en los ficheros que sólo contengan código PHP.

### 2.2. Líneas

NO DEBE haber un límite estricto en la longitud de la línea.

El límite flexible de la línea DEBE estar en 120 caracteres; los correctores de estilo automáticos DEBERÍAN advertir de ésto, pero NO DEBEN producir errores.

Las líneas NO DEBERÍAN ser más largas de 80 caracteres; las líneas más largas de estos 80 caracteres DEBERÍAN dividirse en múltiples líneas de no más de 80 caracteres cada una.

NO DEBE haber carateres en blanco al final de las líneas que no estén vacías.

PUEDE añadirse 1 salto de línea entre bloques de código para mejorar la lectura y para indicar código relacionado, pero NO DEBEN tener carateres en blanco y NO DEBEN haber dos o más saltos de línea juntos.

NO DEBE haber más de una sentencia por línea.

### 2.3. Palabras clave y `true`/`false`/`null`.

Las [Palabras clave][] de PHP DEBEN estar en minúsculas.

Las constantes de PHP `true`, `false` y `null` DEBEN estar en minúsculas.

[Palabras clave]: http://php.net/manual/es/reserved.keywords.php


## 3. Espacio de nombre y declaraciones `use`

Cuando esté presente, DEBE haber una línea en blanco después de la declación del `namespace`.

Cuando estén presentes, todas las declaraciones `use` DEBEN ir después de la declaración del `namespace`.

DEBE haber un `use` por declaración.

DEBE haber una línea en blanco después del bloque de declaraciones `use`.

Por ejemplo:

```php
<?php
namespace Proveedor\Paquete;

use FooClass;
use BarClase as Bar;
use OtroProveedor\OtroPaquete\BazClase;

// ... código PHP adicional ...

```


## 4. Clases, propiedades y métodos

El término "clase" hace referencia a todas las clases, interfaces o traits.

### 4.1. Extensiones e implementaciones

Las palabras clave `extends` e `implements` DEBEN declararse en la misma línea del nombre de la clase.

La llave de apertura de la clase DEBE ir en la línea siguiente; la llave de cierre DEBE ir en la línea siguiente al cuerpo de la clase.

```php
<?php
namespace Proveedor\Paquete;

use FooClase;
use BarClase as Bar;
use OtroProveedor\OtroPaquete\BazClase;

class NombreDeClase extends ClasePadre implements \ArrayAccess, \Countable
{
	// constantes, propiedades, métodos
}
```

La lista de `implements` PUEDE ser dividida en múltiples líneas, donde las líneas subsiguientes serán indentadas una vez. Al hacerlo, el primer elemento de la lista DEBE estar en la línea siguiente, y DEBE haber una sola interfaz por línea.

```php
<?php
namespace Proveedor\Paquete;

use FooClase;
use BarClase as Bar;
use OtroProveedor\OtroPaquete\BazClase;

class NombreDeClase extends ClasePadre implements
	\ArrayAccess,
	\Countable,
	\Serializable
{
	// constantes, propiedades, métodos
}
```

### 4.2. Propiedades

La visibilidad DEBE ser declarada en todas las propiedades.

La palabra clave `var` NO DEBE ser usada para declarar una propiedad.

NO DEBE declararse más de una propiedad por sentencia.

Los nombres de las propiedades DEBERÍAN usar un guión bajo como prefijo para indicar si es protegida y dos guiones bajos para indicar si es privada.

Una declaración de propiedas tendrá el siguiente aspecto.

```php
<?php
namespace Proveedor\Paquete;

class NombreDeClase
{
	public $foo = null;
}
```

### 4.3. Métodos

La visibilidad DEBE ser declarada en todos los métodos.

Los nombres de los métodos DEBERÍAN usar un guión bajo como prefijo para indicar si es protegido y dos guiones bajos para indicar si es privado.

Los nombres de métodos NO DEBEN estar declarados con un espacio después del nombre del método. La llave de apertura DEBE situarse en su propia línea, y la llave de cierre DEBE ir en la línea siguiente al cuerpo del método. NO DEBE haber ningún espacio después del paréntesis de apertura, y NO DEBE haber ningún espacio antes del paréntesis de cierre.

La declaración de un método tendrá el siguiente aspecto. Fíjese en la situación de los paréntesis, las comas, los espacios y las llaves:

```php
<?php
namespace Proveedor\Paquete;

class NombreDeClase
{
	public function fooBarBaz($arg1, &$arg2, $arg3 = [])
	{
		// cuerpo del método
	}
}
```

### 4.4. Argumentos de los métodos

En la lista de argumentos NO DEBE haber un espacio antes de cada coma y DEBE haber un espacio después de cada coma.

Los argumentos con valores por defecto del método DEBEN ir al final de la lista de argumentos.

```php
<?php
namespace Proveedor\Paquete;

class NombreDeClase
{
	public function metodoConNombre($arg1, &$arg2, $arg3 = [])
	{
		// cuerpo del método
	}
}
```

### 4.5. `abstract`, `final`, y `static`

Cuando estén presentes las declaraciones `abstract` y `final`, DEBEN preceder a la declaración de visibilidad.

Cuando esté presente la declaración `static`, DEBE ir después de la declaración de visibilidad.

```php
<?php
namespace Proveedor\Paquete;

abstract class NombreDeClase
{
	protected static $foo;

	abstract protected function zim();

	final public static function bar()
	{
		// cuerpo del método
	}
}
```

### 4.6. Llamadas a métodos y funciones

Cuando se realize una llamada a un método o a una función, NO DEBE haber un espacio entre el nombre del método o la función y el paréntesis de apertura, NO DEBE haber un espacio después del paréntesis de apertura, y NO DEBE haber un espacio antes del paréntesis de cierre. En la lista de argumentos, NO DEBE haber espacio antes de cada coma y DEBE haber un espacio después de cada coma.

```php
<?php
bar();
$foo->bar($arg1);
Foo::bar($arg2, $arg3);
```

La lista de argumentos PUEDE dividirse en múltiples líneas, donde cada una se indenta una vez. Cuando esto suceda, el primer argumento DEBE estar en la línea siguiente, y DEBE haber sólo un argumento por línea.

```php
<?php
$foo->bar(
	$argumento_largo,
	$argumento_mas_largo,
	$argumento_todavia_mas_largo
);
```

## 5. Estructuras de control

Las reglas de estilo para las estructuras de control son las siguientes:

- DEBE haber un espacio después de una palabra clave de estructura de control.
- NO DEBE haber espacios después del paréntesis de apertura.
- NO DEBE haber espacios antes del paréntesis de cierre.
- La llave de apertura DEBE estar en la línea siguiente a la condición.
- El cuerpo de la estructura de control DEBE estar indentado una vez.
- La llave de cierre DEBE estar en la línea siguiente al final del cuerpo.

El cuerpo de cada estructura DEBE estar encerrado entre llaves. Esto estandariza el aspecto de las estructuras y reduce la probabilidad de añadir errores como nuevas líneas que se añaden al cuerpo de la estructura.

Cada estructura DEBERÍA estar separada por un salto de línea de otras estructuras o bloques de código, a menos que sea al principio o final del bloque en el que está contenida.


### 5.1. `if`, `elseif`, `else`

Una estructura `if` tendrá el siguiente aspecto. Fíjese en el lugar de los paréntesis, los espacios y las llaves; y que `else` y `elseif` están en la misma línea que las llaves de cierre del cuerpo anterior.

```php
<?php
if ($expr1)
{
	// if cuerpo
}
elseif ($expr2)
{
	// elseif cuerpo
}
else
{
	// else cuerpo;
}

// Esto está bien
if ($variable = Class::function())
{
	statement;
}

// Esto es aun mejor
$variable = Class::function();
if ($variable)
{
	statement;
}
```

La palabra clave `elseif` DEBERÍA ser usada en lugar de `else if` de forma que todas las palabras clave de la estructura estén compuestas por palabras de un solo término.


### 5.2. `switch`, `case`

Una estructura `switch` tendrá el siguiente aspecto. Fíjese en el lugar donde están los paréntesis, los espacios y las llaves. La palabra clave `case` DEBE estar indentada una vez respecto al `switch` y la palabra clave `break` o cualquier otra palabra clave de finalización DEBE estar indentadas al mismo nivel que el cuerpo del `case`. DEBE haber un comentario como `// no break` cuando hay `case` en cascada no vacío.

```php
<?php
switch ($expr)
{
	case 0:
		echo 'Primer case con break';
		break;
	case 1:
		echo 'Segundo case sin break en cascada';
		// no break
	case 2:
	case 3:
	case 4:
		echo 'Tercer case; con return en vez de break';
		return;
	default:
		echo 'Case por defecto';
		break;
}
```


### 5.3. `while`, `do while`

Una instrucción `while` tendrá el siguiente aspecto. Fíjese en el lugar donde están los paréntesis, los espacios y las llaves.

```php
<?php
while ($expr)
{
	// cuerpo de la estructura
}
```

Igualmente, una sentencia `do while` tendrá el siguiente aspecto. Fíjese en el lugar donde están los paréntesis, los espacios y las llaves.

```php
<?php
do
{
	// cuerpo de la estructura;
}
while ($expr);
```

### 5.4. `for`

Una sentencia `for` tendrá el siguiente aspecto. Fíjese en el lugar donde aparecen los paréntesis, los espacios y las llaves.

```php
<?php
for ($i = 0; $i < 10; $i++)
{
	// cuerpo del for
}
```

### 5.5. `foreach`

Un sentencia `foreach` tendrá el siguiente aspecto. Fíjese en el lugar donde aparecen los paréntesis, los espacios y las llaves.

```php
<?php
foreach ($iterable as $key => $value)
{
	// cuerpo foreach
}
```

### 5.6. `try`, `catch`

Un bloque `try catch` tendrá el siguiente aspecto. Fíjese en el lugar donde aparecen los paréntesis, los espacios y los llaves.


```php
<?php
try
{
	// cuerpo del try
}
catch (PrimerTipoDeExcepcion $e)
{
	// cuerpo catch
}
catch (OtroTipoDeExcepcion $e)
{
	// cuerpo catch
}
```

### 5.7. Operador ternario

Una sentencia sólo puede utilizar un operador ternario a la vez, pero NO DEBE utilizar más. La parte de la sentencia correspondiente al operador ternario NO DEBERÍA estar encerrada entre paréntesis a menos que sea necesario.

```php
$variable = isset($lista['variable']) ? $lista['variable'] : true;
```

Antes y después de los caractéres `?` y `:` DEBE ir un caracter de espacio en blanco. 

La condición NO DEBE ir encerrada entre paréntesis.

## 6. Funciones anónimas (closures)

Las «closures» DEBEN declararse con un espacio después de la palabra clave `function`, y un espacio antes y después de la parabra clave `use`.

La llave de apertura DEBE ir en la misma línea, y la llave de cierre DEBE ir en la línea siguiente al final del cuerpo.

NO DEBE haber un espacio después del paréntesis de apertura de la lista de argumentos o la lista de variables, y NO DEBE haber un espacio antes del paréntesis de cierre de la lista de argumentos o la lista de variables.

En la lista de argumentos y la lista variables, NO DEBE haber un espacio antes de cada coma, y DEBE QUE haber un espacio después de cada coma.

Los argumentos de las closures con valores por defecto, DEBEN ir al final de la lista de argumentos.

Una declaración de una closure tendrá el siguiente aspecto. Fíjese en el lugar donde aparecen los paréntesis, las comas, los espacios y las llaves.

```php
<?php
$closure = function ($arg1, $arg2)
{
	// cuerpo
};

$closure_con_variables = function ($arg1, $arg2) use ($var1, $var2)
{
	// cuerpo
};
```

### 6.1 Arreglos

Los arreglos que sean muy largos DEBERÍAN ir en diferentes líneas, una por cada argumento. El paréntesis de apertura debe ir sin espacio entre este y la palabra clave `array`. El paréntesis de cierre debe ir en otra línea. El último elemento de cada coleccoçpm NO DEBERÍA llevar una coma.

```php
<?php
$conditions = array(
	'User.id' => 1,
	'OR' => array(
		'User.name' => 'hello',
		'User.name' => 'world'
	)
);
```

Si el array multi-línea va como argumento de una función, este puede seguir siendo multi línea, pero los parámetros NO DEBEN ser multi-línea también.

```php
<?php
$this->User->find('first', array(
	'fields' => array(
		'User.id',
		'User.name',
		'User.created',
	)
	'conditions' => array(
		'User.id' => 1,
		'OR' => array(
			'User.name' => 'hello',
			'User.name' => 'world'
		)
	)
), $variable, $utlimo_parametros);
```

## 7. Conclusión

Hay muchos elementos de estilo y prácticas omitidas intencionadamente en esta guía. Estos incluyen pero no se limitan a:

- Declaraciones de variables y constantes globales.

- Declaración de funciones.

- Operadores y asignaciones.

- Alineación entre líneas.

- Comentarios y bloques de documentación.

- Prefijos y sufijos en nombres de clases.

- Buenas prácticas.

Futuras recomendaciones PUEDEN revisar y extender esta guía para hacer frente a estos u otros elementos de estilo y práctica.

## Documentación — PHPDocs



## Notas

[^1] `StudlyCaps`, es una forma de notación de texto que sigue el patrón de palabras en minúscula sin espacios y con la primera letra de cada palabra en mayúscula.

[^2] `camelCase`, es una forma de notación de texto que sigue el patrón de palabras en minúscula sin espacios y con la primera letra de cada palabra en mayúsculas exceptuando la primera palabra.

[^3] `under_score`, es una forma de notación de texto que sigue el patrón de palabras en minúsculas sin espacios y con guiones bajos para separar cada palabra.