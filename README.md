# jtrearr2-repo-Practicas

🧩 Mini MVC en PHP — Formulario con Validación y Vistas

Este proyecto implementa una arquitectura MVC simplificada en PHP sin frameworks.
Su objetivo es demostrar buenas prácticas: separación de responsabilidades, autocarga, validación, sanitización y vistas limpias.

📁 Estructura del Proyecto
/public
    index.php
/src
    Controlador.php
    Datos.php
    Validaciones.php
    Vistas.php

🚀 1. public/index.php — Punto de Entrada

Este archivo funciona como Controlador Frontal: es el único accesible directamente por el usuario.

¿Qué hace?
Elemento	Propósito
declare(strict_types=1);	Activa el tipado estricto en PHP.
Autocarga PSR-4	Usa spl_autoload_register para cargar clases automáticamente. Convierte el namespace Src\ al directorio ../src/.
use Src\Controlador;	Importa la clase orquestadora.
Controlador::main();	Cede la ejecución al controlador principal.

El archivo permanece minimalista y se limita a iniciar la aplicación.

🧠 2. src/Controlador.php — El Orquestador

Esta clase decide qué hacer: mostrar formulario, procesar datos, o mostrar el resumen.

Flujo de ejecución
Paso	Descripción
Inicialización	Arranca la sesión y obtiene listas estáticas desde Datos::getAll().
Si es POST	Procesa el formulario.
Sanitización	Aplica Validaciones::sanitizar() a cada campo recibido.
Validación	Ejecuta reglas específicas (DNI, email, fecha, etc.). Guarda errores en $errors.
Éxito	Si no hay errores, muestra el resumen con Vistas::renderSummary() y termina con exit.
Si es GET o POST con errores	Renderiza el formulario mediante Vistas::renderForm(), usando valores previos y mensajes de error.
Composición de página	Envoltorio HTML estándar con renderHeader() y renderFooter().

📦 3. src/Datos.php — Datos Estáticos (Modelo)

Proporciona listas fijas utilizadas tanto en la interfaz como en validaciones.

¿Qué contiene?
Elemento	Propósito
getAll()	Devuelve arrays con listas de provincias, sedes, departamentos, etc.
Estructura	Arrays asociativos: clave interna → texto mostrado.
Uso	Se emplean para rellenar <select> y para verificar que la selección del usuario sea válida.

🔐 4. src/Validaciones.php — Reglas de Negocio y Seguridad

Centraliza todo lo necesario para sanear y verificar los datos del usuario.

Métodos principales
Método	Función
sanitizar()	trim + strip_tags + htmlspecialchars (defensa XSS).
validarNombre()	Mínimo 2 caracteres.
validarDni()	Comprueba formato (8 dígitos + letra) y letra mediante módulo 23.
validarEmail()	Usa filter_var.
validarTelefono()	Deja solo dígitos y +; exige longitud 7–15.
validarFechaAlta()	Verifica formato Y-m-d y fecha no futura.

🎨 5. src/Vistas.php — Capa de Presentación (HTML + CSS)

Genera la interfaz manteniendo el código PHP separado del marcado.

Funciones clave
Método	Función
renderHeader() / renderFooter()	Crea la estructura HTML base (DOCTYPE, <head>, estilos).
pintarSelect()	Construye un <select> con opción preseleccionada (sticky).
renderForm()	Renderiza el formulario usando valores previos y mensajes de error.
renderSummary()	Muestra la página de resumen con datos validados y etiquetas amigables.
