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



                <form action="<?= base_url('admin/documentos/actualizar_documento/' . $documento['id']) ?>" method="post" class="max-w-lg mx-auto bg-white p-6 rounded shadow space-y-4 mb-10">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= esc($documento['id']) ?>">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del documento <span class="text-red-500">*</span></label>
                        <input type="text" name="nombre" required maxlength="100" value="<?= esc($documento['nombre']) ?>" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción <span class="text-red-500">*</span></label>
                        <textarea name="descripcion" required maxlength="255" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"><?= esc($documento['descripcion']) ?></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">¿Obligatorio?</label>
                        <select name="obligatorio" class="w-full border border-gray-300 rounded px-3 py-2">
                            <option value="1" <?= $documento['obligatorio'] ? 'selected' : '' ?>>Sí</option>
                            <option value="0" <?= !$documento['obligatorio'] ? 'selected' : '' ?>>No</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">¿Activo?</label>
                        <select name="activo" class="w-full border border-gray-300 rounded px-3 py-2">
                            <option value="1" <?= $documento['activo'] ? 'selected' : '' ?>>Sí</option>
                            <option value="0" <?= !$documento['activo'] ? 'selected' : '' ?>>No</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">Actualizar Documento</button>
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