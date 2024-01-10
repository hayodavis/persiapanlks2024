<?php
    // Get the current date or a specific date
    $currentDate = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

    // Convert the date to a DateTime object
    $dateTime = new DateTime($currentDate);

    // Get the current month, year, and day
    $currentMonth = $dateTime->format('m');
    $currentYear = $dateTime->format('Y');
    $today = date('d');

    // Calculate the previous and next month
    $prevMonth = $dateTime->modify('-1 month')->format('Y-m-d');
    $nextMonth = $dateTime->modify('+2 months')->format('Y-m-d');
    $dateTime->modify('-1 month'); // Reset to the original date

    // Get the first day of the month and the total number of days
    $firstDay = $dateTime->format('N');
    $lastDay = $dateTime->format('t');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

#calendar {
    max-width: 600px;
    margin: 50px auto;
    text-align: center;
}

h2 {
    color: #333;
}

#header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
}

a {
    text-decoration: none;
    color: #333;
    font-size: 1.5em;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead tr {
    color: red;
}

th, td {
    padding: 10px;
    border: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}

td {
    cursor: pointer;
}

.today {
    background-color: #ffd700;
    font-weight: bold;
}

/* Add more styles as needed */

    </style>
</head>
<body>
    <div id="calendar">
        <h2><?php echo $dateTime->format('F Y'); ?></h2>
        
        <div id="header">
            <a href="?date=<?php echo $prevMonth; ?>">&lt;</a>
            <span><?php echo $dateTime->format('F Y'); ?></span>
            <a href="?date=<?php echo $nextMonth; ?>">&gt;</a>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                        // Fill in the first row with empty cells for previous month
                        for ($i = 1; $i < $firstDay; $i++) {
                            echo '<td></td>';
                        }

                        // Fill in the days of the current month
                        for ($day = 1; $day <= $lastDay; $day++) {
                            $class = ($day == $today) ? 'today' : '';
                            echo "<td class='$class'>$day</td>";

                            // Start a new row for the next week
                            if (($firstDay + $day - 1) % 7 == 0 && $day < $lastDay) {
                                echo '</tr><tr>';
                            }
                        }

                        // Fill in the remaining cells with empty cells for next month
                        $remainingCells = 7 - (($firstDay + $lastDay - 1) % 7);
                        for ($i = 0; $i < $remainingCells; $i++) {
                            echo '<td></td>';
                        }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>