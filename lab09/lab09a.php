<?php
// Lab 09 Nathan Ngo 501090210

$connect = mysqli_connect("localhost", "n8ngo", "AJKhfUyk", "n8ngo") or die("Connection failed: " . mysqli_connect_error());

$drop_table_query = "DROP TABLE IF EXISTS photos";
mysqli_query($connect, $drop_table_query) or die("Error dropping table: " . mysqli_error($connect));

$table_query = "
CREATE TABLE IF NOT EXISTS photos (
    picture_number INT AUTO_INCREMENT PRIMARY KEY,
    subject VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    date_taken DATE NOT NULL,
    picture_url VARCHAR(255) NOT NULL
)";
mysqli_query($connect, $table_query) or die("Error creating table: " . mysqli_error($connect));

$cities = [
    ['City of Toronto', 'Toronto, Ontario, Canada', '2020-05-20', 'images/toronto.jpg'],
    ['City of Vancouver', 'Vancouver, British Columbia, Canada', '2021-06-15', 'images/vancouver.jpg'],
    ['City of New York', 'New York, New York, USA', '2019-07-01', 'images/newyork.jpg'],
    ['City of Los Angeles', 'Los Angeles, California, USA', '2022-07-10', 'images/losangeles.jpg'],
    ['City of London', 'London, England, UK', '2020-08-05', 'images/london.jpg'],
    ['City of Paris', 'Paris, Île-de-France, France', '2020-09-12', 'images/paris.jpg'],
    ['City of Tokyo', 'Tokyo, Kantō, Japan', '2023-10-20', 'images/tokyo.jpg'],
    ['City of Sydney', 'Sydney, New South Wales, Australia', '2021-11-05', 'images/sydney.jpg'],
    ['City of Dubai', 'Dubai, Dubai, UAE', '2022-12-01', 'images/dubai.jpg'],
    ['City of Berlin', 'Berlin, Berlin, Germany', '2019-12-15', 'images/berlin.jpg'],
    ['City of Ottawa', 'Ottawa, Ontario, Canada', '2021-02-03', 'images/ottawa.jpg'],
];

echo "<h1>Table Populated!</h1>";
foreach ($cities as $city) {
    $insert_query = "
    INSERT INTO photos (subject, location, date_taken, picture_url)
    VALUES ('{$city[0]}', '{$city[1]}', '{$city[2]}', '{$city[3]}')
    ";
    mysqli_query($connect, $insert_query);

    echo "<p>Inserted: Subject: {$city[0]}, Location: {$city[1]}, Date Taken: {$city[2]}, URL: {$city[3]}</p>";
}

mysqli_close($connect);
?>
