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
                    <!-- begin: grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 lg:gap-7.5">
                        <div class="col-span-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="flex lg:px-10 py-1.5 gap-2">
                                        <div class="grid grid-cols-1 place-content-center flex-1 gap-1 text-center">
                                            <span class="text-gray-900 text-2xl lg:text-2.5xl leading-none font-semibold">
                                                <span class="badge badge-outline 
                                            <?php if ($repositorio['estatus'] == 'completo') echo 'badge-success'; ?>
                                            <?php if ($repositorio['estatus'] == 'desarrollo') echo 'badge-warning'; ?>
                                            <?php if ($repositorio['estatus'] == 'propuesta') echo 'badge-primary'; ?>
                                            ">
                                                    <?php echo strtoupper($repositorio['estatus']) ?>
                                                </span>
                                            </span>
                                            <span class="text-gray-700 text-sm">
                                                Estatus
                                            </span>
                                        </div>
                                        <span class="[&:not(:last-child)]:border-e border-e-gray-300 my-1">
                                        </span>
                                        <div class="grid grid-cols-1 place-content-center flex-1 gap-1 text-center">
                                            <span class="text-gray-900 text-2xl lg:text-2.5xl leading-none font-semibold">
                                                <?php echo $repositorio['id'] ?>
                                            </span>
                                            <span class="text-gray-700 text-sm">
                                                Archivos
                                            </span>
                                        </div>
                                        <span class="[&:not(:last-child)]:border-e border-e-gray-300 my-1">
                                        </span>
                                        <div class="grid grid-cols-1 place-content-center flex-1 gap-1 text-center">
                                            <span class="text-gray-900 text-2xl lg:text-2.5xl leading-none font-semibold">
                                                1M+
                                            </span>
                                            <span class="text-gray-700 text-sm">
                                                Recursos
                                            </span>
                                        </div>
                                        <span class="[&:not(:last-child)]:border-e border-e-gray-300 my-1">
                                        </span>
                                        <div class="grid grid-cols-1 place-content-center flex-1 gap-1 text-center">
                                            <span class="text-gray-900 text-2xl lg:text-2.5xl leading-none font-semibold">
                                                <?php echo $repositorio['version'] ?>
                                            </span>
                                            <span class="text-gray-700 text-sm">
                                                Version
                                            </span>
                                        </div>
                                        <span class="[&:not(:last-child)]:border-e border-e-gray-300 my-1">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="card">
                                <div class="card-body lg:py-9">
                                    <div class="flex justify-center pb-5">
                                        <img alt="" class="dark:hidden max-h-[170px]" src="<?php echo base_url(); ?>assets/media/illustrations/11.svg" />
                                        <img alt="" class="light:hidden max-h-[170px]" src="<?php echo base_url(); ?>assets/media/illustrations/11-dark.svg" />
                                    </div>
                                    <div class="text-lg font-medium text-gray-900 text-center">
                                        Para empezar agrega un recurso a tu repositorio
                                    </div>
                                    <div class="flex items-center justify-center gap-1">
                                        <span class="text-sm text-gray-700">
                                            Puedes agregar muchos tipos de recurso a tu repositorio.
                                        </span>
                                        <a class="text-sm font-medium link" href="<?php echo base_url(); ?>Recurso/nuevo/<?php echo $repositorio['id'] ?>">
                                            Iniciemos!
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-1 flex">
                            <div class="card pb-3 grow">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Detalles
                                    </h3>
                                </div>
                                <div class="card-body pt-4">
                                    <div class="grid gap-2.5 mb-1">
                                        <div class="flex items-center gap-2.5">
                                            <span class="">
                                                <i class="ki-filled ki-abstract-41 text-lg text-gray-500">
                                                </i>
                                            </span>
                                            <a class="text-gray-900 hover:text-primary-active text-sm" href="#">
                                                Nombre: <?php echo $repositorio['nombre'] ?>
                                            </a>
                                        </div>
                                        <div class="flex items-center gap-2.5">
                                            <span class="">
                                                <i class="ki-filled ki-crown-2 text-lg text-gray-500">
                                                </i>
                                            </span>
                                            <a class="text-gray-900 hover:text-primary-active text-sm" href="#">
                                                Autor: <?php echo $repositorio['autor'] ?>
                                            </a>
                                        </div>
                                        <div class="flex items-center gap-2.5">
                                            <span class="">
                                                <i class="ki-filled ki-briefcase text-lg text-gray-500">
                                                </i>
                                            </span>
                                            <a class="text-gray-900 hover:text-primary-active text-sm" href="#">
                                                UUID: <?php echo $repositorio['uuid'] ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-1 flex">
                            <div class="card grow">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Descripcion
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <p class="text-sm text-gray-800 leading-5.5 mb-4">
                                        <?php echo $repositorio['descripcion'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-1 flex">
                            <div class="card grow">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Estado(s)
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="flex flex-wrap gap-2.5 mb-2">
                                        <?php foreach ($estados as $c) { ?>
                                            <span class="badge badge-sm badge-primary">
                                                <?php echo  $c['nombre'] ?>
                                            </span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-1 flex">
                            <div class="card grow">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Tema(s)
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="flex flex-wrap gap-2.5 mb-2">
                                        <?php foreach ($temas as $c) { ?>
                                            <span class="badge badge-sm badge-success">
                                                <?php echo  $c['clasificacion'] ?> - <?php echo  $c['tema'] ?>
                                            </span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="card">
                                <div class="card-body lg:py-9">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                Projects
                                            </h3>
                                            <div class="menu" data-menu="true">
                                                <div class="menu-item" data-menu-item-offset="0, 10px" data-menu-item-placement="bottom-end" data-menu-item-placement-rtl="bottom-start" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                                                    <button class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
                                                        <i class="ki-filled ki-dots-vertical">
                                                        </i>
                                                    </button>
                                                    <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true">
                                                        <div class="menu-item">
                                                            <a class="menu-link" href="html/demo1/account/home/settings-plain.html">
                                                                <span class="menu-icon">
                                                                    <i class="ki-filled ki-add-files">
                                                                    </i>
                                                                </span>
                                                                <span class="menu-title">
                                                                    Add
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div class="menu-item">
                                                            <a class="menu-link" href="html/demo1/account/members/import-members.html">
                                                                <span class="menu-icon">
                                                                    <i class="ki-filled ki-file-down">
                                                                    </i>
                                                                </span>
                                                                <span class="menu-title">
                                                                    Import
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div class="menu-item" data-menu-item-offset="-15px, 0" data-menu-item-placement="right-start" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:hover">
                                                            <div class="menu-link">
                                                                <span class="menu-icon">
                                                                    <i class="ki-filled ki-file-up">
                                                                    </i>
                                                                </span>
                                                                <span class="menu-title">
                                                                    Export
                                                                </span>
                                                                <span class="menu-arrow">
                                                                    <i class="ki-filled ki-right text-3xs rtl:transform rtl:rotate-180">
                                                                    </i>
                                                                </span>
                                                            </div>
                                                            <div class="menu-dropdown menu-default w-full max-w-[125px]">
                                                                <div class="menu-item">
                                                                    <a class="menu-link" href="html/demo1/account/home/settings-sidebar.html">
                                                                        <span class="menu-title">
                                                                            PDF
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                                <div class="menu-item">
                                                                    <a class="menu-link" href="html/demo1/account/home/settings-sidebar.html">
                                                                        <span class="menu-title">
                                                                            CVS
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                                <div class="menu-item">
                                                                    <a class="menu-link" href="html/demo1/account/home/settings-sidebar.html">
                                                                        <span class="menu-title">
                                                                            Excel
                                                                        </span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="menu-item">
                                                            <a class="menu-link" href="html/demo1/account/security/privacy-settings.html">
                                                                <span class="menu-icon">
                                                                    <i class="ki-filled ki-setting-3">
                                                                    </i>
                                                                </span>
                                                                <span class="menu-title">
                                                                    Settings
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
                                                            Project Name
                                                        </th>
                                                        <th class="min-w-40 !font-normal !text-gray-700">
                                                            Progress
                                                        </th>
                                                        <th class="min-w-32 !font-normal !text-gray-700">
                                                            People
                                                        </th>
                                                        <th class="min-w-32 !font-normal !text-gray-700">
                                                            Due Date
                                                        </th>
                                                        <th class="w-[30px]">
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-start">
                                                            <a class="text-sm font-medium text-gray-900 hover:text-primary" href="#">
                                                                Acme software development
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="progress progress-primary">
                                                                <div class="progress-bar" style="width: 60%">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="flex justify-end rtl:justify-start shrink-0">
                                                                <div class="flex -space-x-2">
                                                                    <div class="flex">
                                                                        <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="assets/media/avatars/300-4.png" />
                                                                    </div>
                                                                    <div class="flex">
                                                                        <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="assets/media/avatars/300-1.png" />
                                                                    </div>
                                                                    <div class="flex">
                                                                        <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="assets/media/avatars/300-2.png" />
                                                                    </div>
                                                                    <div class="flex">
                                                                        <span class="relative inline-flex items-center justify-center shrink-0 rounded-full ring-1 font-semibold leading-none text-3xs size-6 text-success-inverse ring-success-light bg-success">
                                                                            +3
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-sm font-medium text-gray-700">
                                                            24 Aug, 2024
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
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-search-list">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    View
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-file-up">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Export
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-separator">
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-pencil">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Edit
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-copy">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Make a copy
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-separator">
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-trash">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Remove
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-start">
                                                            <a class="text-sm font-medium text-gray-900 hover:text-primary" href="#">
                                                                Strategic Partnership Deal
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="progress">
                                                                <div class="progress-bar" style="width: 100%">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="flex justify-end rtl:justify-start shrink-0">
                                                                <div class="flex -space-x-2">
                                                                    <div class="flex">
                                                                        <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="assets/media/avatars/300-1.png" />
                                                                    </div>
                                                                    <div class="flex">
                                                                        <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="assets/media/avatars/300-2.png" />
                                                                    </div>
                                                                    <div class="flex">
                                                                        <span class="hover:z-5 relative inline-flex items-center justify-center shrink-0 rounded-full ring-1 font-semibold leading-none text-3xs size-6 text-danger-inverse ring-danger-light bg-danger">
                                                                            M
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-sm font-medium text-gray-700">
                                                            10 Sep, 2024
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
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-search-list">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    View
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-file-up">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Export
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-separator">
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-pencil">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Edit
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-copy">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Make a copy
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-separator">
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-trash">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Remove
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-start">
                                                            <a class="text-sm font-medium text-gray-900 hover:text-primary" href="#">
                                                                Client Onboarding
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="progress progress-primary">
                                                                <div class="progress-bar" style="width: 20%">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="flex justify-end rtl:justify-start shrink-0">
                                                                <div class="flex -space-x-2">
                                                                    <div class="flex">
                                                                        <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="assets/media/avatars/300-20.png" />
                                                                    </div>
                                                                    <div class="flex">
                                                                        <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="assets/media/avatars/300-7.png" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-sm font-medium text-gray-700">
                                                            19 Sep, 2024
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
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-search-list">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    View
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-file-up">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Export
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-separator">
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-pencil">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Edit
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-copy">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Make a copy
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-separator">
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-trash">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Remove
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-start">
                                                            <a class="text-sm font-medium text-gray-900 hover:text-primary" href="#">
                                                                Widget Supply Agreement
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="progress progress-success">
                                                                <div class="progress-bar" style="width: 100%">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="flex justify-end rtl:justify-start shrink-0">
                                                                <div class="flex -space-x-2">
                                                                    <div class="flex">
                                                                        <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="assets/media/avatars/300-6.png" />
                                                                    </div>
                                                                    <div class="flex">
                                                                        <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="assets/media/avatars/300-23.png" />
                                                                    </div>
                                                                    <div class="flex">
                                                                        <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="assets/media/avatars/300-12.png" />
                                                                    </div>
                                                                    <div class="flex">
                                                                        <span class="relative inline-flex items-center justify-center shrink-0 rounded-full ring-1 font-semibold leading-none text-3xs size-6 text-primary-inverse ring-primary-light bg-primary">
                                                                            +1
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-sm font-medium text-gray-700">
                                                            5 May, 2024
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
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-search-list">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    View
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-file-up">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Export
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-separator">
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-pencil">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Edit
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-copy">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Make a copy
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-separator">
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-trash">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Remove
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-start">
                                                            <a class="text-sm font-medium text-gray-900 hover:text-primary" href="#">
                                                                Project X Redesign
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="progress progress-primary">
                                                                <div class="progress-bar" style="width: 80%">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="flex justify-end rtl:justify-start shrink-0">
                                                                <div class="flex -space-x-2">
                                                                    <div class="flex">
                                                                        <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="assets/media/avatars/300-2.png" />
                                                                    </div>
                                                                    <div class="flex">
                                                                        <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="assets/media/avatars/300-15.png" />
                                                                    </div>
                                                                    <div class="flex">
                                                                        <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-6" src="assets/media/avatars/300-18.png" />
                                                                    </div>
                                                                    <div class="flex">
                                                                        <span class="relative inline-flex items-center justify-center shrink-0 rounded-full ring-1 font-semibold leading-none text-3xs size-6 text-success-inverse ring-success-light bg-success">
                                                                            +2
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-sm font-medium text-gray-700">
                                                            1 Feb, 2025
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
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-search-list">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    View
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-file-up">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Export
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-separator">
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-pencil">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Edit
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-copy">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Make a copy
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="menu-separator">
                                                                        </div>
                                                                        <div class="menu-item">
                                                                            <a class="menu-link" href="#">
                                                                                <span class="menu-icon">
                                                                                    <i class="ki-filled ki-trash">
                                                                                    </i>
                                                                                </span>
                                                                                <span class="menu-title">
                                                                                    Remove
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-footer justify-center">
                                            <a class="btn btn-link" href="html/demo1/public-profile/projects/3-columns.html">
                                                All Projects
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