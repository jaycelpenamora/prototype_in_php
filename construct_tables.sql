CREATE TABLE `movies_T` (
    `movie_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `language` VARCHAR(255) NOT NULL,
    `genre` VARCHAR(255) NOT NULL,
    `release_date` DATETIME NOT NULL,
    `rental_price` DECIMAL(8, 2) NOT NULL,
    UNIQUE KEY `movies_t_title_unique` (`title`),
    INDEX `movies_t_genre_index` (`genre`)
);

CREATE TABLE `users_T` (
    `user_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `age` TINYINT UNSIGNED NOT NULL,
    `country` VARCHAR(255) NOT NULL,
    `social_media_url` VARCHAR(255) NOT NULL,
    `created_at` DATETIME NOT NULL,
    `updated_at` DATETIME NOT NULL,
    UNIQUE KEY `users_t_email_unique` (`email`)
);

CREATE TABLE `rentals_T` (
    `rental_id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `movie_id` BIGINT UNSIGNED NOT NULL,
    `issued_date` DATETIME NOT NULL,
    `due_date` DATETIME NOT NULL,
    `return_date` DATETIME NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users_T` (`user_id`),
    FOREIGN KEY (`movie_id`) REFERENCES `movies_T` (`movie_id`)
);
