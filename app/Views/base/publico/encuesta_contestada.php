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
            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>
            <div class="container mt-5">
                <div class="alert alert-warning text-center" role="alert">
                    <h4 class="alert-heading">¡Encuesta ya respondida!</h4>
                    <p>Gracias por participar. Ya hemos registrado tus respuestas.</p>
                    <hr>
                    <p class="mb-0">Si necesitas hacer alguna corrección, comunícate con el administrador.</p>
                </div>

                <div class="text-center mt-4">
                    <p>Estado de preficha:
                        <strong class="<?= $estadoPreficha && $fechaPreficha ? 'text-success' : 'text-danger' ?>">
                            <?= $estadoPreficha && $fechaPreficha ? 'Disponible' : 'No disponible' ?>
                        </strong>
                    </p>

                    <?php if ($estadoPreficha): ?>
                        <div class="alert alert-success text-center mt-3" role="alert">
                            <p>¡Tu pago ya se ha reflejado correctamente!</p>
                        </div>
                    <?php endif; ?>

                    <?php if ($estadoPreficha && $fechaPreficha): ?>
                        <a href="<?= site_url('aspirantes/preficha') ?>" target="_blank" class="btn btn-primary mt-3">
                            Descargar ficha
                        </a>
                        <a href="<?= site_url('aspirantes/referencia-bancaria') ?>" target="_blank" class="btn btn-outline-second mt-3 ml-2">
                            Descargar referencia bancaria
                        </a>
                    <?php else: ?>
                        <button class="btn btn-secondary mt-3" disabled>
                            Todavía no tengo fecha de entrega
                        </button>
                    <?php endif; ?>
                </div>




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