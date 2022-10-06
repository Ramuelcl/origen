<?php
// app/helpers.php
// Modifica tu archivo composer.json para agregar la carga del archivo con la clave files dentro de la sección autoload de la siguiente manera:
// ],
// "files": [
//     "app/helpers.php"
// ],
if (!function_exists('current_user')) {
    function current_user()
    {
        return auth()->user();
    }
}
function images($path = '')
{
    return asset("/images/$path");
}

function productImagePath($image_name)
{
    return public_path('images/products/' . $image_name);
}
if (!function_exists('setActive')) {
    function setActive($route = 'home')
    {
        return request()->routeIs($route) ? 'active' : '';
    }
}
function changeDateFormate($date, $date_format)
{
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);
}

/**
 * helpers de nombres y correos
 *
 * @param [string] $nombre
 * @return string (iniciales el nombre)
 */

function getIniciales($nombre)
{
    $name = '';
    $explode = explode(' ', $nombre);
    foreach ($explode as $x) {
        $name .= $x[0];
    }
    return $name;
}

function limpiar_caracteres($string)
{
    //función para limpiar strings
    $string = trim($string);

    $string = str_replace(['á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'], ['a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'], $string);

    $string = str_replace(['é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'], ['e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'], $string);

    $string = str_replace(['í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'], ['i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'], $string);

    $string = str_replace(['ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'], ['o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'], $string);

    $string = str_replace(['ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'], ['u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'], $string);

    $string = str_replace(['ñ', 'Ñ', 'ç', 'Ç'], ['n', 'N', 'c', 'C'], $string);

    //Esta parte se encarga de eliminar cualquier caracter extraño
    $string = str_replace(['|', '!', '', '·', "$", '%', '&', '/', '(', ')', '?', "'", '¡', '¿', '[', '^', '<code>', ']', '+', '}', '{', '¨', '´', '>', '< ', ';', ',', ':', ' '], '', $string);

    return $string;
}
