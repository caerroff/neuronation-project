CREATE DATABASE OLD_DATABASE;

CREATE TABLE Users(
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    status INT NOT NULL
);

CREATE TABLE Courses(
    course_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    timestramp DATETIME NOT NULL,
);


CREATE TABLE Sessions(
    session_id INT PRIMARY KEY AUTO_INCREMENT,
    course_id INT NOT NULL,
    timestamp DATETIME NOT NULL,
    FOREIGN KEY (course_id) REFERENCES Courses(course_id)
);

CREATE TABLE Scores(
    score_id INT PRIMARY KEY AUTO_INCREMENT,
    uid INT NOT NULL,
    sid INT NOT NULL,
    score INT NOT NULL,
    score_normalized INT NOT NULL,
    FOREIGN KEY (uid) REFERENCES Users(user_id),
    FOREIGN KEY (sid) REFERENCES Sessions(session_id)
);

CREATE TABLE DomainCategories(
    category_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE Exercises(
    exercise_id INT PRIMARY KEY AUTO_INCREMENT,
    course_id INT NOT NULL,
    cat_id INT NOT NULL,
    name VARCHAR(50) NOT NULL,
    points INT NOT NULL,
    FOREIGN KEY (course_id) REFERENCES Courses(course_id),
    FOREIGN KEY (cat_id) REFERENCES DomainCategories(category_id)
);
