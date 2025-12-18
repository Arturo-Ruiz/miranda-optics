<!-- Edit Payment Method Modal -->
<div id="editPaymentMethodModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div id="editPaymentMethodBackdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity opacity-0 ease-in-out duration-300"></div>

    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div id="editPaymentMethodPanel" class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg opacity-0 scale-95 ease-in-out duration-300">
            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Editar Método de Pago</h3>
                        
                        <!-- Error Messages -->
                        <div id="editFormErrors" class="hidden rounded-md bg-red-50 p-4 mt-2">
                            <div class="flex">
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Se encontraron errores:</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul id="editErrorList" class="list-disc pl-5 space-y-1"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form id="editPaymentMethodForm" class="mt-4 space-y-4">
                            <input type="hidden" id="edit_payment_method_id">
                            
                            <!-- Name -->
                            <div>
                                <label for="edit_name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                <input type="text" name="name" id="edit_name" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>

                            <!-- Is USD -->
                            <div class="flex items-center">
                                <input id="edit_is_usd" name="is_usd" type="checkbox" value="1"
                                    class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <label for="edit_is_usd" class="ml-2 block text-sm text-gray-900">
                                    ¿Es en Dólares?
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="submit" form="editPaymentMethodForm" id="editSubmitBtn"
                    class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
                    Actualizar
                </button>
                <button type="button" onclick="closeEditModal()"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>
