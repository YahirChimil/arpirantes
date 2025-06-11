<!DOCTYPE html>
<html class="h-full" data-theme="true" dir="ltr" lang="es-mx">
<head>
    <?= view('base/template/head'); ?>
</head>7


<body class="antialiased flex h-full text-base text-gray-700 [--tw-page-bg:#fefefe] demo1 sidebar-fixed header-fixed bg-[--tw-page-bg]">
    
    <div class="flex grow">
        <?= view('base/template/sidebar'); ?>

        <div class="wrapper flex grow flex-col">
            <?= view('base/template/header'); ?>

            <div class="container mx-auto px-4 py-6">
                <h2 class="text-2xl font-bold mb-4">Encuesta para Aspirantes</h2>
                <?php if (session()->getFlashdata('success')): ?>
                    </div>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">¡encuesta registrada con exito! </strong>
        <span class="block sm:inline"><?= session()->getFlashdata('success') ?></span>
    </div>
<?php endif; ?>
<?php if (isset($ya_respondio) && $ya_respondio): ?>
    <div class="alert alert-warning">Ya has respondido esta encuesta.</div>
<?php else: ?>
    <!-- Mostrar formulario -->
<?php endif; ?>




                <form action="<?= base_url('encuesta/guardar') ?>" method="post" class="space-y-6">
                    <!-- Datos del aspirante -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-100 p-4 rounded-md shadow">
                        <div>
                            <label class="block text-sm font-medium">CURP</label>
                            <input type="text" name="curp" value="<?= esc($aspirante['curp']) ?>" readonly class="input input-bordered w-full mt-1" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Nombre</label>
                            <input type="text" value="<?= esc($aspirante['nombre']) ?>" readonly class="input input-bordered w-full mt-1" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Primer Apellido</label>
                            <input type="text" value="<?= esc($aspirante['primer_apellido']) ?>" readonly class="input input-bordered w-full mt-1" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Segundo Apellido</label>
                            <input type="text" value="<?= esc($aspirante['segundo_apellido']) ?>" readonly class="input input-bordered w-full mt-1" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Género</label>
                            <input type="text" value="<?= esc($aspirante['genero']) ?>" readonly class="input input-bordered w-full mt-1" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Fecha de nacimiento</label>
                            <input type="text" value="<?= esc($aspirante['fecha_nacimiento']) ?>" readonly class="input input-bordered w-full mt-1" />
                        </div>
                    </div>

                    <!-- Preguntas con paginación -->
                    <?php
                    $preguntas_filtradas = array_filter($preguntas, fn($p) => !in_array($p['texto'], ['CURP', 'genero', 'fecha_nacimiento']));

                    // Agrupar por sección
                    $secciones = [];
                    foreach ($preguntas_filtradas as $pregunta) {
                        $seccion = $pregunta['seccion'];
                        if (!isset($secciones[$seccion])) {
                            $secciones[$seccion] = [];
                        }
                        $secciones[$seccion][] = $pregunta;
                    }
                    
                    ?>

