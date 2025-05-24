<header
    class="header fixed top-0 z-10 start-0 end-0 flex items-stretch shrink-0 bg-white border-b border-gray-200"
    data-sticky="true" data-sticky-class="shadow-sm" data-sticky-name="header" id="header">
    <!-- Contenedor principal header -->
    <div class="container-fixed flex justify-between items-stretch lg:gap-4" id="header_container">
        <!-- Logo dispositivo movil  -->
        <div class="flex gap-1 lg:hidden items-center -ms-1">
            <a class="shrink-0" href="#">
                <img class="max-h-[25px] w-full"
                    src="<?php echo base_url(); ?>images/logos/logo_discere_solo_svg_transparente.svg" />
            </a>
            <div class="flex items-center">
                <button class="btn btn-icon btn-light btn-clear btn-sm" data-drawer-toggle="#sidebar">
                    <i class="ki-filled ki-menu">
                    </i>
                </button>
            </div>
        </div>
        <!-- End Logo dispositivo movil -->
        <!--Contenedor cabecera-menu -->
        <div class="flex items-stretch" id="">
            <div class="flex flex-col justify-center gap-4">
                <h2 class="text-1.5xl font-semibold text-gray-900"> <?php echo config_clientname; ?></h2>
            </div>
        </div>
        <!--End Contenedor cabecera-menu-->
        <!-- Topbar -->
        <div class="flex items-center gap-2 lg:gap-3.5">

            <div class="menu" data-menu="true">
                <div class="menu-item" data-menu-item-offset="20px, 10px" data-menu-item-offset-rtl="-20px, 10px"
                    data-menu-item-placement="bottom-end" data-menu-item-placement-rtl="bottom-start"
                    data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                    <div class="menu-toggle btn btn-icon rounded-full">
                        <img alt="" class="size-9 rounded-full border-2 border-success shrink-0"
                            src="<?php echo base_url(); ?>images/foto_perfil/<?php echo $user_info['foto'] ?>">
                        </img>
                    </div>
                    <div class="menu-dropdown menu-default border-gray-300 w-screen max-w-[250px]">
                        <div class="flex items-center justify-between px-5 py-1.5 gap-1.5">
                            <div class="flex items-center gap-2">
                                <img alt="" class="size-14 rounded-full border-2 border-success"
                                    src="<?php echo base_url(); ?>images/foto_perfil/<?php echo $user_info['foto'] ?>">
                                <div class="flex flex-col gap-1.5">
                                    <span class="text-sm text-gray-800 font-semibold leading-none">
                                    <?php echo $user_info['nombre'] ?>
                                    </span>
                                    <a class="text-xs text-gray-600 hover:text-primary font-medium leading-none"
                                        href="#">
                                        <?php echo $user_info['username'] ?>
                                    </a>
                                    <span class="badge badge-xs badge-success badge-outline">
                                        <?php if($user_info['nivel']==0) echo 'Developer'; ?>
                                        <?php if($user_info['nivel']==1) echo 'Administrador'; ?>
                                        <?php if($user_info['nivel']==2) echo 'Docente'; ?>
                                        <?php if($user_info['nivel']==3) echo 'Alumno'; ?>
                                        <?php if($user_info['nivel']==4) echo 'Aspirante'; ?>
                                    </span>
                                </div>
                                </img>
                            </div>
                        </div>
                        <div class="menu-separator">
                        </div>
                        <div class="flex flex-col">
                            <div class="menu-item">
                                <a class="menu-link" href="<?php echo base_url(); ?>Acceso/perfil">
                                    <span class="menu-icon">
                                        <i class="ki-filled ki-notepad-edit">
                                        </i>
                                    </span>
                                    <span class="menu-title">
                                        Modificar perfil
                                    </span>
                                </a>
                                <a class="menu-link" href="<?php echo base_url(); ?>Acceso/perfil">
                                    <span class="menu-icon">
                                        <i class="ki-filled ki-password-check">
                                        </i>
                                    </span>
                                    <span class="menu-title">
                                        Modificar contraseña
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="menu-separator">
                        </div>
                        <div class="flex flex-col">
                            <div class="menu-item px-4 py-1.5">
                                <a class="btn btn-sm btn-light justify-center"
                                    href="<?php echo base_url(); ?>Acceso/logout">
                                    Cerrar sesión
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->
    </div>
    <!-- Contenedor principal header -->
</header>