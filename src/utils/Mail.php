<?php

class Mail
{
    private $apiKey;
    private $listId;

    public function __construct($apiKey, $listId)
    {
        $this->apiKey = $apiKey;
        $this->listId = $listId;
    }

    public function subscribe($email, $firstName, $lastName)
    {
        $serverPrefix = substr($this->apiKey, strpos($this->apiKey, '-') + 1);
        $url = "https://{$serverPrefix}.api.mailchimp.com/3.0/lists/{$this->listId}/members/";

        $data = [
            'email_address' => $email,
            'status' => 'subscribed', // Or 'pending' if you want MailChimp to send a confirmation email
            'merge_fields' => [
                'FNAME' => $firstName,
                'LNAME' => $lastName,
            ],
        ];

        $json = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $this->apiKey);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode == 200) {
            echo "Verification Email sent!";
        } else {
            echo "There was an error sending the registration email. Please try again.";
        }
    }
}

// Usage
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subscriber = new Mail("a0f906224dedd5d89265f1144578a083-us18", "YOUR_LIST_ID");
    $subscriber->subscribe($_POST['email'], $_POST['firstName'], $_POST['lastName']);
}
