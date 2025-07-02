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
             <?php if (session()->getFlashdata('error')): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">¡Éxito! </strong>
        <span class="block sm:inline"><?= session()->getFlashdata('error') ?></span>
    </div>
<?php endif; ?>
          <main class="grow content pt-5 px-6" id="content" role="main">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">
        Documentación de Aspirantes
    </h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <strong class="font-bold">Éxito:</strong> <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (empty($aspirantes)): ?>
        <p class="text-gray-600">No hay aspirantes con documentos subidos.</p>
    <?php else: ?>
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CURP</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correo</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($aspirantes as $aspirante): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <?= esc($aspirante['curp']) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <?= esc($aspirante['nombre']) . ' ' . esc($aspirante['primer_apellido']) . ' ' . esc($aspirante['segundo_apellido']) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                <?= esc($aspirante['correo']) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                                <a href="<?= base_url('admin/documentos/ver/' . $aspirante['curp']) ?>"
                                   class="inline-flex items-center px-3 py-1.5 border border-blue-600 text-blue-600 text-sm font-medium rounded hover:bg-blue-600 hover:text-white transition">
                                    Ver Documentos
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
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