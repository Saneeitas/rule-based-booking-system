-- Create Users Table
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'staff') NOT NULL,
    dietary_restrictions VARCHAR(255),
    dietary_preferences VARCHAR(255)
);

-- Create Cafeterias Table
CREATE TABLE cafeterias (
    cafeteria_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    contact_phone VARCHAR(15),
    contact_email VARCHAR(255)
);

-- Create Menu Items Table
CREATE TABLE menu_items (
    menu_item_id INT PRIMARY KEY AUTO_INCREMENT,
    cafeteria_id INT,
    dish_name VARCHAR(255) NOT NULL,
    ingredients TEXT,
    portion_size VARCHAR(50),
    calories INT,
    carbohydrates INT,
    protein INT,
    fats INT,
    dietary_tags VARCHAR(255)
);

-- Create Bookings Table
CREATE TABLE bookings (
    booking_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    menu_item_id INT,
    booking_date DATE,
    booking_time TIME,
    special_requests TEXT
);
