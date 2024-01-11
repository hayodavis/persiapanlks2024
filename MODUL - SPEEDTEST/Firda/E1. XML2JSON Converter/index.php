<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['xml_input'])) {
        $xmlString = $_POST['xml_input'];

        $jsonResult = xmlToJson($xmlString);
    } else {
        $error = 'Please provide XML input.';
    }
}

function xmlToJson($xmlString)
{
    $xml = simplexml_load_string($xmlString);
    $json = json_encode([$xml->getName() => xmlToArray($xml)], JSON_PRETTY_PRINT);
    return $json;
}

function xmlToArray($xml)
{
    $array = [];

    foreach ($xml->children() as $child) {
        if ($child->count() > 0) {
            $array[$child->getName()] = xmlToArray($child);
        } else {
            $array[$child->getName()] = (string) $child;
        }
    }

    return $array;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML to JSON Converter</title>
    <style>
        textarea {
            width: 50%;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <h1>XML to JSON Converter</h1>

    <form method="post" action="">
        <label for="xml_input">Enter XML:</label><br>
        <textarea id="xml_input" name="xml_input" rows="5" cols="40"><?php echo isset($_POST['xml_input']) ? $_POST['xml_input'] : ''; ?></textarea><br>
        <input type="submit" value="Convert">
    </form>

    <?php if (isset($jsonResult)): ?>
        <h2>JSON Output:</h2>
        <textarea rows="10" readonly><?php echo $jsonResult; ?></textarea>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>

</body>
</html>
