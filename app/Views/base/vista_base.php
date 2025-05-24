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
                <!-- Container -->
                <div class="container-fixed" id="content_container">
                </div>
                <!-- End of Container -->
                <!-- Container -->
                <div class="container-fixed">
                    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                        <div class="flex flex-col justify-center gap-2">
                            <h1 class="text-xl font-medium leading-none text-gray-900">
                                <?php echo $titulo; ?>
                            </h1>
                            <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                                <?php echo $miga; ?> :: <?php echo $sub_miga; ?>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <a class="btn btn-sm btn-light" href="#">
                                Boton accion1
                            </a>
                        </div>
                    </div>
                </div>
                <!-- End of Container -->
                <!-- Container -->
                <div class="container-fixed">
                    <!-- begin: grid -->
                    <div class="grid lg:grid-cols-3 gap-y-5 lg:gap-7.5 items-stretch">

                        <div class="lg:col-span-3">
                            <style>
                                .entry-callout-bg {
                                    background-image: url('<?php echo base_url(); ?>images/logos/bg_cliente.png');
                                }

                                .dark .entry-callout-bg {
                                    background-image: url('<?php echo base_url(); ?>images/logos/bg_cliente.png');
                                }
                            </style>
                            <div class="card h-full h-full">
                                <div
                                    class="card-body p-10 bg-[length:80%] rtl:[background-position:-70%_25%] [background-position:175%_25%] bg-no-repeat entry-callout-bg">
                                    <div class="flex flex-col justify-center gap-4">
                                       
                                        <h2 class="text-1.5xl font-semibold text-gray-900">
                                            Bienvenidos a DISCERE CRM
                                            <br />
                                            para el
                                            <a class="link" href="#">
                                                Instituto Tecnológico de Oaxaca
                                            </a>
                                        </h2>
                                        <p class="text-sm font-normal text-gray-700 leading-5.5">
                                            bla bla bla
                                            <br />
                                            templates. Join the KeenThemes community today
                                            <br />
                                            for top-quality designs and resources.
                                        </p>
                                    </div>
                                </div>
                                <div class="card-footer justify-center">
                                    <a class="btn btn-link" href="#">
                                        Ir a xxxxxx
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end: grid -->
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