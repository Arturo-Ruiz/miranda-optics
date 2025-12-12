<!-- Create Patient Modal -->
<div id="createPatientModal" class="fixed inset-0 z-50 overflow-y-auto hidden transition-opacity duration-300" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div id="createPatientBackdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity duration-300 opacity-0" aria-hidden="true" onclick="closeCreateModal()"></div>

        <div id="createPatientPanel" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full opacity-0 scale-95">
            <form id="createPatientForm">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- Error messages container -->
                    <div id="createFormErrors" class="mb-4 hidden">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            <ul id="createErrorList" class="list-disc list-inside"></ul>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <div class="border-b border-gray-200 mb-4">
                        <nav class="-mb-px flex space-x-8">
                            <button type="button" onclick="switchTab('personal')" id="personalTab"
                                class="tab-button active border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Datos Personales
                            </button>
                            <button type="button" onclick="switchTab('formula')" id="formulaTab"
                                class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Fórmula Óptica
                            </button>
                        </nav>
                    </div>

                    <!-- Personal Data Tab -->
                    <div id="personalTabContent" class="tab-content">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="create_first_name" class="block text-sm font-medium text-gray-700">Nombre *</label>
                                <input type="text" name="first_name" id="create_first_name" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="create_last_name" class="block text-sm font-medium text-gray-700">Apellido *</label>
                                <input type="text" name="last_name" id="create_last_name" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="create_age" class="block text-sm font-medium text-gray-700">Edad *</label>
                                <input type="number" name="age" id="create_age" required min="1" max="120"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="create_id_card" class="block text-sm font-medium text-gray-700">Cédula *</label>
                                <input type="text" name="id_card" id="create_id_card" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="create_occupation" class="block text-sm font-medium text-gray-700">Ocupación</label>
                                <input type="text" name="occupation" id="create_occupation"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="create_phone" class="block text-sm font-medium text-gray-700">Teléfono *</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                        +58
                                    </span>
                                    <input type="text" name="phone" id="create_phone" required
                                        placeholder="4241234567"
                                        pattern="[0-9]{10}"
                                        maxlength="10"
                                        class="flex-1 block w-full rounded-none rounded-r-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Solo números, 10 dígitos (ej: 4241234567)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Formula Tab -->
                    <div id="formulaTabContent" class="tab-content hidden">
                        @include('patients.partials.formula-form')
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" id="createSubmitBtn"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Crear Paciente
                    </button>
                    <button type="button" onclick="closeCreateModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
