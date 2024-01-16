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

    // Highlighted month (for current month)
    $highlightedMonth = $dateTime->format('m');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
               body {
    font-family: 'Times New Roman', Times, serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background-color: whitesmoke;
}

#calendar {
    max-width: 600px;
    margin: 50px auto;
    text-align: center;
    background-color: white;
    padding: 20px;
    border-top: 3px solid #B80000;
    border-radius: 5px;
}

h2 {
    color: #333;
}

#header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    border-bottom: 1px solid #ddd;
}

a {
    text-decoration: none;
    color: #333;
    font-size: 1.5em;
}

table {
    width: 100%;
    height: 300px ;
    border-collapse: collapse;
}

thead tr {
    color: #B80000;
}

#bttnleft {
    transform: rotate(270deg);
}
#bttnright {
    transform: rotate(90deg);
}

th, td {
    padding: 10px;
    border: 1px solid #ddd;
}

th {
    background-color: white;
    border: 0px;
}

td {
    cursor: pointer;
}

.today {
    background-color: #B80000;
    color: white;
    font-weight: bold;
}
    </style>
</head>
<body>
    <div id="calendar">
        <h2><?php echo $dateTime->format('F'); ?></h2>
        
        <div id="header">
            <a id="bttnleft" href="?date=<?php echo $prevMonth; ?>">&#128314;</a>
            <span><?php echo $dateTime->format('Y'); ?></span>
            <a id="bttnright" href="?date=<?php echo $nextMonth; ?>">&#128314;</a>
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
                            $class = ($day - $firstDay + 2 == $today && $currentMonth == date('n') && $currentYear == date('Y')) ? 'today' : '';
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
