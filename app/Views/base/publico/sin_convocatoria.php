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

<body class="antialiased flex flex-col min-h-screen text-base text-gray-700 [--tw-page-bg:#fefefe] bg-[--tw-page-bg]">
    <!-- Header con logo y título -->
    <header class="w-full bg-orange-400 py-4 shadow mb-6">
        <div class="max-w-6xl mx-auto px-4 flex flex-row items-center justify-between">
            <!-- Logo izquierdo -->
            <div class="flex-shrink-0">
                <img src="<?= base_url(); ?>images/logos/logo_cliente.png" alt="Logo izquierdo" class="h-20 w-auto">
            </div>
            <!-- Título -->
            <div class="flex-1 flex flex-col items-center">
                <h2 class="text-2xl font-semibold text-gray-800 mb-1">Instituto Tecnológico de Oaxaca</h2>
                <span class="text-base font-normal text-gray-700">Registro de Aspirante - Convocatoria: <?= esc($periodo ?? '') ?></span>
            </div>
            <!-- Logo derecho -->
            <div class="flex-shrink-0">
                <img src="<?= base_url(); ?>images/logos/logo_ito.png" alt="Logo derecho" class="h-20 w-auto">
            </div>
        </div>
    </header>


    <!-- Main -->
    <main class="grow content pt-5" id="content" role="content">
        <div class="container mt-5">
            <div class="alert alert-warning text-center" role="alert">
                <h4 class="alert-heading">Aspirante aun no es tiempo de registrarse</h4>
                Próxima convocatoria: <strong><?= esc($periodo) ?></strong><br>
                y el periodo para registrarse sera <strong><?= esc($registro_inicio) ?></strong> al <strong><?= esc($registro_fin) ?></strong>
                <hr>
                <p class="mb-0">
                    Si tienes alguna duda, acude la institución o visita el
                    <a href="https://www.itoaxaca.edu.mx" target="_blank" class="text-blue-700 underline font-semibold">sitio oficial</a> para más información.
                </p>
            </div>


        </div>
    </main>


    <!-- End of Footer -->
    <?php echo view('base/template/footer'); ?>


    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>assets/js/core.bundle.js"></script>

</body>

</html>