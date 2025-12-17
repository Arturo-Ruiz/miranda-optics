<?php  
  
namespace App\Http\Controllers;  
  
use App\Models\Crystal;  
use Illuminate\Http\Request;  
  
class CrystalController extends Controller  
{  
    public function index(Request $request)  
    {  
        $query = Crystal::query();  
  
        if ($request->has('search') && $request->search !== '') {  
            $search = $request->search;  
            $query->where('name', 'like', "%{$search}%");  
        }  
  
        $crystals = $query->orderBy('id', 'desc')  
            ->paginate(10)  
            ->appends($request->query());  
  
        if ($request->ajax()) {  
            return response()->json([  
                'success' => true,  
                'crystals' => $crystals,  
                'pagination' => (string) $crystals->links()  
            ]);  
        }  
  
        return view('crystals.index', compact('crystals'));  
    }  
  
    public function store(Request $request)  
    {  
        $validated = $request->validate([  
            'name' => ['required', 'string', 'max:255'],  
            'price' => ['required', 'numeric', 'min:0']  
        ]);  
  
        $crystal = Crystal::create($validated);  
  
        return response()->json([  
            'success' => true,  
            'message' => 'Crystal created successfully.',  
            'crystal' => $crystal  
        ]);  
    }  
  
    public function show(Crystal $crystal)  
    {  
        return response()->json([  
            'success' => true,  
            'crystal' => $crystal  
        ]);  
    }  
  
    public function update(Request $request, Crystal $crystal)  
    {  
        $validated = $request->validate([  
            'name' => ['required', 'string', 'max:255'],  
            'price' => ['required', 'numeric', 'min:0']  
        ]);  
  
        $crystal->update($validated);  
  
        return response()->json([  
            'success' => true,  
            'message' => 'Crystal updated successfully.',  
            'crystal' => $crystal  
        ]);  
    }  
  
    public function destroy(Crystal $crystal)  
    {  
        $crystal->delete();  
  
        return response()->json([  
            'success' => true,  
            'message' => 'Crystal deleted successfully.'  
        ]);  
    }  
}
