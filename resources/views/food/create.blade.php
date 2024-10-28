@extends('restaurant.dashboard')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Add New Food Item</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('food.store') }}" method="POST" enctype="multipart/form-data"
        class="bg-light p-4 rounded shadow text-dark">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required onblur="fetchNutrients()">
        </div>
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control-file" required>
        </div>
        <div class="form-group mb-3" hidden>
            <label for="expired_date">Expiration Date</label>
            <input type="date" name="expired_date" id="expired_date" class="form-control" required
                min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d', strtotime('+1 year')) }}">
        </div>
        <div class="form-group mb-3">
            <label for="calories">Calories Per 100g</label>
            <input type="text" name="calories" id="calories" class="form-control" required step="0.01">
            <div id="nutrient-results" class="mt-3 d-flex justify-content-between">
                <div id="protein" class="mr-3"></div>
                <div id="fat" class="mr-3"></div>
                <div id="carbs"></div>
            </div>
        </div>
        <input type="hidden" name="fats" id="fats">
        <input type="hidden" name="carbs" id="carbs">
        <input type="hidden" name="proteins" id="proteins">
        <button type="submit" id="submit-button" class="btn btn-primary btn-block">Add Food Item</button>
    </form>
</div>

<script>
    function recalculateCalories() {
        const fats = parseFloat(document.getElementById('input_fat').value) || 0;
        const carbs = parseFloat(document.getElementById('input_carbs').value) || 0;
        const proteins = parseFloat(document.getElementById('input_protein').value) || 0;

        const calories = (fats * 9) + (carbs * 4) + (proteins * 4);
        document.getElementById('calories').value = calories.toFixed(2);
    }

    function fetchNutrients() {
        const foodName = document.getElementById('name').value;
        const resultsContainer = document.getElementById('nutrient-results');
        const submitButton = document.getElementById('submit-button');
        resultsContainer.innerHTML = '';

        submitButton.disabled = true;

        if (foodName) {
            fetch(`https://world.openfoodfacts.org/cgi/search.pl?search_terms=${encodeURIComponent(foodName)}&search_simple=1&json=1`)
                .then(response => response.json())
                .then(data => {
                    console.log(data);

                    if (data.products && data.products.length > 0) {
                        const filteredProducts = data.products.filter(product =>
                            product.product_name && product.product_name.toLowerCase().includes(foodName.toLowerCase())
                        );

                        let mostSimilarProduct = null;
                        let minDistance = Infinity;

                        filteredProducts.forEach(product => {
                            const distance = levenshteinDistance(foodName.toLowerCase(), product.product_name.toLowerCase());
                            if (distance < minDistance) {
                                minDistance = distance;
                                mostSimilarProduct = product;
                            }
                        });

                        if (mostSimilarProduct && mostSimilarProduct.product_name.length > 3) {
                            const productName = mostSimilarProduct.product_name || 'Unknown';
                            const brand = mostSimilarProduct.brands || 'Unknown';
                            const fats = mostSimilarProduct.nutriments ? mostSimilarProduct.nutriments.fat_100g || 0 : 0;
                            const carbs = mostSimilarProduct.nutriments ? mostSimilarProduct.nutriments.carbohydrates_100g || 0 : 0;
                            const proteins = mostSimilarProduct.nutriments ? mostSimilarProduct.nutriments.proteins_100g || 0 : 0;

                            const calories = (fats * 9) + (carbs * 4) + (proteins * 4);

                            document.getElementById('calories').value = calories.toFixed(2);
                            document.getElementById('fats').value = fats;
                            document.getElementById('carbs').value = carbs;
                            document.getElementById('proteins').value = proteins;

                            resultsContainer.innerHTML = `
                                <div class="product d-flex flex-column">
                                    <div id="protein"><strong>Protein:</strong> ${proteins} g</div>
                                    <div id="fat"><strong>Fat:</strong> ${fats} g</div>
                                    <div id="carbs"><strong>Carbohydrates:</strong> ${carbs} g</div>
                                </div>
                            `;
                        } else {
                            resultsContainer.innerHTML = '<p>No products found matching your search.</p>';
                            resultsContainer.innerHTML += `
                                <div class="form-group mb-3">
                                    <label for="input_protein">Protein (g)</label>
                                    <input type="text" name="input_protein" id="input_protein" class="form-control" oninput="recalculateCalories()">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="input_fat">Fat (g)</label>
                                    <input type="text" name="input_fat" id="input_fat" class="form-control" oninput="recalculateCalories()">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="input_carbs">Carbohydrates (g)</label>
                                    <input type="text" name="input_carbs" id="input_carbs" class="form-control" oninput="recalculateCalories()">
                                </div>
                            `;

                        }
                    } else {
                        resultsContainer.innerHTML = '<p>Please insert nutrients manually:</p>';

                        resultsContainer.innerHTML += `
                                <div class="form-group mb-3">
                                    <label for="input_protein">Protein (g)</label>
                                    <input type="text" name="input_protein" id="input_protein" class="form-control" oninput="recalculateCalories()">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="input_fat">Fat (g)</label>
                                    <input type="text" name="input_fat" id="input_fat" class="form-control" oninput="recalculateCalories()">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="input_carbs">Carbohydrates (g)</label>
                                    <input type="text" name="input_carbs" id="input_carbs" class="form-control" oninput="recalculateCalories()">
                                </div>
                            `;

                    }
                })
                .catch(error => {
                    console.error('Error fetching from Open Food Facts:', error);
                    fetchFromSpoonacular(foodName, resultsContainer);
                })
                .finally(() => {

                    submitButton.disabled = false;
                });
        } else {

            submitButton.disabled = false;
        }
    }


    function levenshteinDistance(a, b) {
        const matrix = [];

        for (let i = 0; i <= b.length; i++) {
            matrix[i] = [i];
        }
        for (let j = 0; j <= a.length; j++) {
            matrix[0][j] = j;
        }

        for (let i = 1; i <= b.length; i++) {
            for (let j = 1; j <= a.length; j++) {
                if (b.charAt(i - 1) === a.charAt(j - 1)) {
                    matrix[i][j] = matrix[i - 1][j - 1];
                } else {
                    matrix[i][j] = Math.min(
                        matrix[i - 1][j - 1] + 1,
                        Math.min(matrix[i][j - 1] + 1,
                            matrix[i - 1][j] + 1)
                    );
                }
            }
        }
        return matrix[b.length][a.length];
    }

    function fetchFromSpoonacular(foodName, resultsContainer) {
        fetch(`https://api.spoonacular.com/food/ingredients/search?query=${encodeURIComponent(foodName)}&apiKey=a815639d66b847609c0ef2e57d736c14&includeNutrition=true`)
            .then(response => response.json())
            .then(data => {
                if (data.results && data.results.length > 0) {
                    const shortestItem = data.results.reduce((prev, curr) => {
                        return (curr.name.length < prev.name.length) ? curr : prev;
                    });

                    fetch(`https://api.spoonacular.com/food/ingredients/${shortestItem.id}/information?amount=1&apiKey=a815639d66b847609c0ef2e57d736c14`)
                        .then(response => response.json())
                        .then(nutrientData => {
                            const nutrition = nutrientData.nutrition;
                            const calories = nutrition.nutrients.find(n => n.name === 'Calories');
                            const protein = nutrition.nutrients.find(n => n.name === 'Protein');
                            const fat = nutrition.nutrients.find(n => n.name === 'Fat');
                            const carbs = nutrition.nutrients.find(n => n.name === 'Carbohydrates');

                            resultsContainer.innerHTML = `
                                <p><strong>Item:</strong> ${shortestItem.name}</p>
                                <p><strong>Calories:</strong> ${calories ? calories.amount : 'N/A'} kcal</p>
                                <p><strong>Protein:</strong> ${protein ? protein.amount : 'N/A'} g</p>
                                <p><strong>Fat:</strong> ${fat ? fat.amount : 'N/A'} g</p>
                                <p><strong>Carbohydrates:</strong> ${carbs ? carbs.amount : 'N/A'} g</p>
                            `;
                        })
                        .catch(error => console.error('Error fetching ingredient details from Spoonacular:', error));
                } else {
                    resultsContainer.innerHTML = '<p>No results found.</p>';
                }
            })
            .catch(error => console.error('Error fetching nutrient data from Spoonacular:', error));
    }

</script>


@endsection
