<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Preficha de Entrega</title>
    <style>
        body {
            font-family: Helvetica, sans-serif;
            padding: 40px;
            font-size: 14px;
            color: #333;
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
            font-size: 20px;
            margin-bottom: 5px;
        }

        h2 {
            font-size: 16px;
            text-align: center;
            margin-bottom: 25px;
        }

        .info p {
            margin: 6px 0;
        }

        .label {
            font-weight: bold;
        }

        .docs {
            margin-top: 30px;
        }

        .docs table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .docs th,
        .docs td {
            border: 1px solid #ccc;
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



        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <div style="flex: 1; text-align: left;">
                <img src="<?= $logoBase64 ?>" alt="Logo Izquierdo" style="height: 60px; width: auto; object-fit: contain;">
            </div>
            <div style="flex: 1; text-align: right;">
                <?php if (!empty($logo2Base64)): ?>
                    <img src="<?= $logo2Base64 ?>" alt="Logo Derecho" style="height: 80px; width: auto; object-fit: contain;">
                <?php endif; ?>
            </div>
        </div>



        <div>
            <h1>INSTITUTO TECNOLÓGICO DE OAXACA</h1>
            <h2>Preficha para Entrega de Documentos</h2>
        </div>
    </header>

    <div class="info">
        <p><span class="label">Nombre:</span> <?= esc($aspirante['nombre'] . ' ' . $aspirante['primer_apellido'] . ' ' . $aspirante['segundo_apellido']) ?></p>
        <p><span class="label">CURP:</span> <?= esc($aspirante['curp']) ?></p>
        <p><span class="label">Carrera:</span> <?= esc($aspirante['nombre_carrera']) ?></p>
        <p><span class="label">Sede:</span> <?= esc($aspirante['nombre_sede']) ?></p>
        <p><span class="label">Periodo:</span> <?= esc($periodo) ?></p>
        <p><span class="label">Fecha de Entrega:</span> <?= date('d/m/Y', strtotime($fecha_entrega)) ?></p>
        <p><span class="label">Horario:</span> 9:00 AM - 2:00 PM</p>
    </div>

    <div class="docs">
        <h3>Documentos Requeridos (Originales):</h3>
        <table>
            <tr>
                <th>#</th>
                <th>Documento</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Acta de nacimiento</td>
            </tr>
            <tr>
                <td>2</td>
                <td>CURP</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Certificado o Constancia de estudios</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Recibo de pago</td>
            </tr>
            <tr>
                <td>4</td>
                <td>2 fotos tamaño infantil</td>
            </tr>
        </table>
    </div>

    <p class="footer-note">Preséntate puntualmente con tus documentos completos en el horario y fecha indicada. Gracias por tu atención.</p>

</body>

</html>