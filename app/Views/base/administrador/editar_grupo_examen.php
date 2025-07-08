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
            <div class="overflow-x-auto">   
            
                    <form method="post" action="<?= base_url('grupos-examen/actualizar/' . $grupo['id']) ?>" class="bg-white shadow-md rounded p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
    <?= csrf_field() ?>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del Grupo</label>
        <input type="text" name="nombre" value="<?= esc($grupo['nombre']) ?>" class="w-full px-3 py-2 border border-gray-300 rounded" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Convocatoria</label>
        <select name="codigo_convocatoria" class="w-full px-3 py-2 border border-gray-300 rounded" required>
            <?php foreach ($convocatorias as $conv): ?>
                <option value="<?= $conv['codigo'] ?>" <?= $conv['codigo'] == $grupo['codigo_convocatoria'] ? 'selected' : '' ?>>
                    <?= $conv['codigo'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Sede</label>
        <select name="sede_id" class="w-full px-3 py-2 border border-gray-300 rounded" required>
            <?php foreach ($sedes as $sede): ?>
                <option value="<?= $sede['id_sede'] ?>" <?= $sede['id_sede'] == $grupo['sede_id'] ? 'selected' : '' ?>>
                    <?= esc($sede['nombre_sede']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Carrera</label>
        <select name="carrera_id" class="w-full px-3 py-2 border border-gray-300 rounded" required>
            <?php foreach ($carreras as $carrera): ?>
                <option value="<?= $carrera['id'] ?>" <?= $carrera['id'] == $grupo['carrera_id'] ? 'selected' : '' ?>>
                    <?= esc($carrera['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Aula</label>
        <select name="aula_id" class="w-full px-3 py-2 border border-gray-300 rounded" required>
            <?php foreach ($aulas as $aula): ?>
                <option value="<?= $aula['id'] ?>" <?= $aula['id'] == $grupo['aula_id'] ? 'selected' : '' ?>>
                    <?= esc($aula['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
        <input type="date" name="fecha" value="<?= esc($grupo['fecha']) ?>" class="w-full px-3 py-2 border border-gray-300 rounded" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Hora</label>
        <input type="time" name="hora" value="<?= esc($grupo['hora']) ?>" class="w-full px-3 py-2 border border-gray-300 rounded" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Capacidad</label>
        <input type="number" name="capacidad"  max="100" min="1" value="<?= esc($grupo['capacidad']) ?>" class="w-full px-3 py-2 border border-gray-300 rounded" required min="1">
    </div>

    <div class="md:col-span-3 text-right">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
            Guardar Cambios
        </button>
    </div>
</form>

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
    $(document).ready(function () {
        // Aplica la restricción a todos los inputs numéricos con atributo max o con id específico
        $('input[type="number"]').on('input', function () {
            let max = 100;
            if (parseInt(this.value) > max) {
                this.value = max;
            }
        });

        // Evita subir con la rueda del mouse más allá de 100
        $('input[type="number"]').on('wheel', function (e) {
            let max = 100;
            if (parseInt(this.value) >= max && e.originalEvent.deltaY < 0) {
                e.preventDefault();
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#sede').on('change', function () {
            const sedeId = $(this).val();

            // Carreras
            $.ajax({
                url: '<?= base_url('getCarrerasPorSede') ?>/' + sedeId,
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    const $carrera = $('#carrera');
                    $carrera.empty().append('<option value="">Selecciona una carrera</option>');
                    data.forEach(c => {
                        $carrera.append('<option value="' + c.id + '">' + c.nombre + '</option>');
                    });
                },
                error: function () {
                    $('#carrera').html('<option value="">Error al cargar</option>');
                }
            });

            // Aulas
            $.ajax({
                url: '<?= base_url('getAulasPorSede') ?>/' + sedeId,
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    const $aula = $('#aula');
                    $aula.empty().append('<option value="">Selecciona un aula</option>');
                    data.forEach(a => {
                        $aula.append('<option value="' + a.id + '">' + a.nombre + '</option>');
                    });
                },
                error: function () {
                    $('#aula').html('<option value="">Error al cargar</option>');
                }
            });
        });
    });
</script>
    <!-- End of Scripts -->
          


    <!-- End of Scripts -->
     

</body>

</html>