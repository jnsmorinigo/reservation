<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">{{ __('Welcome to the Employee Schedule Management System') }}
                    </h3>
                    <p class="mb-6">{{ __('Here you can manage employee schedules, reservations, and more.') }}</p>

                    <h4 class="font-semibold text-md mb-2">Ejercicios:</h4>

                    <ul class="list-disc list-inside mb-4">
                        <!-- Ejercicio 1: Diseño del esquema de la base de datos -->
                        <li>
                            <a href="{{ route('employees.index') }}" target="_blank"
                                class="text-blue-600 hover:underline">
                                Diseñar el esquema de base de datos y cargar los datos de empleados y reservas
                            </a>
                        </li><br>

                        <!-- Ejercicio 2: Consulta de horarios reservados y disponibles -->
                        <li>
                            <a href="{{ route('employees.time-blocks') }}?start_time=09:00:00 2024-11-02&end_time=17:00:00 2024-11-08"
                                target="_blank" class="text-blue-600 hover:underline">
                                Implementar consulta de empleados disponibles y reservados en un intervalo de tiempo
                            </a>
                        </li><br>

                        <!-- Ejercicio 3: Buscar empleado disponible en una fecha y hora específicas -->
                        <li>
                            <a href="{{ route('employees.check-availability-api') }}?date_time=09:00:00 2024-11-01"
                                target="_blank" class="text-blue-600 hover:underline">
                                Buscar empleado disponible en una fecha y hora específica (zona horaria New York)
                            </a>
                        </li><br>

                        <!-- Ejercicio 4: Generar reporte Excel -->
                        <li>
                            <a href="{{ route('employees.reportListHours') }}?start_date=09:00:00 2024-10-02&end_date=17:00:00 2024-10-08&type=available"
                                target="_blank" class="text-blue-600 hover:underline">
                                Generar reporte descargable en Excel (horas disponibles y reservadas)<br>
                                <code>params:?start_date=09:00:00 2024-10-02&end_date=17:00:00
                                    2024-10-08&type=available</code>
                            </a>
                        </li><br>

                        <li>
                            <a href="{{ route('employees.reportEmployeesStatus') }}?start_date=09:00:00 2024-10-02&end_date=17:00:00 2024-10-08"
                                target="_blank" class="text-blue-600 hover:underline">
                                Generar reporte descargable en Excel (Estados empleados)<br>
                                <code>params:?start_date=09:00:00 2024-10-02&end_date=17:00:00 2024-10-08</code>
                            </a>
                        </li><br>

                        <!-- Bonus: Mandar correo con el horario de un empleado -->
                        <li>
                            <form action="{{ route('employees.send-schedule-email-api', ['id' => 1]) }}" method="POST"
                                target="_blank">
                                @csrf
                                <input type="hidden" name="date" value="2024-10-01">
                                <button type="submit" class="text-blue-600 hover:underline">
                                    Mandar correo con el horario de un día completo de un empleado
                                    <br>
                                    <code>params:?date=2024-11-01</code>
                                </button>
                            </form>
                        </li><br>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
