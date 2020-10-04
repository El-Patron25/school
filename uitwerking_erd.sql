
CREATE DATABASE IF NOT EXISTS booksstore;

CREATE TABLE IF NOT EXISTS users (
	user_id INT(22) NOT NULL AUTO_INCREMENT,
	username VARCHAR(255) NOT NULL,
	created_at DATETIME,
	updated_at DATETIME,
	PRIMARY KEY (user_id)
);

CREATE TABLE IF NOT EXISTS authors (
	author_id INT(22) NOT NULL AUTO_INCREMENT,
	first_name VARCHAR(255) NOT NULL,
	last_name VARCHAR(255) NOT NULL,
	created_at DATETIME,
	updated_at DATETIME,
	PRIMARY KEY (author_id)
);

CREATE TABLE IF NOT EXISTS books (
	book_id INT(22) NOT NULL AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
	author_id INT(22) NOT NULL,
	publishing_year VARCHAR(255) NOT NULL,
	genre VARCHAR(255) NOT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME NOT NULL,
	PRIMARY KEY (book_id),
	FOREIGN KEY (author_id) REFERENCES authors(author_id)

);

CREATE TABLE IF NOT EXISTS favourites (
	favourite_id INT(22) NOT NULL AUTO_INCREMENT,
	user_id INT(22) NOT NULL,
	book_id INT(22) NOT NULL,
	created_at DATETIME,
	updated_at DATETIME,
	PRIMARY KEY (favourite_id),
	FOREIGN KEY (user_id) REFERENCES users (user_id),
	FOREIGN KEY (book_id) REFERENCES books (book_id)
);