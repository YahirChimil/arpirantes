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
                <!-- begin: grid -->
                <div class="grid lg:grid-cols-3 gap-y-5 lg:gap-7.5 items-stretch">

                    <div class="lg:col-span-3">

                        <div class="card h-full h-full">
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                            <?php endif; ?>

                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php endif; ?>
                            <div
                                class="card-body p-10 bg-[length:80%] rtl:[background-position:-70%_25%] [background-position:175%_25%] bg-no-repeat entry-callout-bg">
                                <div class="flex flex-col justify-center gap-4">
                                    <!-- Secciones de carga masiva, compactas y separadas visualmente del filtro -->
                                    <div class="flex gap-4 mb-4">

                                        <!-- Preficha -->
                                        <div class="card w-1/2">
                                            <div class="card-body p-3">

                                                <h2 class="text-base font-semibold mb-2 text-gray-800">Carga pagos Preficha
                                                    (CSV)</h2>
                                                <form action="<?= base_url('aspirantes/cargarCSV') ?>" method="post"
                                                    enctype="multipart/form-data" class="flex flex-col gap-2" onsubmit="return confirmarCarga('preficha')">
                                                    <?= csrf_field() ?>
                                                    <input type="file" name="csv_preficha" accept=".csv" required class="block text-xs">
                                                    <button type="submit"
                                                        class="bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700">Cargar</button>
                                                </form>

                                            </div>
                                        </div>
                                        <!-- Curso -->
                                        <div class="card w-1/2">
                                            <div class="card-body p-3">
                                                <h2 class="text-base font-semibold mb-2 text-gray-800">Carga pagos Curso
                                                    (CSV)</h2>
                                                <form action="<?= base_url('admin/cargar_csv_curso') ?>" method="post"
                                                    enctype="multipart/form-data" class="flex flex-col gap-2" onsubmit="return confirmarCarga('curso')">
                                                    <?= csrf_field() ?>
                                                    <input type="file" name="csv_curso" accept=".csv" required class="block text-xs">
                                                    <button type="submit"
                                                        class="bg-green-600 text-white px-2 py-1 rounded text-xs hover:bg-green-700">Cargar</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Filtros y contador -->
                                    <form method="get" class="flex flex-wrap gap-4 mb-6">
                                        <div>
                                            <label for="sede" class="block text-sm font-medium text-gray-700">Sede</label>
                                            <select name="sede" id="sede" class="form-select px-2 py-1 rounded border-gray-300">
                                                <option value="">Todas</option>
                                                <?php foreach ($sedes as $sede): ?>
                                                    <option value="<?= esc($sede['id_sede']) ?>" <?= ($filtro_sede == $sede['id_sede']) ? 'selected' : '' ?>>
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
                                                    <option value="<?= esc($carrera['id']) ?>" <?= ($filtro_carrera == $carrera['id']) ? 'selected' : '' ?>>
                                                        <?= esc($carrera['nombre']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="preficha" class="block text-sm font-medium text-gray-700">Pago preficha</label>
                                            <select name="preficha" id="preficha" class="form-select px-2 py-1 rounded border-gray-300">
                                                <option value="">Todas</option>
                                                <option value="1" <?= ($filtro_preficha === '1') ? 'selected' : '' ?>>Sí</option>
                                                <option value="0" <?= ($filtro_preficha === '0') ? 'selected' : '' ?>>No</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="pago" class="block text-sm font-medium text-gray-700">Pago curso</label>
                                            <select name="pago" id="pago" class="form-select px-2 py-1 rounded border-gray-300">
                                                <option value="">Todos</option>
                                                <option value="1" <?= ($filtro_pago === '1') ? 'selected' : '' ?>>Sí</option>
                                                <option value="0" <?= ($filtro_pago === '0') ? 'selected' : '' ?>>No</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="buscar" class="block text-sm font-medium text-gray-700">Buscar</label>
                                            <input type="text" name="buscar" id="buscar" value="<?= esc($buscar) ?>" class="form-input px-2 py-1 rounded border-gray-300" placeholder="CURP o nombre">
                                        </div>
                                        <div class="self-end">
                                            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 text-sm">Filtrar</button>
                                        </div>
                                    </form>

                                    <p class="mb-4 text-sm text-gray-700">Resultados: <strong><?= $totalRegistros ?></strong></p>
                                    <?php if ($buscar || $filtro_sede || $filtro_carrera || $filtro_preficha !== '' || $filtro_pago !== ''): ?>
                                        <!-- Encabezado de filtros activos -->
                                        <div class="mb-4 p-3 bg-gray-100 rounded text-sm text-gray-700">
                                            <strong>Filtros aplicados:</strong>
                                            <?php if ($filtro_sede): ?> | Sede: <span class="font-semibold"><?= esc(array_column($sedes, 'nombre_sede', 'id_sede')[$filtro_sede] ?? '') ?></span><?php endif; ?>
                                            <?php if ($filtro_carrera): ?> | Carrera: <span class="font-semibold"><?= esc(array_column($carreras, 'nombre', 'id')[$filtro_carrera] ?? '') ?></span><?php endif; ?>
                                            <?php if ($filtro_preficha !== ''): ?> | Preficha: <span class="font-semibold"><?= $filtro_preficha == '1' ? 'Sí' : 'No' ?></span><?php endif; ?>
                                            <?php if ($filtro_pago !== ''): ?> | Pago curso: <span class="font-semibold"><?= $filtro_pago == '1' ? 'Sí' : 'No' ?></span><?php endif; ?>
                                            <?php if ($buscar): ?> | Búsqueda: <span class="font-semibold"><?= esc($buscar) ?></span><?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($aspirantes)): ?>
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full bg-white border rounded shadow text-sm">
                                                <thead>
                                                    <tr class="bg-gray-200">
                                                        <th class="px-3 py-2 border">CURP</th>
                                                        <th class="px-3 py-2 border">Nombre</th>
                                                        <th class="px-3 py-2 border">Sede</th>
                                                        <th class="px-3 py-2 border">Carrera</th>
                                                        <th class="px-3 py-2 border">Preficha</th>
                                                        <th class="px-3 py-2 border">Pago curso</th>
                                                        <th class="px-3 py-2 border advanced-col" style="display:none;">Registrar preficha</th>
                                                        <th class="px-3 py-2 border advanced-col" style="display:none;">Registrar pago curso</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($aspirantes as $aspirante): ?>
                                                        <tr>
                                                            <td class="px-3 py-2 border"><?= esc($aspirante['curp']) ?></td>
                                                            <td class="px-3 py-2 border"><?= esc($aspirante['nombre']) ?> <?= esc($aspirante['primer_apellido']) ?> <?= esc($aspirante['segundo_apellido']) ?></td>
                                                            <td class="px-3 py-2 border"><?= esc($aspirante['sede_nombre']) ?></td>
                                                            <td class="px-3 py-2 border"><?= esc($aspirante['carrera_nombre']) ?></td>
                                                            <td class="px-3 py-2 border">
                                                                <?php if ($aspirante['preficha'] == 1): ?>
                                                                    <span class="inline-block px-2 py-1 rounded bg-green-100 text-green-800 font-semibold">Pago registrado</span>
                                                                <?php else: ?>
                                                                    <span class="inline-block px-2 py-1 rounded bg-red-100 text-red-800 font-semibold">Pago no registrado</span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td class="px-3 py-2 border">
                                                                <?php if ($aspirante['pago_curso'] == 1): ?>
                                                                    <span class="inline-block px-2 py-1 rounded bg-green-100 text-green-800 font-semibold">Pago registrado</span>
                                                                <?php else: ?>
                                                                    <span class="inline-block px-2 py-1 rounded bg-red-100 text-red-800 font-semibold">Pago no registrado</span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td class="px-3 py-2 border text-center advanced-col" style="display:none;">
                                                                <form action="<?= base_url('admin/registrar_preficha') ?>" method="post">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" name="curp" value="<?= esc($aspirante['curp']) ?>">
                                                                    <input type="checkbox" name="preficha" value="1" <?= $aspirante['preficha'] == 1 ? 'checked' : '' ?> onchange="this.form.submit()">
                                                                </form>
                                                            </td>
                                                            <td class="px-3 py-2 border text-center advanced-col" style="display:none;">
                                                                <form action="<?= base_url('admin/registrar_pago') ?>" method="post">
                                                                    <?= csrf_field() ?>
                                                                    <input type="hidden" name="curp" value="<?= esc($aspirante['curp']) ?>">
                                                                    <input type="checkbox" name="pago_curso" value="1" <?= $aspirante['pago_curso'] == 1 ? 'checked' : '' ?> onchange="this.form.submit()">
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                            <?php if ($totalPaginas > 1): ?>
                                                <nav class="mt-6 flex justify-center gap-2 text-sm">
                                                    <?php if ($paginaActual > 1): ?>
                                                        <a href="<?= current_url() . '?' . http_build_query(array_merge($_GET, ['page' => $paginaActual - 1])) ?>"
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
                                                        <a href="<?= current_url() . '?' . http_build_query(array_merge($_GET, ['page' => $i])) ?>"
                                                            class="px-3 py-1 border rounded <?= ($i == $paginaActual) ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' ?>">
                                                            <?= $i ?>
                                                        </a>
                                                    <?php endfor; ?>

                                                    <?php if ($paginaActual < $totalPaginas): ?>
                                                        <a href="<?= current_url() . '?' . http_build_query(array_merge($_GET, ['page' => $paginaActual + 1])) ?>"
                                                            class="px-3 py-1 border rounded hover:bg-gray-100">Siguiente</a>
                                                    <?php endif; ?>
                                                </nav>
                                            <?php endif; ?>
                                        </div>
                                    <?php elseif ($buscar || $filtro_sede || $filtro_carrera || $filtro_preficha !== '' || $filtro_pago !== ''): ?>
                                        <div class="p-4 bg-red-50 border border-red-200 rounded text-red-700 mt-4">
                                            No se encontraron aspirantes con los filtros seleccionados.
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-footer justify-center">
                                <a class="btn btn-link" href="#">

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end: grid -->
            </div>
            <div class="flex justify-end mt-4">
                <label class="flex items-center gap-2 text-sm cursor-pointer">
                    <span>Ajustes avanzados</span>
                    <input type="checkbox" id="toggleAdvanced" class="form-checkbox h-4 w-4 text-blue-600 rounded">
                </label>
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
    document.getElementById('toggleAdvanced').addEventListener('change', function() {
        const cols = document.querySelectorAll('.advanced-col');
        cols.forEach(col => {
            col.style.display = this.checked ? '' : 'none';
        });
    });
