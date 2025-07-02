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
            <

            <!-- End of Header -->
            <!-- Content -->
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
