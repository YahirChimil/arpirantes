<!DOCTYPE html>
<html class="h-full" data-theme="true" data-theme-mode="light" dir="ltr" lang="en">

<head>
    <base href="">
    <title>
        <?php if (isset($titulo)) {
            echo $titulo . ' ::';
        } ?> <?php if (isset($titulo)) {
            echo $miga . ' ::';
        } ?>
        <?php echo config_namesystem; ?> :: <?php echo config_clientname; ?> v<?php echo config_version; ?>
    </title>
    <meta charset="utf-8" />
    <meta content="follow, index" name="robots" />
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(); ?>images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url(); ?>images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url(); ?>images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>images/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo base_url(); ?>images/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo base_url(); ?>images/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/vendors/keenicons/styles.bundle.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet" />
</head>

<body class="antialiased flex h-full text-base text-gray-700 dark:bg-coal-500">
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
    <style>
        .branded-bg {
            background-image: url('<?php echo base_url(); ?>images/logos/bg_cliente.png');
        }

        .dark .branded-bg {
            background-image: url('<?php echo base_url(); ?>images/logos/bg_cliente.png');
        }
    </style>
    <div class="grid lg:grid-cols-2 grow">
        <div class="flex justify-center items-center p-8 lg:p-10 order-2 lg:order-1">
            <div class="card max-w-[370px] w-full">
                <form action="<?php echo base_url(); ?>Acceso/login" class="card-body flex flex-col gap-5 p-10" id="sign_in_form" method="post">
                    <div class="text-center mb-2.5">
                    
                        <div class="flex items-center justify-center font-medium p-4">
                            <span class="">
                                <img class="h-[70px] max-w-none"  src="<?php echo base_url(); ?>images/logos/logo_cliente.png" />
                            </span>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 leading-none mb-2.5">
                            Acceder
                        </h3>
                        <!--
                        <div class="flex items-center justify-center font-medium">
                            <span class="text-2sm text-gray-700 me-1.5">
                                ¿Eres aspirante?
                            </span>
                            <a class="text-2sm link" href="">
                                Registrate
                            </a>
                        </div>
    -->
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="border-t border-gray-200 w-full">
                        </span>
                        <span class="text-2xs text-gray-500 font-medium uppercase">
                            ó
                        </span>
                        <span class="border-t border-gray-200 w-full">
                        </span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="form-label font-normal text-gray-900">
                            Usuario
                        </label>
                        <input name="usuario" id="usuario" class="input" placeholder="" type="text" value="admin" />
                    </div>
                    <div class="flex flex-col gap-1">
                        <div class="flex items-center justify-between gap-1">
                            <label class="form-label font-normal text-gray-900">
                                Contraseña
                            </label>
                            <a class="text-2sm link shrink-0"
                                href="#">
                                ¿Perdio su acceso?
                            </a>
                        </div>
                        <div class="input" data-toggle-password="true">
                            <input name="contrasena"  id="contrasena" placeholder="********" type="password" value="4m4r4l3101" />
                        </div>
                    </div>
                    <label class="checkbox-group">
                        <input class="checkbox checkbox-sm" name="check" type="checkbox" value="1" />
                        <span class="checkbox-label">
                            Recordarme
                        </span>
                    </label>
                    <button class="btn btn-primary flex justify-center grow">
                        Acceder
                    </button>
                </form>
            </div>
        </div>
        <div
            class="lg:rounded-xl lg:border lg:border-gray-200 lg:m-5 order-1 lg:order-2 bg-top xxl:bg-center xl:bg-cover bg-no-repeat branded-bg">
            <div class="flex flex-col p-8 lg:p-16 gap-4">
                <a href="#">
                    <img class="h-[28px] max-w-none" src="<?php echo base_url(); ?>images/logos/logo_discere_solo_svg_transparente.svg" />
                </a>
                
                <div class="flex flex-col gap-3">
                    <h3 class="text-2xl font-semibold text-gray-900">
                        Acceso Seguro a Plataforma
                    </h3>
                    <div class="text-base font-medium text-gray-600">
                        Una plataforma robusta, confiable y accesible
                        <br />
                        controla tus procesos
                        <span class="text-gray-900 font-semibold">
                        de la manera mas eficiente
                        </span>
                        solo con DISCERE CRM
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Page -->
    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>assets/js/core.bundle.js">
    </script>

    <!-- End of Scripts -->
</body>

</html>