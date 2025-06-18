<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FoodRecommendation;

class FoodRecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recommendations = [
            // ===== MONDAY MEALS =====
            // Breakfast
            [
                'name' => 'Oatmeal dengan Buah',
                'description' => 'Oatmeal dengan potongan pisang, strawberry, dan taburan almond. Sarapan sehat yang mengenyangkan dan kaya serat.',
                'diet_types' => ['Low Fat', 'Balanced Diet', 'DASH'],
                'meal_type' => 'breakfast',
                'day' => 'monday',
                'calories_per_serving' => 320,
                'is_active' => true,
            ],
            [
                'name' => 'Greek Yogurt Parfait',
                'description' => 'Greek yogurt berlapis dengan granola, madu, dan buah-buahan segar. Tinggi protein dan probiotik.',
                'diet_types' => ['Low Fat'],
                'meal_type' => 'breakfast',
                'day' => 'monday',
                'calories_per_serving' => 280,
                'is_active' => true,
            ],
            // Lunch
            [
                'name' => 'Salad Quinoa Mediterranean',
                'description' => 'Salad quinoa dengan olive, feta cheese, tomat cherry, dan dressing lemon olive oil.',
                'diet_types' => ['Mediterranean',],
                'meal_type' => 'lunch',
                'day' => 'monday',
                'calories_per_serving' => 420,
                'is_active' => true,
            ],
            [
                'name' => 'Sup Sayuran dan Kacang',
                'description' => 'Sup hangat dengan berbagai sayuran segar dan kacang merah. Kaya serat dan protein nabati.',
                'diet_types' => ['Low Fat', 'DASH'],
                'meal_type' => 'lunch',
                'day' => 'monday',
                'calories_per_serving' => 350,
                'is_active' => true,
            ],
            // Dinner
            [
                'name' => 'Salmon Panggang dengan Asparagus',
                'description' => 'Fillet salmon panggang dengan asparagus dan kentang baby. Kaya omega-3 dan antioksidan.',
                'diet_types' => ['Mediterranean', 'Low Carb'],
                'meal_type' => 'dinner',
                'day' => 'monday',
                'calories_per_serving' => 380,
                'is_active' => true,
            ],

            // ===== TUESDAY MEALS =====
            // Breakfast
            [
                'name' => 'Telur Dadar Sayuran',
                'description' => 'Telur dadar dengan campuran bayam, tomat, dan paprika. Tinggi protein dan vitamin.',
                'diet_types' => ['Low Carb', 'Balanced Diet'],
                'meal_type' => 'breakfast',
                'day' => 'tuesday',
                'calories_per_serving' => 280,
                'is_active' => true,
            ],
            [
                'name' => 'Chia Pudding',
                'description' => 'Pudding chia dengan susu almond, vanilla, dan topping buah kiwi dan raspberry.',
                'diet_types' => ['Low Fat',],
                'meal_type' => 'breakfast',
                'day' => 'tuesday',
                'calories_per_serving' => 250,
                'is_active' => true,
            ],
            // Lunch
            [
                'name' => 'Bowl Buddha Vegetarian',
                'description' => 'Bowl dengan quinoa, roasted chickpeas, avocado, wortel panggang, dan tahini dressing.',
                'diet_types' => ['Balanced Diet', 'Mediterranean'],
                'meal_type' => 'lunch',
                'day' => 'tuesday',
                'calories_per_serving' => 480,
                'is_active' => true,
            ],
            [
                'name' => 'Grilled Chicken Salad',
                'description' => 'Salad mix dengan dada ayam panggang, cherry tomato, cucumber, dan vinaigrette.',
                'diet_types' => ['Low Carb', 'Low Fat'],
                'meal_type' => 'lunch',
                'day' => 'tuesday',
                'calories_per_serving' => 390,
                'is_active' => true,
            ],
            // Dinner
            [
                'name' => 'Tuna Steak dengan Sayuran Panggang',
                'description' => 'Tuna steak segar dengan zucchini, bell pepper, dan eggplant panggang.',
                'diet_types' => ['Mediterranean', 'Low Carb'],
                'meal_type' => 'dinner',
                'day' => 'tuesday',
                'calories_per_serving' => 360,
                'is_active' => true,
            ],

            // ===== WEDNESDAY MEALS =====
            // Breakfast
            [
                'name' => 'Smoothie Bowl Hijau',
                'description' => 'Smoothie bowl dari bayam, pisang, dan mangga dengan topping granola dan chia seed.',
                'diet_types' => ['Low Fat', 'Balanced Diet'],
                'meal_type' => 'breakfast',
                'day' => 'wednesday',
                'calories_per_serving' => 290,
                'is_active' => true,
            ],
            [
                'name' => 'Pancake Oat Pisang',
                'description' => 'Pancake sehat dari oat dan pisang tanpa tepung, disajikan dengan maple syrup.',
                'diet_types' => ['Low Fat', 'Balanced Diet'],
                'meal_type' => 'breakfast',
                'day' => 'wednesday',
                'calories_per_serving' => 310,
                'is_active' => true,
            ],
            // Lunch
            [
                'name' => 'Lentil Curry',
                'description' => 'Kari lentil dengan santan tipis, sayuran, dan rempah-rempah. Tinggi protein dan serat.',
                'diet_types' => ['DASH'],
                'meal_type' => 'lunch',
                'day' => 'wednesday',
                'calories_per_serving' => 410,
                'is_active' => true,
            ],
            [
                'name' => 'Turkey Wrap',
                'description' => 'Wrap whole wheat dengan turkey breast, lettuce, tomato, dan avocado.',
                'diet_types' => ['Balanced Diet', 'Low Fat'],
                'meal_type' => 'lunch',
                'day' => 'wednesday',
                'calories_per_serving' => 380,
                'is_active' => true,
            ],
            // Dinner
            [
                'name' => 'Tofu Teriyaki dengan Brokoli',
                'description' => 'Tofu panggang dengan saus teriyaki rendah sodium dan brokoli kukus.',
                'diet_types' => ['Low Fat', 'Balanced Diet'],
                'meal_type' => 'dinner',
                'day' => 'wednesday',
                'calories_per_serving' => 320,
                'is_active' => true,
            ],

            // ===== THURSDAY MEALS =====
            // Breakfast
            [
                'name' => 'Avocado Toast',
                'description' => 'Roti gandum dengan alpukat tumbuk, tomat cherry, dan taburan biji wijen.',
                'diet_types' => ['Mediterranean', 'Balanced Diet'],
                'meal_type' => 'breakfast',
                'day' => 'thursday',
                'calories_per_serving' => 340,
                'is_active' => true,
            ],
            [
                'name' => 'Protein Smoothie',
                'description' => 'Smoothie protein dengan whey, pisang, spinach, dan almond milk.',
                'diet_types' => ['Low Fat',],
                'meal_type' => 'breakfast',
                'day' => 'thursday',
                'calories_per_serving' => 270,
                'is_active' => true,
            ],
            // Lunch
            [
                'name' => 'Mediterranean Chicken Bowl',
                'description' => 'Bowl dengan ayam panggang, quinoa, hummus, cucumber, dan olive oil dressing.',
                'diet_types' => ['Mediterranean', 'Balanced Diet'],
                'meal_type' => 'lunch',
                'day' => 'thursday',
                'calories_per_serving' => 450,
                'is_active' => true,
            ],
            [
                'name' => 'Zucchini Noodles dengan Pesto',
                'description' => 'Zucchini spiralized dengan pesto basil, cherry tomato, dan parmesan.',
                'diet_types' => ['Low Carb', 'Mediterranean'],
                'meal_type' => 'lunch',
                'day' => 'thursday',
                'calories_per_serving' => 300,
                'is_active' => true,
            ],
            // Dinner
            [
                'name' => 'Beef Stir Fry',
                'description' => 'Tumis daging sapi dengan sayuran beragam dan saus rendah sodium.',
                'diet_types' => ['Low Carb', 'Balanced Diet'],
                'meal_type' => 'dinner',
                'day' => 'thursday',
                'calories_per_serving' => 420,
                'is_active' => true,
            ],

            // ===== FRIDAY MEALS =====
            // Breakfast
            [
                'name' => 'Quinoa Breakfast Bowl',
                'description' => 'Quinoa dengan almond milk, cinnamon, dan topping buah-buahan segar.',
                'diet_types' => ['Balanced Diet'],
                'meal_type' => 'breakfast',
                'day' => 'friday',
                'calories_per_serving' => 330,
                'is_active' => true,
            ],
            [
                'name' => 'Egg Benedict Sehat',
                'description' => 'English muffin whole wheat dengan telur poached, avocado, dan yogurt sauce.',
                'diet_types' => ['Balanced Diet',],
                'meal_type' => 'breakfast',
                'day' => 'friday',
                'calories_per_serving' => 350,
                'is_active' => true,
            ],
            // Lunch
            [
                'name' => 'Ayam Panggang dengan Sayuran',
                'description' => 'Dada ayam panggang dengan brokoli, wortel, dan ubi jalar panggang.',
                'diet_types' => ['Low Fat', 'Balanced Diet'],
                'meal_type' => 'lunch',
                'day' => 'friday',
                'calories_per_serving' => 450,
                'is_active' => true,
            ],
            [
                'name' => 'Sushi Bowl',
                'description' => 'Brown rice bowl dengan salmon, avocado, edamame, dan nori.',
                'diet_types' => ['Mediterranean', 'Balanced Diet'],
                'meal_type' => 'lunch',
                'day' => 'friday',
                'calories_per_serving' => 460,
                'is_active' => true,
            ],
            // Dinner
            [
                'name' => 'Cod Fish dengan Lemon Herbs',
                'description' => 'Ikan cod panggang dengan herbs dan lemon, disajikan dengan quinoa.',
                'diet_types' => ['Low Fat', 'Mediterranean'],
                'meal_type' => 'dinner',
                'day' => 'friday',
                'calories_per_serving' => 340,
                'is_active' => true,
            ],

            // ===== SATURDAY MEALS =====
            // Breakfast
            [
                'name' => 'French Toast Sehat',
                'description' => 'French toast dari roti gandum dengan telur, cinnamon, dan topping berries.',
                'diet_types' => ['Balanced Diet',],
                'meal_type' => 'breakfast',
                'day' => 'saturday',
                'calories_per_serving' => 360,
                'is_active' => true,
            ],
            [
                'name' => 'Acai Bowl',
                'description' => 'Acai bowl dengan granola, coconut flakes, dan berbagai buah tropis.',
                'diet_types' => ['Low Fat', 'Balanced Diet'],
                'meal_type' => 'breakfast',
                'day' => 'saturday',
                'calories_per_serving' => 320,
                'is_active' => true,
            ],
            // Lunch
            [
                'name' => 'Stuffed Bell Pepper',
                'description' => 'Paprika isi dengan quinoa, kacang hitam, corn, dan cheese rendah lemak.',
                'diet_types' => ['Balanced Diet'],
                'meal_type' => 'lunch',
                'day' => 'saturday',
                'calories_per_serving' => 380,
                'is_active' => true,
            ],
            [
                'name' => 'Poke Bowl',
                'description' => 'Hawaiian poke bowl dengan raw tuna, brown rice, dan vegetables.',
                'diet_types' => ['Low Fat', 'Balanced Diet'],
                'meal_type' => 'lunch',
                'day' => 'saturday',
                'calories_per_serving' => 420,
                'is_active' => true,
            ],
            // Dinner
            [
                'name' => 'Grilled Portobello Mushroom',
                'description' => 'Jamur portobello panggang dengan balsamic glaze dan roasted vegetables.',
                'diet_types' => ['Low Carb', 'Mediterranean'],
                'meal_type' => 'dinner',
                'day' => 'saturday',
                'calories_per_serving' => 280,
                'is_active' => true,
            ],

            // ===== SUNDAY MEALS =====
            // Breakfast
            [
                'name' => 'Breakfast Burrito Bowl',
                'description' => 'Bowl dengan scrambled eggs, black beans, avocado, salsa, dan cheese.',
                'diet_types' => ['Balanced Diet',],
                'meal_type' => 'breakfast',
                'day' => 'sunday',
                'calories_per_serving' => 380,
                'is_active' => true,
            ],
            [
                'name' => 'Muesli dengan Yogurt',
                'description' => 'Muesli dengan greek yogurt, madu, dan nuts. Kaya serat dan protein.',
                'diet_types' => ['Balanced Diet'],
                'meal_type' => 'breakfast',
                'day' => 'sunday',
                'calories_per_serving' => 340,
                'is_active' => true,
            ],
            // Lunch
            [
                'name' => 'Gazpacho dengan Salad',
                'description' => 'Gazpacho dingin dengan mixed green salad dan whole grain croutons.',
                'diet_types' => ['Low Fat', 'Mediterranean'],
                'meal_type' => 'lunch',
                'day' => 'sunday',
                'calories_per_serving' => 300,
                'is_active' => true,
            ],
            [
                'name' => 'Chickpea Curry',
                'description' => 'Kari kacang arab dengan sayuran dan santan tipis, disajikan dengan brown rice.',
                'diet_types' => ['DASH'],
                'meal_type' => 'lunch',
                'day' => 'sunday',
                'calories_per_serving' => 400,
                'is_active' => true,
            ],
            // Dinner
            [
                'name' => 'Tahu Tempe Bacem',
                'description' => 'Tahu dan tempe bacem dengan kuah santan tipis dan sayuran tradisional.',
                'diet_types' => ['Balanced Diet'],
                'meal_type' => 'dinner',
                'day' => 'sunday',
                'calories_per_serving' => 320,
                'is_active' => true,
            ],

            // ===== GENERAL SNACKS (Can be eaten any day) =====
            [
                'name' => 'Greek Yogurt dengan Berries',
                'description' => 'Greek yogurt plain dengan campuran blueberry, raspberry, dan madu.',
                'diet_types' => ['Low Fat',],
                'meal_type' => 'snack',
                'day' => null,
                'calories_per_serving' => 150,
                'is_active' => true,
            ],
            [
                'name' => 'Hummus dengan Sayuran',
                'description' => 'Hummus buatan sendiri dengan stik wortel, mentimun, dan paprika.',
                'diet_types' => ['Mediterranean', 'Low Fat'],
                'meal_type' => 'snack',
                'day' => null,
                'calories_per_serving' => 180,
                'is_active' => true,
            ],
            [
                'name' => 'Mixed Nuts',
                'description' => 'Campuran kacang almond, walnut, dan cashew tanpa garam tambahan.',
                'diet_types' => ['Mediterranean', 'Low Carb'],
                'meal_type' => 'snack',
                'day' => null,
                'calories_per_serving' => 200,
                'is_active' => true,
            ],
            [
                'name' => 'Apple dengan Almond Butter',
                'description' => 'Potongan apel dengan 1 sdm almond butter untuk protein dan lemak sehat.',
                'diet_types' => ['Balanced Diet', 'Low Fat'],
                'meal_type' => 'snack',
                'day' => null,
                'calories_per_serving' => 190,
                'is_active' => true,
            ],
            [
                'name' => 'Dark Chocolate dengan Strawberry',
                'description' => 'Dark chocolate 70% dengan strawberry segar sebagai dessert sehat.',
                'diet_types' => ['Mediterranean', 'Low Fat'],
                'meal_type' => 'snack',
                'day' => null,
                'calories_per_serving' => 140,
                'is_active' => true,
            ],
            [
                'name' => 'Protein Ball',
                'description' => 'Energy ball dari oat, protein powder, peanut butter, dan honey.',
                'diet_types' => ['Balanced Diet'],
                'meal_type' => 'snack',
                'day' => null,
                'calories_per_serving' => 160,
                'is_active' => true,
            ],
            [
                'name' => 'Cottage Cheese dengan Buah',
                'description' => 'Cottage cheese rendah lemak dengan potongan peach dan cinnamon.',
                'diet_types' => ['Low Fat',],
                'meal_type' => 'snack',
                'day' => null,
                'calories_per_serving' => 120,
                'is_active' => true,
            ],
            [
                'name' => 'Edamame',
                'description' => 'Edamame kukus dengan sedikit sea salt sebagai snack tinggi protein.',
                'diet_types' => ['Low Fat'],
                'meal_type' => 'snack',
                'day' => null,
                'calories_per_serving' => 130,
                'is_active' => true,
            ],

            // ===== ADDITIONAL BREAKFAST OPTIONS =====
            [
                'name' => 'Overnight Oats Cokelat',
                'description' => 'Overnight oats dengan cocoa powder, chia seeds, dan sliced banana.',
                'diet_types' => ['Balanced Diet'],
                'meal_type' => 'breakfast',
                'day' => null,
                'calories_per_serving' => 300,
                'is_active' => true,
            ],
            [
                'name' => 'Breakfast Quinoa Salad',
                'description' => 'Quinoa salad dengan cucumber, mint, feta cheese, dan lemon dressing.',
                'diet_types' => ['Mediterranean',],
                'meal_type' => 'breakfast',
                'day' => null,
                'calories_per_serving' => 320,
                'is_active' => true,
            ],

            // ===== ADDITIONAL LUNCH OPTIONS =====
            [
                'name' => 'Thai Beef Salad',
                'description' => 'Salad daging sapi dengan herbs Thailand, lime dressing, dan vegetables.',
                'diet_types' => ['Low Carb', 'Balanced Diet'],
                'meal_type' => 'lunch',
                'day' => null,
                'calories_per_serving' => 380,
                'is_active' => true,
            ],
            [
                'name' => 'Ratatouille dengan Quinoa',
                'description' => 'Ratatouille tradisional Prancis disajikan dengan quinoa sebagai protein.',
                'diet_types' => ['Mediterranean', 'Low Fat'],
                'meal_type' => 'lunch',
                'day' => null,
                'calories_per_serving' => 350,
                'is_active' => true,
            ],

            // ===== ADDITIONAL DINNER OPTIONS =====
            [
                'name' => 'Baked Sweet Potato dengan Kacang',
                'description' => 'Ubi jalar panggang dengan black beans, avocado, dan yogurt sauce.',
                'diet_types' => ['Balanced Diet'],
                'meal_type' => 'dinner',
                'day' => null,
                'calories_per_serving' => 360,
                'is_active' => true,
            ],
            [
                'name' => 'Mediterranean Fish Stew',
                'description' => 'Semur ikan dengan tomat, olive, dan herbs khas Mediterania.',
                'diet_types' => ['Mediterranean', 'Low Fat'],
                'meal_type' => 'dinner',
                'day' => null,
                'calories_per_serving' => 320,
                'is_active' => true,
            ],
        ];

        foreach ($recommendations as $recommendation) {
            FoodRecommendation::create($recommendation);
        }
    }
}
