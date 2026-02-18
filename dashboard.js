$(document).ready(function () {
    loadRecipes(); // Load all recipes when the page loads

    // Open Add Recipe Modal
    $('#addRecipeBtn').click(function () {
        $('#modalTitle').text('Add New Recipe');
        $('#recipeId').val('');
        $('#recipeTitle').val('');
        $('#recipeDescription').val('');
        $('#recipeModal').show();
    });

    // Close Modal
    $('.close').click(function () {
        $('#recipeModal').hide();
    });

    $("#logoutBtn").click(function () {
        window.location.href = "home.html"; // Redirect to logout page
    });

    // Handle Add/Edit Recipe Form Submission
    $('#recipeForm').submit(function (e) {
        e.preventDefault();

        var recipeId = $('#recipeId').val();
        var title = $('#recipeTitle').val();
        var description = $('#recipeDescription').val();
        var url = recipeId ? 'edit_recipe.php' : 'add_recipe.php'; // Check if adding or editing

        $.ajax({
            url: url,
            type: 'POST',
            data: { id: recipeId, title: title, description: description },
            dataType: 'json',
            success: function (response) {
                alert(response.message);
                $('#recipeModal').hide();
                loadRecipes(); // Reload recipe list
            },
            error: function () {
                alert('Error processing request.');
            }
        });
    });

    // Load Recipes
    function loadRecipes() {
        $.ajax({
            url: 'fetch_recipes.php',
            type: 'GET',
            dataType: 'html',
            success: function (response) {
                $('#recipeList').html(response);

                // Bind edit and delete buttons
                $('.editRecipe').click(function () {
                    var id = $(this).data('id');
                    var title = $(this).data('title');
                    var description = $(this).data('description');

                    $('#modalTitle').text('Edit Recipe');
                    $('#recipeId').val(id);
                    $('#recipeTitle').val(title);
                    $('#recipeDescription').val(description);
                    $('#recipeModal').show();
                });

                $('.deleteRecipe').click(function () {
                    var id = $(this).data('id');
                    if (confirm('Are you sure you want to delete this recipe?')) {
                        $.ajax({
                            url: 'delete_recipe.php',
                            type: 'POST',
                            data: { id: id },
                            dataType: 'json',
                            success: function (response) {
                                alert(response.message);
                                loadRecipes();
                            },
                            error: function () {
                                alert('Error deleting recipe.');
                            }
                        });
                    }
                });
            }
        });
    }
    
    
});
