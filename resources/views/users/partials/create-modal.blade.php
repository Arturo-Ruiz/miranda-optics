<!-- Create User Modal -->
<div id="createUserModal" class="fixed inset-0 z-50 overflow-y-auto hidden transition-opacity duration-300" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div id="createModalBackdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity duration-300 opacity-0" aria-hidden="true" onclick="closeCreateModal()"></div>

        <!-- Modal panel -->
        <div id="createModalPanel" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full opacity-0 scale-95">
            <form id="createUserForm">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modal-title">
                                Crear Nuevo Usuario
                            </h3>
                            
                            <!-- Error messages container -->
                            <div id="createFormErrors" class="mb-4 hidden">
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                                    <ul id="createErrorList" class="list-disc list-inside"></ul>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <!-- Name -->
                                <div>
                                    <label for="create_name" class="block text-sm font-medium text-gray-700">
                                        Nombre
                                    </label>
                                    <input type="text" name="name" id="create_name" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="create_email" class="block text-sm font-medium text-gray-700">
                                        Email
                                    </label>
                                    <input type="email" name="email" id="create_email" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="create_password" class="block text-sm font-medium text-gray-700">
                                        Contraseña
                                    </label>
                                    <div class="relative">
                                        <input type="password" name="password" id="create_password" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm pr-10">
                                        <button type="button" onclick="togglePassword('create_password')" 
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Password Confirmation -->
                                <div>
                                    <label for="create_password_confirmation" class="block text-sm font-medium text-gray-700">
                                        Confirmar Contraseña
                                    </label>
                                    <div class="relative">
                                        <input type="password" name="password_confirmation" id="create_password_confirmation" required
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm pr-10">
                                        <button type="button" onclick="togglePassword('create_password_confirmation')" 
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" id="createSubmitBtn"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Crear Usuario
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
