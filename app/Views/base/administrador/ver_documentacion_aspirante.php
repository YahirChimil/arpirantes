<!--
Product:
Version:
Author:
License:
-->

<!DOCTYPE html>

<html class="h-full" data-theme="true"  dir="ltr" lang="es-mx">

<head>
    <?php echo view('base/template/head'); ?>

</head>

<body class="antialiased flex h-full text-base text-gray-700 [--tw-page-bg:#fefefe] demo1 sidebar-fixed header-fixed bg-[--tw-page-bg]"></body>    <!-- Theme Mode -->
    
    <!-- End of Theme Mode -->
    <!-- Page -->
    <!-- Main -->
    <div class="flex grow">
        <!-- Sidebar -->
        <?php echo view('base/template/sidebar'); ?>
        <!-- End of Sidebar -->
        <!-- Wrapper -->
        <div class="wrapper flex grow flex-col">
            <!-- Header -->
            <?php echo view('base/template/header'); ?>

            <!-- End of Header -->
            <!-- Content -->
             <?php if (session()->getFlashdata('error')): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">¡Éxito! </strong>
        <span class="block sm:inline"><?= session()->getFlashdata('error') ?></span>
    </div>
<?php endif; ?>
          <main class="grow content pt-5 px-6" id="content" role="main">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        Revisión de Documentación de: <?= esc($aspirante['nombre']) . ' ' . esc($aspirante['primer_apellido']) . ' ' . esc($aspirante['segundo_apellido']) ?>
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <?php foreach ($documentos as $documento): ?>
            <?php $docSubido = $subidos[$documento['id']] ?? null; ?>
            <div class="mb-6 p-4 border rounded bg-white shadow-sm">
                <h3 class="text-lg font-semibold text-gray-700 mb-2"><?= esc($documento['descripcion']) ?></h3>

                <?php if ($docSubido): ?>
                    <div class="mb-3">
                        <a href="<?= base_url('uploads/' . $docSubido['ruta']) ?>" target="_blank"
                           class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium">
                            👁 Ver Documento
                        </a>
                    </div>

                    <form action="<?= base_url('admin/documentos/actualizar') ?>" method="post" class="space-y-2">
                        <?= csrf_field() ?>
                        <input type="hidden" name="documento_aspirante_id" value="<?= $docSubido['id'] ?>">

                        <!-- Estatus -->
                        <label class="block text-sm font-medium text-gray-700">Estatus:</label>
                        <select name="estatus" class="w-full border-gray-300 rounded">
                            <option value="0" <?= $docSubido['estatus'] == 0 ? 'selected' : '' ?>>🕒 Sin revisar</option>
                            <option value="1" <?= $docSubido['estatus'] == 1 ? 'selected' : '' ?>>📝 Con observaciones</option>
                            <option value="2" <?= $docSubido['estatus'] == 2 ? 'selected' : '' ?>>✅ Aprobado</option>
                        </select>

                        <!-- Observaciones -->
                        <label class="block text-sm font-medium text-gray-700 mb-1">Observaciones:</label>
