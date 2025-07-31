<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Referencia Bancaria</title>
    <style>
        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
        }

        .referencia {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }

        .qr {
            text-align: center;
            margin: 20px 0;
        }

        .info {
            margin: 10px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .table th,
        .table td {
            border: 1px solid #333;
            padding: 4px 8px;
        }

        .concepto {
            font-size: 13px;
        }

        .footer {
            font-size: 10px;
            color: #555;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <?php if ($logoBase64): ?>
            <img src="<?= $logoBase64 ?>" alt="Logo" height="40">
        <?php endif; ?>
        <h3>INSTITUTO TECNOLÓGICO DE OAXACA</h3>
        <div>Departamento de Recursos Financieros</div>
        <div>FORMATO DE PAGO REFERENCIADO</div>
    </div>
    <table class="table">
        <tr>
            <th>CANTIDAD</th>
            <th>CONCEPTO</th>
            <th>MONTO</th>
        </tr>
        <tr>
            <td>1</td>
            <td class="concepto">PAGO DE FICHA DE ASPIRANTE<br>CURP: <?= esc($curp) ?></td>
            <td>$410.00 MXN</td>
        </tr>
    </table>
    <div class="qr">
        <!-- Puedes usar una imagen QR estática o generarla dinámicamente -->
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=<?= urlencode($referencia) ?>" alt="QR">
    </div>
    <div class="referencia">
        REFERENCIA PERSONAL: <?= esc($referencia) ?>
    </div>
    <div class="info">
        <strong>Válida hasta:</strong> <?= esc($valida_hasta) ?><br>
        <strong>Banco:</strong> BBVA BANCOMER<br>
        <strong>Convenio CIE:</strong> 001371010
    </div>
    <div class="info" style="margin-top:10px;">
        <strong>ESTA REFERENCIA BANCARIA ES ÚNICA Y PERSONAL. NO LA COMPARTAS.</strong>
    </div>
    <div class="footer">
        Presenta este formato en ventanilla o usa la app BBVA para realizar el pago.<br>
        <em>Este documento es solo de muestra.</em>
    </div>
</body>

</html>