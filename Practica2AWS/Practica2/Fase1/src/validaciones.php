<?php
// src/validaciones.php
declare(strict_types=1);

namespace Src;

class Validaciones
{
    public static function sanitizar(string $s): string
    {
        $s = trim($s);
        $s = strip_tags($s);
        $s = htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        return $s;
    }

    public static function validarNombre(string $s): bool
    {
        return strlen($s) >= 2;
    }

    public static function validarDni(string $dni): bool
    {
        // Normaliza (quita espacios, mayúsculas)
        $dni = strtoupper(str_replace([' ', '-'], '', $dni));
        if (!preg_match('/^(\d{7,8})([A-Z])$/', $dni, $m)) return false;
        $num = (int)$m[1];
        $letra = $m[2];
        $tabla = 'TRWAGMYFPDXBNJZSQVHLCKE';
        $expected = $tabla[$num % 23];
        return $expected === $letra;
    }

    public static function validarEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validarTelefono(string $tel): bool
    {
        $tel = preg_replace('/[^\d\+]/', '', $tel);
        $len = strlen(preg_replace('/[^\d]/', '', $tel));
        return $len >= 7 && $len <= 15;
    }

    public static function validarFechaAlta(string $fecha): bool
    {
        if (empty($fecha)) return false;
        $d = \DateTime::createFromFormat('Y-m-d', $fecha);
        if (!$d) return false;
        $d->setTime(0,0,0);
        $hoy = new \DateTime('today');
        return $d <= $hoy;
    }
}
