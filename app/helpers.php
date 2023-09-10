<?php 

// Form

if(! function_exists('isChecked') )
{
    function isChecked(bool $bool, $default = '')
    {
        return $bool ? 'checked' : $default;
    }
}

if(! function_exists('isSelected') )
{
    function isSelected(bool $bool, $default = '')
    {
        return $bool ? 'selected' : $default;
    }
}

if(! function_exists('isRequired') )
{
    function isRequired(bool $bool, $default = '')
    {
        return $bool ? 'required' : $default;
    }
}

// Misc

if(! function_exists('nombreMesNumero') )
{
    function nombreMesNumero(int $index)
    {
        static $nombres_meses = [
            1 => 'enero',
            2 => 'febrero',
            3 => 'marzo',
            4 => 'abril',
            5 => 'mayo',
            6 => 'junio',
            7 => 'julio',
            8 => 'agosto',
            9 => 'septiembre',
            10 => 'octubre',
            11 => 'noviembre',
            12 => 'diciembre',
        ];

        return isset( $nombres_meses[ $index ] ) ? $nombres_meses[ $index ] : false;
    }
}

if(! function_exists('nombreDiaSemana') )
{
    function nombreDiaSemana(int $index)
    {
        static $nombres_meses = [
            0 => 'domingo',
            1 => 'lunes',
            2 => 'martes',
            3 => 'miercoles',
            4 => 'jueves',
            5 => 'viernes',
            6 => 'sábado',
        ];

        return isset( $nombres_meses[ $index ] ) ? $nombres_meses[ $index ] : false;
    }
}

if(! function_exists('convertirLinks') )
{
    function convertirLinks(string $texto)
    {
        $url_pattern = '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i';   
        return preg_replace($url_pattern, '<a href="$0" target="_blank">$0</a>', $texto);
    }
}
