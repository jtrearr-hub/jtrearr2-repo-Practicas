<?php
// public/index.php
declare(strict_types=1);

// Autocarga de clases (PSR-4 simple)
spl_autoload_register(function ($class) {
    // Prefijo del namespace base
    $prefix = 'Src\\';
    // Directorio base para el prefijo
    $base_dir = __DIR__ . '/../src/';

    // ¿La clase usa el prefijo?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Obtener el nombre relativo de la clase
    $relative_class = substr($class, $len);

    // Reemplazar el prefijo de namespace con el directorio base,
    // reemplazar separadores de namespace con separadores de directorio
    // y añadir .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Si el archivo existe, requerirlo
    if (file_exists($file)) {
        require $file;
    }
});

use Src\Controlador;

// Delegar la lógica al controlador principal
Controlador::main();
