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

<body class="antialiased flex h-full text-base text-gray-700 [--tw-page-bg:#fefefe] demo1 sidebar-fixed header-fixed bg-[--tw-page-bg]">    <!-- Theme Mode -->
    
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
            <div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">Encuesta para Aspirantes</h2>

    <form action="<?= base_url('encuesta/guardar') ?>" method="post" class="space-y-6">

        <!-- Datos del aspirante -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-100 p-4 rounded-md shadow">
            <div>
                <label class="block text-sm font-medium">CURP</label>
                <input type="text" name="curp" value="<?= esc($aspirante['curp']) ?>" readonly class="input input-bordered w-full mt-1" />
            </div>
            <div>
                <label class="block text-sm font-medium">Nombre</label>
                <input type="text" value="<?= esc($aspirante['nombre']) ?>" readonly class="input input-bordered w-full mt-1" />
            </div>
            <div>
                <label class="block text-sm font-medium">Primer Apellido</label>
                <input type="text" value="<?= esc($aspirante['primer_apellido']) ?>" readonly class="input input-bordered w-full mt-1" />
            </div>
            <div>
                <label class="block text-sm font-medium">Segundo Apellido</label>
                <input type="text" value="<?= esc($aspirante['segundo_apellido']) ?>" readonly class="input input-bordered w-full mt-1" />
            </div>
            <div>
                <label class="block text-sm font-medium">Genero</label>
                <input type="text" value="<?= esc($aspirante['genero']) ?>" readonly class="input input-bordered w-full mt-1" />
            </div>
            <div>
                <label class="block text-sm font-medium">Fecha de nacimiento</label>
                <input type="text" value="<?= esc($aspirante['fecha_nacimiento']) ?>" readonly class="input input-bordered w-full mt-1" />
            </div>
        </div>

        <!-- Preguntas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach ($preguntas as $pregunta): ?>
                <?php
        // Si ya está en los datos del aspirante, no mostramos esa pregunta
        if (in_array($pregunta['texto'], ['CURP','genero','fecha_nacimiento'])) {
            continue;
        }
    ?>
                <div>
                    <label class="block text-sm font-semibold mb-1">
                        <?= esc($pregunta['texto']) ?>
                    </label>

                    <?php if ($pregunta['tipo_respuesta'] === 'texto'): ?>
                        <input type="text" name="respuestas[<?= $pregunta['id'] ?>]" class="input input-bordered w-full" />

                    <?php elseif ($pregunta['tipo_respuesta'] === 'numero'): ?>
                        <input type="number" name="respuestas[<?= $pregunta['id'] ?>]" class="input input-bordered w-full" />

                    <?php elseif ($pregunta['tipo_respuesta'] === 'opcion' && !empty($pregunta['opciones'])): ?>
                        <select name="respuestas[<?= $pregunta['id'] ?>]" class="select select-bordered w-full">
                            <option value="">Seleccione</option>
                            <?php foreach (explode('|', $pregunta['opciones']) as $opcion): ?>
                                <option value="<?= esc($opcion) ?>"><?= esc($opcion) ?></option>
                            <?php endforeach; ?>
                        </select>

                    <?php elseif ($pregunta['tipo_respuesta'] === 'multiple' && !empty($pregunta['opciones'])): ?>
                        <?php foreach (explode('|', $pregunta['opciones']) as $opcion): ?>
                            <label class="inline-flex items-center mr-3">
                                <input type="checkbox" name="respuestas[<?= $pregunta['id'] ?>][]" value="<?= esc($opcion) ?>" class="checkbox mr-2">
                                <?= esc($opcion) ?>
                            </label>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Botón -->
        <div class="text-center pt-6">
            <button type="submit" class="btn btn-primary px-6 py-2">
                Enviar Encuesta
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
    <script src="<?php echo base_url(); ?>assets/js/core.bundle.js">
    </script>

    <!-- End of Scripts -->
</body>

</html>