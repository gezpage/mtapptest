# Mind Tools Test App

## Database creation SQL

    -- Mind Tools Test App
    -- Database creation script

    CREATE DATABASE mindtools;

    CREATE TABLE mindtools.users
    (
      id int PRIMARY KEY NOT NULL,
      username varchar(255) NOT NULL,
      email varchar(255) NOT NULL,
      name varchar(255) NOT NULL,
      password_hash varchar(255) NOT NULL,
      status enum('enabled', 'disabled', 'awaiting_verification') DEFAULT 'awaiting_verification' NOT NULL
    );

