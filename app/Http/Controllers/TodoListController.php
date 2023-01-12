<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\listItem;

class TodoListController extends Controller
{
    public function index()
    {
        return view('welcome', ['listItems' => listItem::where('is_complete', 0)->get()]);
    }

    public function saveItem(Request $request)
    {
        \Log::info(json_encode($request->all()));

        // Below uses the modal ListItem that is created via a migration command.
        $newListItem = new listItem;
        $newListItem->name = $request->listItem;
        $newListItem->is_complete = 0;

        // Save in the database.
        $newListItem->save();

        // Delete from database.
        // $newListItem->delete();

        // You are at /saveItem.
        // Ensure the user is redirected to the home page to prevent re-submitting form data upon refreshing the page.
        return redirect('/');
    }

    public function markComplete($id)
    {
        \Log::info($id);
        $listItem = ListItem::find($id);
        if ($listItem->is_complete === 0) {
            $listItem->is_complete = 1;
        } else {
            $listItem->is_complete = 0;
        }

        $listItem->save();
        return redirect('/');
    }
}
?>