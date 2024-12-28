-- Create customers table (for authentication)
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,                 -- Unique identifier for each user
    username VARCHAR(100) NOT NULL,                         -- User's username
    email VARCHAR(150) NOT NULL UNIQUE,                     -- User's email, must be unique
    password_hash VARCHAR(255) NOT NULL,                    -- Password stored as a hashed value
    role ENUM('user', 'admin') DEFAULT 'user',              -- User role, defaults to 'user'
    status ENUM('active', 'inactive') DEFAULT 'active',     -- User account status, defaults to 'active'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,         -- Account creation timestamp
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Auto-update on modification
);


--Create categories table
CREATE TABLE Categories (
  category_id INT AUTO_INCREMENT PRIMARY KEY,    -- Unique ID for each category
  category_name VARCHAR(255) NOT NULL UNIQUE,    -- Name of the category
  category_description TEXT,                     -- Description of the category
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Timestamp when the category was created
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Auto-update on record modification
);

--Create products table
CREATE TABLE Products (
  product_id INT AUTO_INCREMENT PRIMARY KEY,
  product_name VARCHAR(255) NOT NULL,
  product_description TEXT,
  product_price DECIMAL(10, 2) NOT NULL,
  product_image VARCHAR(255),
  category_id INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (category_id) REFERENCES Categories(category_id)
);

--Create orders table
CREATE TABLE Orders (
  order_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  total_price DECIMAL(10, 2) NOT NULL,
  order_status ENUM('pending', 'completed', 'canceled') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

--Create orderItems table
CREATE TABLE OrderItems (
  orderItem_id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  quantity INT NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  FOREIGN KEY (order_id) REFERENCES Orders(order_id),
  FOREIGN KEY (product_id) REFERENCES Products(product_id)
);

CREATE TABLE Cart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
);

--Create payment table
CREATE TABLE Payments (
  payment_id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  payment_method ENUM('credit_card', 'paypal', 'bank_transfer') NOT NULL,
  payment_status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
  payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  amount DECIMAL(10, 2) NOT NULL,
  FOREIGN KEY (order_id) REFERENCES Orders(order_id)
);

CREATE TABLE Shipping (
    shipping_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    -- postal_code VARCHAR(20) NOT NULL,
    country VARCHAR(100) NOT NULL,
    shipping_status ENUM('pending', 'shipped', 'delivered') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES Orders(order_id)
);

CREATE TABLE Wishlist (
    wishlist_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users(user_id),
    FOREIGN KEY (product_id) REFERENCES Products(product_id)
);

CREATE TABLE Reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    user_id INT NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    review_text TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES Products(product_id),
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

-- Create shops table
CREATE TABLE Shops (
    shop_id INT AUTO_INCREMENT PRIMARY KEY,                 -- Unique identifier for each shop
    shop_name VARCHAR(255) NOT NULL,                        -- Name of the shop
    owner_id INT NOT NULL,                                  -- Reference to the owner (user_id from Users table)
    shop_description TEXT,                                  -- Description of the shop
    shop_address VARCHAR(255),                              -- Address of the shop
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,         -- Shop creation timestamp
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Auto-update on modification
    FOREIGN KEY (owner_id) REFERENCES Users(user_id)        -- Foreign key to link shop owner
);

-- Modify Products table to link products with a shop
ALTER TABLE Products
ADD COLUMN shop_id INT,
ADD FOREIGN KEY (shop_id) REFERENCES Shops(shop_id);
