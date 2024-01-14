<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['xmlInput'])) {
        $xmlData = $_POST['xmlInput'];
        
        function convertXmlToJson($xmlData)
        {
            $xmlObject = simplexml_load_string($xmlData);
            $jsonResult = json_encode($xmlObject, JSON_PRETTY_PRINT);
            return $jsonResult;
        }

        $jsonOutput = convertXmlToJson($xmlData);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom XML to JSON Converter</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #container {
            width: 70%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #xmlInput {
            width: 100%;
            height: 200px;
            margin-bottom: 10px;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #convertButton {
            background-color: blue;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 3px;
        }

        #jsonOutput {
            width: 100%;
            height: 200px;
            margin-top: 20px;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <div id="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <textarea id="xmlInput" name="xmlInput" rows="18" cols="28"><?php echo isset($xmlData) ? htmlspecialchars($xmlData, ENT_QUOTES, 'UTF-8') : ''; ?></textarea><br><br>
            <input id="convertButton" type="submit" value="Convert!">
        </form>

        <div id="jsonOutput">
        <?php if (isset($jsonOutput)): ?>
            <pre><textarea rows="18" cols="28"><?php echo htmlspecialchars($jsonOutput, ENT_QUOTES, 'UTF-8'); ?></textarea></pre>
        <?php endif; ?>
        </div>
    </div>
</body>
</html>
