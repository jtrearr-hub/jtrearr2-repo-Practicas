<?php
// src/datos.php
declare(strict_types=1);

namespace Src;

class Datos
{
    public static function getAll(): array
    {
        // array key => label (keys serán value de los selects)
        $provincias = [
            'alava' => 'Álava',
            'albacete' => 'Albacete',
            'alicante' => 'Alicante',
            'almeria' => 'Almería',
            'asturias' => 'Asturias',
            'avila' => 'Ávila',
            'badajoz' => 'Badajoz',
            'barcelona' => 'Barcelona',
            'burgos' => 'Burgos',
            'caceres' => 'Cáceres',
            'cadiz' => 'Cádiz',
            'cantabria' => 'Cantabria',
            'castellon' => 'Castellón',
            'ciudad-real' => 'Ciudad Real',
            'cordoba' => 'Córdoba',
            'cuenca' => 'Cuenca',
            'girona' => 'Girona',
            'granada' => 'Granada',
            'guadalajara' => 'Guadalajara',
            'guipuzcoa' => 'Guipúzcoa',
            'huelva' => 'Huelva',
            'huesca' => 'Huesca',
            'islas-baleares' => 'Islas Baleares',
            'jaen' => 'Jaén',
            'a-coruna' => 'A Coruña',
            'la-rioja' => 'La Rioja',
            'las-palmas' => 'Las Palmas',
            'leon' => 'León',
            'lleida' => 'Lleida',
            'lugo' => 'Lugo',
            'madrid' => 'Madrid',
            'malaga' => 'Málaga',
            'murcia' => 'Murcia',
            'navarra' => 'Navarra',
            'ourense' => 'Ourense',
            'palencia' => 'Palencia',
            'pontevedra' => 'Pontevedra',
            'salamanca' => 'Salamanca',
            'santa-cruz-de-tenerife' => 'Santa Cruz de Tenerife',
            'segovia' => 'Segovia',
            'sevilla' => 'Sevilla',
            'soria' => 'Soria',
            'tarragona' => 'Tarragona',
            'teruel' => 'Teruel',
            'toledo' => 'Toledo',
            'valencia' => 'Valencia',
            'valladolid' => 'Valladolid',
            'vizcaya' => 'Vizcaya',
            'zamora' => 'Zamora',
            'zaragoza' => 'Zaragoza'
        ];

        // Ejemplo de sedes (key -> label). Puedes extender estas listas.
        $sedes = [
            'madrid' => 'Madrid - Central',
            'barcelona' => 'Barcelona - Oficina',
            'valencia' => 'Valencia - Delegación',
            'sevilla' => 'Sevilla - Delegación',
            'bilbao' => 'Bilbao - Delegación'
        ];

        // Ejemplo departamentos
        $departamentos = [
            'marketing' => 'Marketing',
            'ventas' => 'Ventas',
            'finanzas' => 'Finanzas',
            'rrhh' => 'Recursos Humanos',
            'it' => 'Tecnología / IT',
            'logistica' => 'Logística'
        ];

        return [
            'provincias' => $provincias,
            'sedes' => $sedes,
            'departamentos' => $departamentos
        ];
    }
}
