<!--
Product:
Version:
Author:
License:
-->

<!DOCTYPE html>

<html class="h-full" data-theme="true" dir="ltr" lang="es-mx">

<head>
    <?php echo view('base/template/head'); ?>

</head>

<body class="antialiased flex h-full text-base text-gray-700 [--tw-page-bg:#fefefe] demo1 sidebar-fixed header-fixed bg-[--tw-page-bg]"></body> <!-- Theme Mode -->

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
                Documentación del Aspirante: <?= esc($aspirante['nombre']) . ' ' . esc($aspirante['primer_apellido']) . ' ' . esc($aspirante['segundo_apellido']) ?>
            </h2>

            <?php
            // Determina si todos los documentos subidos están aceptados (estatus == 2)
            $totalAceptados = 0;
            foreach ($subidos as $doc) {
                if ($doc['estatus'] == 2) {
                    $totalAceptados++;
                }
            }
            $procesoFinalizado = ($totalAceptados == $documentosNecesarios && $documentosNecesarios > 0);
            ?>

            <!-- Aviso estilizado -->
            <div class="mb-8">
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-800 p-4 rounded shadow flex items-center gap-3">
                    <svg class="w-7 h-7 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>
                    <div>
                        <span class="font-semibold">¡Importante!</span>
                        <span>Conserva la documentación aceptada. Una vez revisada, deberás entregarla en Servicios Escolares y todavía pueden rechazártela si presenta observaciones.</span>
                    </div>
                </div>
                <?php
                // Detecta si ya subió todos los archivos (sin importar si están aceptados)
                $totalSubidos = 0;
                foreach ($documentos as $documento) {
                    if (isset($subidos[$documento['id']])) {
                        $totalSubidos++;
                    }
                }
                $todosSubidos = ($totalSubidos == $documentosNecesarios && $documentosNecesarios > 0);
                ?>
                <?php if ($procesoFinalizado): ?>
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded shadow flex items-center gap-3">
                        <svg class="w-7 h-7 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                        <div>
                            <span class="font-semibold">¡Proceso finalizado!</span>
                            <span>Todos tus documentos han sido aceptados. El proceso de documentación está finalizado.</span>
                        </div>
                    </div>
                <?php elseif ($todosSubidos): ?>
                    <div class="bg-pink-100 border-l-4 border-pink-500 text-pink-800 p-4 rounded shadow flex items-center gap-3">
                        <svg class="w-7 h-7 text-pink-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                        <div>
                            <span class="font-semibold">¡Listo!</span>
                            <span>Ya subiste todos tus documentos. <strong>Espera a que el administrador los revise</strong> para finalizar el proceso.</span>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-800 p-4 rounded shadow flex items-center gap-3">
                        <svg class="w-7 h-7 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                        <div>
                            <span class="font-semibold">¡Importante!</span>
                            <span>Debes subir <strong>todos los archivos</strong> para que el Administrador los pueda revisar.</span>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($documentos as $documento): ?>
                    <div class="mb-6 p-4 border rounded bg-gray-50 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2"><?= esc($documento['descripcion']) ?></h3>
                        <?php $docSubido = $subidos[$documento['id']] ?? null; ?>

                        <?php if ($docSubido): ?>
                            <!-- Mostrar estatus del documento -->
                            <div class="mb-2">
                                <?php if ($docSubido['estatus'] == 0): ?>
                                    <span class="inline-flex items-center text-yellow-600 text-sm font-medium">
                                        🕒 <span class="ml-1">Sin revisar</span>
                                    </span>
                                <?php elseif ($docSubido['estatus'] == 1): ?>
                                    <span class="inline-flex items-center text-orange-600 text-sm font-medium">
                                        📝 <span class="ml-1">Con observaciones</span>
                                    </span>
                                    <?php if (!empty($docSubido['observaciones'])): ?>
                                        <p class="text-sm text-gray-700 mt-1 italic border-l-4 border-orange-400 pl-2">
                                            <?= esc($docSubido['observaciones']) ?>
                                        </p>
                                    <?php endif; ?>
                                <?php elseif ($docSubido['estatus'] == 2): ?>
                                    <span class="inline-flex items-center text-green-600 text-sm font-medium">
                                        ✅ <span class="ml-1">Aprobado</span>
                                    </span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($docSubido): ?>
                            <div class="flex items-center gap-4 mb-3">
                                <!-- Ver documento -->
                                <a href="<?= base_url('uploads/' . $docSubido['ruta']) ?>" target="_blank"
                                    class="flex items-center space-x-1 text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span>Ver Documento</span>
                                </a>

                                <!-- Eliminar documento solo si NO está aceptado -->
                                <?php if ($docSubido['estatus'] != 2): ?>
                                    <form action="<?= base_url('aspirante/eliminar_documento') ?>" method="post" onsubmit="return confirmarEliminar(this);">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="documento_id" value="<?= $documento['id'] ?>">
                                        <input type="hidden" name="aspirante_curp" value="<?= esc($aspirante['curp']) ?>">
                                        <button type="submit"
                                            class="flex items-center space-x-1 text-red-600 hover:text-red-800 text-sm font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
                                            </svg>
                                            <span>Eliminar</span>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!$docSubido): ?>
                            <!-- Formulario para subir documento -->
                            <form action="<?= base_url('aspirante/subir_documento') ?>" method="post" enctype="multipart/form-data" class="mt-3 space-y-2">
                                <?= csrf_field() ?>
                                <input type="hidden" name="documento_id" value="<?= $documento['id'] ?>">
                                <input type="file" name="archivo" accept="application/pdf" class="block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                                <button type="submit"
                                    class="flex items-center justify-center space-x-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <span>Subir</span>
                                </button>
                            </form>
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


<script>
    function confirmarEliminar(form) {
        const documentoId = form.querySelector('input[name="documento_id"]').value;
        const curp = form.querySelector('input[name="aspirante_curp"]').value;



        return confirm('¿Estás seguro de que deseas eliminar este documento?');
    }
</script>

<!-- End of Scripts -->
</body>

</html>