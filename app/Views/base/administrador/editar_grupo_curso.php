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
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <main class="grow content pt-5" id="content" role="content">
            <div class="container mx-auto max-w-xl bg-white p-6 rounded shadow">
                <h2 class="text-xl font-bold mb-4">Editar Grupo de Curso <?= esc($grupo['id']) ?></h2>
                <form method="post" action="<?= base_url('grupos/actualizar/' . $grupo['id']) ?>">
                    <?= csrf_field() ?>

                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium">Nombre del grupo</label>
                        <input type="text" name="nombre" id="nombre" class="form-input w-full"
                            value="<?= esc($grupo['nombre']) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="capacidad" class="block text-sm font-medium">Capacidad</label>
                        <input type="number" name="capacidad" id="capacidad" class="form-input w-full"
                            value="<?= esc($grupo['capacidad']) ?>" required>
                    </div>

                    <!-- Hora inicio -->
                    <div class="mb-4">
                        <label for="hora_inicio" class="block text-sm font-medium">Hora inicio</label>
                        <input type="time" name="hora_inicio" id="hora_inicio" class="form-input w-full"
                            value="<?= esc($grupo['hora_inicio']) ?>" required min="07:00" max="20:00">
                    </div>

                    <!-- Hora fin -->
                    <div class="mb-4">
                        <label for="hora_fin" class="block text-sm font-medium">Hora fin</label>
                        <input type="time" name="hora_fin" id="hora_fin" class="form-input w-full"
                            value="<?= esc($grupo['hora_fin']) ?>" required min="07:00" max="20:00">
                    </div>

                    <div class="mb-4">
                        <label for="tipo" class="block text-sm font-medium">Tipo</label>
                        <input type="text" name="tipo" id="tipo" class="form-input w-full"
                            value="<?= esc($grupo['tipo']) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="catedratico" class="block text-sm font-medium">Catedrático</label>
                        <input type="text" name="catedratico" id="catedratico" class="form-input w-full"
                            value="<?= esc($grupo['catedratico']) ?>">
                    </div>

                    <div class="mb-4">
                        <label for="sede_id" class="block text-sm font-medium">Sede</label>
                        <select name="sede_id" id="sede_id" class="form-select w-full" required>
                            <?php foreach ($sedes as $sede): ?>
                                <option value="<?= $sede['id_sede'] ?>"
                                    <?= $grupo['sede'] == $sede['id_sede'] ? 'selected' : '' ?>>
                                    <?= esc($sede['nombre_sede']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="aula_id" class="block text-sm font-medium">Aula</label>
                        <select name="aula_id" id="aula_id" class="form-select w-full" required>
                            <?php foreach ($aulas as $aula): ?>
                                <option value="<?= $aula['id'] ?>" <?= $grupo['aula'] == $aula['id'] ? 'selected' : '' ?>>
                                    <?= esc($aula['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="carrera_id" class="block text-sm font-medium">Carrera</label>
                        <select name="carrera_id" id="carrera_id" class="form-select w-full" required>
                            <?php foreach ($carreras as $carrera): ?>
                                <option value="<?= $carrera['id'] ?>" <?= $grupo['carrera'] == $carrera['id'] ? 'selected' : '' ?>>
                                    <?= esc($carrera['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-full">Actualizar Grupo</button>
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