-- Modelo do banco de dados

create DATABASE petshop;

CREATE TABLE users(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(20) NOT NULL, 
    pwd VARCHAR(255) NOT NULL, 
    email VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);


CREATE TABLE products(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    name VARCHAR (60) NOT NULL,
    description TEXT NOT NULL, 
    image VARCHAR(255) NOT NULL, 
    price DECIMAL(9,2) NOT NULL,
    quantity INT(9) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);


SELECT
      a.name,
      GROUP_CONCAT(b.tag)
FROM products a
JOIN products_tags b
USING (id)
WHERE id = 8;


