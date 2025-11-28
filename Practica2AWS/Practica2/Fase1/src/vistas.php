<?php
// src/vistas.php
declare(strict_types=1);

namespace Src;

class Vistas
{
    public static function renderHeader(string $title = 'App'): string
    {
        return <<<HTML
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>{$title}</title>
  <style>
    :root{
      --bg: #f5f7fb;
      --card: #ffffff;
      --muted: #6b7280;
      --text: #0f172a;
      --accent: #0ea5a4;
      --accent-600: #059e9c;
      --danger: #dc2626;
      --success: #16a34a;
      --border: #e6edf2;
      --radius: 12px;
      --gap: 16px;
      --maxw: 980px;
    }

    *{box-sizing:border-box}
    body {
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
      background: linear-gradient(180deg, var(--bg), #eef6f8 1200px);
      color: var(--text);
      margin: 0;
      padding: 24px;
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      line-height:1.4;
    }

    .container {
      max-width: var(--maxw);
      margin: 0 auto;
      background: transparent;
      padding: 8px;
    }

    header.page-head {
      margin-bottom: 18px;
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap: 12px;
    }
    header.page-head h1 {
      font-size: 1.25rem;
      margin: 0;
      letter-spacing: -0.2px;
    }
    header.page-head p {
      margin: 0;
      color: var(--muted);
      font-size: .92rem;
    }

    .card {
      background: var(--card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 18px;
      box-shadow: 0 6px 18px rgba(16,24,40,0.04);
    }

    form .grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: var(--gap);
    }

    @media (max-width:760px){
      form .grid { grid-template-columns: 1fr; }
    }

    .form-row { margin-bottom: 12px; }
    label {
      display:block;
      font-weight: 600;
      margin-bottom: 6px;
      color: #0b1220;
      font-size: .95rem;
    }

    input[type="text"],
    input[type="email"],
    input[type="date"],
    select {
      width:100%;
      padding: 10px 12px;
      border-radius: 10px;
      border: 1px solid var(--border);
      background: linear-gradient(180deg,#fff,#fbfeff);
      font-size: .97rem;
      color: var(--text);
      transition: box-shadow .15s, border-color .12s, transform .06s;
      outline: none;
    }

    input::placeholder { color: #9aa4ad; }

    input:focus, select:focus {
      border-color: var(--accent);
      box-shadow: 0 6px 18px rgba(14,165,164,0.12);
      transform: translateY(-1px);
    }

    .error { color: var(--danger); font-size: .92rem; margin-top:6px; }

    .hint { color: var(--muted); font-size: .88rem; margin-top:6px; }

    .actions {
      display:flex;
      gap: 12px;
      align-items:center;
      margin-top: 14px;
      flex-wrap:wrap;
    }

    .btn {
      display:inline-flex;
      align-items:center;
      gap:8px;
      padding: 10px 14px;
      border-radius: 10px;
      border: none;
      cursor: pointer;
      font-weight: 600;
      font-size: .98rem;
    }

    .btn-primary {
      background: linear-gradient(180deg,var(--accent), var(--accent-600));
      color: white;
      box-shadow: 0 8px 20px rgba(14,165,164,0.18);
    }
    .btn-primary:hover { transform: translateY(-2px); }

    .btn-ghost {
      background: transparent;
      border: 1px solid var(--border);
      color: var(--text);
    }

    .summary {
      border-radius: 12px;
      padding: 16px;
      border: 1px solid #dbefea;
      background: linear-gradient(180deg,#f8fffb,#ffffff);
    }

    .summary p { margin: 8px 0; }
    .summary strong { color: #06202a; }

    footer {
      margin-top: 18px;
      color: var(--muted);
      font-size:.88rem;
      text-align: center;
    }

    .two-col {
      display:grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
    }
    @media (max-width:760px){ .two-col { grid-template-columns: 1fr; } }

    /* Pequeños estilos de ayuda */
    .field-inline { display:flex; gap:8px; align-items:center; }
    .small { font-size:.85rem; color:var(--muted); }

    /*Visibilidad del teclado para los usuarios con focus*/ 
    :focus-visible { outline: 3px solid rgba(14,165,164,0.18); outline-offset: 3px; }
  </style>
</head>
<body>
  <div class="container">
    <header class="page-head">
      <div>
        <h1>{$title}</h1>
        <p class="small">Registro de empleados</p>
      </div>
    </header>
HTML;
    }

    public static function renderFooter(): string
    {
        $year = date('Y');
        return <<<HTML
    <footer class="small"> Registro de empleados — {$year} </footer>
  </div>
</body>
</html>
HTML;
    }

    public static function pintarSelect(string $name, string $selected, array $options, string $placeholder = 'Selecciona'): string
    {
        $html = "<select id=\"{$name}\" name=\"{$name}\">";
        $html .= "<option value=\"\">{$placeholder}</option>";
        foreach ($options as $value => $label) {
            $sel = ($value === $selected) ? ' selected' : '';
            $html .= "<option value=\"" . htmlspecialchars($value, ENT_QUOTES) . "\"{$sel}>" . htmlspecialchars($label) . "</option>";
        }
        $html .= "</select>";
        return $html;
    }

    public static function renderForm(array $input, array $errors, array $datos): string
    {
        // Valores sticky short helpers
        $v = fn($k) => htmlspecialchars($input[$k] ?? '', ENT_QUOTES);
        $e = fn($k) => isset($errors[$k]) ? "<div class=\"error\">".htmlspecialchars($errors[$k], ENT_QUOTES)."</div>" : '';

        $provinciasSelect = self::pintarSelect('provincia', $input['provincia'], $datos['provincias'], 'Selecciona una provincia');
        $sedesSelect = self::pintarSelect('sede', $input['sede'], $datos['sedes'], 'Selecciona una sede');
        $departamentosSelect = self::pintarSelect('departamento', $input['departamento'], $datos['departamentos'], 'Selecciona un departamento');

        return <<<HTML
  <main class="card" role="main" aria-labelledby="form-title">
    <h2 id="form-title" style="margin-top:0; font-size:1.05rem;">Alta de empleado</h2>

    <form method="post" novalidate>
      <div class="grid">
        <div>
          <div class="form-row">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="{$v('nombre')}" required>
            {$e('nombre')}
          </div>

          <div class="form-row">
            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" value="{$v('apellidos')}" required>
            {$e('apellidos')}
          </div>

          <div class="form-row">
            <label for="dni">DNI</label>
            <input type="text" id="dni" name="dni" value="{$v('dni')}" placeholder="12345678Z">
            <div class="hint">Formato: 8 dígitos y letra (ej. 12345678Z)</div>
            {$e('dni')}
          </div>

          <div class="form-row">
            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" value="{$v('email')}" placeholder="nombre@dominio.com">
            {$e('email')}
          </div>
        </div>

        <div>
          <div class="form-row">
            <label for="telefono">Teléfono</label>
            <input type="text" id="telefono" name="telefono" value="{$v('telefono')}" placeholder="+34 612 345 678">
            {$e('telefono')}
          </div>

          <div class="form-row">
            <label for="fecha_alta">Fecha de alta</label>
            <input type="date" id="fecha_alta" name="fecha_alta" value="{$v('fecha_alta')}">
            {$e('fecha_alta')}
          </div>

          <div class="form-row">
            <label for="provincia">Provincia</label>
            {$provinciasSelect}
            {$e('provincia')}
          </div>

          <div class="form-row">
            <label for="sede">Sede</label>
            {$sedesSelect}
            {$e('sede')}
          </div>

          <div class="form-row">
            <label for="departamento">Departamento</label>
            {$departamentosSelect}
            {$e('departamento')}
          </div>
        </div>
      </div>

      <div class="actions">
        <button class="btn btn-primary" type="submit">Dar de alta</button>
        <button class="btn btn-ghost" type="reset">Limpiar</button>
      </div>
    </form>
  </main>
HTML;
    }

    public static function renderSummary(array $input, array $datos): string
    {
        $prov = $datos['provincias'][$input['provincia']] ?? $input['provincia'];
        $sede = $datos['sedes'][$input['sede']] ?? $input['sede'];
        $dep = $datos['departamentos'][$input['departamento']] ?? $input['departamento'];

        $nombre = htmlspecialchars($input['nombre'], ENT_QUOTES);
        $apellidos = htmlspecialchars($input['apellidos'], ENT_QUOTES);
        $dni = htmlspecialchars($input['dni'], ENT_QUOTES);
        $email = htmlspecialchars($input['email'], ENT_QUOTES);
        $telefono = htmlspecialchars($input['telefono'], ENT_QUOTES);
        $fecha = htmlspecialchars($input['fecha_alta'], ENT_QUOTES);

        return <<<HTML
  <main class="card" role="main" aria-labelledby="summary-title">
    <h2 id="summary-title" style="margin-top:0; font-size:1.05rem;">Resumen del alta</h2>
    <div class="summary">
      <p><strong>Nombre:</strong> {$nombre} {$apellidos}</p>
      <p><strong>DNI:</strong> {$dni}</p>
      <p><strong>Email:</strong> {$email}</p>
      <p><strong>Teléfono:</strong> {$telefono}</p>
      <p><strong>Fecha de alta:</strong> {$fecha}</p>
      <p><strong>Provincia:</strong> {$prov}</p>
      <p><strong>Sede:</strong> {$sede}</p>
      <p><strong>Departamento:</strong> {$dep}</p>
    </div>

    <div style="margin-top:12px;">
      <a class="btn btn-ghost" href="{$_SERVER['PHP_SELF']}">Volver al formulario</a>
    </div>
  </main>
HTML;
    }
}
