<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the POST request with parameters
    $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
    $message = isset($_POST['message']) ? $_POST['message'] : null;

    if ($phone && $message) {
        // Your SMS sending logic here
        // You can reuse the existing cURL code
        $to = '254' . substr($phone, 1);

        $ApiKey = 'mrbZnidZL1aisGhRem5yQ38v1DjFZXdFamYpRr21YtQ=';
        $ClientId = 'ae5e5440-3968-4422-8018-feb27cebd201';
        $SenderId = 'SUCDIAGENCY';
        $AccessKey = 'mwNYuBUe0fxbYqDyyYkz9gsgNIH5cP0H';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.onfonmedia.co.ke/v1/sms/SendBulkSMS",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode(array(
                "SenderId" => $SenderId,
                "MessageParameters" => array(
                    array(
                        "Number" => $to,
                        "Text" => $message,
                    ),
                ),
                "ApiKey" => $ApiKey,
                "ClientId" => $ClientId,
            )),
            CURLOPT_HTTPHEADER => array(
                "accesskey: " . $AccessKey,
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if (!$err) {
            // Successfully sent the SMS
            echo "SMS sent successfully.";
        } else {
            // Handle the cURL error
            echo "Error: $err";
        }
    } else {
        // Missing phone or message parameters
        echo "Missing phone or message parameters.";
    }
} else {
    // Handle other HTTP methods (GET, PUT, DELETE, etc.)
    echo "Unsupported HTTP method.";
}
