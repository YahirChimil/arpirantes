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
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Registrar Nueva Convocatoria</h2>

               <?php if (session()->getFlashdata('success')): ?>
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>


                <form method="post" action="<?= site_url('convocatoria/guardar') ?>" class="bg-white shadow rounded-lg p-6 mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Código de Convocatoria</label>
                            <input type="text" name="codigo" class=" mayusculas mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Registro - Inicio</label>
                            <input type="date" name="registro_inicio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Registro - Fin</label>
                            <input type="date" name="registro_fin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Preficha - Inicio</label>
                            <input type="date" name="preficha_inicio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Preficha - Fin</label>
                            <input type="date" name="preficha_fin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Documentos - Inicio</label>
                            <input type="date" name="documentos_inicio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Documentos - Fin</label>
                            <input type="date" name="documentos_fin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Examen - inicio</label>
                            <input type="date" name="examen_inicio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
                            Registrar Convocatoria
                        </button>
                    </div>
                </form>

                <h3 class="text-xl font-semibold text-gray-800 mb-4">Convocatorias Registradas</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 shadow rounded-lg overflow-hidden">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Código</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Registro</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Preficha</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Documentos</th>
                                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Examen de admision</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($convocatorias as $conv): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= esc($conv['codigo']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= esc($conv['registro_inicio']) ?> a <?= esc($conv['registro_fin']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= esc($conv['preficha_inicio']) ?> a <?= esc($conv['preficha_fin']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= esc($conv['documentos_inicio']) ?> a <?= esc($conv['documentos_fin']) ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><?= esc($conv['examen_inicio']) ?> </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($convocatorias)): ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No hay convocatorias registradas.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
                                
    <script>
document.addEventListener('DOMContentLoaded', function () {
    // --- 1. Forzar mayúsculas en campos específicos ---
    document.querySelectorAll('.mayusculas').forEach(function (input) {
        input.addEventListener('input', function () {
            this.value = this.value.toUpperCase();
        });
    });

    // --- 2. No permitir fechas anteriores a hoy ---
    const today = new Date().toISOString().split('T')[0];
    const dateInputs = document.querySelectorAll('input[type="date"]');
    dateInputs.forEach(input => input.setAttribute('min', today));

    // --- 3. Encadenar fechas para que no se pueda seleccionar anterior a la anterior ---
    const fechaCadena = [
        ['registro_inicio', 'registro_fin'],
        ['registro_fin', 'preficha_inicio'],
        ['preficha_inicio', 'preficha_fin'],
        ['preficha_fin', 'documentos_inicio'],
        ['documentos_inicio', 'documentos_fin']
    ];

    fechaCadena.forEach(([anterior, siguiente]) => {
        const campoAnterior = document.querySelector(`[name="${anterior}"]`);
        const campoSiguiente = document.querySelector(`[name="${siguiente}"]`);

        campoAnterior.addEventListener('change', () => {
            if (campoAnterior.value) {
                campoSiguiente.min = campoAnterior.value;
                if (campoSiguiente.value < campoAnterior.value) {
                    campoSiguiente.value = '';
                }
            }
        });
    });
});
</script>



    <!-- End of Scripts -->
     

</body>

</html>