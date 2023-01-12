<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- External stylesheets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Local stylesheets -->
    <link rel="stylesheet" href="{{ url('css/app.css') }}" type="text/css">
</head>

<body class="antialiased">
    <div
        class="relative flex flex-direction-column items-top min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0 flex-align-center">

        <h1 class="mb">Recepten</h1>

        <!-- Recept toevoegen -->
        <div class="flex flex-direction-column flex-justify-center" style="width:90%;max-width:500px;">
            <h2>Recept toevoegen</h2>
            <form action="{{ route('addRecipe') }}" method="POST" class="flex flex-direction-column">
                {{ csrf_field() }}
                <input type="text" required name="recipe_add_title" class="input input--wide mb-small"
                    placeholder="Titel" />
                <input type="text" required name="recipe_add_description" class="input input--wide mb-small"
                    placeholder="Beschrijving (max. 200 karakters)" maxlength="200" />
                <button type="submit" class="btn btn--primary">Insturen</button>
            </form>
        </div>

        <!-- Divider -->
        <div class="divider mt mb"></div>
        <h2>Overzicht Recepten</h2>

        <!-- Recepten weergeven -->
        @foreach ($recipes as $recipe)
        <div class="flex flex-direction-row mb-small flex-justify-between">
            <div class="flex flex-direction-column" id="recipeData{{$recipe->id}}">
                <p>Recept titel: {{$recipe->title}}</p>
                <p>Recept omschrijving: {{$recipe->short_description}}
            </div>
            <div class="flex flex-direction-column hidden" id="recipeEditForm{{$recipe->id}}">
                <!-- Ik wilde de recipe ID meesturen, maar kreeg het onderstaande niet voor elkaar. -->
                <form action="{{ route('updateRecipe', [$recipe->id]) }}" method="POST">
                    {{csrf_field()}}
                    <div class="flex flex-direction-row">
                        <p class="no-mb">Titel</p>
                        <input type="text" class="input input--wide" name="recipe_edit_title"
                            value="{{$recipe->title}}" />
                    </div>
                    <div class="flex flex-direction-row">
                        <p class="no-mb">Omschrijving</p>
                        <input type="text" class="input input--wide" name="recipe_edit_description"
                            value="{{$recipe->short_description}}" />
                    </div>
                    <button type="submit" class="btn btn--primary btn--wide">Save</button>
                </form>
            </div>
            <div class="flex flex-direction-row">
                <a id="recipeEditButton{{$recipe->id}}" class="btn btn--secondary"
                    onClick="toggleEditForm({{$recipe->id}})">Edit</a>

                <!-- Ik heb geen form met post gebruikt, dan kwam het design er minder mooi uit te zien. -->
                <a href="{{ route('deleteRecipe', [$recipe->id]) }}" class="btn btn--delete">Delete</a>
            </div>
        </div>
        <div class="divider"></div>
        @endforeach

        {{ $recipes->links() }}
    </div>



    <div id="formEditButtons{{ $recipe->id }}" class="flex flex-direction-row">
        <a class="btn btn--secondary" onclick="toggleEditForm({{ $recipe->id }})">Edit</a>
        <a class="btn btn--delete">Delete</a>
    </div>


    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            // toggleEditForm(4);
        });

        function log(text) {
            log(text, "");
        }

        function log(text, argument) {
            console.log(text, argument);
        }

        function toggleEditForm(recipeID) {
            log("Edit recipe with id " + recipeID);
            var elementRecipeData = document.getElementById("recipeData" + recipeID);
            var elementRecipeForm = document.getElementById("recipeEditForm" + recipeID);
            var elementEditRecipeButton = document.getElementById("recipeEditButton" + recipeID);
            var elementSaveRecipeButton = document.getElementById("recipeSaveButton" + recipeID);

            elementRecipeData.classList.toggle("hidden");
            elementRecipeForm.classList.toggle("hidden");
            elementEditRecipeButton.classList.toggle("hidden");
            elementSaveRecipeButton.classList.toggle("hidden");
        }
    </script>
</body>

</html>
