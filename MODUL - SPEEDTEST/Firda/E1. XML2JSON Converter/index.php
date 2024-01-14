<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['xml_input'])) {
        $xmlString = $_POST['xml_input'];

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

        $jsonResult = xmlToJson($xmlString);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML to JSON Converter</title>
    <style>
        body {
            display: flex;
            flex-direction: row;
            margin-top: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .output-textarea {
            margin-left: 10px;
        }

        #convertButton {
            background-color: #0249bd;
            color: #fff;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <form method="post" action="">
        <textarea id="xml_input" name="xml_input" rows="20" cols="25"><?php echo isset($_POST['xml_input']) ? $_POST['xml_input'] : ''; ?></textarea>
        <input type="submit" id="convertButton" value="Convert">
    </form>

    <?php if (isset($jsonResult)) : ?>
        <pre><textarea class="output-textarea" readonly rows="20" cols="25"><?php echo $jsonResult; ?></textarea></pre>
    <?php endif; ?>
</body>

</html>