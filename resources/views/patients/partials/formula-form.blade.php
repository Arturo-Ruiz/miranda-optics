<!-- Optical Formula Form Component -->
<div class="space-y-6">
    <!-- Formula Table -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Fórmula</label>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 border border-gray-300 text-xs font-medium text-gray-700"></th>
                        <th class="px-3 py-2 border border-gray-300 text-xs font-medium text-gray-700">ESF</th>
                        <th class="px-3 py-2 border border-gray-300 text-xs font-medium text-gray-700">CIL</th>
                        <th class="px-3 py-2 border border-gray-300 text-xs font-medium text-gray-700">EJE</th>
                        <th class="px-3 py-2 border border-gray-300 text-xs font-medium text-gray-700">ADD</th>
                        <th class="px-3 py-2 border border-gray-300 text-xs font-medium text-gray-700">DPN</th>
                        <th class="px-3 py-2 border border-gray-300 text-xs font-medium text-gray-700">ALT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-3 py-2 border border-gray-300 font-medium text-sm">OD</td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[formula][od][esf]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[formula][od][cil]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[formula][od][eje]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[formula][od][add]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[formula][od][dpn]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[formula][od][alt]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border border-gray-300 font-medium text-sm">OI</td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[formula][oi][esf]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[formula][oi][cil]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[formula][oi][eje]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[formula][oi][add]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[formula][oi][dpn]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[formula][oi][alt]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Options Grid -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Opciones</label>
        <div class="grid grid-cols-3 gap-3">
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="optical_formula[options][vs]" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="text-sm text-gray-700">VS</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="optical_formula[options][poly]" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="text-sm text-gray-700">POLY</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="optical_formula[options][tallado]" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="text-sm text-gray-700">TALLADO</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="optical_formula[options][bif]" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="text-sm text-gray-700">BIF</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="optical_formula[options][ar]" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="text-sm text-gray-700">AR</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="optical_formula[options][terminado]" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="text-sm text-gray-700">TERMINADO</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="optical_formula[options][prog]" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="text-sm text-gray-700">PROG</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="optical_formula[options][foto]" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="text-sm text-gray-700">FOTO</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="optical_formula[options][blue_block]" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="text-sm text-gray-700">BLUE BLOCK</span>
            </label>
        </div>
    </div>

    <!-- Vision Tables -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Vision Lejana -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Visión Lejana</label>
            <table class="w-full border border-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 border border-gray-300 text-xs font-medium text-gray-700"></th>
                        <th class="px-3 py-2 border border-gray-300 text-xs font-medium text-gray-700">AV.SC</th>
                        <th class="px-3 py-2 border border-gray-300 text-xs font-medium text-gray-700">AV.CC</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-3 py-2 border border-gray-300 font-medium text-sm">OD</td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[vision_lejana][od][av_sc]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[vision_lejana][od][av_cc]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border border-gray-300 font-medium text-sm">OI</td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[vision_lejana][oi][av_sc]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[vision_lejana][oi][av_cc]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Vision Cercana -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Visión Cercana</label>
            <table class="w-full border border-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-2 border border-gray-300 text-xs font-medium text-gray-700"></th>
                        <th class="px-3 py-2 border border-gray-300 text-xs font-medium text-gray-700">AV.SC</th>
                        <th class="px-3 py-2 border border-gray-300 text-xs font-medium text-gray-700">AV.CC</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-3 py-2 border border-gray-300 font-medium text-sm">OD</td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[vision_cercana][od][av_sc]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[vision_cercana][od][av_cc]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                    </tr>
                    <tr>
                        <td class="px-3 py-2 border border-gray-300 font-medium text-sm">OI</td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[vision_cercana][oi][av_sc]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                        <td class="px-2 py-2 border border-gray-300"><input type="text" name="optical_formula[vision_cercana][oi][av_cc]" class="w-full px-2 py-1 text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Observation -->
    <div>
        <label for="formula_observation" class="block text-sm font-medium text-gray-700">
            Observación
        </label>
        <textarea name="optical_formula[observation]" id="formula_observation" rows="3"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
    </div>
</div>
