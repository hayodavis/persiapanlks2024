<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['xmlInput'])) {
        $xmlString = $_POST['xmlInput'];
        
        function xmlToJson($xmlString)
        {
            $xmlObject = simplexml_load_string($xmlString);
            $json = json_encode($xmlObject, JSON_PRETTY_PRINT);
            return $json;
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
            background-color: whitesmoke;
        }
        #a {
            display: flex;
        }
        #json {
            margin-left: 10px;
        }
        #tmblConvert {
            background-color: #025aa5;
            border-color: #94bbfa;
            color: white;
            height: 40px;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div id="a">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <textarea id="xmlInput" name="xmlInput" rows="18" cols="28"><?php echo isset($_POST['xmlInput']) ? htmlspecialchars($_POST['xmlInput'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea><br><br>
        <input id="tmblConvert" type="submit" value="Convert!">
    </form>

    <div id="json">
    <?php if (isset($jsonResult)): ?>
        <pre><textarea rows="18" cols="28"><?php echo htmlspecialchars($jsonResult, ENT_QUOTES, 'UTF-8'); ?></textarea></pre>
    <?php endif; ?>
    </div>
</body>
</html>