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
             <?php if (session()->getFlashdata('mensaje')): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">¡Éxito! </strong>
        <span class="block sm:inline"><?= session()->getFlashdata('mensaje') ?></span>
    </div>
<?php endif; ?>
            <main class="grow content pt-5 px-6" id="content" role="content">
          <h2 class="text-2xl font-bold text-gray-700 mb-4">Aspirantes Registrados</h2>

    

    <!-- Filtros y Acciones -->
    <div class="bg-white p-4 rounded shadow-md mb-6 border border-gray-200">
        <form method="get" class="flex flex-wrap gap-4 items-end">
            <div class="flex flex-col">
                <label for="buscar" class="text-sm font-medium">Buscar Aspirante</label>
                <input type="text" name="buscar" id="buscar" placeholder="CURP o Nombre"
                    class="px-3 py-2 border rounded" value="<?= esc($_GET['buscar'] ?? '') ?>">
            </div>

            <div class="flex flex-col">
                <label for="sede" class="text-sm font-medium">Sede</label>
                <select name="sede" id="sede" class="px-3 py-2 border rounded">
                    <option value="">Todas</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="carrera" class="text-sm font-medium">Carrera</label>
                <select name="carrera" id="carrera" class="px-3 py-2 border rounded">
                    <option value="">Todas</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="preficha" class="text-sm font-medium">Preficha</label>
                <select name="preficha" id="preficha" class="px-3 py-2 border rounded">
                    <option value="">Todas</option>
                    <option value="1" <?= ($_GET['preficha'] ?? '') === '1' ? 'selected' : '' ?>>Pagada</option>
                    <option value="0" <?= ($_GET['preficha'] ?? '') === '0' ? 'selected' : '' ?>>No Pagada</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded">
                Filtrar
            </button>
        </form>

        <div class="mt-4 flex flex-wrap gap-3">
            <!-- Botón: Generar Prefichas -->
            <form action="<?= base_url('aspirantes/generarPrefichas') ?>" method="post" onsubmit="return confirm('¿Estás seguro de generar las prefichas?');">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Generar Prefichas
                </button>
            </form>

            <!-- Botón: Cargar Aspirantes Seleccionados -->
            <form action="<?= base_url('aspirantes/cargarCSV') ?>" method="post" enctype="multipart/form-data" class="mt-4 flex items-center gap-4" onsubmit="return confirm('¿Deseas cargar los CURPs del CSV?');">
              <?= csrf_field() ?>
              <input type="file" name="csv_file" accept=".csv" required class="border rounded px-3 py-2 text-sm">
              <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm">
                  Cargar CSV de Aspirantes Seleccionados
              </button>
          </form>
                <a href="<?= base_url('aspirantes/imprimirSeleccionados') ?>" target="_blank"
            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
              Lista selccionados
          </a>

        </div>
    </div>

    <!-- Tabla de aspirantes -->
    <div class="overflow-x-auto bg-white rounded shadow-md border border-gray-200">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">CURP</th>
                    <th class="px-4 py-2 text-left">Nombre Completo</th>
                    <th class="px-4 py-2 text-left">Sede</th>
                    <th class="px-4 py-2 text-left">Carrera</th>
                    <th class="px-4 py-2 text-left">Preficha</th>
                    <th class="px-4 py-2 text-center">Examen</th>
                    <th class="px-4 py-2 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <?php foreach ($aspirantes as $aspirante): ?>
                    <tr class="border-t">
                        <td class="px-4 py-2"><?= esc($aspirante['curp']) ?></td>
                        <td class="px-4 py-2"><?= esc($aspirante['nombre'] . ' ' . $aspirante['primer_apellido'] . ' ' . $aspirante['segundo_apellido']) ?></td>
                        <td class="px-4 py-2"><?= esc($aspirante['sede']) ?></td>
                        <td class="px-4 py-2"><?= esc($aspirante['carrera']) ?></td>
                        <td class="px-4 py-2">
                            <?= $aspirante['preficha'] == 1
                                ? '<span class="text-green-700 bg-green-100 px-2 py-1 rounded text-xs">Pagada</span>'
                                : '<span class="text-red-700 bg-red-100 px-2 py-1 rounded text-xs">No Pagada</span>' ?>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox"
                                       class="toggle-examen"
                                       data-curp="<?= esc($aspirante['curp']) ?>"
                                       <?= $aspirante['examen'] == 1 ? 'checked' : '' ?>>
                                <span class="ml-2 text-sm"><?= $aspirante['examen'] == 1 ? 'Sí' : 'No' ?></span>
                            </label>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <a href="<?= base_url('aspirante/editar/' . $aspirante['curp']) ?>"
                               class="text-blue-600 hover:underline text-sm">
                               Editar
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
                <a href="<?= base_url('Acceso/aspirante_registrados') . '?' . http_build_query(array_merge($_GET, ['page' => $paginaActual - 1])) ?>"
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
                <a href="<?= base_url('Acceso/aspirante_registrados') . '?' . http_build_query(array_merge($_GET, ['page' => $i])) ?>"
                   class="px-3 py-1 border rounded <?= ($i == $paginaActual) ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' ?>">
                   <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($paginaActual < $totalPaginas): ?>
                <a href="<?= base_url('Acceso/aspirante_registrados') . '?' . http_build_query(array_merge($_GET, ['page' => $paginaActual + 1])) ?>"
                   class="px-3 py-1 border rounded hover:bg-gray-100">Siguiente</a>
            <?php endif; ?>
        </nav>
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
        $(document).ready(function () {
    function cargarSedes(selectId) {
        $.ajax({
            url: '<?= base_url('getSedes') ?>',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                const $select = $(selectId);
                $select.empty().append('<option value="">Selecciona una sede</option>');
                data.forEach(function (sede) {
                    $select.append('<option value="' + sede.id_sede + '">' + sede.nombre_sede + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error('Error al obtener sedes:', error);
            }
        });
    }

    function cargarCarreras(sedeId, selectId) {
        $.ajax({
            url: '<?= base_url('getCarrerasPorSede') ?>/' + sedeId,
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                const $select = $(selectId);
                $select.empty().append('<option value="">Selecciona una carrera</option>');
                data.forEach(function (carrera) {
                    $select.append('<option value="' + carrera.id + '">' + carrera.nombre + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error('Error al obtener carreras:', error);
                $(selectId).empty().append('<option value="">Error al cargar carreras</option>');
            }
        });
    }

    // Cargar sedes para los dos select
    cargarSedes('#sede');
    cargarSedes('#sede_alt');

    // Evento de cambio para sede principal
    $('#sede').on('change', function () {
        const sedeId = $(this).val();
        if (sedeId) {
            cargarCarreras(sedeId, '#carrera');
        } else {
            $('#carrera').empty().append('<option value="">Selecciona una carrera</option>');
        }
    });

    // Evento de cambio para sede alternativa
    $('#sede_alt').on('change', function () {
        const sedeId = $(this).val();
        if (sedeId) {
            cargarCarreras(sedeId, '#carrera_alt');
        } else {
            $('#carrera_alt').empty().append('<option value="">Selecciona una carrera</option>');
        }
    });
});

     </script>
     <script>
document.querySelectorAll('.toggle-examen').forEach(toggle => {
    toggle.addEventListener('change', function () {
        const curp = this.dataset.curp;
        const estado = this.checked ? 1 : 0;

        fetch("<?= base_url('aspirante/toggle-examen') ?>", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?= csrf_hash() ?>' // Si tienes CSRF habilitado
            },
            body: JSON.stringify({
                curp: curp,
                examen: estado
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.nextElementSibling.textContent = estado ? 'Sí' : 'No';
            } else {
                alert('Error al actualizar el campo.');
                this.checked = !this.checked;
            }
        })
        .catch(err => {
            alert('Error en la petición.');
            this.checked = !this.checked;
        });
    });
});
</script>

    <!-- End of Scripts -->
</body>

</html>