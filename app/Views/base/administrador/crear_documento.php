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
        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <!-- filepath: c:\xampp\htdocs\rockstar\rockstar\app\Views\base\administrador\crear_documento.php -->
        <!-- ...existing code arriba... -->
        <main class="grow content pt-5" id="content" role="content">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">




                <!-- Formulario para crear documento -->

                <!-- Tabla de documentos existentes -->
                <h2 class="text-xl text-center font-semibold text-gray-800 mb-6 ">Documentos Existentes</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-max w-full max-w-3xl mx-auto divide-y divide-gray-200 shadow rounded-lg overflow-hidden text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-2 py-2 text-left font-medium text-gray-500 uppercase">Nombre</th>
                                <th class="px-2 py-2 text-left font-medium text-gray-500 uppercase">Descripción</th>
                                <th class="px-2 py-2 text-center font-medium text-gray-500 uppercase">Obligatorio</th>
                                <th class="px-2 py-2 text-center font-medium text-gray-500 uppercase">Activo</th>
                                <th class="px-2 py-2 text-center font-medium text-gray-500 uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($documentos as $doc): ?>
                                <tr>
                                    <td class="px-2 py-2"><?= esc($doc['nombre']) ?></td>
                                    <td class="px-2 py-2"><?= esc($doc['descripcion']) ?></td>
                                    <td class="px-2 py-2 text-center"><?= $doc['obligatorio'] ? 'Sí' : 'No' ?></td>
                                    <td class="px-2 py-2 text-center"><?= $doc['activo'] ? 'Sí' : 'No' ?></td>
                                    <td class="px-2 py-2 text-center">
                                        <a href="<?= base_url('admin/documentos/editar_documento/' . $doc['id']) ?>" class="inline-block bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-xs">
                                            Editar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($documentos)): ?>
                                <tr>
                                    <td colspan="5" class="px-2 py-4 text-center text-gray-400">No hay documentos registrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <h3 class=" text-xl text-center font-semibold text-gray-800 mb-4  align-middle">Registrar Nuevo Documento</h3>

                <form action="<?= base_url('admin/crear_documento') ?>" method="post" class="max-w-lg mx-auto bg-white p-6 rounded shadow space-y-4 mb-10">
                    <?= csrf_field() ?>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del documento <span class="text-red-500">*</span></label>
                        <input type="text" name="nombre" required maxlength="100" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción <span class="text-red-500">*</span></label>
                        <textarea name="descripcion" required maxlength="255" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">¿Obligatorio?</label>
                        <select name="obligatorio" class="w-full border border-gray-300 rounded px-3 py-2">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">¿Activo?</label>
                        <select name="activo" class="w-full border border-gray-300 rounded px-3 py-2">
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">Guardar Documento</button>
                    </div>
                </form>

            </div>
        </main>
        <!-- ...existing code abajo... -->
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





<!-- End of Scripts -->


</body>

</html>