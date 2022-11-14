<?php
// app/helpers.php
// Modifica tu archivo composer.json para agregar la carga del archivo con la clave files dentro de la sección autoload de la siguiente manera:
// ],
// "files": [
//     "app/helpers.php"
// ],
// ---
// ejecutar composer dump-autoload

//
if (!function_exists('fncGlob_Files')) {
    // TODO: recursividad en directorios
function fncGlob_Files($folder, $name='*', $ext='jpg,jpeg,png', $limit=0, $sec=0, $recur=false){
    // dump([$folder, $name, $ext, $folder.$name.".".$ext]);
    if( !is_dir( $folder ) ) {
        die ( "Invalid directory.\n\n" );
    }

    // $FILES = glob($folder.$name."."."{$ext}", GLOB_BRACE);
    $FILES = glob($folder.$name.".".$ext);
    // dump($FILES);
    $set_limit    = 0;

    foreach($FILES as $key => $file) {

        if( $set_limit && ($set_limit == $limit) )    break;

        if( filemtime( $file ) > $sec ){

            $FILE_LIST[$key]['path']    = substr( $file, 0, ( strrpos( $file, "\\" ) +1 ) );
            $array = explode(".", substr( $file, ( strrpos( $file, "\\" ) +1 ) ));
            $FILE_LIST[$key]['name']    = $array[0];
            $FILE_LIST[$key]['ext']    = $array[1];
            $FILE_LIST[$key]['filename']    = $file;

            // $FILE_LIST[$key]['name']    = substr( $file, ( strrpos( $file, "\\" ) +1 ) );
            $FILE_LIST[$key]['size']    = filesize( $file );
            $FILE_LIST[$key]['date']    = date('Y-m-d G:i:s', filemtime( $file ) );

            if($set_limit>0){
                $set_limit++;
            }
        }

    }
    if(!empty($FILE_LIST)){
        return $FILE_LIST;
    } else {
        die( "No files found!\n\n" );
    }
}

// So....

// $folder = "c:\temp";
// $name   = "my_videos";
// $ext    = "flv,mp4"; // flash video files
// $limit  = 2; // 0 = sin límite
// $sec    = "7200"; // files older than 2 hours, 0 = sin límite

// print_r(glob_files($folder, $name, $ext, $limit, $sec));

// Would return:

// Array
// (
//     [0] => Array
//         (
//             [path] => c:\temp\my_videos\
//             [name] => fluffy_bunnies.flv
//             [size] => 21160480
//             [date] => 2007-10-30 16:48:05
//         )

//     [1] => Array
//         (
//             [path] => c:\temp\my_videos\
//             [name] => synergymx.com.flv
//             [size] => 14522744
//             [date] => 2007-10-25 15:34:45
//         )
// )
}

if (!function_exists('current_user')) {
    function current_user()
    {
        return auth()->user();
    }
}

if (!function_exists('images')) {
    function images($path = '')
    {
        return asset("/images/$path");
    }
}

if (!function_exists('productImagePath')) {
    function productImagePath($image_name)
    {
        return public_path('images/products/' . $image_name);
    }
}

if (!function_exists('setActive')) {
    function setActive($route = 'home')
    {
        return request()->routeIs($route) ? 'active' : '';
    }
}

if (!function_exists('changeDateFormate')) {
    function changeDateFormate($date, $date_format)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);
    }
}

/**
 * helpers de nombres y correos
 *
 * @param [string] $nombre
 * @return string (iniciales el nombre)
 */

if (!function_exists('getIniciales')) {
    function getIniciales($nombre)
    {
        $name = '';
        $explode = explode(' ', $nombre);
        foreach ($explode as $x) {
            $name .= $x[0];
        }
        return $name;
    }
}

if (!function_exists('limpiar_caracteres')) {
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

    if (!function_exists('fncHexa_Rgb')) {
        function fncHexa_Rgb($hexa)
        {
            [$r, $g, $b] = \sscanf($hexa, '#%02x%02x%02x');
            return "rgb($r,$g,$b)";
        }
    }
}
