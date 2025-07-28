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


        <div class="overflow-x-auto">
            <!-- Encabezado, sidebar y demás ya incluidos -->
            <main class="grow content pt-5 px-6" id="content" role="content">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <div class="mb-4">
                    <a href="<?= base_url('grupos/curso') ?>"
                        class="inline-flex items-center bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 transition text-sm font-medium">
                        ← Regresar a Grupos de Curso
                    </a>
                </div>

                <h2 class="text-3xl font-extrabold text-gray-800 mb-6">
                    Aspirantes del Grupo <?= esc($grupo['id']) ?> - <?= esc($grupo['nombre'] ?? 'Sin nombre') ?>
                </h2>

                <div class="mb-6 flex flex-wrap gap-4 text-gray-600">
                    <div><strong>Carrera:</strong> <?= esc($aspirantes[0]['nombre_carrera'] ?? 'No disponible') ?></div>
                    <div><strong>Sede:</strong> <?= esc($aspirantes[0]['nombre_sede'] ?? 'No disponible') ?></div>
                </div>
                <div class="mb-6 flex flex-col md:flex-row items-end gap-4 bg-white p-4 rounded shadow">
                    <form id="formAgregarAspirante" method="post" action="<?= base_url('grupos-curso/agregarManual/' . $grupo['id']) ?>" class="flex flex-wrap gap-4 items-end">
                        <?= csrf_field() ?>

                        <!-- Sede -->
                        <div>
                            <label for="sede" class="block text-sm font-medium text-gray-700">Sede</label>
                            <select id="sede" class="form-select w-48 bg-gray-100" disabled>
                                <option value="<?= esc($grupo['sede']) ?>"><?= esc($grupo['nombre_sede'] ?? $grupo['sede']) ?></option>
                            </select>
                        </div>

                        <!-- Campo oculto para enviar sede_id -->
                        <input type="hidden" name="sede_id" value="<?= esc($grupo['sede']) ?>">

                        <!-- Carrera -->
                        <div>
                            <label for="carrera" class="block text-sm font-medium text-gray-700">Carrera</label>
                            <select id="carrera" name="carrera_id" class="form-select w-48">
                                <option value="">Carrera</option>
                            </select>
                        </div>

                        <!-- Aspirante -->
                        <div>
                            <label for="aspirante" class="block text-sm font-medium text-gray-700">Aspirante</label>
                            <select id="aspirante" name="curp" class="form-select w-64">
                                <option value="">Aspirante</option>
                            </select>
                        </div>

                        <!-- Botón Agregar -->
                        <div>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Agregar
                            </button>
                        </div>
                    </form>
                </div>




                <form action="<?= base_url('grupos-curso/asignar/' . $grupo['id']) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-4 bg-blue-100 text-blue-800 p-4 rounded shadow-sm">
                        <p><strong>Capacidad del grupo:</strong> <?= $capacidad ?></p>
                        <p><strong>Aspirantes asignados:</strong> <?= $totalAsignados ?></p>
                        <p><strong>Lugares disponibles:</strong> <?= $lugaresDisponibles ?></p>
                    </div>

                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded mb-4">
                        Guardar Asignación
                    </button>

                    <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden shadow-sm">
                        <thead class="bg-gradient-to-r from-blue-600 to-blue-400 text-white">
                            <tr>
                                <th class="px-4 py-2"><input type="checkbox" onclick="toggleAll(this)"></th>
                                <th class="px-6 py-3 text-left uppercase tracking-wider">CURP</th>
                                <th class="px-6 py-3 text-left uppercase tracking-wider">Nombre Completo</th>
                                <th class="px-6 py-3 text-left uppercase tracking-wider">Carrera</th>
                                <th class="px-6 py-3 text-left uppercase tracking-wider">Sede</th>
                                <th class="px-6 py-3 text-left uppercase tracking-wider max-w-[200px]">Correo</th>
                                <th class="px-6 py-3 text-center uppercase tracking-wider">
                                    Acciones<br>
                                    <input type="checkbox" id="toggleAllCurso" title="Seleccionar todos curso">
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php if (empty($aspirantes)): ?>
                                <tr>
                                    <td colspan="7" class="text-center text-gray-500 py-4">No hay aspirantes para este grupo.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($aspirantes as $asp):
                                    $yaAsignado = in_array($asp['curp'], $curpsAsignados);
                                ?>
                                    <tr class="hover:bg-blue-50">
                                        <td class="px-4 py-2">
                                            <input type="checkbox" name="aspirantes[]" value="<?= esc($asp['id']) ?>" <?= $yaAsignado ? 'checked' : '' ?>>
                                        </td>
                                        <td class="px-6 py-4 font-mono"><?= esc($asp['curp']) ?></td>
                                        <td class="px-6 py-4"><?= esc($asp['nombre'] . ' ' . $asp['primer_apellido'] . ' ' . $asp['segundo_apellido']) ?></td>
                                        <td class="px-6 py-4"><?= esc($asp['nombre_carrera']) ?></td>
                                        <td class="px-6 py-4"><?= esc($asp['nombre_sede']) ?></td>
                                        <td class="px-6 py-4 max-w-[200px] truncate" title="<?= esc($asp['correo']) ?>">
                                            <span class="select-all block"><?= esc($asp['correo']) ?></span>
                                        </td>

                                        <td class="px-6 py-4 text-center">
                                            <?php if ($yaAsignado): ?>
                                                <a href="<?= base_url('grupos-curso/eliminarAspirante/' . $grupo['id'] . '/' . $asp['curp']) ?>"
                                                    onclick="return confirm('¿Eliminar a este aspirante del grupo?');"
                                                    class="text-red-600 hover:text-red-800">
                                                    Eliminar
                                                </a><br>
                                            <?php endif; ?>
                                            <label class="inline-flex items-center cursor-pointer mt-2">
                                                <input type="checkbox"
                                                    class="toggle-curso"
                                                    data-curp="<?= esc($asp['curp']) ?>"
                                                    <?= $asp['nivelacion_aprobado'] == 1 ? 'checked' : '' ?>>
                                                <span class="ml-2 text-sm">curso niv.</span>
                                            </label>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </form>
            </main>

            <script>
                function toggleAll(source) {
                    document.querySelectorAll('input[name="aspirantes[]"]').forEach(cb => cb.checked = source.checked);
                }
            </script>


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
    <script>
        function confirmarEliminacion() {
            return confirm("¿Estás seguro de que deseas eliminar a este aspirante del grupo?");
        }
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

    <script>
        $(document).ready(function() {
            const sedeId = $('#sede').val();

            // Cargar carreras automáticamente al cargar la página
            if (sedeId) {
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
            }

            // Cuando cambias la carrera, carga aspirantes
            $('#carrera').on('change', function() {
                const carreraId = $(this).val();

                $('#aspirante').html('<option>Cargando...</option>');

                if (carreraId && sedeId) {
                    $.ajax({
                        url: '<?= base_url('getAspirantesSinGrupo') ?>',
                        method: 'POST',
                        data: {
                            sede_id: sedeId,
                            carrera_id: carreraId,
                            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                        },
                        dataType: 'json',
                        success: function(data) {
                            const $aspirante = $('#aspirante');
                            $aspirante.empty().append('<option value="">Selecciona un aspirante</option>');
                            data.forEach(function(a) {
                                const nombreCompleto = `${a.nombre} ${a.primer_apellido} ${a.segundo_apellido}`;
                                $aspirante.append(`<option value="${a.curp}">${nombreCompleto} (${a.curp})</option>`);
                            });
                        },
                        error: function() {
                            $('#aspirante').html('<option>Error al cargar aspirantes</option>');
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#carrera').on('change', function() {
                const carreraId = $(this).val();
                const sedeId = $('#sede').val(); // viene deshabilitado, pero aún se puede leer

                $('#aspirante').html('<option>Cargando...</option>');

                if (carreraId && sedeId) {
                    $.ajax({
                        url: '<?= base_url('getAspirantesSinGrupo') ?>',
                        method: 'POST',
                        data: {
                            sede_id: sedeId,
                            carrera_id: carreraId,
                            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                        },
                        dataType: 'json',
                        success: function(data) {
                            const $aspirante = $('#aspirante');
                            $aspirante.empty().append('<option value="">Selecciona un aspirante</option>');
                            data.forEach(function(a) {
                                const nombreCompleto = `${a.nombre} ${a.primer_apellido} ${a.segundo_apellido}`;
                                $aspirante.append(`<option value="${a.curp}">${nombreCompleto} (${a.curp})</option>`);
                            });
                        },
                        error: function() {
                            $('#aspirante').html('<option>Error al cargar aspirantes</option>');
                        }
                    });
                }
            });
        });
    </script>

    <script>
        document.querySelectorAll('.toggle-curso').forEach(toggle => {
            toggle.addEventListener('change', function(event) {
                event.preventDefault(); // ✅ Evita que dispare comportamiento por defecto
                event.stopPropagation(); // ✅ Evita conflicto con formularios padres

                const curp = this.dataset.curp;
                const estado = this.checked ? 1 : 0;

                fetch("<?= base_url('grupo/toggle-curso') ?>", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                        },
                        body: JSON.stringify({
                            curp: curp,
                            nivelacion_aprobado: estado
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.nextElementSibling.textContent = estado ? 'Sí' : 'No';
                        } else {
                            alert('Error al actualizar el estado del curso.');
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

    <script>
        document.getElementById('toggleAllCurso').addEventListener('change', function() {
            const estado = this.checked;
            document.querySelectorAll('.toggle-curso').forEach(input => {
                input.checked = estado;
                input.dispatchEvent(new Event('change'));
            });
        });
    </script>


    <!-- End of Scripts -->


    </body>

</html>