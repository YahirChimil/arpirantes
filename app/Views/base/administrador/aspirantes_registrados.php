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
            <main class="grow content pt-5" id="content" role="content">
            <form method="get" class="mb-4 flex flex-wrap items-end gap-4">
  <div class="flex flex-col">
    <label for="sede" class="mb-1 text-sm font-medium text-gray-700">Sede</label>
    <select name="sede" id="sede" class="border border-gray-300 rounded px-3 py-2">
      <option value="">Todas</option>
      <!-- Opciones cargadas por AJAX -->
    </select>
  </div>

  <div class="flex flex-col">
    <label for="carrera" class="mb-1 text-sm font-medium text-gray-700">Carrera</label>
    <select name="carrera" id="carrera" class="border border-gray-300 rounded px-3 py-2">
      <option value="">Todas</option>
      <!-- Opciones cargadas por AJAX -->
    </select>
  </div>

  <div class="flex flex-col">
    <label for="preficha" class="mb-1 text-sm font-medium text-gray-700">Preficha</label>
    <select name="preficha" id="preficha" class="border border-gray-300 rounded px-3 py-2">
      <option value="">Todas</option>
      <option value="1" <?= (isset($_GET['preficha']) && $_GET['preficha'] === '1') ? 'selected' : '' ?>>Pagada</option>
      <option value="0" <?= (isset($_GET['preficha']) && $_GET['preficha'] === '0') ? 'selected' : '' ?>>No Pagada</option>
    </select>
  </div>

  <div class="flex items-center">
    <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
      Filtrar
    </button>
  </div>
</form>



            <table class="table table-bordered w-full">
    <thead>
        <tr>
            <th>CURP</th>
            <th>Nombre Completo</th>
            <th>Sede</th>
            <th>Carrera</th>
            <th>Preficha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($aspirantes as $aspirante): ?>
            <tr>
                <td><?= esc(data: $aspirante['curp']) ?></td>
                <td><?= esc($aspirante['nombre']) . ' ' . esc($aspirante['primer_apellido']) . ' ' . esc($aspirante['segundo_apellido']) ?></td>
                <td><?= esc($aspirante['sede']) ?></td>
                <td><?= esc($aspirante['carrera']) ?></td>
                <td>
                    <?= ($aspirante['preficha'] == 1) ? '<span class="badge bg-success">Pagada</span>' : '<span class="badge bg-danger">No Pagada</span>' ?>
                </td>
                <td>
    <a href="<?= base_url('aspirante/editar/' . $aspirante['curp']) ?>" class="btn btn-sm btn-primary">
        Editar
    </a>
</td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

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
    <!-- End of Scripts -->
</body>

</html>