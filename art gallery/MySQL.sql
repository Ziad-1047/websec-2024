
CREATE DATABASE artgallery;
USE artgallery;

CREATE TABLE artworks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  artist VARCHAR(255),
  description TEXT,
  price DECIMAL(10, 2)
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255),
  password VARCHAR(255),
  role VARCHAR(20)
);
INSERT INTO users (username, password, role) VALUES
    ('user', 'user123', 'regular'),
    ('artist', 'artist123', 'artist'),
    ('admin', 'admin123', 'admin');


SELECT * FROM users WHERE username = 'admin';

INSERT INTO users (username, password, role) VALUES
    ('ziad', 'ziad123', 'regular'),
    ('mike', 'mike123', 'artist'),
    ('ronaldo', 'ronaldo123', 'admin');
