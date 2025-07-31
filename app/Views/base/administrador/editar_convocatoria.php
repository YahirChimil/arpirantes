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
            <div class="max-w-6xl mx-auto px-4 py-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Editar Convocatoria</h2>
                <form method="post" action="<?= site_url('convocatoria/actualizar/' . $convocatoria['id']) ?>" class="bg-white shadow rounded-lg p-6 mb-8">
                    <?= csrf_field() ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Código de Convocatoria</label>
                            <input type="text" name="codigo" class="mayusculas mt-1 block w-full border-gray-300 rounded-md shadow-sm" required value="<?= esc($convocatoria['codigo']) ?>">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Registro - Inicio</label>
                            <input type="date" name="registro_inicio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required value="<?= esc($convocatoria['registro_inicio']) ?>">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Registro - Fin</label>
                            <input type="date" name="registro_fin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required value="<?= esc($convocatoria['registro_fin']) ?>">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Preficha - Inicio</label>
                            <input type="date" name="preficha_inicio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required value="<?= esc($convocatoria['preficha_inicio']) ?>">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Preficha - Fin</label>
                            <input type="date" name="preficha_fin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required value="<?= esc($convocatoria['preficha_fin']) ?>">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Documentos - Inicio</label>
                            <input type="date" name="documentos_inicio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required value="<?= esc($convocatoria['documentos_inicio']) ?>">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Documentos - Fin</label>
                            <input type="date" name="documentos_fin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required value="<?= esc($convocatoria['documentos_fin']) ?>">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Examen - inicio</label>
                            <input type="date" name="examen_inicio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required value="<?= esc($convocatoria['examen_inicio']) ?>">
                        </div>
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
                            Actualizar Convocatoria
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

<!-- End of Scripts -->
</body>

</html>