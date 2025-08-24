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
    <header class="w-full bg-orange-400 py-4 shadow mb-6">
        <div class="max-w-6xl mx-auto px-4 flex flex-row items-center justify-between">
            <!-- Logo izquierdo -->
            <div class="flex-shrink-0">
                <img src="<?= base_url(); ?>images/logos/logo_cliente.png" alt="Logo izquierdo" class="h-20 w-auto">
            </div>
            <!-- Título -->
            <div class="flex-1 flex flex-col items-center">
                <h2 class="text-2xl font-semibold text-gray-800 mb-1">Instituto Tecnológico de Oaxaca</h2>
                <span class="text-base font-normal text-gray-700">Registro de Aspirante - Convocatoria: <?= esc($periodo ?? '') ?></span>
                <span class="block mt-2">
                    <strong>¿Ya estás registrado o culminaste tu registro?</strong>
                    Ingresa al sistema para consultar tu avance o descargar tus documentos.
                    <a href="<?= base_url('/') ?>" class="underline text-blue font-semibold hover:text-blue-200 ml-1">Haz clic aquí para entrar</a>
                </span>
            </div>
            <!-- Logo derecho -->
            <div class="flex-shrink-0">
                <img src="<?= base_url(); ?>images/logos/logo_ito.png" alt="Logo derecho" class="h-20 w-auto">
            </div>
        </div>
    </header>

    <!-- Main -->
    <main class="grow content pt-5" id="content" role="content">
        <div class="max-w-5xl mx-auto mt-8 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                Bienvenido Aspirante comienza tu registro.
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
                        <label class="block text-lg font-medium text-gray-700 mb-1">
                            Carga tu CURP en formato PDF <span class="text-red-500">*</span>
                            <span class="block text-base font-normal text-gray-500 mt-1">
                                Descárgala desde el sitio oficial:
                                <a href="https://www.gob.mx/curp" target="_blank" class="text-blue-600 hover:underline font-medium ">www.gob.mx/curp</a>.
                                Asegúrate de que sea la versión digital, no deben ser fotos o capturas de pantalla en formato PDF ya que tomaremos datos a partir de este.
                            </span>
                            <span class="block text-xs text-red-500 mb-2">
                                Los campos marcados con <span class="font-bold">*</span> son obligatorios.
                            </span>

                        </label>
                        <input type="file" name="curp" accept=".pdf" required class="w-full border rounded p-2 mt-1 text-sm font-sans">
                        <span class="text-red-500 text-xs font-bold mt-1 block">* Este campo es obligatorio.</span>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition font-sans">Analizar CURP</button>
                </form>
            <?php else: ?>
                <form action="<?= base_url('guardar-aspirante') ?>" method="post" class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
                    <span class="block text-sm font-normal text-gray-500 mt-1">
                        <strong>Aviso:</strong> Los datos <b>CURP, FECHA DE NACIMIENTO, EDAD, GÉNERO Y NOMBRE COMPLETO</b> se extraen directamente de tu documento CURP y <b>no se pueden editar</b>.
                        Si existe un error en estos campos, completa tu registro y contacta a la <b>Coordinación de Servicios e Internet al correo
                            <a href="mailto:soporte@itoaxaca.edu.mx" target="_blank" class="text-blue-700 underline font-semibold" onclick="navigator.clipboard.writeText('soporte@itoaxaca.edu.mx'); return false;">soporte@itoaxaca.edu.mx</a></b> para solicitar la corrección. Los demás datos solicitados son responsabilidad del aspirante y deben ser ingresados correctamente.

                    </span>
                    <span class="block text-xs text-red-500 mb-2">
                        Los campos marcados con <span class="font-bold">*</span> son obligatorios.
                    </span>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        <!-- Datos precargados como etiquetas y ocultos como input -->
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">CURP</label>
                            <span class="block px-4 py-2 text-gray-700 font-semibold"><?= esc($curp) ?></span>
                            <input type="hidden" name="curp" value="<?= esc($curp) ?>">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Fecha de nacimiento</label>
                            <span class="block px-4 py-2 text-gray-700 font-semibold"><?= esc($fecha_nacimiento) ?></span>
                            <input type="hidden" name="fecha_nacimiento" value="<?= esc($fecha_nacimiento) ?>">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Edad</label>
                            <span class="block px-4 py-2 text-gray-700 font-semibold"><?= esc($edad) ?></span>
                            <input type="hidden" name="edad" value="<?= esc($edad) ?>">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Género</label>
                            <span class="block px-4 py-2 text-gray-700 font-semibold"><?= esc($genero) ?></span>
                            <input type="hidden" name="genero" value="<?= esc($genero) ?>">
                        </div>
                        <!-- Campos editables -->
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Primer Apellido</label>
                            <span class="block px-4 py-2 text-gray-700 font-semibold"><?= esc($primer_apellido) ?></span>
                            <input type="hidden" name="primer_apellido" value="<?= esc($primer_apellido) ?>">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Segundo Apellido</label>
                            <span class="block px-4 py-2 text-gray-700 font-semibold"><?= esc($segundo_apellido) ?></span>
                            <input type="hidden" name="segundo_apellido" value="<?= esc($segundo_apellido) ?>">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Nombre</label>
                            <span class="block px-4 py-2 text-gray-700 font-semibold"><?= esc($nombre) ?></span>
                            <input type="hidden" name="nombre" value="<?= esc($nombre) ?>">
                        </div>

                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Correo <span class="text-red-500">*</span></label>
                            <span class="block text-xs text-gray-500 mb-1">
                                El correo debe ser personal ya que tu registro se asocia con tu correo.
                            </span>
                            <input type="email" name="correo" required
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Teléfono <span class="text-red-500">*</span></label>
                            <input type="tel" name="telefono" required
                                pattern="[0-9]{10}"
                                maxlength="10"
                                inputmode="numeric"
                                title="Ingresa un número de teléfono de 10 dígitos"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                            <span class="text-xs text-gray-500">Debe contener exactamente 10 dígitos numéricos.</span>
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Sede Primera opción <span class="text-red-500">*</span></label>
                            <select id="sede" name="sede" required
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Selecciona una sede</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Carrera Primera opción <span class="text-red-500">*</span></label>
                            <select id="carrera" name="carrera" required
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Selecciona una carrera</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Sede Segunda opción<span class="text-red-500">*</span></label>
                            <select id="sede_alt" name="sede_alternativa"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Selecciona una sede</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">Carrera Segunda opción<span class="text-red-500">*</span></label>
                            <select id="carrera_alt" name="carrera_alternativa"
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Selecciona una carrera</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700 mb-1">¿Es Reingreso?<span class="text-red-500">*</span></label>
                            <select name="reingreso" required
                                class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Selecciona</option>

                                <option value="NO">No, nunca he estado inscrito en algún plantel del Tecnológico Nacional de México.</option>
                                <option value="SI AUTORIZADO">Sí, pero ya cuento con mi baja autorizada por comité académico.</option>
                                <option value="SI TITULADO">Sí, pero ya cuento con mi Título y cédula o acta de examen profesional.</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="periodo" value="<?= esc($periodo ?? '') ?>">
                    <div class="mt-6">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="datos_verificados" required class="form-checkbox text-blue-600">
                            <span class="ml-2 text-gray-700 text-sm">
                                Declaro que los datos proporcionados son verdaderos y correctos. Si miento, se me aplicarán las sanciones conforme al reglamento institucional.
                                <span class="text-red-500 font-bold">*</span>
                            </span>
                        </label>
                    </div>
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