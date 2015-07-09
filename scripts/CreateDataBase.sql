
  DROP DATABASE IF EXISTS Gallery;

  CREATE DATABASE IF NOT EXISTS Gallery;

  USE Gallery;

  CREATE TABLE image (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                      CreateTS DATETIME NOT NULL,
                      BaseName VARCHAR(255) NOT NULL,
                      UUIDName VARCHAR(255) NOT NULL
                     );
  CREATE TABLE comment(id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        CreateTS DATETIME NOT NULL,
                        Imgtext VARCHAR(255),
                        ImageID int(11) NOT NULL,
                        FOREIGN KEY(ImageID) REFERENCES  image(id)
                      );