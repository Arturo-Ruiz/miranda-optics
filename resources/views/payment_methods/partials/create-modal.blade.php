<!-- Create Payment Method Modal -->
<div id="createPaymentMethodModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div id="createPaymentMethodBackdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity opacity-0 ease-in-out duration-300"></div>

    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div id="createPaymentMethodPanel" class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg opacity-0 scale-95 ease-in-out duration-300">
            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                        <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Crear Método de Pago</h3>
                        
                        <!-- Error Messages -->
                        <div id="createFormErrors" class="hidden rounded-md bg-red-50 p-4 mt-2">
                            <div class="flex">
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Se encontraron errores:</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul id="createErrorList" class="list-disc pl-5 space-y-1"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form id="createPaymentMethodForm" class="mt-4 space-y-4">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                <input type="text" name="name" id="name" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    placeholder="Ej: Zelle, Efectivo USD, Pago Móvil">
                            </div>

                            <!-- Is USD -->
                            <div class="flex items-center">
                                <input id="is_usd" name="is_usd" type="checkbox" value="1"
                                    class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <label for="is_usd" class="ml-2 block text-sm text-gray-900">
                                    ¿Es en Dólares?
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button type="submit" form="createPaymentMethodForm" id="createSubmitBtn"
                    class="inline-flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
                    Guardar
                </button>
                <button type="button" onclick="closeCreateModal()"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>
