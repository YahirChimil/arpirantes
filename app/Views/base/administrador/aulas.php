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

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Administración de Aulas</h2>

   <form method="post" action="<?= base_url('aulas/guardar') ?>" class="bg-white shadow-md rounded p-6 grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <?= csrf_field() ?>

    <div>
        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre del Aula/Laboratorio</label>
        <input type="text" name="nombre" id="nombre" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <div>
        <label for="capacidad" class="block text-sm font-medium text-gray-700 mb-1">Capacidad</label>
        <input type="number" name="capacidad" id="capacidad"  max="100" min="1" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required min="1">
    </div>

    <div>
        <label for="tipo" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Espacio</label>
        <select name="tipo" id="tipo" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <option value="">Selecciona una opción</option>
            <option value="1">Aula</option>
            <option value="2">Laboratorio</option>
            <option value="3">Laboratorio de Cómputo</option>
            <option value="4">Oficinas Administrativas</option>
        </select>
    </div>

    <div>
        <label for="sede_id" class="block text-sm font-medium text-gray-700 mb-1">Sede</label>
        <select name="sede_id" id="sede" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
             <option value="">Cargando sedes...</option>
            
        </select>

        

    </div>

    <div>
        <label for="disponible" class="block text-sm font-medium text-gray-700 mb-1">¿Disponible?</label>
        <select name="disponible" id="disponible" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <option value="1">Sí</option>
            <option value="0">No</option>
        </select>
    </div>

    <div class="md:col-span-3">
        <label for="observaciones" class="block text-sm font-medium text-gray-700 mb-1">Observaciones</label>
        <textarea name="observaciones" id="observaciones" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
    </div>

    <div class="md:col-span-3 text-right">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
            Guardar Aula
        </button>
    </div>
</form>


    <h3 class="text-xl font-semibold mb-3 text-gray-800">Lista de Aulas Registradas</h3>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left border border-gray-200 shadow-sm rounded-lg">
           <thead class="bg-gray-100">
    <tr>
        <th class="px-4 py-2 border">#</th>
        <th class="px-4 py-2 border">Nombre</th>
        <th class="px-4 py-2 border">Sede</th>
        <th class="px-4 py-2 border">Capacidad</th>
        <th class="px-4 py-2 border">Tipo</th>
        <th class="px-4 py-2 border">Disponible</th>
        <th class="px-4 py-2 border">Observaciones</th>
        <th class="px-4 py-2 border text-center">Acciones</th>
    </tr>
</thead>
<tbody>
    <?php if (!empty($aulas)): ?>
        <?php foreach ($aulas as $index => $aula): ?>
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2 border"><?= $index + 1 ?></td>
                <td class="px-4 py-2 border"><?= esc($aula['nombre']) ?></td>
                <td class="px-4 py-2 border"><?= esc($aula['sede_id']) ?></td>
                <td class="px-4 py-2 border"><?= esc($aula['capacidad']) ?></td>
                <td class="px-4 py-2 border">
                    <?php
                        switch ($aula['tipo']) {
                            case 1: echo 'Aula'; break;
                            case 2: echo 'Laboratorio'; break;
                            case 3: echo 'Laboratorio de Cómputo'; break;
                            case 4: echo 'Oficinas Administrativas'; break;
                            default: echo 'Desconocido';
                        }
                    ?>
                </td>
                <td class="px-4 py-2 border">
                    <?= $aula['disponible'] ? '<span class="text-green-600 font-medium">Sí</span>' : '<span class="text-red-600 font-medium">No</span>' ?>
                </td>
                <td class="px-4 py-2 border"><?= esc($aula['observaciones'] ?? '-') ?></td>
                <td class="px-4 py-2 border text-center">
                    <a href="<?= base_url('aulas/editar/' . $aula['id']) ?>" class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white text-sm px-3 py-1 rounded transition">
                        Editar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8" class="text-center py-4 text-gray-500">No hay aulas registradas.</td>
        </tr>
    <?php endif; ?>
</tbody>

        </table>
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
          <script>
        function validarFormulario() {
            const nombre = document.getElementById("nombre").value.trim();
            const capacidad = document.getElementById("capacidad").value;
            const tipo = document.getElementById("tipo").value;

            if (!nombre || capacidad <= 0 || !tipo) {
                alert("Por favor completa todos los campos correctamente.");
                return false;
            }
            return true;
        }
    </script>                      
    <script>
    $(document).ready(function () {
        $.ajax({
            url: '<?= base_url('getSedes') ?>',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                const $select = $('#sede');
                $select.empty().append('<option value="">Selecciona una sede</option>');
                data.forEach(function (sede) {
                    $select.append('<option value="' + sede.id_sede + '">' + sede.nombre_sede + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error('Error al obtener sedes:', error);
            }
        });
    });
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