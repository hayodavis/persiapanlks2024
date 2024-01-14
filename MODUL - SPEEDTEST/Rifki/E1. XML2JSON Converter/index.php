<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>XML to JSON Converter</title>
    <style>
        textarea{
            width : 360px;
        }
        .textarea {
            display: flex;
            gap: 15px
        }
        button {
            margin-top: 10px;
            background-color: #025aa5;
            border-color: #94bbfa;
            color: white;
            height: 40px;
            border-radius: 3px;
        }
        
    </style>
</head>
<body>
    <h1>XML to JSON Converter</h1>
        <p>Enter XML content:</p>
    <form action="" method="post">
        <!-- <label for="xmlContent">Enter XML content:</label><br> -->
        <div class="textarea">
            <textarea class="inputXML" name="xmlContent" id="xmlContent" rows="8" cols="80"></textarea><br>
        
        <?php
        // Function to convert XML to JSON
        function xmlToJson($xmlString)
        {
            $xmlObject = simplexml_load_string($xmlString);
            $jsonString = json_encode($xmlObject, JSON_PRETTY_PRINT);
            return $jsonString;
        }

        // Check if XML content is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["xmlContent"])) {
            // Read the XML content
            $xmlString = $_POST["xmlContent"];

            // Convert XML to JSON
            $jsonResult = xmlToJson($xmlString);

            // Output JSON result
            echo '<textarea class="hasilJSON" rows="10" cols="80" readonly>' . htmlspecialchars($jsonResult) . '</textarea>';
            
        }

        ?>
        </div>
        
         <button type="submit">Convert</button>   
    </form>

</body>
</html>
