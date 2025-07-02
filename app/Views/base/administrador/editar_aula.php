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

           <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Actualizacion de Aulas</h2>

   <form method="post" action="<?= base_url('aulas/actualizar/' . $aula['id']) ?>"  onsubmit="return confirmarEnvio()" class="bg-white shadow-md rounded p-6 grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <?= csrf_field() ?>

    <div>
        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Aula/Laboratorio</label>
        <input type="text" name="nombre" id="nombre" value="<?= esc($aula['nombre']) ?>" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <div>
        <label for="capacidad" class="block text-sm font-medium text-gray-700 mb-1">Capacidad</label>
        <input type="number" name="capacidad" id="capacidad" max="100" min="1" value="<?= esc($aula['capacidad']) ?>" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required min="1">
    </div>

    <div>
        <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Espacio</label>
        <select name="tipo" id="tipo" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <option value="1" <?= $aula['tipo'] == 1 ? 'selected' : '' ?>>Aula</option>
            <option value="2" <?= $aula['tipo'] == 2 ? 'selected' : '' ?>>Laboratorio</option>
            <option value="3" <?= $aula['tipo'] == 3 ? 'selected' : '' ?>>Laboratorio de Cómputo</option>
            <option value="4" <?= $aula['tipo'] == 4 ? 'selected' : '' ?>>Oficinas Administrativas</option>
        </select>
    </div>

    <div>
    <label for="sede" class="block text-sm font-medium text-gray-700 mb-1">Sede</label>
    <select name="sede_id" id="sede" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <?php foreach ($sedes as $sede): ?>
            <option value="<?= $sede['id_sede'] ?>" <?= ($aula['sede_id'] == $sede['id_sede']) ? 'selected' : '' ?>>
                <?= esc($sede['nombre_sede']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>


    <div class="md:col-span-3">
        <label for="observaciones" class="block text-sm font-medium text-gray-700 mb-1">Observaciones</label>
        <textarea name="observaciones" id="observaciones" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"><?= esc($aula['observaciones']) ?></textarea>
    </div>

    <div class="md:col-span-3">
        <label for="disponible" class="inline-flex items-center">
            <input type="checkbox" name="disponible" id="disponible" value="1" <?= $aula['disponible'] ? 'checked' : '' ?> class="mr-2">
            Disponible
        </label>
    </div>

    <div class="md:col-span-3 text-right">
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
            Actualizar Aula
        </button>
    </div>
</form>



</body>

</html>
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
          <script>
    function confirmarEnvio() {
        return confirm('¿Estás seguro de que deseas guardar esta aula con los datos proporcionados?');
    }
</script>
                    
    

<script>
    $(document).ready(function () {
        // Aplica la restricción a todos los inputs numéricos con atributo max o con id específico
        $('input[type="number"]').on('input', function () {
            let max = 100;
            if (parseInt(this.value) > max) {
                this.value = max;
            }
        });

        // Evita subir con la rueda del mouse más allá de 100
        $('input[type="number"]').on('wheel', function (e) {
            let max = 100;
            if (parseInt(this.value) >= max && e.originalEvent.deltaY < 0) {
                e.preventDefault();
            }
        });
    });
</script>

    <!-- End of Scripts -->
     

</body>

</html>