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


                <!-- Botón para descargar preficha si ya pagó y está generada -->
                <?php if (!empty($avance['pagoRealizado']) && !empty($avance['prefichaGenerada'])): ?>
                    <div class="mb-6">
                        <div class="bg-blue-50 border border-blue-300 rounded p-3">
                            <strong class="text-blue-800">Fecha y hora de entrega de documentos:</strong>
                            <p class="text-sm text-blue-700 mt-2">
                                <?= isset($preficha['fecha']) ? date('d/m/Y ') : 'Por asignar' ?>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="max-w-100 mx-auto bg-white rounded shadow p-6 mt-8">
                <div class="mb-8">
                    <!-- Barra de progreso estilo pasos con lógica dinámica y foreach -->
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Avance de registro</h3>

                    <div class="flex w-full bg-white rounded shadow mb-8 overflow-hidden">



                        <?php foreach ($steps as $i => $step): ?>
                            <?php
                            $completed = !empty($avance[$step['key']]);
                            $active = $i === 0 || !empty($avance[$steps[$i - 1]['key']]);
                            $border = $i < count($steps) - 1 ? ' border-none border-r last:border-r-0' : '';
                            $circleClass = $completed
                                ? 'bg-violet-600 text-white'
                                : ($active ? 'border-2 border-violet-600 text-violet-600 bg-white' : 'border-2 border-gray-400 text-gray-400 bg-white');
                            $labelClass = $completed || $active ? 'text-violet-700' : 'text-gray-400';
                            $descClass = $completed ? 'text-gray-750' : 'text-gray-500';
                            ?>
                            <div class="flex-1 flex flex-col items-center py-4 <?= $border ?>">
                                <div class="flex items-center">
                                    <div class="rounded-full <?= $circleClass ?> w-8 h-8 flex items-center justify-center font-bold">
                                        <?php if ($completed): ?>
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        <?php else: ?>
                                            <?= $step['num'] ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="mt-2 <?= $labelClass ?> font-bold"><?= $step['label'] ?></div>
                                <div class="text-xs <?= $descClass ?>"><?= $step['desc'] ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Texto y barra de porcentaje como refuerzo -->



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
                            <p class="text-sm text-yellow-700 mb-2">
                                Descarga tu referencia y realiza el pago en el banco para continuar el proceso.
                            </p>
                            <form action="<?= base_url('aspirantes/referencia-bancaria') ?>" method="post" target="_blank">
                                <?= csrf_field() ?>
                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded transition">
                                    Descargar referencia de pago
                                </button>
                            </form>
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
            </div>
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