<?php
$currentMonth = date('n');
$currentYear = date('Y');
$currentDay = date('j');

if (isset($_GET['prev'])) {
  $currentMonth = ($currentMonth == 1) ? 12 : $currentMonth - 1;
  $currentYear = ($currentMonth == 12) ? $currentYear - 1 : $currentYear;
}

if (isset($_GET['next'])) {
  $currentMonth = ($currentMonth == 12) ? 1 : $currentMonth + 1;
  $currentYear = ($currentMonth == 1) ? $currentYear + 1 : $currentYear;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendar</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 50px;
    }

    .calendar-container {
      text-align: center;
      border-top: 5px solid #F0677D;
      border-right: 1px solid #c7c7c7;
      border-left: 1px solid #c7c7c7;
      border-bottom: 1px solid #c7c7c7;
      padding: 25px;
    }

    .top-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff;
      border-bottom: 1px solid #c7c7c7;
      padding-bottom: 15px;
    }

    .arrow-btn {
      cursor: pointer;
    }

    .month-year {
      color: #2a343d;
      font-size: 18px;
    }

    .year {
      color: #2a343d;
      font-size: 14px;
    }

    #calendar {
      border-collapse: collapse;
      margin-top: 20px;
      width: 100%;
      text-align: center;
    }

    #calendar th,
    #calendar td {
      border: 1px solid #c7c7c7;
      padding: 10px;
    }

    #calendar th {
      background-color: #fff;
      color: #F0677D;
    }

    .highlight-today {
      background-color: #F0677D;
      color: white;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="calendar-container">

    <div class="top-row">
      <a href="?prev" class="arrow-btn"><img src="left.png" alt="prev"></a>
      <div class="month-year">
        <?php echo date('F', mktime(0, 0, 0, $currentMonth, 1, $currentYear)); ?>
        <br>
        <div class="year">
          <?php echo date('Y', mktime(0, 0, 0, $currentMonth, 1, $currentYear)); ?>
        </div>
      </div>

      <a href="?next" class="arrow-btn"><img src="right.png" alt="next"></a>
    </div>

    <table id="calendar">
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
        <?php
        $firstDayOfMonth = mktime(0, 0, 0, $currentMonth, 1, $currentYear);
        $daysInMonth = date('t', $firstDayOfMonth);
        $dayOfWeek = date('w', $firstDayOfMonth);

        $currentDayOfMonth = 1;

        for ($i = 0; $i < $dayOfWeek; $i++) {
          echo '<td></td>';
        }

        while ($currentDayOfMonth <= $daysInMonth) {
          echo '<td' . (($currentMonth == date('n') && $currentDayOfMonth == $currentDay) ? ' class="highlight-today"' : '') . '>' . $currentDayOfMonth . '</td>';

          if (++$dayOfWeek == 7) {
            echo '</tr><tr>';
            $dayOfWeek = 0;
          }

          $currentDayOfMonth++;
        }

        while ($dayOfWeek > 0 && $dayOfWeek < 7) {
          echo '<td></td>';
          $dayOfWeek++;
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>