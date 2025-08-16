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
        <main class="grow content pt-5" id="content" role="content">
            <!-- Container -->
            <!-- filepath: c:\xampp\htdocs\rockstar\rockstar\app\Views\base\publico\aspirante_info.php -->
            <main class="grow content pt-5" id="content" role="content">
                <div class="max-w-3xl mx-auto bg-white rounded shadow p-6 mt-8">
                    <h2 class="text-xl font-bold mb-4 text-blue-900">Mi Información</h2>
                    <div class="mb-6">
                        <p><strong>CURP:</strong> <?= esc($aspirante['curp']) ?></p>
                        <p><strong>Nombre:</strong> <?= esc($aspirante['nombre']) ?> <?= esc($aspirante['primer_apellido']) ?> <?= esc($aspirante['segundo_apellido']) ?></p>
                        <p><strong>Correo:</strong> <?= esc($aspirante['correo']) ?></p>
                        <p><strong>Teléfono:</strong> <?= esc($aspirante['telefono']) ?></p>
                        <p><strong>Carrera:</strong> <?= esc($aspirante['carrera_nombre']) ?></p>
                        <p><strong>Sede:</strong> <?= esc($aspirante['sede_nombre']) ?></p>
                    </div>

                    <!-- Botón para descargar referencia si no ha pagado -->
                    <?php if (!empty($avance['encuestaContestada']) && !$avance['pagoRealizado']): ?>
                        <div class="mb-6">
                            <a href="<?= base_url('aspirantes/referencia-bancaria') ?>"
                                class="btn btn-warning px-4 py-2 font-semibold">
                                Descargar Referencia de Pago
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- Botón para descargar preficha si ya pagó y está generada -->
                    <?php if (!empty($avance['pagoRealizado']) && !empty($avance['prefichaGenerada'])): ?>
                        <div class="mb-6">
                            <a href="<?= base_url('aspirantes/preficha') ?>"
                                class="btn btn-success px-4 py-2 font-semibold">
                                Descargar Preficha
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Avance de registro</h3>
                    <div class="w-full bg-gray-200 rounded-full h-4 mb-2">
                        <div class="bg-blue-600 h-4 rounded-full transition-all duration-500"
                            style="width: <?= isset($avance['porcentaje']) ? $avance['porcentaje'] : 0 ?>%;"></div>
                    </div>
                    <div class="flex flex-wrap justify-between text-xs text-gray-700 mb-2">
                        <span><?= $avance['registro'] ? '✔️ Registro' : 'Registro pendiente' ?></span>
                        <span><?= $avance['usuarioCreado'] ? '✔️ Usuario creado' : 'Usuario pendiente' ?></span>
                        <span><?= $avance['encuestaContestada'] ? '✔️ Encuesta contestada' : 'Encuesta pendiente' ?></span>
                        <span><?= $avance['pagoRealizado'] ? '✔️ Pago realizado' : '⏳ Pago pendiente' ?></span>
                        <span><?= $avance['prefichaGenerada'] ? '✔️ Preficha generada' : '⏳ Esperando generación de preficha' ?></span>
                        <span><?= $avance['documentacionSubida'] ? '✔️ Documentación subida' : '⏳ Documentación pendiente' ?></span>
                        <span><?= $avance['documentacionAprobada'] ? '✔️ Documentación aprobada' : '⏳ Documentación por aprobar' ?></span>
                    </div>

                    <?php if (!empty($avance) && !$avance['encuestaContestada']): ?>
                        <div class="bg-yellow-50 border border-yellow-300 rounded p-3 mt-2">
                            <strong class="text-yellow-800">¡Importante!</strong>
                            <p class="text-sm text-yellow-700 mb-2">
                                Para continuar con tu proceso, debes contestar la encuesta de aspirante.
                            </p>
                            <a href="<?= base_url('Acceso/encuesta'); ?>" class="text-blue-700 underline font-semibold" target="_blank">
                                Ir a la encuesta
                            </a>
                        </div>
                    <?php elseif (!empty($avance) && !$avance['pagoRealizado'] && $avance['encuestaContestada']): ?>
                        <div class="bg-yellow-50 border border-yellow-300 rounded p-3 mt-2">
                            <strong class="text-yellow-800">Pago pendiente</strong>
                            <p class="text-sm text-yellow-700 mb-0">
                                Descarga tu referencia y realiza el pago en el banco para continuar el proceso.
                            </p>
                        </div>
                    <?php elseif (!empty($avance) && $avance['pagoRealizado'] && !$avance['prefichaGenerada']): ?>
                        <div class="bg-yellow-50 border border-yellow-300 rounded p-3 mt-2">
                            <strong class="text-yellow-800">Preficha pendiente</strong>
                            <p class="text-sm text-yellow-700 mb-0">
                                La preficha aún no ha sido generada por el instituto. Por favor, espera a que el personal la procese y revisa periódicamente esta página.
                            </p>
                        </div>
                    <?php elseif (!empty($avance) && $avance['prefichaGenerada'] && !$avance['documentacionSubida']): ?>
                        <div class="bg-yellow-50 border border-yellow-300 rounded p-3 mt-2">
                            <strong class="text-yellow-800">Subir documentación</strong>
                            <p class="text-sm text-yellow-700 mb-2">
                                Debes subir toda tu documentación en PDF y estar pendiente de tu correo para saber si fue aprobada o si tienes observaciones.
                            </p>
                            <a href="<?= base_url('aspirante/documentacion'); ?>" class="text-blue-700 underline font-semibold" target="_blank">
                                Ir a subir documentación
                            </a>
                        </div>
                    <?php elseif (!empty($avance) && $avance['documentacionSubida'] && !$avance['documentacionAprobada']): ?>
                        <div class="bg-yellow-50 border border-yellow-300 rounded p-3 mt-2">
                            <strong class="text-yellow-800">Documentación en revisión</strong>
                            <p class="text-sm text-yellow-700 mb-0">
                                Tu documentación está siendo revisada. Revisa tu correo y esta página para conocer el resultado.
                            </p>
                        </div>
                    <?php elseif (!empty($avance) && $avance['documentacionAprobada'] && !$avance['pagoRealizado']): ?>
                        <div class="bg-green-50 border border-green-300 rounded p-3 mt-2">
                            <strong class="text-green-800">¡Documentación aprobada!</strong>
                            <p class="text-sm text-green-700 mb-0">
                                Tu documentación ha sido aprobada. Ahora puedes realizar el pago para continuar con el proceso.
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </main>
            <!-- End of Container -->
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