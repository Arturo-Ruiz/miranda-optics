<div id="createMountModal" class="fixed inset-0 z-50 overflow-y-auto hidden transition-opacity duration-300">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div id="createMountBackdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity duration-300 opacity-0" onclick="closeCreateModal()"></div>

        <div id="createMountPanel" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full opacity-0 scale-95">
            <form id="createMountForm">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <!-- New Pretty Header -->
                    <div class="sm:flex sm:items-start mb-4">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                     <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M175.3 160C161.3 160 148.8 169.2 144.7 182.6L102.4 320L256 320C273.7 320 288 334.3 288 352L352 352C352 334.3 366.3 320 384 320L537.6 320L495.3 182.6C491.2 169.2 478.8 160 464.7 160L432 160C414.3 160 400 145.7 400 128C400 110.3 414.3 96 432 96L464.7 96C506.8 96 544.1 123.5 556.5 163.8L601.9 311.3C606 324.5 608 338.2 608 352L608 448C608 501 565 544 512 544L448 544C395 544 352 501 352 448L352 416L288 416L288 448C288 501 245 544 192 544L128 544C75 544 32 501 32 448L32 352C32 338.2 34.1 324.5 38.1 311.3L83.5 163.8C95.9 123.5 133.1 96 175.3 96L208 96C225.7 96 240 110.3 240 128C240 145.7 225.7 160 208 160L175.3 160zM96 384L96 448C96 465.7 110.3 480 128 480L192 480C209.7 480 224 465.7 224 448L224 384L96 384zM512 480C529.7 480 544 465.7 544 448L544 384L416 384L416 448C416 465.7 430.3 480 448 480L512 480z"/></svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">Crear Montura</h3>
                            
                            <!-- Error messages container -->
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
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label for="create_name" class="block text-sm font-medium text-gray-700">Nombre *</label>
                            <input type="text" name="name" id="create_name" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="create_stock" class="block text-sm font-medium text-gray-700">Stock *</label>
                            <input type="number" name="stock" id="create_stock" min="0" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="create_price" class="block text-sm font-medium text-gray-700">Precio *</label>
                            <input type="number" name="price" id="create_price" step="0.01" min="0" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit" id="createSubmitBtn"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Crear Montura
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