<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class ListController extends Controller
{
    private $searchItems;

    public function index()
    {
        Log::info(json_encode($this->searchItems));
        return view('welcome', ['listItems' => ListItem::where('is_complete', 0)->get(), 
        'boughtItems' => ListItem::where('updated_at', '>=', Carbon::now()->subDays(7)->toDateTimeString())->get(), 
        'totalItems' => ListItem::all()->unique('name'), 'searchItems' => $this->searchItems]);
    }

    public function saveItem(Request $request)
    {
        //Log::info(json_encode($request->all()));
        $newItem = new ListItem;
        $newItem->name = $request->listItem;
        $newItem->is_complete = 0;
        $newItem->save();
        return redirect('/');
    }

    public function markComplete($id)
    {
        Log::info(json_encode($id));
        $findItem = ListItem::find($id);
        $findItem->is_complete = 1;
        $findItem->save();
        return redirect('/');
    }

    public function deleteItem($id)
    {
        $deleteItem = ListItem::find($id);
        $deleteItem->delete();
        return redirect('/');
    }

    public function findItem($name)
    {
        // Log::info(json_encode($name));
        return Redirect::away('https://www.google.dk/search?q='.$name.'&tbm=isch&sa=X&ved=2ahUKEwiFoL_D2Lj_AhWCcfEDHc7yCN0Q0pQJegQICxAB&biw=1879&bih=939&dpr=1');
    }

    public function totalItem($id)
    {
        $findItem = ListItem::find($id);
        $newItem = new ListItem;
        $newItem->name = $findItem->name;
        $newItem->is_complete = 0;
        $newItem->save();
        return redirect('/');
    }

    public function searchItem(Request $request)
    {
        $search = $request->input('search');
        $this-> searchItems = ListItem::query()->where('name', 'LIKE', "%{$search}%")->get();

        return redirect('/');
    }
}
