<!--
Product:
Version:
Author:
License:
-->
<!DOCTYPE html>

<html class="h-full" data-theme="true" data-theme-mode="light" dir="ltr" lang="es-mx">

<head>
    <?php echo view('base/template/head'); ?>

</head>

<body class="antialiased flex h-full text-base text-gray-700 [--tw-page-bg:#fefefe] demo1 sidebar-fixed header-fixed bg-[--tw-page-bg]"></body>    <!-- Theme Mode -->

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
           

            <!-- End of Header -->
            <!-- Content -->
            <main class="grow content pt-5" id="content" role="content">
            <div class="max-w-5xl mx-auto mt-8 bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Registro de Aspirante</h2>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <?= session()->getFlashdata('error') ?>
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
            Asegúrate de que sea la version digital, no deben ser fotos o capturas de pantaala en formato PDF.
        </span>
    </label>
    <input type="file" name="curp" accept=".pdf" required class="w-full border rounded p-2 mt-1 text-sm">
</div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Analizar CURP</button>
        </form>

    <!-- Formulario paso 2: Continuar registro -->
    <?php else: ?>
        <form action="<?= base_url('guardar-aspirante') ?>" method="post" class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
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

        <!-- Resto de los campos del formulario (manteniendo el mismo patrón) -->
        <div>
            <label class="block font-medium text-gray-700 mb-1">Primer Apellido</label>
            <input type="text" name="primer_apellido"  value="<?= esc($primer_apellido) ?>" readonly 
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
            <input type="email" name="correo" required 
                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div>
            <label class="block font-medium text-gray-700 mb-1">Teléfono</label>
            <input type="tel" name="telefono" required 
                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>
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

    <!-- Botón centrado con mejor estilo -->
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
</body>

</html>