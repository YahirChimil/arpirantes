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

<body class="antialiased flex h-full text-base text-gray-700 [--tw-page-bg:#fefefe] demo1 sidebar-fixed header-fixed bg-[--tw-page-bg]">
    <!-- Theme Mode -->
    
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
            <div class="p-6 max-w-4xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Editar Aspirante</h2>

                <form action="<?= base_url('aspirante/actualizar/' . $aspirante['curp']) ?>" method="post" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
                    <?= csrf_field() ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Columna 1 -->
                        <div class="space-y-4">
                            <div>
                                <label class="block font-medium text-gray-700 mb-1">CURP</label>
                                <input type="text" name="curp" value="<?= esc($aspirante['curp']) ?>" 
                                       class="w-full bg-gray-50 border border-gray-300 rounded-md px-4 py-2 text-gray-700" readonly>
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700 mb-1">Nombre</label>
                                <input type="text" name="nombre" value="<?= esc($aspirante['nombre']) ?>" 
                                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700 mb-1">Primer Apellido</label>
                                <input type="text" name="primer_apellido" value="<?= esc($aspirante['primer_apellido']) ?>" 
                                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700 mb-1">Segundo Apellido</label>
                                <input type="text" name="segundo_apellido" value="<?= esc($aspirante['segundo_apellido']) ?>" 
                                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700 mb-1">Correo</label>
                                <input type="email" name="correo" value="<?= esc($aspirante['correo']) ?>" 
                                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            </div>
                        </div>

                        <!-- Columna 2 -->
                        <div class="space-y-4">
                            <div>
                                <label class="block font-medium text-gray-700 mb-1">Fecha de Nacimiento</label>
                                <input type="date" name="fecha_nacimiento" value="<?= esc($aspirante['fecha_nacimiento']) ?>" 
                                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700 mb-1">Edad</label>
                                <input type="number" name="edad" value="<?= esc($aspirante['edad']) ?>" 
                                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700 mb-1">Género</label>
                                <select name="genero" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="M" <?= $aspirante['genero'] == 'M' ? 'selected' : '' ?>>Masculino</option>
                                    <option value="F" <?= $aspirante['genero'] == 'F' ? 'selected' : '' ?>>Femenino</option>
                                    <option value="O" <?= $aspirante['genero'] == 'O' ? 'selected' : '' ?>>Otro</option>
                                </select>
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700 mb-1">Teléfono</label>
                                <input type="text" name="telefono" value="<?= esc($aspirante['telefono']) ?>" 
                                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700 mb-1">¿Reingreso?</label>
                                <select name="reingreso" class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="0" <?= $aspirante['reingreso'] == 0 ? 'selected' : '' ?>>No</option>
                                    <option value="1" <?= $aspirante['reingreso'] == 1 ? 'selected' : '' ?>>Sí</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Campos de sede y carrera en ancho completo -->
                    <div class="space-y-4">
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Sede</label>
                            <select id="sede" name="sede" required 
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Selecciona una sede</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Carrera</label>
                            <select id="carrera" name="carrera" required 
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Selecciona una carrera</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Sede Alternativa</label>
                            <select id="sede_alt" name="sede_alternativa"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Selecciona una sede</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Carrera Alternativa</label>
                            <select id="carrera_alt" name="carrera_alternativa"
                                    class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Selecciona una carrera</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition-colors duration-200 shadow-sm hover:shadow-md border border-blue-700">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>

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
    <script src="<?php echo base_url(); ?>assets/js/core.bundle.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- End of Scripts -->
    
    <script>
        $(document).ready(function () {
            function cargarSedes(selectId, valorSeleccionado = '') {
                $.ajax({
                    url: '<?= base_url('getSedes') ?>',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        const $select = $(selectId);
                        $select.empty().append('<option value="">Selecciona una sede</option>');
                        data.forEach(function (sede) {
                            const selected = sede.id_sede == valorSeleccionado ? 'selected' : '';
                            $select.append(`<option value="${sede.id_sede}" ${selected}>${sede.nombre_sede}</option>`);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error('Error al obtener sedes:', error);
                    }
                });
            }

            function cargarCarreras(sedeId, selectId, valorSeleccionado = '') {
                if (!sedeId) {
                    $(selectId).empty().append('<option value="">Selecciona una carrera</option>');
                    return;
                }
                
                $.ajax({
                    url: '<?= base_url('getCarrerasPorSede') ?>/' + sedeId,
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        const $select = $(selectId);
                        $select.empty().append('<option value="">Selecciona una carrera</option>');
                        data.forEach(function (carrera) {
                            const selected = carrera.id == valorSeleccionado ? 'selected' : '';
                            $select.append(`<option value="${carrera.id}" ${selected}>${carrera.nombre}</option>`);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error('Error al obtener carreras:', error);
                        $(selectId).empty().append('<option value="">Error al cargar carreras</option>');
                    }
                });
            }

            // Cargar sedes con valores actuales del aspirante
            cargarSedes('#sede', '<?= $aspirante["sede"] ?? "" ?>');
            cargarSedes('#sede_alt', '<?= $aspirante["sede_alternativa"] ?? "" ?>');

            // Si ya hay una sede principal seleccionada, cargar sus carreras
            if ('<?= $aspirante["sede"] ?? "" ?>') {
                cargarCarreras('<?= $aspirante["sede"] ?>', '#carrera', '<?= $aspirante["carrera"] ?? "" ?>');
            }

            // Si ya hay una sede alternativa seleccionada, cargar sus carreras
            if ('<?= $aspirante["sede_alternativa"] ?? "" ?>') {
                cargarCarreras('<?= $aspirante["sede_alternativa"] ?>', '#carrera_alt', '<?= $aspirante["carrera_alternativa"] ?? "" ?>');
            }

            // Evento de cambio para sede principal
            $('#sede').on('change', function () {
                const sedeId = $(this).val();
                cargarCarreras(sedeId, '#carrera');
            });

            // Evento de cambio para sede alternativa
            $('#sede_alt').on('change', function () {
                const sedeId = $(this).val();
                cargarCarreras(sedeId, '#carrera_alt');
            });
        });
    </script>
</body>
</html>