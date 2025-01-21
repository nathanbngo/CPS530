<!-- Lab08 Nathan Ngo 501090210 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lab 08</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            color: #007ACC;
            text-align: center;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .section {
            width: 80%;
            max-width: 900px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .section h2 {
            color: #333;
            margin-bottom: 10px;
        }
        .greeting {
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            color: #fff;
            padding: 50px;
            background-size: cover;
            border-radius: 8px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: 500;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="submit"] {
            background-color: #007ACC;
            color: #fff;
            cursor: pointer;
            border: none;
        }
        .form-group input[type="submit"]:hover {
            background-color: #005f99;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table th, table td {
            border: 1px solid #ccc;
            text-align: center;
            padding: 10px;
        }
        table th {
            background-color: #007ACC;
            color: white;
        }
        table td {
            background-color: #f0f8ff;
        }
        .image-selection img {
            width: 150px;
            margin: 5px;
            cursor: pointer;
        }
        .top-right {
            position: absolute;
            top: 10px;
            right: 10px;
            opacity: 0.8;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <h1>Lab 08</h1>

    <!-- Problem 1 -->
    <div class="section">
        <h2>Problem 1</h2>
        <?php
        $hour = date("H");
        $greeting = "";
        $background = "";

        // Determine the greeting and background image based on the current hour
        if ($hour >= 5 && $hour < 12) {
            $greeting = "Good Morning";
            $background = "morning.jpg";
        } elseif ($hour >= 12 && $hour < 17) {
            $greeting = "Good Afternoon";
            $background = "afternoon.jpg";
        } elseif ($hour >= 17 && $hour < 21) {
            $greeting = "Good Evening";
            $background = "evening.jpg";
        } else {
            $greeting = "Good Night";
            $background = "night.jpg";
        }

        // Output the greeting and background image
        echo "<div class='greeting' style='background-image: url($background); height: 200px; display: flex; justify-content: center; align-items: center; text-align: center; border-radius: 8px;'>
                <span style='background-color: rgba(0, 0, 0, 0.5); color: white; padding: 10px 20px; border-radius: 4px;'>$greeting</span>
            </div>";
        ?>
    </div>


    <!-- Problem 2 -->
    <div class="section">
        <h2>Problem 2</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
                <label for="rows">Number of Rows (3-12):</label>
                <input type="number" id="rows" name="rows" min="3" max="12" required>
            </div>
            <div class="form-group">
                <label for="cols">Number of Columns (3-12):</label>
                <input type="number" id="cols" name="cols" min="3" max="12" required>
            </div>
            <input type="hidden" name="form_type" value="multiplication">
            <div class="form-group">
                <input type="submit" value="Generate Table">
            </div>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['form_type'] == 'multiplication') {
            $rows = intval($_POST['rows']);
            $cols = intval($_POST['cols']);

            if ($rows >= 3 && $rows <= 12 && $cols >= 3 && $cols <= 12) {
                echo "<table>";
                echo "<tr><th></th>";
                for ($c = 1; $c <= $cols; $c++) {
                    echo "<th>$c</th>";
                }
                echo "</tr>";

                for ($r = 1; $r <= $rows; $r++) {
                    echo "<tr><th>$r</th>";
                    for ($c = 1; $c <= $cols; $c++) {
                        echo "<td>" . ($r * $c) . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p style='color: red;'>Please enter numbers between 3 and 12.</p>";
            }
        }
        ?>
    </div>

    <!-- Problem 3 -->
    <div class="section" id="problem3">
        <h2>Problem 3</h2>
        <form method="POST" action="#problem3">
            <div class="form-group">
                <label for="image">Select an Image:</label>
                <select id="image" name="image" required>
                    <option value="">-- Select an Image --</option>
                    <option value="image1.gif">Image 1</option>
                    <option value="image2.gif">Image 2</option>
                    <option value="image3.gif">Image 3</option>
                    <option value="image4.gif">Image 4</option>
                    <option value="image5.gif">Image 5</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit">
            </div>
        </form>
        <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['image']) && !empty($_POST['image'])) {
            $selected_image = htmlspecialchars($_POST['image']); // Sanitize the input

            // Validate that the image file exists
            if (file_exists($selected_image)) {
                // Store the selected image in a session variable for display in the top-right corner
                session_start();
                $_SESSION['selected_image'] = $selected_image;

                // Display confirmation message
                echo "<p style='text-align: center; margin-top: 20px;'>Image successfully selected: <strong>$selected_image</strong></p>";
            } else {
                // Error message if the file does not exist
                echo "<p style='text-align: center; color: red; margin-top: 20px;'>The selected image does not exist.</p>";
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Error message if no image is selected
            echo "<p style='text-align: center; color: red; margin-top: 20px;'>Please select an image.</p>";
        }

        // Display the selected image in the top-right corner if it exists in the session
        session_start();
        if (isset($_SESSION['selected_image'])) {
            $image = $_SESSION['selected_image'];
            echo "<div style='position: fixed; top: 10px; right: 10px; text-align: center; z-index: 1000;'>
                    <img src='$image' alt='Selected Image' style='max-width: 150px; height: auto; border-radius: 8px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);'>
                    <p style='font-size: 12px; color: #555;'>$image</p>
                </div>";
        }
        ?>
    </div>

</body>
</html>
