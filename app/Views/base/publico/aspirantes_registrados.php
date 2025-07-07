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

<body
    class="antialiased flex h-full text-base text-gray-700 [--tw-page-bg:#fefefe] demo1 sidebar-fixed header-fixed bg-[--tw-page-bg]">
</body> <!-- Theme Mode -->

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
            <table class="table table-bordered w-full">
                <thead>
                    <tr>
                        <th>CURP</th>
                        <th>Nombre Completo</th>
                        <th>Sede</th>
                        <th>Carrera</th>
                        <th>Examen Aprobado</th>
                        <th>Pago Realizado</th>
                        <th>Grupo Nivelacion</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aspirantes as $aspirante): ?>
                        <tr>
                            <td><?= esc($aspirante['curp']) ?></td>
                            <td><?= esc($aspirante['nombre']) . ' ' . esc($aspirante['primer_apellido']) . ' ' . esc($aspirante['segundo_apellido']) ?>
                            </td>
                            <td><?= esc($aspirante['sede']) ?></td>
                            <td><?= esc($aspirante['carrera'] ?? 'No asignada') ?></td>
                            <td><?= $aspirante['examen_aprobado'] ? 'Sí' : 'No' ?></td>
                            <td><?= $aspirante['pago_realizado'] ? 'Sí' : 'No' ?></td>
                            <td><?= !empty($aspirante['grupo_nivelacion']) ? esc($aspirante['grupo_nivelacion']) : 'No asignado' ?>
                            </td>



                            <!-- NUEVO NUEVO -->
                            <td>
                                <a href="<?= base_url('aspirante/editar/' . $aspirante['curp']) ?>"
                                    class="btn btn-sm btn-primary">
                                    Editar
                                </a>

                                <?php if ((int) $aspirante['examen_aprobado'] === 1 && (int) $aspirante['pago_realizado'] === 1): ?>
                                    <a href="<?= base_url('aspirante/asignarGrupoVista/' . $aspirante['curp']) ?>"
                                        class="btn btn-sm btn-success">
                                        Asignar a Grupo
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">Pendiente</span>
                                <?php endif; ?>

                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

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