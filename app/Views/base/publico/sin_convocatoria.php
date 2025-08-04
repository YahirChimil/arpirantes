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
    <header class="w-full bg-blue-900 py-4 shadow">
        <div class="max-w-5xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between">
            <div class="flex-1 flex flex-col items-center md:items-start">
                <h1 class="text-2xl md:text-3xl font-bold text-white mb-1">Registro de Aspirantes</h1>
                <p class="text-blue-100 text-center md:text-left text-sm md:text-base">
                    Bienvenido al sistema de registro de aspirantes del Instituto Tecnológico de Oaxaca.<br>
                    Aquí podrás iniciar tu proceso de registro, cargar tu CURP y completar tus datos personales para participar en la convocatoria actual.
                </p>
            </div>
            <div class="mt-4 md:mt-0 md:ml-8 flex-shrink-0 relative">
                <div style="
                    background: linear-gradient(90deg, #fff 60%, rgba(255,255,255,0) 100%);
                    border-radius: 1rem;
                    padding: 1rem 2rem 1rem 1rem;
                    display: flex;
                    align-items: center;
                    box-shadow: 0 2px 8px 0 rgba(0,0,0,0.04);
                ">
                    <img class="max-h-[120px] w-auto block" src="<?php echo base_url(); ?>images/logos/logo_cliente.png" alt="Logo cliente" />
                </div>
            </div>
        </div>
    </header>

    <!-- Main -->
    <main class="grow content pt-5" id="content" role="content">
        <div class="container mt-5">
            <div class="alert alert-warning text-center" role="alert">
                <h4 class="alert-heading">Aspirante aun no es tiempo de registrarse</h4>
                <p>Mantente al pendiente con las fechas</p>
                <hr>
                <p class="mb-0">Si tienes alguna duda comunicate con la institucion .</p>
            </div>


        </div>
    </main>


    <!-- End of Footer -->
    <?php echo view('base/template/footer'); ?>


    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>assets/js/core.bundle.js"></script>

</body>

</html>