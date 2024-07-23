CREATE TABLE categories(
	id int AUTO_INCREMENT PRIMARY KEY,
    name varchar(50)
);


CREATE TABLE products(
	product_number INT AUTO_INCREMENT,
    category_id int,
    title varchar(50) not null,
    description text not null,
    price int not null,
    quantity_avilable int not null,
    image varchar(100) not null,
    primary key(product_number),
    FOREIGN KEY(category_id) REFERENCES categories(id) on update cascade on delete cascade
);

CREATE TABLE coupon(
	id int AUTO_INCREMENT PRIMARY KEY,
    name varchar(50) not null,
    percent int not null,
    expiry_date date
);


CREATE TABLE users(
	id int AUTO_INCREMENT,
    name varchar(100) not null,
    email varchar(100) not null,
    `password` varchar(255) not null,
    phone varchar(12) not null,
    address varchar(255) NOT null,
    city varchar(20),
    postal_code int,
    role varchar(20),
    PRIMARY KEY (id)
);

CREATE TABLE orders(
	order_number int AUTO_INCREMENT PRIMARY KEY,
    order_date datetime NOT NULL DEFAULT NOW(),
    `first_price` int NOT null,
    `final_price` int NOT null,
    payment_type varchar(50),
    user_id int NOT null,
    FOREIGN KEY (user_id) REFERENCES users(id) on update cascade on delete cascade 
    
);

CREATE TABLE order_details(
	order_number int NOT null,
    product_number int not null,
    quantity int DEFAULT 1,
    price_each int not null,
    FOREIGN key (order_number) REFERENCES orders(order_number) on update cascade on delete cascade ,
    FOREIGN key (product_number) REFERENCES products(product_number)on update cascade on delete cascade
);


insert into coupon (name,percent,expiry_date) values
('RABG',10,'2024-04-01'),
('XB45',15,'2024-10-01'),
('MA18',5,'2024-06-01'),
('BYZX',20,'2024-08-01'),
('MOH52',25,'2024-11-15');

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `city`, `postal_code`,`role`) VALUES (NULL, 'admin', 'admin@admin.com', '$2y$10$FUrrLsGlfX/awwITBTSAF.QOS/LWUdUK60dchnVZ5wisVEMwXVsR.', '+20102597242', 'city/city', NULL, NULL,'admin');