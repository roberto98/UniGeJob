CREATE DATABASE IF NOT EXISTS db;

CREATE TABLE IF NOT EXISTS users (
  id int(11) NOT NULL AUTO_INCREMENT,
  email varchar(100) NOT NULL,
  first_name varchar(100) NOT NULL,
  last_name varchar(100) NOT NULL,
  sesso varchar(15),
  birthday date default '0000-00-00',
  address varchar(100),
  city varchar(100),
  state varchar(100),
  foto_profilo varchar(100) default '../icon/circolari.png',
  hashedpassword varchar(100) NOT NULL,
  insert_date datetime default now(),
  newsletter boolean NOT NULL  default false,
  PRIMARY KEY (id),
  UNIQUE KEY(email)   );

CREATE TABLE IF NOT EXISTS annunci (
  id int(11) NOT NULL AUTO_INCREMENT,
  email varchar(100) NOT NULL,
  title varchar(100) NOT NULL,
  description varchar(2000) NOT NULL,
  immagine varchar(100) default '../icon/not-found.png',
  rag_sociale varchar(10),
  num_cell varchar(15),
  insert_date datetime default now(),
  PRIMARY KEY (id)    );

CREATE TABLE IF NOT EXISTS password_resets (
  id int(11) NOT NULL AUTO_INCREMENT,
  email varchar(255) NOT NULL,
  token varchar(255) NOT NULL,
  insert_date datetime default now(),
  PRIMARY KEY (id),
  UNIQUE KEY(token)     );