<div id="secciones-preguntas">
<?php
function renderPregunta($pregunta, $esHija = false) {
    ob_start();
    ?>
    <div class="pregunta <?= $esHija ? 'pregunta-hija hidden' : '' ?>"
         data-pregunta-id="<?= esc($pregunta['id']) ?>"
         <?= isset($pregunta['pregunta_padre']) ? 'data-pregunta-padre="' . esc($pregunta['pregunta_padre']) . '"' : '' ?>>
        <label class="block text-sm font-semibold mb-1"><?= esc($pregunta['texto']) ?></label>

        <?php if ($pregunta['tipo_respuesta'] === 'texto'): ?>
            <input type="text" name="respuestas[<?= $pregunta['id'] ?>]" class="input input-bordered w-full" />

        <?php elseif ($pregunta['tipo_respuesta'] === 'numero'): ?>
            <input type="number" name="respuestas[<?= $pregunta['id'] ?>]" class="input input-bordered w-full" />

        <?php elseif ($pregunta['tipo_respuesta'] === 'opcion' && !empty($pregunta['opciones'])): ?>
            <select name="respuestas[<?= $pregunta['id'] ?>]" class="select select-bordered w-full"
                    data-controlador="<?= esc($pregunta['id']) ?>" required>
                <option value="">Seleccione</option>
                <?php foreach (explode('|', $pregunta['opciones']) as $opcion): ?>
                    <option value="<?= esc($opcion) ?>"><?= esc($opcion) ?></option>
                <?php endforeach; ?>
            </select>

        <?php elseif ($pregunta['tipo_respuesta'] === 'multiple' && !empty($pregunta['opciones'])): ?>
            <?php foreach (explode('|', $pregunta['opciones']) as $opcion): ?>
                <label class="inline-flex items-center mr-3">
                    <input type="checkbox" name="respuestas[<?= $pregunta['id'] ?>][]" value="<?= esc($opcion) ?>" class="checkbox mr-2">
                    <?= esc($opcion) ?>
                </label>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
?>
<?php foreach ($secciones as $nombre_seccion => $grupo): ?>
    <div class="seccion-preguntas <?= $nombre_seccion === array_key_first($secciones) ? '' : 'hidden' ?>" data-seccion="<?= esc($nombre_seccion) ?>">
        <h2 class="text-lg font-bold mb-4"><?= esc($nombre_seccion) ?></h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php
            $preguntas_mostradas = [];
            foreach ($grupo as $pregunta) {
                if (isset($pregunta['pregunta_padre'])) continue;
                echo renderPregunta($pregunta);
                $preguntas_mostradas[] = $pregunta['id'];

                foreach ($grupo as $posible_hija) {
                    if (isset($posible_hija['pregunta_padre']) && $posible_hija['pregunta_padre'] == $pregunta['id']) {
                        echo renderPregunta($posible_hija, true);
                        $preguntas_mostradas[] = $posible_hija['id'];
                    }
                }
            }

            foreach ($grupo as $pregunta) {
                if (!in_array($pregunta['id'], $preguntas_mostradas)) {
                    echo renderPregunta($pregunta);
                }
            }
            ?>
        </div>
    </div>
<?php endforeach; ?>


</div>



                    <!-- Botones de navegación -->
                    <div class="flex justify-between mt-6">
                        <button type="button" id="anterior" class="btn btn-secondary" disabled>Anterior</button>
                        <button type="button" id="siguiente" class="btn btn-primary">Siguiente</button>
                    </div>

                    <!-- Botón de envío solo al final -->
                    <div class="text-center pt-6 hidden" id="boton-enviar">
                        <button type="submit" class="btn btn-primary px-6 py-2">
                            Enviar Encuesta
                        </button>
                    </div>
                </form>
            

            <?= view('base/template/footer'); ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?= base_url(); ?>assets/js/core.bundle.js"></script>
    <script>
        let seccionActual = 0;
        const secciones = document.querySelectorAll('.seccion-preguntas');
        const btnAnterior = document.getElementById('anterior');
        const btnSiguiente = document.getElementById('siguiente');
        const btnEnviar = document.getElementById('boton-enviar');

        function mostrarSeccion(index) {
            secciones.forEach((sec, i) => {
                sec.classList.toggle('hidden', i !== index);
            });
            btnAnterior.disabled = index === 0;
            btnSiguiente.classList.toggle('hidden', index === secciones.length - 1);
            btnEnviar.classList.toggle('hidden', index !== secciones.length - 1);
        }

        btnAnterior.addEventListener('click', () => {
            if (seccionActual > 0) {
                seccionActual--;
                mostrarSeccion(seccionActual);
            }
        });

        btnSiguiente.addEventListener('click', () => {
    const seccion = secciones[seccionActual];
    const inputs = seccion.querySelectorAll('select[required], input[required], textarea[required]');
    let valido = true;

    inputs.forEach(input => {
        if (!input.value || input.value.trim() === '') {
            input.classList.add("border-red-500", "border-2");
            valido = false;
        } else {
            input.classList.remove("border-red-500", "border-2");
        }
    });

    if (!valido) {
        alert("Responde todas las preguntas requeridas antes de continuar.");
        return; // No avanzar si no está válido
    }

    if (seccionActual < secciones.length - 1) {
        seccionActual++;
        mostrarSeccion(seccionActual);
    }
});


        mostrarSeccion(seccionActual);
    </script>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("select[data-controlador]").forEach(select => {
        select.addEventListener("change", function () {
            const idControladora = this.dataset.controlador;
            const valor = this.value;

            document.querySelectorAll(`[data-pregunta-padre="${idControladora}"]`).forEach(hija => {
                if (valor === "Sí") {
                    hija.classList.remove("hidden");
                } else {
                    hija.classList.add("hidden");
                    hija.querySelectorAll("input, select, textarea").forEach(input => {
                        input.value = ''; // limpiar si se oculta
                    });
                }
            });
        });
    });
});
</script>
<script>
    document.querySelector("form").addEventListener("submit", function (e) {
        const selects = this.querySelectorAll("select[required]");
        let valido = true;

        selects.forEach(select => {
            if (select.value.trim() === "") {
                select.classList.add("border-red-500", "border-2");
                valido = false;
            } else {
                select.classList.remove("border-red-500", "border-2");
            }
        });

        if (!valido) {
            e.preventDefault();
            alert("Por favor, responde todas las preguntas obligatorias antes de enviar la encuesta.");
        }
    });
</script>

</body>
</html>
