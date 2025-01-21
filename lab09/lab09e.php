<?php
// Lab 09 Nathan Ngo 501090210

$connect = mysqli_connect("localhost", "n8ngo", "AJKhfUyk", "n8ngo") or die("Connection failed: " . mysqli_connect_error());

$total_query = "SELECT COUNT(*) AS total FROM photos";
$total_result = mysqli_query($connect, $total_query);
$total = mysqli_fetch_assoc($total_result)['total'];

$random_query = "SELECT * FROM photos ORDER BY RAND() LIMIT 1";
$random_result = mysqli_query($connect, $random_query);
$photo = mysqli_fetch_assoc($random_result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lab 09: Random Photo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Random Photo</h1>
    <p>Total Photos: <strong><?php echo $total; ?></strong></p>
    <?php if ($photo): ?>
        <div class="photo">
            <img src="<?php echo $photo['picture_url']; ?>" alt="<?php echo $photo['subject']; ?>">
            <p>
                <strong>Photo #:</strong> <?php echo $photo['picture_number']; ?><br>
                <strong>Subject:</strong> <?php echo $photo['subject']; ?><br>
                <strong>Location:</strong> <?php echo $photo['location']; ?><br>
                <strong>Date Taken:</strong> <?php echo $photo['date_taken']; ?><br>
                <strong>Image URL:</strong> <a href="<?php echo $photo['picture_url']; ?>"><?php echo $photo['picture_url']; ?></a>
            </p>
        </div>
    <?php else: ?>
        <p>No photos available.</p>
    <?php endif; ?>
</body>
</html>