</script>
<script>
    function confirmarCarga(tipo) {
        return confirm(
            tipo === 'preficha' ?
            '¿Seguro que deseas cargar el archivo de pagos Preficha? Se marcarán como pagados todos los CURP incluidos.' :
            '¿Seguro que deseas cargar el archivo de pagos Curso? Se marcarán como pagados todos los CURP incluidos.'
        );
    }
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
                    $select.empty()
                        .append('<option value="">Ninguno</option>')
                        .append('<option value="todas">Todas</option>');
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
                    $select.empty()
                        .append('<option value="">Ninguno</option>')
                        .append('<option value="todas">Todas</option>');
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
            if (sedeId && sedeId !== 'todas') {
                cargarCarreras(sedeId, '#carrera');
            } else {
                $('#carrera').empty()
                    .append('<option value="">Ninguno</option>')
                    .append('<option value="todas">Todas</option>');
            }
        });

        // Evento de cambio para sede alternativa
        $('#sede_alt').on('change', function() {
            const sedeId = $(this).val();
            if (sedeId && sedeId !== 'todas') {
                cargarCarreras(sedeId, '#carrera_alt');
            } else {
                $('#carrera_alt').empty()
                    .append('<option value="">Ninguno</option>')
                    .append('<option value="todas">Todas</option>');
            }
        });
    });
</script>
<!-- End of Scripts -->
</body>

</html>