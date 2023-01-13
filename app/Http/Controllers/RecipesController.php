<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipesController extends Controller
{
    public function index()
    {
        // $recipes = Recipe::Paginate(10); // Pagination works, but not sorting.
        // $recipes = Recipe::all()->sortDesc(); // this works, but no pagination!
        $recipes = Recipe::orderBy('created_at', 'desc')->simplePaginate(10); // Both work!

        return view('recipeshome', ['recipes' => $recipes]);
    }

    public function addRecipe(Request $request)
    {
        \Log::info("Added recipe!");
        $recipe_title = $request->recipe_add_title;
        $recipe_description = $request->recipe_add_description;
        \Log::info("Request: ", [$recipe_title, $recipe_description]);

        $newrecipe = new Recipe;
        $newrecipe->title = $recipe_title;
        $newrecipe->short_description = $recipe_description;

        $newrecipe->save();

        return redirect('/');
    }

    public function updateRecipe(Request $request, $id)
    {
        \Log::info($request);
        \Log::info($id);
        $recipeNewTitle = $request->recipe_title;
        $recipeNewDescription = $request->recipe_description;

        $newRecipeModel = Recipe::find($id);
        $newRecipeModel->title = $recipeNewTitle;
        $newRecipeModel->short_description = $recipeNewDescription;
        $newRecipeModel->save();

        return redirect('/');
    }

    public function deleteRecipe($id)
    {
        \Log::info("You want the following recipe to be deleted:");
        \Log::info($id);

        if ($id >= 0 && $id !== null) {
            $recipe = Recipe::find($id);
            \Log::info($recipe);

            if ($recipe !== null) {
                $recipe->delete();
                \Log::info("Recipe " . $id . " deleted!");
            } else {
                \Log::info("Recipe " . $id . " is already deleted!");
            }
        }

        return redirect('/');
    }
}
?>