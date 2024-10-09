<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Database Setup and Data Seeding') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Cargar los datos iniciales de empleados y reservas</h3>

                    <p class="mb-4">
                        Para configurar la base de datos y cargar los datos iniciales, debes ejecutar el siguiente comando en tu terminal:
                    </p>

                    <div class="bg-gray-100 p-4 rounded mb-4">
                        <code class="text-sm text-gray-600">
                            php artisan migrate:fresh --seed
                        </code>
                    </div>

                    <p class="mb-4">
                        Este comando realizará las siguientes acciones:
                    </p>

                    <ul class="list-disc list-inside mb-4">
                        <li>
                            Se eliminará la base de datos actual y se creará una nueva estructura con las migraciones definidas.
                        </li>
                        <li>
                            Se ejecutarán los seeders para insertar al menos 3 empleados y generar 2 meses de horarios.
                        </li>
                        <li>
                            Se generarán al menos 8 reservas para cada empleado en la primera semana de cada mes.
                        </li>
                    </ul>

                    <p class="mb-4">
                        Asegúrate de haber configurado correctamente el archivo <code>.env</code> con la conexión a la base de datos antes de ejecutar el comando.
                    </p>

                    <h4 class="font-semibold text-md mb-2">Instrucciones:</h4>

                    <ol class="list-decimal list-inside mb-4">
                        <li>Ejecuta <code>php artisan migrate:fresh --seed</code> en tu terminal.</li>
                        <li>Revisa que los datos se hayan cargado correctamente en la base de datos.</li>
                        <li>Una vez completado, podrás ver los datos cargados en el sistema de gestión de empleados y reservas.</li>
                    </ol>

                    <p class="text-sm text-gray-500">
                        Para cualquier duda, consulta la documentación o contacta al soporte del sistema.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
