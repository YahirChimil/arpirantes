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
                    <div class="grid gap-5 lg:gap-7.5">
                        <!-- begin: cards -->
                        <div id="integrations_cards">
                            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5 lg:gap-7.5">
                                

                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/brand-logos/chrome.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Liga de internet
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir una serie de campos para una link de internet.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-primary">facil</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_link/<?php echo $id ?>/link">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/file-types/excel.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Base de datos en csv
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir un archivo csv para su posterior consulta, no tiene un formato especifico de columnas
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-primary">facil</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_csv/<?php echo $id ?>/csv">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/file-types/excel.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Base de datos en excel
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir un archivo xlsx para su posterior consulta, no tiene un formato especifico de columnas
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-primary">facil</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_excel/<?php echo $id ?>/excel">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/file-types/calendar.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Evento
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite agendar un evento en el sistema.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-warning">intermedio</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_evento/<?php echo $id ?>/evento">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/file-types/map.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Mapa base/capa KML
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir un archivo kml para ver como capa en un mapa y para descarga.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-warning">intermedio</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_kml/<?php echo $id ?>/kml">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/file-types/map.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Mapa base/capa Geojson
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir un archivo geojson para ver como capa en un mapa y para descarga.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-warning">intermedio</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_geojson/<?php echo $id ?>/geojson">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/file-types/map.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Coordenada decimal
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite agergar una coordenada decimal (latitud, longitud) para consulta en mapa.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-warning">intermedio</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_coordenada/<?php echo $id ?>/coordenada">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/file-types/municipio.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Municipio
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite agergar un municipio inegi a tu Repositorio, esto clasifica las busquedas.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-warning">intermedio</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_municipio/<?php echo $id ?>/municipio">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/brand-logos/bitsane.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Investigacion cientifica (Articulo)
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir una serie de campos especializados para una investigacion cientifica.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-danger">avanzado</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_articulo/<?php echo $id ?>/articulo">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/brand-logos/bitsane.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Investigacion cientifica (Tesis)
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir una serie de campos especializados para una tesis.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-danger">avanzado</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_tesis/<?php echo $id ?>/tesis">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/brand-logos/bitsane.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Investigacion cientifica (Libro)
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir una serie de campos especializados de un libro.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-danger">avanzado</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_libro/<?php echo $id ?>/libro">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/brand-logos/bitsane.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Investigacion cientifica (Capitulo de libro)
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir una serie de campos especializados de un capitulo de libro.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-danger">avanzado</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_libro_capitulo/<?php echo $id ?>/libro_capitulo">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/brand-logos/bitsane.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Congreso, seminario, simposio o conferencia.
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir una serie de campos especializados de un congreso, seminario, simposio o conferencia.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-danger">avanzado</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_congreso/<?php echo $id ?>/congreso">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/brand-logos/bitsane.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Proyecto de investigacion.
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir una serie de campos especializados de un proyecto de investigacionen proceso.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-danger">avanzado</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_proyecto_investigacion/<?php echo $id ?>/proyecto_investigacion">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/file-types/doc.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Documento DOCX
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir un archivo docx (word) para ver como descarga.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-warning">intermedio</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_doc/<?php echo $id ?>/doc">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/file-types/image.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Imagen / Fotografia
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir un archivo de imagen (jpeg, jpg, png) para visualizar en la plataforma.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-warning">facil</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_imagen/<?php echo $id ?>/imagen">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/file-types/mail.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Correo electronico
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite agregar un correo electronico de contacto al recurso.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-warning">facil</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_correo/<?php echo $id ?>/correo">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/file-types/mp3.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Audio / Musica
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir un archivo de audio (mp3, wav) para visualizar en la plataforma.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-warning">intermedio</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_audio/<?php echo $id ?>/audio">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/file-types/pdf.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Documento PDF
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir un archivo PDF para visualizar en la plataforma.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-warning">facil</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_pdf/<?php echo $id ?>/pdf">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/file-types/powerpoint.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Documento de Presentacion PowerPoint
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir un archivo PPTX para visualizar en la plataforma.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-warning">facil</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_pptx/<?php echo $id ?>/pptx">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/file-types/sql.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Base de datos SQL
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir un archivo SQL para descarga en la plataforma.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-warning">avanzado</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_sql/<?php echo $id ?>/sql">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/file-types/video-1.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Archivo de video
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir un archivo de video en formato mp4 para visualizar en la plataforma.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-warning">facil</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_video/<?php echo $id ?>/video">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/file-types/video.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Video de Youtube
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir un link de youtube para visualizar video en la plataforma.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-warning">facil</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_youtube/<?php echo $id ?>/youtube">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body p-5 lg:p-7.5">
                                        <div class="flex items-center justify-between mb-3 lg:mb-5">
                                            <div class="flex items-center justify-center">
                                                <img alt="" class="h-11 shrink-0" src="<?php echo base_url(); ?>assets/media/file-types/zip.svg" />
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1 lg:gap-2.5">
                                            <p class="text-base font-smedium text-gray-900 hover:text-primary-active">
                                                Archivo comprimido
                                            </p>
                                            <span class="text-2sm text-gray-700">
                                                Este recurso te permite subir un archivo comprimido (zip) para su descarga en la plataforma.
                                            </span>

                                        </div>
                                        <span class="badge badge-outline badge-warning">intermedio</span>
                                    </div>
                                    <div class="card-footer justify-between items-center py-3.5">
                                        <a class="btn btn-light btn-sm" href="<?php echo base_url(); ?>Recurso/agregar_zip/<?php echo $id ?>/zip">
                                            <i class="ki-filled ki-mouse-square">
                                            </i>
                                            Agregar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end: cards -->
                        <div class="grid lg:grid-cols-2 gap-5 lg:gap-7.5">
                            <div class="card">
                                <div class="card-body px-10 py-7.5 lg:pr-12.5">
                                    <div class="flex flex-wrap md:flex-nowrap items-center gap-6 md:gap-10">
                                        <div class="flex flex-col items-start gap-3">
                                            <h2 class="text-1.5xl font-medium text-gray-900">
                                                ¿ Preguntas ?
                                            </h2>
                                            <p class="text-sm text-gray-800 leading-5.5 mb-2.5">
                                                Visite nuestro centro de manuales donde encontrara la capacitacion sobre el sistema
                                            </p>
                                        </div>
                                        <img alt="image" class="dark:hidden max-h-[150px]" src="<?php echo base_url(); ?>assets/media/illustrations/29.svg" />
                                        <img alt="image" class="light:hidden max-h-[150px]" src="<?php echo base_url(); ?>assets/media/illustrations/29-dark.svg" />
                                    </div>
                                </div>
                                <div class="card-footer justify-center">
                                    <a class="btn btn-link" href="<?php echo base_url(); ?>">
                                        Ir a centro de manuales
                                    </a>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body px-10 py-7.5 lg:pr-12.5">
                                    <div class="flex flex-wrap md:flex-nowrap items-center gap-6 md:gap-10">
                                        <div class="flex flex-col items-start gap-3">
                                            <h2 class="text-1.5xl font-medium text-gray-900">
                                                Contacte a soporte
                                            </h2>
                                            <p class="text-sm text-gray-800 leading-5.5 mb-2.5">
                                                Necesita asistencia con este tema?
                                            </p>
                                        </div>
                                        <img alt="image" class="dark:hidden max-h-[150px]" src="<?php echo base_url(); ?>assets/media/illustrations/31.svg" />
                                        <img alt="image" class="light:hidden max-h-[150px]" src="<?php echo base_url(); ?>assets/media/illustrations/31-dark.svg" />
                                    </div>
                                </div>
                                <div class="card-footer justify-center">
                                    <a class="btn btn-link" href="mailto:soporte@tecnm.mx">
                                        Contactar a soporte
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
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