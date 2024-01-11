<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission

    // Retrieve XML from the form
    $xmlString = $_POST['xmlInput'];

    // Convert XML to SimpleXML object
    $xml = simplexml_load_string($xmlString);

    // Convert SimpleXML object to JSON
    $json = json_encode($xml, JSON_PRETTY_PRINT);
} else {
    // Initial load or direct access to the script
    $xmlString = '';
    $json = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML to JSON Converter</title>
</head>

<body>
    <h2>XML to JSON Converter</h2>

    <form method="post">
        <label for="xmlInput">Input XML:</label>
        <textarea name="xmlInput" id="xmlInput" rows="8" cols="40"><?php echo htmlentities($xmlString); ?></textarea>

        <br>

        <input type="submit" value="Convert">

        <br>

        <label for="jsonOutput">Output JSON:</label>
        <textarea id="jsonOutput" rows="8" cols="40" readonly><?php echo htmlentities($json); ?></textarea>
    </form>

    <script >
        // Clear the JSON output area when XML input area is changed
        document.getElementById('xmlInput').addEventListener('input', function () {
            document.getElementById('jsonOutput').value = '';
        });
    </script>
</body>

</html>
