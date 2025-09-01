<!-- filepath: app/Views/pdf/horario_grupo.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Horario de Grupo</title>
    <style>
        body {
            font-family: Helvetica, Arial, sans-serif;
            padding: 40px;
            font-size: 15px;
            color: #222;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo {
            width: 100px;
            height: auto;
        }

        h1 {
            text-align: center;
            font-size: 22px;
            margin-bottom: 5px;
        }

        h2 {
            font-size: 16px;
            text-align: center;
            margin-bottom: 20px;
        }

        .info p {
            margin: 6px 0;
        }

        .label {
            font-weight: bold;
        }

        .horario-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        .horario-table th,
        .horario-table td {
            border: 1px solid #bbb;
            padding: 8px;
            text-align: left;
        }

        .footer-note {
            margin-top: 30px;
            font-style: italic;
        }
    </style>
</head>

<body>
    <header>
        <div style="flex: 1; text-align: left;">
            <img src="<?= $logoBase64 ?>" alt="Logo Izquierdo" style="height: 60px; width: auto; object-fit: contain;">
        </div>
        <div style="flex: 1; text-align: right;">
            <?php if (!empty($logo2Base64)): ?>
                <img src="<?= $logo2Base64 ?>" alt="Logo Derecho" style="height: 80px; width: auto; object-fit: contain;">
            <?php endif; ?>
        </div>
    </header>

    <div>
        <h1>INSTITUTO TECNOLÓGICO DE OAXACA</h1>
        <h2>
            <?php if ($tipo === 'examen'): ?>
                Horario de Examen de Admisión
            <?php elseif ($tipo === 'nivelacion'): ?>
                Horario de Curso de Nivelación
            <?php else: ?>
                Horario de Grupo
            <?php endif; ?>
        </h2>
    </div>

    <div class="info">
        <p><span class="label">Nombre:</span> <?= esc($aspirante['nombre'] . ' ' . $aspirante['primer_apellido'] . ' ' . $aspirante['segundo_apellido']) ?></p>
        <p><span class="label">CURP:</span> <?= esc($aspirante['curp']) ?></p>
        <p><span class="label">Carrera:</span> <?= esc($aspirante['carrera_nombre']) ?></p>
        <p><span class="label">Sede:</span> <?= esc($grupo['nombre_sede']) ?></p>
        <p><span class="label">Aula:</span> <?= esc($grupo['nombre_aula']) ?></p>
        <p><span class="label">Grupo:</span> <?= esc($grupo['nombre']) ?></p>
        <?php if (!empty($grupo['docente'])): ?>
            <p><span class="label">Docente:</span> <?= esc($grupo['docente']) ?></p>
        <?php endif; ?>
    </div>

    <table class="horario-table">
        <tr>
            <th>Actividad</th>
            <?php if ($tipo === 'examen'): ?>
                <th>Fecha</th>
                <th>Hora</th>
            <?php else: ?>
                <th>Hora de Inicio</th>
                <th>Hora de Fin</th>
            <?php endif; ?>

            <th>Lugar</th>
        </tr>
        <tr>
            <td>
                <?php if ($tipo === 'examen'): ?>
                    Examen de Admisión
                <?php elseif ($tipo === 'nivelacion'): ?>
                    Curso de Nivelación
                <?php else: ?>
                    Actividad de Grupo
                <?php endif; ?>
            </td>
            <?php if ($tipo === 'examen'): ?>
                <td>
                    <?= !empty($grupo['fecha']) ? date('d/m/Y', strtotime($grupo['fecha'])) : '' ?>
                </td>
                <td>
                    <?= !empty($grupo['hora']) ? esc($grupo['hora']) : '' ?>
                </td>

            <?php else: ?>
                <td>
                    <?= !empty($grupo['hora_inicio']) ? esc(data: $grupo['hora_inicio']) : '' ?>

                </td>
                <td>
                    <?= !empty($grupo['hora_fin']) ? esc(data: $grupo['hora_fin']) : '' ?>
                </td>
            <?php endif; ?>
            <td>
                <?= esc($grupo['nombre_aula']) ?>, <?= esc($grupo['nombre_sede']) ?>
            </td>
        </tr>
    </table>

    <p class="footer-note">
        Preséntate puntualmente con tu identificación y este horario impreso. Sigue las indicaciones del personal y revisa tu correo para cualquier actualización.
    </p>
</body>

</html>