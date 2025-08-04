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

<body class="antialiased flex flex-col min-h-screen text-base text-gray-700 [--tw-page-bg:#fefefe] bg-[--tw-page-bg]">
    <!-- Header con logo y título -->
    <header class="w-full bg-blue-900 py-4 shadow">
        <div class="max-w-5xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between">
            <div class="flex-1 flex flex-col items-center md:items-start">
                <h1 class="text-2xl md:text-3xl font-bold text-white mb-1">Registro de Aspirantes</h1>
                <p class="text-blue-100 text-center md:text-left text-sm md:text-base">
                    Bienvenido al sistema de registro de aspirantes del Instituto Tecnológico de Oaxaca.<br>
                    Aquí podrás iniciar tu proceso de registro, cargar tu CURP y completar tus datos personales para participar en la convocatoria actual.<br>
                    <span class="block mt-2">
                        <strong>¿Ya estás registrado o culminaste tu registro?</strong>
                        Ingresa al sistema para consultar tu avance o descargar tus documentos.
                        <a href="<?= base_url('/') ?>" class="underline text-white font-semibold hover:text-blue-200 ml-1">Haz clic aquí para entrar</a>
                    </span>
                </p>
            </div>
            <div class="mt-4 md:mt-0 md:ml-8 flex-shrink-0 relative">
                <div style="
                    background: linear-gradient(90deg, #fff 60%, rgba(255,255,255,0) 100%);
                    border-radius: 1rem;
                    padding: 1rem 2rem 1rem 1rem;
                    display: flex;
                    align-items: center;
                    box-shadow: 0 2px 8px 0 rgba(0,0,0,0.04);
                ">
                    <img class="max-h-[120px] w-auto block" src="<?php echo base_url(); ?>images/logos/logo_cliente.png" alt="Logo cliente" />
                </div>
            </div>
        </div>
    </header>

    <!-- Main -->
    <main class="grow content pt-5" id="content" role="content">
        <div class="max-w-5xl mx-auto mt-8 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                Registro de Aspirante - Convocatoria: <?= esc($periodo ?? '') ?>
            </h2>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">¡Éxito! </strong>
                    <span class="block sm:inline"><?= session()->getFlashdata('success') ?></span>
                </div>
            <?php endif; ?>

            <!-- Formulario paso 1: Subir CURP -->
            <?php if (!isset($curp)): ?>
                <form action="<?= base_url('analizar-curp') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Carga tu CURP en formato PDF <span class="text-red-500">*</span>
                            <span class="block text-xs font-normal text-gray-500 mt-1">
                                Descárgala desde el sitio oficial:
                                <a href="https://www.gob.mx/curp" target="_blank" class="text-blue-600 hover:underline">www.gob.mx/curp</a>.
                                Asegúrate de que sea la versión digital, no deben ser fotos o capturas de pantalla en formato PDF ya que tomaremos datos a partir de este.
                            </span>
                        </label>
                        <input type="file" name="curp" accept=".pdf" required class="w-full border rounded p-2 mt-1 text-sm">
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Analizar CURP</button>
                </form>
            <?php else: ?>
                <form action="<?= base_url('guardar-aspirante') ?>" method="post" class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
                    <span class="block text-xs font-normal text-gray-500 mt-1">
                        Los datos de CURP, FECHA DE NACIMIENTO, EDAD y GÉNERO se extraen directamente de tu documento CURP anteriormente cargado y no se pueden editar. En caso de encontrar algún error, te pedimos que completes tu registro y luego te pongas en contacto con la Coordinación de Servicios para solicitar la corrección.
                    </span>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Datos precargados -->
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">CURP</label>
                            <input type="text" name="curp" value="<?= esc($curp) ?>" readonly
                                class="w-full bg-gray-50 border border-gray-300 rounded-md px-4 py-2 text-gray-700">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Fecha de nacimiento</label>
                            <input type="date" name="fecha_nacimiento" value="<?= esc($fecha_nacimiento) ?>" readonly
                                class="w-full bg-gray-50 border border-gray-300 rounded-md px-4 py-2 text-gray-700">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Edad</label>
                            <input type="number" name="edad" value="<?= esc($edad) ?>" readonly
                                class="w-full bg-gray-50 border border-gray-300 rounded-md px-4 py-2 text-gray-700">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Género</label>
                            <input type="text" name="genero" value="<?= esc($genero) ?>" readonly
                                class="w-full bg-gray-50 border border-gray-300 rounded-md px-4 py-2 text-gray-700">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Primer Apellido</label>
                            <input type="text" name="primer_apellido" value="<?= esc($primer_apellido) ?>" readonly
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Segundo Apellido</label>
                            <input type="text" name="segundo_apellido" value="<?= esc($segundo_apellido) ?>" readonly
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Nombre</label>
                            <input type="text" name="nombre" value="<?= esc($nombre) ?>" readonly
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Correo</label>
                            <span class="block text-xs text-gray-500 mb-1">
                                El correo debe ser personal ya que tu registro se asocia con tu correo.
                            </span>
                            <input type="email" name="correo" required
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Teléfono</label>
                            <input type="tel" name="telefono" required
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Sede Primera opción</label>
                            <select id="sede" name="sede" required
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Selecciona una sede</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Carrera Primera opción</label>
                            <select id="carrera" name="carrera" required
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Selecciona una carrera</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Sede Segunda opción</label>
                            <select id="sede_alt" name="sede_alternativa"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Selecciona una sede</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Carrera Segunda opción</label>
                            <select id="carrera_alt" name="carrera_alternativa"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Selecciona una carrera</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">¿Es Reingreso?</label>
                            <select name="reingreso" required
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Selecciona</option>
                                <option value="Sí">Sí</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="periodo" value="<?= esc($periodo ?? '') ?>">
                    <div class="mt-8 flex justify-center">
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition-colors duration-200 shadow-sm hover:shadow-md border border-blue-700">
                            Guardar Aspirante
                        </button>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </main>

    <!-- End of Footer -->
    <?php echo view('base/template/footer'); ?>


    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>assets/js/core.bundle.js"></script>
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
            cargarSedes('#sede');
            cargarSedes('#sede_alt');
            $('#sede').on('change', function() {
                const sedeId = $(this).val();
                if (sedeId) {
                    cargarCarreras(sedeId, '#carrera');
                } else {
                    $('#carrera').empty().append('<option value="">Selecciona una carrera</option>');
                }
            });
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
</body>

</html>