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

    #calendar {
      border-collapse: collapse;
      margin-top: 20px;
    }

    #calendar th,
    #calendar td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
    }

    #calendar th {
      background-color: #f2f2f2;
    }

    .highlight-today {
      background-color: #4caf50;
      color: white;
      font-weight: bold;
    }

    .btn-container {
      margin-top: 20px;
    }

    .arrow-btn {
      padding: 10px;
      font-size: 16px;
      cursor: pointer;
    }
  </style>
</head>

<body>

<h2><?php echo date('F Y', mktime(0, 0, 0, $currentMonth, 1, $currentYear)); ?></h2>

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
        echo '<td' . (($currentDayOfMonth == $currentDay) ? ' class="highlight-today"' : '') . '>' . $currentDayOfMonth . '</td>';

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

  <div class="btn-container">
    <a href="?prev" class="arrow-btn">&lt;&lt; Prev</a>
    <a href="?next" class="arrow-btn">Next &gt;&gt;</a>
  </div>

</body>

</html>