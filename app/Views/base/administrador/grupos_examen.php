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
       
            <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
            <div class="overflow-x-auto">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Crear Nuevo Grupo de Examen</h2>
             <main class="grow content pt-5" id="content" role="content">
                <!-- COMBOBOX: Seleccionar convocatoria -->
<form method="get" action="<?= base_url('grupos-examen') ?>" class="mb-6 w-full md:w-1/3">
    <label class="block mb-1 text-sm font-medium text-gray-700">Convocatoria:</label>
    <select name="convocatoria" class="w-full border rounded px-2 py-1" required>
        <option value="">Selecciona una convocatoria</option>
        <?php foreach ($convocatorias as $conv): ?>
            <option value="<?= esc($conv['codigo']) ?>" <?= ($conv['codigo'] == $convocatoriaSeleccionada) ? 'selected' : '' ?>>
                <?= esc($conv['codigo']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <div class="mt-2 text-right">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Ver aspirantes</button>
    </div>
</form>
<?php if ($convocatoriaSeleccionada): ?>

    <!-- TABLA DE ASPIRANTES SIN GRUPO -->
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Grupos Registrados</h2>

<table class="w-full table-auto border border-gray-300 rounded shadow">
    <thead class="bg-gray-100">
        <tr>
            <th class="border px-4 py-2">Nombre</th>
            <th class="border px-4 py-2">Convocatoria</th>
            <th class="border px-4 py-2">Sede</th>
            <th class="border px-4 py-2">Carrera</th>
            <th class="border px-4 py-2">Aula</th>
            <th class="border px-4 py-2">Fecha</th>
            <th class="border px-4 py-2">Hora</th>
            <th class="border px-4 py-2">Capacidad</th>
            <th class="border px-4 py-2">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($grupos as $grupo): ?>
            <tr class="hover:bg-gray-50">
                <td class="border px-4 py-2"><?= esc($grupo['nombre']) ?></td>
                <td class="border px-4 py-2"><?= esc($grupo['codigo_convocatoria']) ?></td>
                <td class="border px-4 py-2"><?= esc($grupo['nombre_sede']) ?></td>
                <td class="border px-4 py-2"><?= esc($grupo['nombre_carrera']) ?></td>
                <td class="border px-4 py-2"><?= esc($grupo['nombre_aula']) ?></td>
                <td class="border px-4 py-2"><?= date('d/m/Y', strtotime($grupo['fecha'])) ?></td>
                <td class="border px-4 py-2"><?= esc($grupo['hora']) ?></td>
                <td class="border px-4 py-2"><?= esc($grupo['capacidad']) ?></td>
                <td class="border px-4 py-2 text-center">
                    <a href="<?= base_url('grupos-examen/editar/' . $grupo['id']) ?>" 
                       class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 text-sm">
                        Editar
                    </a>
                    <a href="<?= base_url('grupos-examen/aspirantes/' . $grupo['id']) ?>" 
                       class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-sm ml-2">
                        Ver Aspirantes
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


    <!-- CUADROS DE CREACIÓN DE GRUPOS -->
    <h2 class="text-lg font-semibold mb-4">Crear Grupos</h2>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-6">
<?php foreach ($aspirantesSinGrupo as $grupo): ?>
    <div class="bg-white border border-gray-300 shadow-sm rounded-lg p-4">
        <h3 class="text-md font-semibold text-gray-800"><?= esc($grupo['nombre_sede']) ?></h3>
        <p class="text-sm text-gray-600"><?= esc($grupo['nombre_carrera']) ?></p>
        <p class="text-2xl font-bold text-blue-600"><?= esc($grupo['total']) ?> aspirantes</p>

        <form action="<?= base_url('grupos-examen/guardar') ?>" method="post" class="grupo-form mt-3 space-y-2">
    <?= csrf_field() ?>
    <input type="hidden" name="sede_id" value="<?= esc($grupo['sede_id']) ?>">
    <input type="hidden" name="carrera_id" value="<?= esc($grupo['carrera_id']) ?>">
    <input type="hidden" name="codigo_convocatoria" value="<?= esc($convocatoriaSeleccionada) ?>">

    <input type="text" name="nombre" placeholder="Nombre del grupo" required class="w-full border rounded px-2 py-1 text-sm">

    <label for="fecha"  i class="block text-xs font-semibold text-gray-600">Fecha</label>
    <input type="date" name="fecha" required class="w-full border rounded px-2 py-1 text-sm">

    <label for="hora" class="block text-xs font-semibold text-gray-600">Hora</label>
    <input type="time" name="hora" required class="w-full border rounded px-2 py-1 text-sm">

    <select name="aula_id" required class="w-full border rounded px-2 py-1 text-sm">
        <option value="">Aula</option>
        <?php foreach ($aulas as $aula): ?>
            <option value="<?= $aula['id'] ?>"><?= esc($aula['nombre']) ?></option>
        <?php endforeach; ?>
    </select>

    <input type="number" name="capacidad" placeholder="Capacidad" required class="w-full border rounded px-2 py-1 text-sm" min="1" max="100">

    <button type="submit" class="w-full bg-blue-600 text-white py-1 rounded hover:bg-blue-700 text-sm">
        Crear Grupo
    </button>
</form>

    </div>
<?php endforeach; ?>
</div>



<?php endif; ?>






        
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
    $(document).ready(function () {
        $('#sede').on('change', function () {
            const sedeId = $(this).val();

            // Carreras
            $.ajax({
                url: '<?= base_url('getCarrerasPorSede') ?>/' + sedeId,
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    const $carrera = $('#carrera');
                    $carrera.empty().append('<option value="">Selecciona una carrera</option>');
                    data.forEach(c => {
                        $carrera.append('<option value="' + c.id + '">' + c.nombre + '</option>');
                    });
                },
                error: function () {
                    $('#carrera').html('<option value="">Error al cargar</option>');
                }
            });

            // Aulas
            $.ajax({
                url: '<?= base_url('getAulasPorSede') ?>/' + sedeId,
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    const $aula = $('#aula');
                    $aula.empty().append('<option value="">Selecciona un aula</option>');
                    data.forEach(a => {
                        $aula.append('<option value="' + a.id + '">' + a.nombre + '</option>');
                    });
                },
                error: function () {
                    $('#aula').html('<option value="">Error al cargar</option>');
                }
            });
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
<script>
document.addEventListener('DOMContentLoaded', function () {
  const convocatoriaSelect = document.querySelector('select[name="convocatoria"]');
  const fechaInputs = document.querySelectorAll('input[name="fecha"]');

  function formatFecha(fecha) {
    return new Date(fecha).toISOString().split('T')[0];
  }

  convocatoriaSelect.addEventListener('change', function () {
    const codigo = this.value;

    if (!codigo) {
      fechaInputs.forEach(input => {
        input.value = '';
        input.disabled = true;
        input.removeAttribute('min');
        input.removeAttribute('max');
      });
      return;
    }

    fetch(`<?= base_url('getFechasConvocatoria') ?>/${codigo}`)
      .then(response => response.json())
      .then(data => {
        if (data.examen_inicio && data.examen_fin) {
          const min = formatFecha(data.examen_inicio);
          const max = formatFecha(data.examen_fin);

          fechaInputs.forEach(input => {
            input.min = min;
            input.max = max;
            input.disabled = false;
          });
        } else {
          fechaInputs.forEach(input => {
            input.disabled = true;
            input.removeAttribute('min');
            input.removeAttribute('max');
          });
        }
      })
      .catch(error => {
        console.error('Error al obtener fechas:', error);
        fechaInputs.forEach(input => {
          input.disabled = true;
          input.removeAttribute('min');
          input.removeAttribute('max');
        });
      });
  });

  // Si ya hay una convocatoria seleccionada al cargar, forzar cambio
  if (convocatoriaSelect.value) {
    convocatoriaSelect.dispatchEvent(new Event('change'));
  }
});
</script>




    <!-- End of Scripts -->
     

</body>

</html>