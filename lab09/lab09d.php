<?php
// Lab 09 Nathan Ngo 501090210

$connect = mysqli_connect("localhost", "n8ngo", "AJKhfUyk", "n8ngo") or die("Connection failed: " . mysqli_connect_error());

$countries = mysqli_query($connect, "SELECT DISTINCT SUBSTRING_INDEX(location, ', ', -1) AS country FROM photos ORDER BY country ASC");
$years = mysqli_query($connect, "SELECT DISTINCT YEAR(date_taken) AS year FROM photos ORDER BY year DESC");

$selected_country = isset($_GET['country']) ? $_GET['country'] : '';
$selected_year = isset($_GET['year']) ? $_GET['year'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lab 09: Query Photos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Query Photos</h1>
    <form method="GET" action="lab09d.php">
        <label for="country">Select Country:</label>
        <select id="country" name="country">
            <option value="">None</option>
            <?php while ($row = mysqli_fetch_assoc($countries)): ?>
                <option value="<?php echo $row['country']; ?>" <?php echo ($row['country'] === $selected_country) ? 'selected' : ''; ?>>
                    <?php echo $row['country']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="year">Select Year:</label>
        <select id="year" name="year">
            <option value="">None</option>
            <?php while ($row = mysqli_fetch_assoc($years)): ?>
                <option value="<?php echo $row['year']; ?>" <?php echo ($row['year'] == $selected_year) ? 'selected' : ''; ?>>
                    <?php echo $row['year']; ?>
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit">Filter</button>
    </form>
    <?php
    if (!empty($selected_country) || !empty($selected_year)) {
        $query = "SELECT * FROM photos WHERE 1";

        if (!empty($selected_country)) {
            $query .= " AND location LIKE '%$selected_country'";
        }
        if (!empty($selected_year)) {
            $query .= " AND YEAR(date_taken) = $selected_year";
        }

        $result = mysqli_query($connect, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<div class='photos'>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='photo'>
                        <img src='{$row['picture_url']}' alt='{$row['subject']}'>
                        <p>
                            <strong>Photo #:</strong> {$row['picture_number']}<br>
                            <strong>Subject:</strong> {$row['subject']}<br>
                            <strong>Location:</strong> {$row['location']}<br>
                            <strong>Date Taken:</strong> {$row['date_taken']}<br>
                            <strong>Image URL:</strong> <a href='{$row['picture_url']}'>{$row['picture_url']}</a>
                        </p>
                    </div>";
            }
            echo "</div>";
        } else {
            echo "<p>No results found for the selected criteria.</p>";
        }
    }
    ?>
</body>
</html>
