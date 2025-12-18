<?php

namespace App\Http\Controllers;

use App\Models\Mount;
use Illuminate\Http\Request;

class MountController extends Controller
{
    public function index(Request $request)
    {
        $query = Mount::query();

        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        $mounts = $query->orderBy('id', 'desc')
            ->paginate(10)
            ->appends($request->all());

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'mounts' => $mounts,
                'pagination' => (string) $mounts->appends($request->all())->links()
            ]);
        }

        return view('mounts.index', compact('mounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'stock' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0']
        ]);

        $mount = Mount::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Mount created successfully.',
            'mount' => $mount
        ]);
    }

    public function show(Mount $mount)
    {
        return response()->json([
            'success' => true,
            'mount' => $mount
        ]);
    }

    public function update(Request $request, Mount $mount)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'stock' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0']
        ]);

        $mount->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Mount updated successfully.',
            'mount' => $mount
        ]);
    }

    public function destroy(Mount $mount)
    {
        $mount->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mount deleted successfully.'
        ]);
    }
}
