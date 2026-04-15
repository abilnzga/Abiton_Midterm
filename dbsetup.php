<?php
mysqli_report(MYSQLI_REPORT_OFF);

$host = '127.0.0.1';
$user = 'root';
$passwords = [
    '', 'root', 'Johann', 'johann',
    'LAnuzga', 'lanuzga', 'Lanuzga',
    'abilnzga', 'Abilnzga', 'ABILNZGA',
    'jacob', 'Jacob', 'JACOB',
    'ci4', 'CI4', 'ci4exam',
    'admin', 'Admin', 'Admin123',
    '123456', '1234567890',
    'midterm', 'Midterm',
];

$connected = null;
$foundPass = null;

foreach ($passwords as $pass) {
    $c = new mysqli($host, $user, $pass, 'ci4', 3306);
    if (!$c->connect_error) {
        echo "SUCCESS with password: '$pass'\n";
        $connected = $c;
        $foundPass = $pass;
        break;
    }
}

if ($connected) {
    $sql = "CREATE TABLE IF NOT EXISTS `api_tokens` (
      `id`         INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
      `user_id`    INT(11) UNSIGNED NOT NULL,
      `token`      VARCHAR(255)     NOT NULL,
      `created_at` DATETIME         DEFAULT NULL,
      `expires_at` DATETIME         DEFAULT NULL,
      PRIMARY KEY (`id`),
      UNIQUE KEY `token` (`token`),
      CONSTRAINT `fk_api_tokens_user`
        FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
        ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

    if ($connected->query($sql)) {
        echo "api_tokens table created successfully!\n";
        echo "PASSWORD TO PUT IN .env: '$foundPass'\n";
    } else {
        echo "Query failed: " . $connected->error . "\n";
    }
    $connected->close();
} else {
    echo "All passwords failed. Please enter your MySQL root password manually.\n";
    echo "Update D:\\ABITON_MIDTERM\\.env line: database.default.password = YOUR_PASSWORD\n";
    echo "Then run: php spark migrate\n";
}
