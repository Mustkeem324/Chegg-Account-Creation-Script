<?php
function generateRandomEmail($domain = "hotmail.com") {
    $usernameLength = rand(20, 28);
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $username = '';

    for ($i = 0; $i < $usernameLength; $i++) {
        $username .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $username . '@' . $domain;
}

function generateRandomPassword($length = 12) {
    if ($length < 6) {
        throw new Exception("Password length must be at least 6 characters");
    }

    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=[]{}|;:,.<>?';
    $password = '';

    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $password;
}


function create_account($email,$password){
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://gateway.chegg.com/auth-gate/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{"query":"mutation Signup($userCredentials: UserCredentials!, $userProfile: UserProfile!, $clientId: String!) {\\n  signUpUser(\\n    userCredentials: $userCredentials\\n    userProfile: $userProfile\\n    clientId: $clientId\\n  ) {\\n    tokens {\\n      idToken\\n      accessToken\\n      expires\\n    }\\n    encryptedEmail\\n    encryptedCheggId\\n    uuid\\n  }\\n}\\n","variables":{"userCredentials":{"email":"'.$email.'","password":"'.$password.'"},"userProfile":{"sourceProduct":"core|auth|CHGG","sourcePage":"chegg|auth|Sign out"},"clientId":"CHGG"}}',
    CURLOPT_HTTPHEADER => array(
        'accept: application/json',
        'accept-language: en-US,en;q=0.9',
        'content-type: application/json',
        'cookie: CVID=ba5e0204-d717-448e-b204-f6504767aac8; langPreference=en-US; _pxvid=dceb9a73-3077-11ef-8820-bc340e19098a; V=2a20b6455e9f836fedee360ae518cf7766769605b53f7c.17097248; C=0; O=0; U=0; _cc_id=b1a51b94c31dd0df518d7be752b7aabf; panoramaId_expiry=1719773371592; panoramaId=cc6084e7fba9afa8ce13e7c6af4d185ca02cc31d35f547c6a2eb98655040ceae; panoramaIdType=panoDevice; permutive-id=2d01de62-34ba-4904-b7cc-e37e9643dc33; OptanonAlertBoxClosed=2024-06-25T06:46:36.108Z; eupubconsent-v2=CQAwU-QQAwU-QAcABBENA6EkAP_gAAAAACiQKTtV_G__bWlr8X73aftkeY1H9_h77sQxBhfJE-4FzDvW_JwXh2ExNA36tqIKmRIEuzbBIQNkHJDUTVCgSogVryDMak2coTNIJ6BkiFMRO2dYCFxvmwtjMQIY5vr993dx2B-t_dv83dziz4FHnzQ5v2e0WJCdA58tDft9bROb-9IOd-58v4v8_F_rE2_eT1k_tevp7D9-css7_XW-9_Yff79Ll_-mB_gAAAECQAQF5joAIC8yUAEBeZSACAvM.f_wAAAAAAAAA; _gcl_au=1.1.2092756661.1719298000; _tt_enable_cookie=1; _ttp=4Mq8KbgYWf_Kn-QQiTflB6zmWfZ; _scid=4b722a4e-960a-4a9b-953d-b1a9616ad685; _cs_c=0; exp_id=23d83b41-4568-414c-914a-e60ccdd00a91; _ga_HRYBF3GGTD=GS1.1.1719380342.5.0.1719380342.0.0.0; _ga_1Y0W4H48JW=GS1.1.1719380342.5.0.1719380342.0.0.0; pxcts=8435915d-3392-11ef-8137-4b49adee4e0e; PHPSESSID=a47a60b4a925420957f3a66cfe804a56; user_geo_location=%7B%22country_iso_code%22%3A%22IN%22%2C%22country_name%22%3A%22India%22%2C%22region%22%3A%22UP%22%2C%22region_full%22%3A%22Uttar+Pradesh%22%2C%22city_name%22%3A%22Lucknow%22%2C%22postal_code%22%3A%22226005%22%2C%22locale%22%3A%7B%22localeCode%22%3A%5B%22en-IN%22%2C%22hi-IN%22%2C%22gu-IN%22%2C%22kn-IN%22%2C%22kok-IN%22%2C%22mr-IN%22%2C%22sa-IN%22%2C%22ta-IN%22%2C%22te-IN%22%2C%22pa-IN%22%5D%7D%7D; local_fallback_mcid=91696999558399287180813948984246412930; s_ecid=MCMID|91696999558399287180813948984246412930; IR_gbd=chegg.com; _sctr=1%7C1719340200000; _ga=GA1.2.2136121792.1719047172; _gid=GA1.2.1296977268.1719388998; _oa_sso=https%253A%252F%252Fwww.chegg.com; cto_bundle=tR_9qV80NzBHVWJJaFFlRjk0WUcxTGdyMlYwVDYzNWN0JTJGYWF6WEtBaE1maFQ1RTR4aURjeG92TU9jTyUyRlh6Y1RJOSUyRkRHS1JVUSUyQmtwM0xvdThiY1BsRGtsTVB6ZGtNQUUxS1IwblclMkI4SGdqOUElMkYlMkIlMkZsTTEwSkQzSDVGQk4yb2ZWUjdLa2V3OXJiTHVXaElVc2JUellic2RNTCUyRmclM0QlM0Q; rio-chegganalytics=[{"eventID":"event22","eventName":"Sign Up Success","eventValue":"Chegg","profile":{"cheggUUID":"0c806e13-3f79-4e69-9591-20e37c0a20a6","encEmailAddress":"EyYWzT852NRoBFQ6JYQOdS48ShVyLQkmJYRhpwAGpKzSS2AET4sQDQ==","encUserId":"vi/VfAeL9iSKBwCRM9ejlBMMXJrAAQNpY6njXocwAhzIolWST64rNQ==","regSourceProduct":"core|CHGG"},"timeStamp":"2024-06-26T11:45:23.584Z","type":"auth"}]; ab.storage.deviceId.b283d3f6-78a7-451c-8b93-d98cdb32f9f1=%7B%22g%22%3A%225a23ea3d-7f7a-d6c0-8934-5f583f7c1792%22%2C%22c%22%3A1719388986464%2C%22l%22%3A1719402327424%7D; ab.storage.userId.b283d3f6-78a7-451c-8b93-d98cdb32f9f1=%7B%22g%22%3A%220c806e13-3f79-4e69-9591-20e37c0a20a6%22%2C%22c%22%3A1719402327411%2C%22l%22%3A1719402327426%7D; hwh_order_ref=/; SU=MWKrEKvMwNeXwAY7YM6Kkw1jjoQPF8eMvyL6j2O95BRN5GarwEjEvOQtAyv_xMmpMfCyDEkLMdw-CzHFZ9-y62EjkipycWWLn-XIQLskjtAjLdozqjpETwh9Xl6E4wFW; exp=C026A; expkey=07D3138E40B55F3053E7CBC28FB21FA9; IR_14422=1719402353122%7C0%7C1719402353122%7C%7C; country_code=US; opt-user-profile=0c806e13-3f79-4e69-9591-20e37c0a20a6%252C29438490978%253A29547940246%252C28952560068%253A29001780062%252C9300000617359%253A417845%252C29222070148%253A29229230196%252C29243320150%253A29239540171; _rdt_uuid=1719298007588.d1438107-4187-4d51-a337-0094ea23ebb9; _uetsid=86d61910339211ef97c03be6bfb938bc; _uetvid=ad33ae0032be11efa2f2e74b9d8204ff; _scid_r=4b722a4e-960a-4a9b-953d-b1a9616ad685; _ga_ZBG6WLWXBE=GS1.2.1719402254.2.1.1719402941.60.0.0; ab.storage.sessionId.b283d3f6-78a7-451c-8b93-d98cdb32f9f1=%7B%22g%22%3A%2212634a99-63e4-be25-b793-4f8c40207928%22%2C%22e%22%3A1719404745945%2C%22c%22%3A1719402327421%2C%22l%22%3A1719402945945%7D; OptanonConsent=isGpcEnabled=0&datestamp=Wed+Jun+26+2024+18%3A56%3A48+GMT%2B0530+(India+Standard+Time)&version=202402.1.0&browserGpcFlag=0&isIABGlobal=false&hosts=&consentId=05495b74-f2bc-4997-a839-ff42e10f9a84&interactionCount=2&isAnonUser=1&landingPath=NotLandingPage&groups=snc%3A1%2Cprf%3A1%2Cfnc%3A1%2Ctrg%3A1%2CV2STACK42%3A1&AwaitingReconsent=false&geolocation=NL%3BNH; forterToken=4ec269c1791c4c94959780e9eabfd2c2_1719408399209__UDF43-m4_13ck_; _cs_cvars=%7B%221%22%3A%5B%22Page%20Name%22%2C%22Auth%20page%22%5D%2C%222%22%3A%5B%22Experience%22%2C%22desktop%22%5D%2C%223%22%3A%5B%22Page%20Type%22%2C%22core%22%5D%7D; _px3=4bb9db637fed23c1aa6880355624f35fbc9b2359fa36fae8ce256fa78c0e46b0:etmr3umzL/X6mGHfBgcKkYsYPpA0c0fehczl+as0YsptVKgTc3IAgB1qmgzk5u5c9UdE502BFXMi2tHieVUaGQ==:1000:5TmuX3gCryJdvQxV33oYixvK75hfwVaznJO8/F4BU0psQzjVHz3sGhGsfIN5Zh7Mj2AzH2seavKfI32fAGiPhNGRhhoOk6MoE4EdkqZkqU2sWed9m4PUBH5URDUKPcmNbOo4W4v7n4HL6dkxhZIHC77Ll/cj+m59E8B/HXinepwtYB3E3ipIPM0yfq2z8WZ6zWkScRgaeIUi1/Y62ew8oWU/H0GxI30JNvRbp7IwqEs=; _px=etmr3umzL/X6mGHfBgcKkYsYPpA0c0fehczl+as0YsptVKgTc3IAgB1qmgzk5u5c9UdE502BFXMi2tHieVUaGQ==:1000:2+OWcwUS9HsVLjq59YOVPfAXORVwGzCWOsEku41kvSvd0h7Z/X3q4OHzyLWQUhAPXPmnWUpB+hu9VVCtEKBJSF15o71D5TIV2K33V+Qvmj9cPp9fcTvPgL6yGqn8PhI0+0Z8N5C+qvW/KAIRWCq6WAr8P7J5oHz4mncI3OTeHLGWqmoJT4zgmd8ws+hlYvyM9myG2x3eN3JryLkbKvnIT7ReekBYnEaIXcD3woSFLzXVKgeuGkYtci2IT0YRxdGss7RZSq8uVbgzErn0zMVg2g==; _cs_id=68d12f14-203f-a4fd-9cbc-bd56f3c34ea0.1719298199.7.1719410301.1719410301.1.1753462199816.1; _cs_s=2.0.0.1719412101609; CSID=1719410305363; id_token=eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJlbWFpbCI6ImFhc3Nhc2Fzc3Mxc0Bob3RtYWlsLmNvbSIsImlzcyI6Imh1Yi5jaGVnZy5jb20iLCJhdWQiOiJDSEdHIiwiaWF0IjoxNzE5NDEwNjYwLCJleHAiOjE3MzQ5NjI2NjAsInN1YiI6IjZiYTQyYjQ4LWJmMjQtNDVkYi04MTU5LTYzMDk4NjUyOTFiYyIsInJlcGFja2VyX2lkIjoiYXB3IiwiY3R5cCI6ImlkIiwiaWRzaWQiOiIwMjU5NzQ3NiIsImlkc3QiOjE3MTk0MTA2NjAwNDEsImlkc2ciOiJwYXNzd29yZCJ9.9FlBADtopuHu3B0gwudL9YCamCKNKdOh8tgr_3vagXYCQOnLFdjscC58xL-75aQdjldWVdxzwDmfBEN7Edvi6uvuUtFOQ0paPhckhtsCCu6nfcORhy0vHwigySmY2CpzLuMWLQ6LNpzkrHKqE4xFUJGopyCqF96klAkU_-TzBF7VVS-NCAkTkc1GCBK0-hu1dH8_yfCRyL6VoQ7EzexDpSM2h9a8Wzl7SW4VlmyJtQ-L8wUbZof_ChPyFL1xlqvLcczjA9zBQ8n_ySCthumaaoshODLGOIWgAETM_GCWdpy8y6s5HiAEVJO_Al58-i2183vdnXdGNQy8RVGsgyI8LA; refreshToken=ext.a0.t00.v1.MWR4wxCuXQYS1rcE1Xs3ZHJZIH4Rq7rncQwAuD-CIVtb-bym25HvT0y51DxlQyxujW5KwZdWGA_27_5rL4-ak4Q; refresh_token=ext.a0.t00.v1.MWR4wxCuXQYS1rcE1Xs3ZHJZIH4Rq7rncQwAuD-CIVtb-bym25HvT0y51DxlQyxujW5KwZdWGA_27_5rL4-ak4Q',
        'dnt: 1',
        'origin: https://www.chegg.com',
        'priority: u=1, i',
        'referer: https://www.chegg.com/',
        'sec-ch-ua: "Not/A)Brand";v="8", "Chromium";v="126", "Google Chrome";v="126"',
        'sec-ch-ua-mobile: ?0',
        'sec-ch-ua-platform: "Linux"',
        'sec-fetch-dest: empty',
        'sec-fetch-mode: cors',
        'sec-fetch-site: same-site',
        'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
        'x-px-chegg-cookie: 4bb9db637fed23c1aa6880355624f35fbc9b2359fa36fae8ce256fa78c0e46b0:etmr3umzL/X6mGHfBgcKkYsYPpA0c0fehczl+as0YsptVKgTc3IAgB1qmgzk5u5c9UdE502BFXMi2tHieVUaGQ==:1000:5TmuX3gCryJdvQxV33oYixvK75hfwVaznJO8/F4BU0psQzjVHz3sGhGsfIN5Zh7Mj2AzH2seavKfI32fAGiPhNGRhhoOk6MoE4EdkqZkqU2sWed9m4PUBH5URDUKPcmNbOo4W4v7n4HL6dkxhZIHC77Ll/cj+m59E8B/HXinepwtYB3E3ipIPM0yfq2z8WZ6zWkScRgaeIUi1/Y62ew8oWU/H0GxI30JNvRbp7IwqEs='
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;

}

function main() {
    $num_accounts = 100;
    $accounts = [];

    for ($i = 0; $i < $num_accounts; $i++) {
        $email = generateRandomEmail();
        $password = generateRandomPassword();
        $response = create_account($email, $password);
        $account_info = [
            "email" => $email,
            "password" => $password,
            "response" => $response
        ];
        $accounts[] = $account_info;
        echo "Created account " . ($i + 1) . ": " . $email . " - " . $response . "\n";
        sleep(1);  // To avoid getting rate limited
    }

    $json_data = json_encode($accounts, JSON_PRETTY_PRINT);
    file_put_contents("accounts.json", $json_data, FILE_APPEND);
}

main();


?>