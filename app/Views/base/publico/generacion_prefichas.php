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
            <div class="container-fixed" id="content_container">
            </div>
            <!-- End of Container -->
            <?php if (session()->getFlashdata('mensaje')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">¡Éxito! </strong>
                    <span class="block sm:inline"><?= session()->getFlashdata('mensaje') ?></span>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <!-- Container -->
            <div class="container-fixed">
                <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                    <div class="flex flex-col justify-center gap-2">
                        <h1 class="text-xl font-medium leading-none text-gray-900">
                            <?php echo $titulo; ?>
                        </h1>
                        <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                            <?php echo $miga; ?> :: <?php echo $sub_miga; ?>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End of Container -->
            <!-- Container -->
            <div class="container-fixed">
                <div class="grid lg:grid-cols-3 gap-y-5 lg:gap-7.5 items-stretch">
                    <div class="lg:col-span-3">
                        <div class="card h-full">
                            <div class="card-body p-8 entry-callout-bg">
                                <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="p-3 bg-blue-50 border border-blue-200 rounded text-blue-800">
                                        <strong>Total de aspirantes en la convocatoria:</strong> <?= $totalAspirantesConvocatoria ?>
                                    </div>
                                    <div class="p-3 bg-green-50 border border-green-200 rounded text-green-800">
                                        <strong>Cumplen criterios para preficha:</strong> <?= $totalCriterioPreficha ?>
                                    </div>
                                    <div class="p-3 bg-yellow-50 border border-yellow-200 rounded text-yellow-800">
                                        <strong>No cumplen criterios para preficha:</strong> <?= $totalNoCriterioPreficha ?>
                                    </div>
                                </div>
                                <div class="flex flex-wrap items-center gap-4 mb-6">

                                    <form action="<?= base_url('aspirantes/generarPrefichas') ?>" method="post" id="formPrefichas">
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                                            Generar Prefichas
                                        </button>
                                    </form>
                                    <form method="get" class="flex flex-wrap gap-4">
                                        <div>
                                            <label for="fecha" class="block text-sm font-medium text-gray-700">Selecciona fecha</label>
                                            <input type="date" name="fecha" id="fecha" value="<?= esc($fecha ?? '') ?>" class="form-input px-2 py-1 rounded border-gray-300" required>
                                        </div>
                                        <div class="self-end">
                                            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">Buscar</button>
                                        </div>
                                    </form>
                                </div>

                                <?php if (isset($aspirantes) && count($aspirantes) > 0): ?>
                                    <p class="mt-4 text-sm text-gray-700">Total: <strong><?= count($aspirantes) ?></strong> aspirantes para el <strong><?= esc($fecha) ?></strong></p>
                                <?php elseif (isset($fecha)): ?>
                                    <div class="p-4 bg-yellow-50 border border-yellow-200 rounded text-yellow-700 mt-4">
                                        No hay aspirantes para entregar preficha en esta fecha.
                                    </div>
                                <?php else: ?>
                                    <div class="p-4 bg-blue-50 border border-blue-200 rounded text-blue-700 mt-4">
                                        Selecciona una fecha para ver los aspirantes que deben entregar preficha.
                                    </div>
                                <?php endif; ?>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full bg-white border rounded shadow text-sm">
                                        <thead>
                                            <tr class="bg-gray-200">
                                                <th class="px-3 py-2 border">CURP</th>
                                                <th class="px-3 py-2 border">Nombre</th>
                                                <th class="px-3 py-2 border">Sede</th>
                                                <th class="px-3 py-2 border">Carrera</th>
                                                <th class="px-3 py-2 border">Preficha</th>
                                                <th class="px-3 py-2 border">Descargar ficha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($aspirantes as $aspirante): ?>
                                                <tr>
                                                    <td class="px-3 py-2 border"><?= esc($aspirante['curp']) ?></td>
                                                    <td class="px-3 py-2 border"><?= esc($aspirante['nombre']) ?> <?= esc($aspirante['primer_apellido']) ?> <?= esc($aspirante['segundo_apellido']) ?></td>
                                                    <td class="px-3 py-2 border"><?= esc($aspirante['sede_nombre']) ?></td>
                                                    <td class="px-3 py-2 border"><?= esc($aspirante['carrera_nombre']) ?></td>
                                                    <td class="px-3 py-2 border"><?= $aspirante['preficha'] == 1 ? 'Generada' : 'Pendiente' ?></td>
                                                    <td class="px-3 py-2 border text-center">
                                                        <a href="<?= base_url('aspirantes/descargarFicha/' . esc($aspirante['curp'])) ?>"
                                                            class="bg-blue-500 hover:bg-blue-700 text-white px-2 py-1 rounded text-xs"
                                                            target="_blank">
                                                            Descargar
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
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
<script>
    document.getElementById('formPrefichas').addEventListener('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¿Estás seguro de generar las prefichas? ya que solo se pueden crear una vez por convocatoria",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, generar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        });
    });
</script>
<!-- End of Scripts -->
</body>

</html>