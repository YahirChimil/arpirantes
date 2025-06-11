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
            <div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Asignación de fechas para entrega de documentación</h1>
    <p class="mb-6 text-gray-600">Consulta el día que te corresponde entregar documentos según tu sede y carrera.</p>

    <table class="min-w-full bg-white border border-gray-200 shadow rounded">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 text-left">Sede</th>
                <th class="px-4 py-2 text-left">Carrera</th>
                <th class="px-4 py-2 text-center">Cantidad</th>
                <th class="px-4 py-2 text-center">Día de entrega</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($grupos as $grupo): ?>
            <tr class="border-t">
                <td class="px-4 py-2"><?= esc($grupo['sede']) ?></td>
                <td class="px-4 py-2"><?= esc($grupo['carrera']) ?></td>
                <td class="px-4 py-2 text-center"><?= $grupo['total'] ?></td>
                <td class="px-4 py-2 text-center"><?= date('d/m/Y', strtotime($grupo['fecha_entrega'])) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

                <!-- End of Container -->
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