-- Sample data for Cafeterias Table
INSERT INTO cafeterias (name, location, contact_phone, contact_email)
VALUES
    ('Cafeteria 1', 'Campus A', '123-456-7890', 'cafeteria1@example.com'),
    ('Cafeteria 2', 'Campus B', '987-654-3210', 'cafeteria2@example.com'),
    ('Cafeteria 3', 'Campus C', '555-123-4567', 'cafeteria3@example.com');

-- Sample data for Menu Items Table
INSERT INTO menu_items (cafeteria_id, dish_name, ingredients, portion_size, calories, carbohydrates, protein, fats, dietary_tags)
VALUES
    (1, 'Vegetable Stir-Fry', 'Mixed vegetables, tofu, soy sauce', 'Medium', 300, 25, 15, 10, 'vegetarian, vegan'),
    (1, 'Grilled Chicken Salad', 'Grilled chicken breast, mixed greens, vinaigrette', 'Large', 400, 5, 30, 15, 'low-carb'),
    (2, 'Margherita Pizza', 'Tomato sauce, mozzarella, basil', 'Large', 600, 50, 20, 30, 'vegetarian'),
    (2, 'Pasta Primavera', 'Pasta, assorted vegetables, cream sauce', 'Medium', 450, 60, 10, 20, 'vegetarian'),
    (3, 'Salmon Bowl', 'Grilled salmon, brown rice, teriyaki sauce', 'Large', 550, 45, 30, 25, 'low-carb, high-protein'),
    (1, 'Vegan Burrito', 'Black beans, rice, guacamole, salsa', 'Medium', 380, 70, 10, 15, 'vegan'),
    (1, 'Fruit Salad', 'Assorted fresh fruits, honey drizzle', 'Small', 150, 40, 2, 1, 'vegetarian'),
    (3, 'Mushroom Risotto', 'Arborio rice, mushrooms, parmesan', 'Medium', 500, 60, 8, 25, 'vegetarian'),
    (2, 'Chicken Shawarma', 'Grilled chicken, pita, tahini sauce', 'Large', 550, 40, 25, 30, 'high-protein'),
    (3, 'Tofu Noodle Bowl', 'Tofu, soba noodles, sesame dressing', 'Medium', 350, 45, 15, 10, 'vegetarian, vegan');
