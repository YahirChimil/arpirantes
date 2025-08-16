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
                Documentación de Aspirantes
            </h2>

            <!-- Filtros por sede y carrera -->
            <form method="get" class="flex flex-wrap gap-4 mb-6">
                <div>
                    <label for="sede" class="block text-sm font-medium text-gray-700">Sede</label>
                    <select name="sede" id="sede" class="form-select px-2 py-1 rounded border-gray-300">
                        <option value="">Todas</option>
                        <?php foreach ($sedes as $sede): ?>
                            <option value="<?= esc($sede['id_sede']) ?>" <?= (isset($_GET['sede']) && $_GET['sede'] == $sede['id_sede']) ? 'selected' : '' ?>>
                                <?= esc($sede['nombre_sede']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="carrera" class="block text-sm font-medium text-gray-700">Carrera</label>
                    <select name="carrera" id="carrera" class="form-select px-2 py-1 rounded border-gray-300">
                        <option value="">Todas</option>
                        <?php foreach ($carreras as $carrera): ?>
                            <option value="<?= esc($carrera['id']) ?>" <?= (isset($_GET['carrera']) && $_GET['carrera'] == $carrera['id']) ? 'selected' : '' ?>>
                                <?= esc($carrera['nombre']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="self-end">
                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">Filtrar</button>
                </div>
            </form>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <strong class="font-bold">Éxito:</strong> <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (empty($aspirantes)): ?>
                <p class="text-gray-600">No hay aspirantes con todos los docuementos cargados.</p>
            <?php else: ?>
                <div class="overflow-x-auto bg-white rounded shadow">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CURP</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($aspirantes as $aspirante): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <?= esc($aspirante['curp']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <?= esc($aspirante['nombre']) . ' ' . esc($aspirante['primer_apellido']) . ' ' . esc($aspirante['segundo_apellido']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        <?= esc($aspirante['correo']) ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                                        <a href="<?= base_url('admin/documentos/ver/' . $aspirante['curp']) ?>"
                                            class="inline-flex items-center px-3 py-1.5 border border-blue-600 text-blue-600 text-sm font-medium rounded hover:bg-blue-600 hover:text-white transition">
                                            Ver Documentos
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <?php if ($totalPaginas > 1): ?>
                    <nav class="mt-6 flex justify-center gap-2 text-sm">
                        <?php if ($paginaActual > 1): ?>
                            <a href="<?= base_url('documentacion/aspirantes') . '?' . http_build_query(array_merge($_GET, ['page' => $paginaActual - 1])) ?>"
                                class="px-3 py-1 border rounded hover:bg-gray-100">Anterior</a>
                        <?php endif; ?>

                        <?php
                        $rango = 2;
                        $inicio = max(1, $paginaActual - $rango);
                        $fin = min($totalPaginas, $paginaActual + $rango);
                        if ($paginaActual <= $rango) $fin = min(5, $totalPaginas);
                        elseif ($paginaActual > $totalPaginas - $rango) $inicio = max(1, $totalPaginas - 4);
                        ?>

                        <?php for ($i = $inicio; $i <= $fin; $i++): ?>
                            <a href="<?= base_url('documentacion/aspirantes') . '?' . http_build_query(array_merge($_GET, ['page' => $i])) ?>"
                                class="px-3 py-1 border rounded <?= ($i == $paginaActual) ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' ?>">
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>

                        <?php if ($paginaActual < $totalPaginas): ?>
                            <a href="<?= base_url('documentacion/aspirantes') . '?' . http_build_query(array_merge($_GET, ['page' => $paginaActual + 1])) ?>"
                                class="px-3 py-1 border rounded hover:bg-gray-100">Siguiente</a>
                        <?php endif; ?>
                    </nav>
                <?php endif; ?>
            <?php endif; ?>
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
    $(document).ready(function() {
        function cargarSedes(selectId) {
            $.ajax({
                url: '<?= base_url('getSedes') ?>',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    const $select = $(selectId);
                    $select.empty().append('<option value="">Selecciona una sede</option>');
                    data.forEach(function(sede) {
                        $select.append('<option value="' + sede.id_sede + '">' + sede.nombre_sede + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener sedes:', error);
                }
            });
        }

        function cargarCarreras(sedeId, selectId) {
            $.ajax({
                url: '<?= base_url('getCarrerasPorSede') ?>/' + sedeId,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    const $select = $(selectId);
                    $select.empty().append('<option value="">Selecciona una carrera</option>');
                    data.forEach(function(carrera) {
                        $select.append('<option value="' + carrera.id + '">' + carrera.nombre + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener carreras:', error);
                    $(selectId).empty().append('<option value="">Error al cargar carreras</option>');
                }
            });
        }

        // Cargar sedes para los dos select
        cargarSedes('#sede');
        cargarSedes('#sede_alt');

        // Evento de cambio para sede principal
        $('#sede').on('change', function() {
            const sedeId = $(this).val();
            if (sedeId) {
                cargarCarreras(sedeId, '#carrera');
            } else {
                $('#carrera').empty().append('<option value="">Selecciona una carrera</option>');
            }
        });

        // Evento de cambio para sede alternativa
        $('#sede_alt').on('change', function() {
            const sedeId = $(this).val();
            if (sedeId) {
                cargarCarreras(sedeId, '#carrera_alt');
            } else {
                $('#carrera_alt').empty().append('<option value="">Selecciona una carrera</option>');
            }
        });
    });
</script>



<!-- End of Scripts -->
</body>

</html>