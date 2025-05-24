<!--
Product:
Version:
Author:
License:
-->
<!DOCTYPE html>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<html class="h-full" data-theme="true" data-theme-mode="light" dir="ltr" lang="es-mx">

<head>
    <?php echo view('base/template/head'); ?>

</head>

<body
    class="antialiased flex h-full text-base text-gray-700 [--tw-page-bg:#fefefe] [--tw-page-bg-dark:var(--tw-coal-500)] demo1 sidebar-fixed header-fixed bg-[--tw-page-bg] dark:bg-[--tw-page-bg-dark]">
    <!-- Theme Mode -->
    <script>
        const defaultThemeMode = 'light'; // light|dark|system
        let themeMode;

        if (document.documentElement) {
            if (localStorage.getItem('theme')) {
                themeMode = localStorage.getItem('theme');
            } else if (document.documentElement.hasAttribute('data-theme-mode')) {
                themeMode = document.documentElement.getAttribute('data-theme-mode');
            } else {
                themeMode = defaultThemeMode;
            }

            if (themeMode === 'system') {
                themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }

            document.documentElement.classList.add(themeMode);
        }
    </script>
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
                    <form method="POST" enctype="multipart/form-data">
                        <div class="flex flex-col items-stretch grow gap-5 lg:gap-7.5">
                            <div class="card pb-2.5">
                                <div class="card-header" id="basic_settings">
                                    <h3 class="card-title">
                                        Detalles de recurso
                                    </h3>
                                </div>
                                <div class="card-body grid gap-5">
                                    <div class="w-full">
                                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                            <label class="form-label flex items-center gap-1 max-w-56">
                                                Nombre del repositorio
                                            </label>
                                            <input data-tooltip="#tooltip_nombre" name="nombre" id="nombre"
                                                maxlength="300" minlength="10" class="input" type="text" value="" required />
                                        </div>
                                        <div class="tooltip" id="tooltip_nombre"> El nombre debe tener entre 10 y 300
                                            caracteres. </div>
                                    </div>
                                    <div class="w-full">
                                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                            <label class="form-label flex items-center gap-1 max-w-56">
                                                Descripción
                                            </label>
                                            <textarea class="textarea" name="descripcion" id="descripcion" placeholder="" rows="6" required="required"></textarea>
                                        </div>
                                    </div>
                                    <div class="w-full">
                                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                            <label class="form-label flex items-center gap-1 max-w-56">
                                                Archivo
                                            </label>
                                            <input class="file-input" type="file" name="archivo" id="archivo" required />
                                        </div>
                                    </div>
                                    
                                    <div class="w-full">
                                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                            <label class="form-label flex items-center gap-1 max-w-56">
                                                Palabras clave (tags)
                                            </label>
                                            <input data-tooltip="#tooltip_tags" name="tags" id="tags" minlength="3" class="input" type="text"  value="" required />
                                        </div>
                                        <div class="tooltip" id="tooltip_tags"> Las palabras clave deben ir separadas por comas. </div>
                                    </div>
                                    
                                    <div class="flex justify-end pt-2.5">
                                        <input class="btn btn-primary" value="Crear resurso" type="submit">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
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
    
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2-temas').select2();
        });
    </script>

    <!-- End of Scripts -->
</body>

</html>