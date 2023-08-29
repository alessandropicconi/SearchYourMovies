CREATE TABLE users (
  id SERIAL,
  user_name varchar(255) NOT NULL ,
  email varchar(255) NOT NULL,
  pass varchar(255) NOT NULL,
  codeV varchar(255) NOT NULL,
  verification BOOLEAN NOT NULL DEFAULT FALSE,
  is_admin INT,
  status INT
);
ALTER TABLE users  ADD PRIMARY KEY (id);



CREATE TABLE favourites (
id SERIAL,
user_id INT,
movie_id INT,
FOREIGN KEY (user_id) REFERENCES users(id)

)

CREATE TABLE reports(
 user_name varchar(255) NOT NULL;
  report TEXT
)
CREATE TABLE image (
  user_name varchar(255),
  filename varchar(255)
) 

CREATE TABLE reviews(
  movie_name TEXT,
  movie_id INT,
  name varchar(255),
  review TEXT
)

/*

mancano i commenti
*/



















