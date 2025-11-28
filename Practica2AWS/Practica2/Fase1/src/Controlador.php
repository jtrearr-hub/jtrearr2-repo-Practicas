<?php
// src/Controlador.php
declare(strict_types=1);

namespace Src;

class Controlador
{
    public static function main(): void
    {
        session_start();

        $datos = Datos::getAll(); // provincias, sedes, departamentos

        $errors = [];
        $input = [
            'nombre' => '',
            'apellidos' => '',
            'dni' => '',
            'email' => '',
            'telefono' => '',
            'fecha_alta' => '',
            'provincia' => '',
            'sede' => '',
            'departamento' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitizar/limpiar entradas
            foreach ($input as $k => $_) {
                $value = $_POST[$k] ?? '';
                $input[$k] = Validaciones::sanitizar($value);
            }

            // Validaciones
            if (!Validaciones::validarNombre($input['nombre'])) {
                $errors['nombre'] = 'El nombre es obligatorio y debe tener al menos 2 caracteres.';
            }
            if (!Validaciones::validarNombre($input['apellidos'])) {
                $errors['apellidos'] = 'Los apellidos son obligatorios y deben tener al menos 2 caracteres.';
            }
            if (!Validaciones::validarDni($input['dni'])) {
                $errors['dni'] = 'DNI inválido. Formato: 8 dígitos y letra (ej. 12345678Z).';
            }
            if (!Validaciones::validarEmail($input['email'])) {
                $errors['email'] = 'Email inválido.';
            }
            if (!Validaciones::validarTelefono($input['telefono'])) {
                $errors['telefono'] = 'Teléfono inválido. Debe contener entre 7 y 15 dígitos (puede incluir +).';
            }
            if (!Validaciones::validarFechaAlta($input['fecha_alta'])) {
                $errors['fecha_alta'] = 'Fecha de alta inválida o en el futuro.';
            }
            if (!in_array($input['provincia'], array_keys($datos['provincias']), true)) {
                $errors['provincia'] = 'Provincia no válida.';
            }
            if (!in_array($input['sede'], array_keys($datos['sedes']), true)) {
                $errors['sede'] = 'Sede no válida.';
            }
            if (!in_array($input['departamento'], array_keys($datos['departamentos']), true)) {
                $errors['departamento'] = 'Departamento no válido.';
            }

            // Si no hay errores, simulamos el alta mostrando resumen
            if (empty($errors)) {
                // En la Fase IAW 1 no se persiste en BD; mostramos resumen
                echo Vistas::renderHeader('Resumen - Alta empleado');
                echo Vistas::renderSummary($input, $datos);
                echo Vistas::renderFooter();
                exit;
            }
        }

        // Mostrar formulario (con sticky values y mensajes de error)
        echo Vistas::renderHeader('Alta de empleado');
        echo Vistas::renderForm($input, $errors, $datos);
        echo Vistas::renderFooter();
    }
}