<select name="observaciones" class="w-full border-gray-300 rounded px-2 py-1" required>
    <option value="">Sin observaciones</option>
    <option value="EL DOCUMENTO NO CORRESPONDE. El documento no es una constacia de estudios." <?= (isset($docSubido['observaciones']) && $docSubido['observaciones'] === 'EL DOCUMENTO NO CORRESPONDE. El documento no es una constacia de estudios.') ? 'selected' : '' ?>>El documento no corresponde</option>

    <option value="EL DOCUMENTO NO ES LEGIBLE. Es necesario escanees el documento nuevamente con una resolucion minima de 150ppp y lo vuelvas a enviar." <?= (isset($docSubido['observaciones']) && $docSubido['observaciones'] === 'EL DOCUMENTO NO ES LEGIBLE. Es necesario escanees el documento nuevamente con una resolucion minima de 150ppp y lo vuelvas a enviar.') ? 'selected' : '' ?>>El documento no es legible</option>

    <option value="EL DOCUMENTO CONTIENE TACHADURAS Y ENMENDADURAS. Tu documento no puede ser aceptado en las condiciones que lo subiste. Acude a tu escuela o al registro civil por uno nuevo." <?= (isset($docSubido['observaciones']) && $docSubido['observaciones'] === 'EL DOCUMENTO CONTIENE TACHADURAS Y ENMENDADURAS. Tu documento no puede ser aceptado en las condiciones que lo subiste. Acude a tu escuela o al registro civil por uno nuevo.') ? 'selected' : '' ?>>Tachaduras y enmendaduras</option>

    <option value="EN EL ACTA NO CORRESPONDEN LOS APELLIDOS DE LOS PADRES CON EL DEL ASPIRANTE. Tu documento no puede ser aceptado sin las correcciones o la justificacion legal necesaria." <?= (isset($docSubido['observaciones']) && $docSubido['observaciones'] === 'EN EL ACTA NO CORRESPONDEN LOS APELLIDOS DE LOS PADRES CON EL DEL ASPIRANTE. Tu documento no puede ser aceptado sin las correcciones o la justificacion legal necesaria.') ? 'selected' : '' ?>>Apellidos no coinciden en el acta</option>

    <option value="EL DOCUMENTO SE ENCUENTRA ALTERADO. Tu documento no puede ser aceptado en las condiciones que lo subiste. Acude a tu escuela o al registro civil por uno nuevo." <?= (isset($docSubido['observaciones']) && $docSubido['observaciones'] === 'EL DOCUMENTO SE ENCUENTRA ALTERADO. Tu documento no puede ser aceptado en las condiciones que lo subiste. Acude a tu escuela o al registro civil por uno nuevo.') ? 'selected' : '' ?>>Documento alterado</option>

    <option value="EL DOCUMENTO NO CONTIENE SELLOS. Tu documento no puede ser aceptado en las condiciones que lo subiste. Acude a tu escuela o al registro civil para obtener el sello oficial." <?= (isset($docSubido['observaciones']) && $docSubido['observaciones'] === 'EL DOCUMENTO NO CONTIENE SELLOS. Tu documento no puede ser aceptado en las condiciones que lo subiste. Acude a tu escuela o al registro civil para obtener el sello oficial.') ? 'selected' : '' ?>>Faltan sellos</option>

    <option value="EL DOCUMENTO NO CONTIENE FIRMAS. Tu documento no puede ser aceptado en las condiciones que lo subiste. Acude a tu escuela o al registro civil para recabar las firmas faltantes." <?= (isset($docSubido['observaciones']) && $docSubido['observaciones'] === 'EL DOCUMENTO NO CONTIENE FIRMAS. Tu documento no puede ser aceptado en las condiciones que lo subiste. Acude a tu escuela o al registro civil para recabar las firmas faltantes.') ? 'selected' : '' ?>>Faltan firmas</option>

    <option value="EL DOCUMENTO NO CORRESPONDE AL INTERESADO. Es necesario escanees el documento que corresponda a los datos del aspirante nuevamente con una resolucion minima de 150ppp y lo vuelvas a enviar." <?= (isset($docSubido['observaciones']) && $docSubido['observaciones'] === 'EL DOCUMENTO NO CORRESPONDE AL INTERESADO. Es necesario escanees el documento que corresponda a los datos del aspirante nuevamente con una resolucion minima de 150ppp y lo vuelvas a enviar.') ? 'selected' : '' ?>>No corresponde al aspirante</option>

    <option value="LA FOTOGRAFIA DEBE SER ACTUAL. La fotografia debe ser con una antiguedad no mayor a 6 meses." <?= (isset($docSubido['observaciones']) && $docSubido['observaciones'] === 'LA FOTOGRAFIA DEBE SER ACTUAL. La fotografia debe ser con una antiguedad no mayor a 6 meses.') ? 'selected' : '' ?>>Fotografía no actual</option>

    <option value="LA FOTOGRAFIA SOLO DEBE ABARCAR EL TAMAÑO INFANTIL. Recorta la fotografia a los bordes de la foto tamaño infantil" <?= (isset($docSubido['observaciones']) && $docSubido['observaciones'] === 'LA FOTOGRAFIA SOLO DEBE ABARCAR EL TAMAÑO INFANTIL. Recorta la fotografia a los bordes de la foto tamaño infantil') ? 'selected' : '' ?>>Tamaño incorrecto de fotografía</option>

    <option value="LA FOTOGRAFIA CONTIENE TACHADURAS Y ENMENDADURAS. La fotografia no debe contener firmas, sellos, o manchas." <?= (isset($docSubido['observaciones']) && $docSubido['observaciones'] === 'LA FOTOGRAFIA CONTIENE TACHADURAS Y ENMENDADURAS. La fotografia no debe contener firmas, sellos, o manchas.') ? 'selected' : '' ?>>Fotografía con tachaduras</option>

    <option value="LAS FIRMAS NO SON LEGIBLES O NO SE ENCUENTRAN EN EL DOCUMENTO. La firmas deben ser en tinta azul." <?= (isset($docSubido['observaciones']) && $docSubido['observaciones'] === 'LAS FIRMAS NO SON LEGIBLES O NO SE ENCUENTRAN EN EL DOCUMENTO. La firmas deben ser en tinta azul.') ? 'selected' : '' ?>>Firmas no legibles o ausentes</option>

    <option value="OTRO MOTIVO." <?= (isset($docSubido['observaciones']) && $docSubido['observaciones'] === 'OTRO MOTIVO.') ? 'selected' : '' ?>>Otro motivo</option>
</select>


                        <!-- Botón -->
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                            Guardar Cambios
                        </button>
                    </form>
                <?php else: ?>
                    <p class="text-gray-500 italic">El aspirante aún no ha subido este documento.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</main>





            <!-- End of Content -->
            <!-- Footer -->
            <?php echo view('base/template/footer'); ?>

            <!-- End of Footer -->
        </div>
        <!-- End of Wrapper -->
    </div>
    <!-- End of Main -->

    <!-- End of Page -->
    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>assets/js/core.bundle.js">
    </script>


                        

    <!-- End of Scripts -->
</body>

</html>