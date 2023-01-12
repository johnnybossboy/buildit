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
        <div class="flex flex-direction-column flex-justify-center container--width">
            <h2 class="mb">Recept toevoegen</h2>
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
        <h2 class="mb">Overzicht Recepten</h2>

        <!-- Recepten weergeven -->
        @foreach ($recipes as $recipe)
        <div class="flex flex-direction-column container--width recipe-item">
            <div id="recipeEditForm{{ $recipe->id }}" class="hidden">
                <form action="{{ route('updateRecipe', [$recipe->id]) }}" method="POST">
                    {{ csrf_field() }}
                    <input class="input input--wide input--recipe " type="text" name="recipe_title"
                        value="{{ $recipe->title }}" />
                    <textarea class="input input--wide input--recipe" type="text" name="recipe_description">
                        {{ $recipe->short_description }}
                    </textarea>
                    <div class="flex flex-direction-row">
                        <button type="submit" onclick="toggleEditForm({{ $recipe->id }})" class="btn btn--primary"
                            id="recipeSaveButton{{$recipe->id}}">Save</button>
                        <button type="button" onclick="toggleEditForm({{ $recipe->id }})"
                            class="btn btn--tertiary ml-small">Cancel</button>
                    </div>
                </form>
            </div>
            <div id="recipeData{{ $recipe->id }}">
                <h3 class="mb-small">{{ $recipe->title }}</h3>
                <p class="mb-small">{{ $recipe->short_description }}</p>
            </div>
            <div id="buttons{{$recipe->id}}" class="flex flex-direction-row">
                <a class="btn btn--secondary" onclick="toggleEditForm({{ $recipe->id }})">Edit</a>
                <a href="{{ route('deleteRecipe', [$recipe->id]) }}" class="btn btn--delete">Delete</a>
            </div>
        </div>
        @endforeach

        @if ($recipes->links()->paginator->hasPages())
        <div class="">
            {{ $recipes->links() }}
            @endif
        </div>

        <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // toggleEditForm(4);
        });

        function log(text) {
            log(text, "");
        }

        function log(text, argument) {
            console.log(text, argument);
        }

        function toggleEditForm(recipeID) {
            log("Edit recipe with id ", recipeID);
            var elementRecipeData = document.getElementById("recipeData" + recipeID);
            var elementRecipeForm = document.getElementById("recipeEditForm" + recipeID);
            var buttons = document.getElementById("buttons" + recipeID);

            buttons.classList.toggle("hidden");

            // Op een of andere manier werkte dit niet (en alleen bij de onderstaande)
            // var elementFormButtons = document.getElementById("formEditButtons" + recipeID);

            elementRecipeData.classList.toggle("hidden");
            elementRecipeForm.classList.toggle("hidden");

            // Op een of andere manier werkte dit niet (en alleen bij de onderstaande)
            // elementFormButtons.classList.toggle("hidden");
        }
        </script>
</body>

</html>