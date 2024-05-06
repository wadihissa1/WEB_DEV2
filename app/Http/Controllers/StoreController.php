<?php
 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\StoreRequest;
use App\Models\Product;
use App\Models\Category;
class StoreController extends Controller
{
    public function create()
    {
        return view('createstore');
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
 
        $user = auth()->user();
 
        // Create a store request
        $storeRequest = StoreRequest::create([
            'user_id' => $user->id,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);
 
        return redirect()->route('chooseaction', ['id' => $user->id]);
    }
 
 
    //cant name view changed to show
   
    public function viewAllStores()
    {
        $user = auth()->user();
       
        // Get only the approved stores
        $userStores = Store::where('user_id', $user->id)
        ->where('status', 'approved')
        ->get();
       
        $userStore = Store::all();
 
 
        return view('viewallstore', [
            'userStores' => $userStores,
        ]);
       
    }


    public function viewPendingRequests()
{
    $user = auth()->user();
    
    // Get stores with pending status
    $pendingRequests = StoreRequest::where('user_id', $user->id)
        ->where('status', 'pending')
        ->get();

    return view('viewpendingrequests', ['pendingRequests' => $pendingRequests]);
}

//  <!--   public function show($storeId)
// {
//     $store = Store::findOrFail($storeId);
//     $products = $store->products()->paginate(6);

//     return view('viewstore', ['store' => $store, 'products' => $products]);
// } 
public function edit($storeId)
{
    $store = Store::findOrFail($storeId);
    return view('editstore', ['store' => $store]);
}

public function update(Request $request, $storeId)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
    ]);

    $store = Store::findOrFail($storeId);
    $store->name = $request->name;
    $store->description = $request->description;
    $store->save();

    return redirect()->route('viewallstores')->with('success', 'Store updated successfully.');
}

public function destroy($storeId)
{
    $store = Store::findOrFail($storeId);
    $store->delete();

    return redirect()->route('viewallstores')->with('success', 'Store deleted successfully.');
}

 
   
    public function show($storeId)
    {
        $store = Store::findOrFail($storeId);
        $user = $store->user; // Assuming 'user' is the relationship between Store and User
    
        $products = $store->products()->simplePaginate(3);
    
        return view('viewstore', [
            'store' => $store, 
            'user' => $user, // Pass the $user variable to the view
            'products' => $products
        ]);
    }

}
 