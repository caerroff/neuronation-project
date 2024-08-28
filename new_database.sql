CREATE DATABASE OLD_DATABASE;

CREATE TABLE Users(
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    status INT NOT NULL,
    -- Making sure username is unique
    CONSTRAINT unique_username UNIQUE (username)
);

CREATE TABLE Courses(
    course_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
);


CREATE TABLE Sessions(
    session_id INT PRIMARY KEY AUTO_INCREMENT,
    course_id INT NOT NULL,
    timestamp DATETIME NOT NULL,
    -- Since we want to include the recent categories the user has trained on, we should include the category_name here to save some time when querying.
    category_name VARCHAR(50) NOT NULL,
    FOREIGN KEY (course_id) REFERENCES Courses(course_id),
    -- Add a constraint checking that category_name is a valid category
    CONSTRAINT valid_category CHECK (category_name IN (SELECT name FROM DomainCategories))
);

CREATE TABLE Scores(
    uid INT NOT NULL,
    sid INT NOT NULL,
    score INT NOT NULL,
    -- Removing score_normalized, as it can probably be calculated in the application. No need to store it.
    FOREIGN KEY (uid) REFERENCES Users(user_id),
    FOREIGN KEY (sid) REFERENCES Sessions(session_id),
    PRIMARY KEY (uid, sid)
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
    FOREIGN KEY (cat_id) REFERENCES DomainCategories(category_id),
);
