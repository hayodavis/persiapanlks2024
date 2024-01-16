<?php
// Read JSON from file
$jsonString = file_get_contents('user_messages.json');

// Convert JSON to associative array
$data = json_decode($jsonString, true);

// Initialize counters and variables
$totalSentMessages = 0;
$totalReceivedMessages = 0;
$totalSentCharacters = 0;
$totalReceivedCharacters = 0;
$wordFrequency = [];

// Loop through messages
foreach ($data['messages'] as $message) {
    if ($message['type'] === 'sent') {
        $totalSentMessages++;
        $totalSentCharacters += strlen($message['content']);
        $words = str_word_count($message['content'], 1, '0123456789');
        foreach ($words as $word) {
            $wordFrequency[$word] = isset($wordFrequency[$word]) ? $wordFrequency[$word] + 1 : 1;
        }
    } elseif ($message['type'] === 'received') {
        $totalReceivedMessages++;
        $totalReceivedCharacters += strlen($message['content']);
    }
}

// Get top 5 sent words
arsort($wordFrequency);
$top5Words = array_slice(array_keys($wordFrequency), 0, 5);

// Calculate averages
$averageSentLength = ($totalSentMessages > 0) ? $totalSentCharacters / $totalSentMessages : 0;
$averageReceivedLength = ($totalReceivedMessages > 0) ? $totalReceivedCharacters / $totalReceivedMessages : 0;

// Display analytics
echo "Top 5 sent words: " . implode(', ', $top5Words) . "\n";
echo "Total messages sent: $totalSentMessages\n";
echo "Total messages received: $totalReceivedMessages\n";
echo "Average character length sent: $averageSentLength\n";
echo "Average character length received: $averageReceivedLength\n";
?>
