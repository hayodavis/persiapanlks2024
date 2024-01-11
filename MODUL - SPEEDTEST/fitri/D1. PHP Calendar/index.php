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

// Array of month names in Bahasa Indonesia
$monthNames = [
  'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
  'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
];
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
      border-top: 5px solid red ;
      margin-top: 20px;
      width: 600px;
      height: 400px;
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
      background-color: red;
      color: white;
      font-weight: bold;
    }

    
    .bttnpnah1 {
      padding: 10px;
      font-size: 30px;
      top: 60px;
      left: 700px;
      font-weight: bold;
      position: absolute;
      color: black;
    }
    .bttnpnah2 {
      padding: 10px;
      font-size: 30px;
      top: 60px;
      right: 700px;
      font-weight: bold;
      position: absolute;
      color: black;

    }
  </style>
</head>

<body>

  <h2><?php echo $monthNames[$currentMonth - 1] . ' ' . $currentYear; ?></h2>

  <table id="calendar">
    <thead>
      <tr>
        <th>Minggu</th>
        <th>Senin</th>
        <th>Selasa</th>
        <th>Rabu</th>
        <th>Kamis</th>
        <th>Jumat</th>
        <th>Sabtu</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $firstDayOfMonth = mktime(0, 0, 0, $currentMonth, 1, $currentYear);
      $daysInMonth = date('t', $firstDayOfMonth);
      $dayOfWeek = date('w', $firstDayOfMonth);

      $currentDayOfMonth = 2;

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
    <a href="?prev" class="bttnpnah1"> < </a>
    <a href="?next" class="bttnpnah2"> > </a>
  </div>

</body>
</html>
