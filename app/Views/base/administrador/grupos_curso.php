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
        <main class="grow content pt-5 px-6" id="content" role="content">
            <table class="w-full table-auto border border-gray-300 rounded shadow mt-4">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="border px-4 py-2">Nombre del Grupo</th>
                        <th class="border px-4 py-2">Sede</th>
                        <th class="border px-4 py-2">Carrera</th>
                        <th class="border px-4 py-2">Aula</th>
                        <th class="border px-4 py-2">Hora Inicio</th>
                        <th class="border px-4 py-2">Hora Fin</th>
                        <th class="border px-4 py-2">Capacidad</th>
                        <th class="border px-4 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($grupos as $grupo): ?>
                        <tr class="hover:bg-gray-50 text-sm">
                            <td class="border px-4 py-2"><?= esc($grupo['nombre']) ?></td>
                            <td class="border px-4 py-2"><?= esc($grupo['nombre_sede']) ?></td>
                            <td class="border px-4 py-2"><?= esc($grupo['nombre_carrera']) ?></td>
                            <td class="border px-4 py-2"><?= esc($grupo['nombre_aula']) ?></td>
                            <td class="border px-4 py-2"><?= esc($grupo['hora_inicio']) ?></td>
                            <td class="border px-4 py-2"><?= esc($grupo['hora_fin']) ?></td>
                            <td class="border px-4 py-2"><?= esc($grupo['capacidad']) ?></td>
                            <td class="border px-4 py-2 text-center">
                                <a href="<?= base_url('grupos/editar/' . $grupo['id']) ?>"
                                    class="inline-block bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                    ✏️
                                </a>
                                <a href="<?= base_url('grupos/verAspirantes/' . $grupo['id']) ?>"
                                    class="inline-flex items-center bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-sm">
                                    👁️
                                </a>
                                <form action="<?= base_url('grupos-curso/eliminar/' . $grupo['id']) ?>" method="post" class="inline-block"
                                    onsubmit="return confirm('¿Estás seguro de eliminar este grupo?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                        🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-6">



                <?php foreach ($aspirantesSinGrupoCurso as $grupo): ?>
                    <div class="bg-white border border-gray-300 shadow-sm rounded-lg p-4">
                        <h3 class="text-md font-semibold text-gray-800"><?= esc($grupo['nombre_sede']) ?></h3>
                        <p class="text-sm text-gray-600"><?= esc($grupo['nombre_carrera']) ?></p>
                        <p class="text-2xl font-bold text-blue-600"><?= esc($grupo['total']) ?> aspirantes sin grupo</p>

                        <form action="<?= base_url('grupos-curso/guardar') ?>" method="post" class="grupo-form mt-3 space-y-2">
                            <?= csrf_field() ?>

                            <input type="hidden" name="sede_id" value="<?= esc($grupo['sede_id']) ?>">
                            <input type="hidden" name="carrera_id" value="<?= esc($grupo['carrera_id']) ?>">

                            <label class="block text-xs font-semibold text-gray-600">Nombre del grupo</label>
                            <input type="text" name="nombre" placeholder="Nombre del grupo" required
                                class="w-full border rounded px-2 py-1 text-sm">

                            <label class="block text-xs font-semibold text-gray-600">Aula</label>
                            <select name="aula_id" id="aula_id_<?= $grupo['sede_id'] . '_' . $grupo['carrera_id'] ?>"
                                class="aula-select w-full border rounded px-2 py-1 text-sm"
                                required>


                                <option value="">Selecciona un aula</option>
                                <?php foreach ($aulas as $aula): ?>
                                    <?php if ($aula['sede_id'] == $grupo['sede_id']): ?>
                                        <option value="<?= $aula['id'] ?>" data-capacidad="<?= $aula['capacidad'] ?>">
                                            <?= esc($aula['nombre']) ?> (<?= $aula['capacidad'] ?>)
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>

                            <label class="block text-xs font-semibold text-gray-600">Hora inicio</label>
                            <input type="time" name="hora_inicio" required class="w-full border rounded px-2 py-1 text-sm">

                            <label class="block text-xs font-semibold text-gray-600">Hora fin</label>
                            <input type="time" name="hora_fin" required class="w-full border rounded px-2 py-1 text-sm">


                            <label class="block text-xs font-semibold text-gray-600">Capacidad</label>
                            <input type="number" name="capacidad"
                                class="capacidad-input w-full border rounded px-2 py-1 text-sm"
                                required min="1">
                            <small class="text-red-600 text-xs capacidad-error hidden">⚠️ Capacidad excede la del aula seleccionada</small>


                            <label class="block text-xs font-semibold text-gray-600">Catedrático</label>
                            <input type="text" name="catedratico" placeholder="Nombre del catedrático"
                                class="w-full border rounded px-2 py-1 text-sm">

                            <label class="block text-xs font-semibold text-gray-600">Tipo</label>
                            <select name="tipo" required class="w-full border rounded px-2 py-1 text-sm">
                                <option value="">Tipo de grupo</option>
                                <option value="logico">Lógico</option>
                                <option value="matematico">Matemático</option>
                            </select>

                            <button type="submit"
                                class="boton-crear w-full bg-blue-600 text-white py-1 rounded hover:bg-blue-700 text-sm">
                                Crear Grupo de Curso
                            </button>

                        </form>
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
    $(document).ready(function() {
        $('#sede').on('change', function() {
            const sedeId = $(this).val();

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
                    $('#aula').html('<option value="">Error al cargar aulas</option>');
                }
            });

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
                    $('#carrera').html('<option value="">Error al cargar carreras</option>');
                }
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formularios = document.querySelectorAll('.grupo-form');

        formularios.forEach(form => {
            const aulaSelect = form.querySelector('.aula-select');
            const capacidadInput = form.querySelector('.capacidad-input');
            const errorMsg = form.querySelector('.capacidad-error');
            const botonCrear = form.querySelector('.boton-crear');

            let maxCapacidad = 0;

            aulaSelect.addEventListener('change', function() {
                const selected = aulaSelect.options[aulaSelect.selectedIndex];
                maxCapacidad = parseInt(selected.dataset.capacidad || 0);
                capacidadInput.setAttribute('max', maxCapacidad);
                validar();
            });

            capacidadInput.addEventListener('input', validar);

            function validar() {
                const valor = parseInt(capacidadInput.value || 0);
                if (maxCapacidad > 0 && valor > maxCapacidad) {
                    capacidadInput.classList.add('border-red-500');
                    errorMsg.classList.remove('hidden');
                    botonCrear.disabled = true;
                    botonCrear.classList.add('opacity-50', 'cursor-not-allowed');
                } else {
                    capacidadInput.classList.remove('border-red-500');
                    errorMsg.classList.add('hidden');
                    botonCrear.disabled = false;
                    botonCrear.classList.remove('opacity-50', 'cursor-not-allowed');
                }
            }
        });
    });
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






<!-- End of Scripts -->
</body>

</html>