<?php
// Lab 09 Nathan Ngo 501090210

$connect = mysqli_connect("localhost", "n8ngo", "AJKhfUyk", "n8ngo") or die("Connection failed: " . mysqli_connect_error());

$query = "SELECT * FROM photos ORDER BY date_taken DESC";
$result = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lab 09: All Photos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>All Photos</h1>
    <div class="photos">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="photo">
                <img src="<?php echo $row['picture_url']; ?>" alt="<?php echo $row['subject']; ?>">
                <p>
                    <strong>Image #:</strong> <?php echo $row['picture_number']; ?><br>
                    <strong>Subject:</strong> <?php echo $row['subject']; ?><br>
                    <strong>Location:</strong> <?php echo $row['location']; ?><br>
                    <strong>Date Taken:</strong> <?php echo $row['date_taken']; ?><br>
                    <strong>Image URL:</strong> <a href="<?php echo $row['picture_url']; ?>"><?php echo $row['picture_url']; ?></a>
                </p>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
