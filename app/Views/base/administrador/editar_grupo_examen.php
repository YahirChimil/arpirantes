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
            <div class="container mx-auto max-w-xl bg-white p-6 rounded shadow">
                <h2 class="text-xl font-bold mb-4">Editar Grupo de Examen <?= esc($grupo['id']) ?></h2>
                <form method="post" action="<?= base_url('grupos-examen/actualizar/' . $grupo['id']) ?>">
                    <?= csrf_field() ?>

                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium">Nombre del grupo</label>
                        <input type="text" name="nombre" id="nombre" class="form-input w-full"
                            value="<?= esc($grupo['nombre']) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="codigo_convocatoria" class="block text-sm font-medium">Convocatoria</label>
                        <select name="codigo_convocatoria" id="codigo_convocatoria" class="form-select w-full" required>
                            <?php foreach ($convocatorias as $conv): ?>
                                <option value="<?= $conv['codigo'] ?>" <?= $conv['codigo'] == $grupo['codigo_convocatoria'] ? 'selected' : '' ?>>
                                    <?= esc($conv['codigo']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="sede_id" class="block text-sm font-medium">Sede</label>
                        <select name="sede_id" id="sede_id" class="form-select w-full" required>
                            <?php foreach ($sedes as $sede): ?>
                                <option value="<?= $sede['id_sede'] ?>" <?= $sede['id_sede'] == $grupo['sede_id'] ? 'selected' : '' ?>>
                                    <?= esc($sede['nombre_sede']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="aula_id" class="block text-sm font-medium">Aula</label>
                        <select name="aula_id" id="aula_id" class="form-select w-full" required>
                            <?php foreach ($aulas as $aula): ?>
                                <option value="<?= $aula['id'] ?>" <?= $aula['id'] == $grupo['aula_id'] ? 'selected' : '' ?>>
                                    <?= esc($aula['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="carrera_id" class="block text-sm font-medium">Carrera</label>
                        <select name="carrera_id" id="carrera_id" class="form-select w-full" required>
                            <?php foreach ($carreras as $carrera): ?>
                                <option value="<?= $carrera['id'] ?>" <?= $carrera['id'] == $grupo['carrera_id'] ? 'selected' : '' ?>>
                                    <?= esc($carrera['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="fecha" class="block text-sm font-medium">Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-input w-full"
                            value="<?= esc($grupo['fecha']) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="hora" class="block text-sm font-medium">Hora</label>
                        <input type="time" name="hora" id="hora" class="form-input w-full"
                            value="<?= esc($grupo['hora']) ?>" required min="07:00" max="20:00">
                    </div>

                    <div class="mb-4">
                        <label for="capacidad" class="block text-sm font-medium">Capacidad</label>
                        <input type="number" name="capacidad" id="capacidad" class="form-input w-full"
                            value="<?= esc($grupo['capacidad']) ?>" required min="1" max="100">
                    </div>

                    <button type="submit" class="btn btn-primary w-full">Actualizar Grupo</button>
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
    $(document).ready(function() {
        // Aplica la restricción a todos los inputs numéricos con atributo max o con id específico
        $('input[type="number"]').on('input', function() {
            let max = 100;
            if (parseInt(this.value) > max) {
                this.value = max;
            }
        });

        // Evita subir con la rueda del mouse más allá de 100
        $('input[type="number"]').on('wheel', function(e) {
            let max = 100;
            if (parseInt(this.value) >= max && e.originalEvent.deltaY < 0) {
                e.preventDefault();
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#sede').on('change', function() {
            const sedeId = $(this).val();

            // Carreras
            $.ajax({
                url: '<?= base_url('getCarrerasPorSede') ?>/' + sedeId,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    const $carrera = $('#carrera');
                    $carrera.empty().append('<option value="">Selecciona una carrera</option>');
                    data.forEach(c => {
                        $carrera.append('<option value="' + c.id + '">' + c.nombre + '</option>');
                    });
                },
                error: function() {
                    $('#carrera').html('<option value="">Error al cargar</option>');
                }
            });

            // Aulas
            $.ajax({
                url: '<?= base_url('getAulasPorSede') ?>/' + sedeId,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    const $aula = $('#aula');
                    $aula.empty().append('<option value="">Selecciona un aula</option>');
                    data.forEach(a => {
                        $aula.append('<option value="' + a.id + '">' + a.nombre + '</option>');
                    });
                },
                error: function() {
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