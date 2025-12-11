<!-- View Formula Modal -->
<div id="viewFormulaModal" class="fixed inset-0 z-50 overflow-y-auto hidden transition-opacity duration-300" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div id="viewFormulaBackdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity duration-300 opacity-0" aria-hidden="true" onclick="closeViewFormulaModal()"></div>

        <div id="viewFormulaPanel" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all duration-300 sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full opacity-0 scale-95">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Fórmula Óptica</h3>
                    <button onclick="closeViewFormulaModal()" class="text-gray-400 hover:text-gray-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <div id="formulaContent" class="space-y-6">
                    <!-- Content will be populated by JavaScript -->
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closeViewFormulaModal()"
                    class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:w-auto sm:text-sm">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
