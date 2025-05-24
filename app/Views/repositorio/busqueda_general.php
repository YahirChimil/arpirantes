<!--
Product:
Version:
Author:
License:
-->
<!DOCTYPE html>

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
                    <!-- begin: grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 lg:gap-7.5">
                        
                        <div class="col-span-2">
                            <div class="card">
                                <div class="card-body lg:py-9">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                Repositorios
                                            </h3>
                                            <div class="menu" data-menu="true">
                                                <div class="menu-item" data-menu-item-offset="0, 10px" data-menu-item-placement="bottom-end" data-menu-item-placement-rtl="bottom-start" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                                                    <button class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
                                                        <i class="ki-filled ki-dots-vertical">
                                                        </i>
                                                    </button>
                                                    <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true">
                                                        <div class="menu-item">
                                                            <a class="menu-link" href="<?php echo base_url(); ?>Repositorio/nuevo">
                                                                <span class="menu-icon">
                                                                    <i class="ki-filled ki-add-files">
                                                                    </i>
                                                                </span>
                                                                <span class="menu-title">
                                                                    Agregar
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-table scrollable-x-auto">
                                            <table class="table text-end">
                                                <thead>
                                                    <tr>
                                                        <th class="text-start min-w-52 !font-normal !text-gray-700">
                                                            Nombre
                                                        </th>
                                                        <th class="min-w-40 !font-normal !text-gray-700">
                                                            Estatus
                                                        </th>
                                                        <th class="min-w-32 !font-normal !text-gray-700">
                                                            Tema
                                                        </th>
                                                        <th class="min-w-32 !font-normal !text-gray-700">
                                                            Estado
                                                        </th>
                                                        <th class="w-[30px]">
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($repositorios as $r) { ?>
                                                    <tr>
                                                        <td class="text-start">
                                                            <a class="text-sm font-medium text-gray-900 hover:text-primary" href="<?php echo base_url(); ?>Repositorio/ver/<?php echo $r['id'] ?>">
                                                                <?php echo $r['nombre'] ?>
                                                            </a>
                                                        </td>
                                                        <td>
                                                        <span class="text-gray-900 text-2xl lg:text-2.5xl leading-none font-semibold">
                                                            <span class="badge badge-outline 
                                                        <?php if ($r['estatus'] == 'completo') echo 'badge-success'; ?>
                                                        <?php if ($r['estatus'] == 'desarrollo') echo 'badge-warning'; ?>
                                                        <?php if ($r['estatus'] == 'propuesta') echo 'badge-primary'; ?>
                                                        ">
                                                                <?php echo strtoupper($r['estatus']) ?>
                                                            </span>
                                                        </span>
                                                        </td>
                                                        <td>
                                                        
                                                            <?php 
                                                            $db = db_connect();
                                                            $query = $db->query('SELECT clasificacion, tema FROM ciit_clasificaciones where deleted = 0 and id in ('. $r['temas'].')');
                                                            $db->close(); 
                                                            $temas = $query->getResultArray(); 
                                                            foreach ($temas as $t) { ?> 
                                                            <span class="badge badge-outline badge-xs badge-primary">
                                                                <?php echo $t['clasificacion'].' -> '.$t['tema']; ?>
                                                            </span>
                                                            <br>
                                                            <?php } ?>
                                                            
                                                        </td>
                                                        <td >
                                                        <?php 
                                                            $db = db_connect();
                                                            $query = $db->query('SELECT nombre FROM ciit_estados where deleted = 0 and id in ('. $r['estado'].')');
                                                            $db->close(); 
                                                            $temas = $query->getResultArray(); 
                                                            foreach ($temas as $t) { ?> 
                                                            <span class="badge badge-outline badge-xs badge-dark">
                                                                <?php echo $t['nombre']; ?>
                                                            </span>
                                                            <br>
                                                            <?php } ?>
                                                        </td>
                                                        <td class="text-start">
                                                            <div class="menu" data-menu="true">
                                                                <div class="menu-item" data-menu-item-offset="0, 10px" data-menu-item-placement="bottom-end" data-menu-item-placement-rtl="bottom-start" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                                                                    <button class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
                                                                        <i class="ki-filled ki-dots-vertical">
                                                                        </i>
                                                                    </button>
                                                                    <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true">
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="<?php echo base_url(); ?>Repositorio/ver/<?php echo $r['id'] ?>">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-search-list">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Ver detalles
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-footer justify-center">
                                            <a class="btn btn-link" href="#">
                                                Busqueda especifica
                                            </a>
                                        </div>
                                    </div>
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