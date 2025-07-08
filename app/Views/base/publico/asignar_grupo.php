<!DOCTYPE html>
<html lang="es-mx">

<head>
    <meta charset="UTF-8">
    <title>Asignar a Grupo</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-800 font-sans">

    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-blue-700">Asignar Aspirante a Grupo de Nivelación</h1>

        <!-- Formulario para crear grupo -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Crear nuevo grupo</h2>
            <form method="post" action="<?= base_url('grupos/crear') ?>" class="flex flex-wrap items-center gap-4">
                <?= csrf_field() ?>
                <input type="text" name="nombre_grupo" placeholder="Nombre del grupo" required
                    class="border border-gray-300 p-3 rounded w-full sm:w-1/3 focus:outline-none focus:ring focus:ring-blue-300">
                <input type="number" name="capacidad" placeholder="Capacidad" required
                    class="border border-gray-300 p-3 rounded w-full sm:w-1/4 focus:outline-none focus:ring focus:ring-blue-300">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 transition">Crear</button>
            </form>
        </div>

        <!-- Lista de grupos -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Grupos disponibles</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto text-sm">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="p-3 text-left">Grupo</th>
                            <th class="p-3 text-left">Capacidad</th>
                            <th class="p-3 text-left">Asignados</th>
                            <th class="p-3 text-left">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($grupos as $grupo): ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3"><?= esc($grupo['nombre']) ?></td>
                                <td class="p-3"><?= esc($grupo['capacidad']) ?></td>
                                <td class="p-3"><?= esc($grupo['asignados']) ?></td>
                                <td
                                    class="p-3 space-y-2 sm:space-y-0 sm:space-x-2 flex flex-col sm:flex-row items-start sm:items-center">
                                    <?php if ($grupo['asignados'] < $grupo['capacidad']): ?>
                                        <form method="post" action="<?= base_url('aspirante/asignarAGrupoFinal') ?>"
                                            class="inline-block">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="curp" value="<?= isset($curp) ? esc($curp) : '' ?>">
                                            <input type="hidden" name="grupo_id" value="<?= esc($grupo['id']) ?>">
                                            <button type="submit"
                                                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                                                Asignar aquí
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-red-600 font-semibold">Grupo lleno</span>
                                    <?php endif; ?>

                                    <a href="<?= base_url('Acceso/aspirante_registrados') ?>"
                                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
                                        ← Volver
                                    </a>

                                    <form method="post" action="<?= base_url('grupos/eliminar/' . $grupo['id']) ?>"
                                        onsubmit="return confirm('¿Eliminar este grupo?')" class="inline-block">
                                        <?= csrf_field() ?>
                                        <button type="submit"
                                            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                                            Eliminar
                                        </button>
                                    </form>

                                    <a href="<?= base_url('grupos/verAspirantes/' . $grupo['id']) ?>"
                                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                                        Ver Aspirantes
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>