// PHP kód pro zpracování IPN zprávy
$ipn_url = "https://www.paypal.com/cgi-bin/webscr";

// Je nutné ověřit IPN zprávu před jejími akcemi
$fields = array(
    'cmd' => '_notify-validate',
    'txn_id' => $_POST['txn_id'],
    // Další potřebná pole
);

// URL k ověření (Paypal server)
$ch = curl_init($ipn_url);
curl_setopt($ch, CURLOPT_URL, $ipn_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Prověřujeme, jestli PayPal odpovídá 'VERIFIED'
$response = curl_exec($ch);
curl_close($ch);

// Pokud odpověděl 'VERIFIED', pokračujeme s akcemi
if ($response == "VERIFIED") {
    // Validace úspěšná, zpracujte údaje transakce a udělejte další akce
}
