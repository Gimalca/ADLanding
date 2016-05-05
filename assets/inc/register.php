 
<?php

print_r($_POST);die;


$params = [
    ['email' => "jone13@sendgrid.com", 'last_name' => "Jones"]
];

$idRecipient = addRecipient($params);

 if($idRecipient){
     recipientToList(300226, $idRecipient);
 }

function addRecipient($params)
{
    $curl = curl_init();
     
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sendgrid.com/v3/contactdb/recipients",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($params),
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer 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",
            "cache-control: no-cache",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);


    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        //echo $response;
        $json = json_decode($response);
        return $idRecipient = $json->{'persisted_recipients'}{0};
    }
}

function recipientToList($idList, $idRecipient)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sendgrid.com/v3/contactdb/lists/$idList/recipients/$idRecipient",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer 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",
            "cache-control: no-cache",
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo 'ok';
    }
}
