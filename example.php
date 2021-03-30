<?php

echo "Inicio: ". getTimeWithMilisec();
echo "\n";
const DEBUG_ENABLE = true;
/**
 * @param string $salt Para aumentar a entropia do nosso par de chaves, recomenda-se passar um salt aleatório da sua escolha e que nunca vai se repetir
 * @return array
 * @throws Exception
 * Essa function tem a responsabilidade de gerar as nossas chaves. Lembre-se, chave publica utiliza-se para criptografar o payload e a chave privada para descriptografar esse bundle criptografado
 */
function generateKeyPair($salt){
    $keyPair = hex2bin(hash('sha512',"$salt".bin2hex(random_bytes(64))));// = \Sodium\crypto_box_keypair()
    $privateKey = sodium_crypto_box_secretkey($keyPair);
    $publicKey = sodium_crypto_box_publickey_from_secretkey($privateKey);

    return ["privateKey" => sodium_bin2hex($privateKey), "publicKey" => sodium_bin2hex($publicKey), "parChaves" => sodium_bin2hex($keyPair)];
}

/**
 * @param $data
 * @param $pbk
 * @return string
 * Criptografando o payload com a chave publica
 */
function encryptByPublicK($data, $pbk){
    return sodium_bin2hex(sodium_crypto_box_seal($data, sodium_hex2bin($pbk)));
}

/**
 * @param $payload
 * @param $publicKey
 * @param $privateKey
 * @return false|string
 * Descriptografando nosso payload utilizando a combinação da chave publica e privada
 */
function decryptPayloadByPrivate($payload, $publicKey, $privateKey){
    $key_pair = sodium_crypto_box_keypair_from_secretkey_and_publickey(sodium_hex2bin($privateKey), sodium_hex2bin($publicKey));
    $plain_text = sodium_crypto_box_seal_open(hex2bin($payload), $key_pair);
    if($plain_text===false){
        die("Fail to decryptPayload");
    }
    return $plain_text;
}

$chaves = generateKeyPair(1238182381);
$payload = $argv[1];
if(DEBUG_ENABLE === true){
    echo "Chaves:";
    echo "\n";
    print_r($chaves);
    echo "\n";
}

$cript_box = encryptByPublicK($payload, $chaves["publicKey"]);

if(DEBUG_ENABLE === true){
    echo "Payload Criptografado:";
    echo "\n";
    print_r($cript_box);
    echo "\n";
}

$decrypt = decryptPayloadByPrivate($cript_box, $chaves["publicKey"], $chaves["privateKey"]);
if(DEBUG_ENABLE === true){
    echo "Payload Descriptografado:";
    echo "\n";
    print_r($decrypt);
    echo "\n";
}
echo "\n";
echo "Final: ". getTimeWithMilisec();


/**
 * pegando o tempo com milisecs com S.O unixlike
 */
function getTimeWithMilisec(){
    $t = microtime(true);
    $micro = sprintf("%06d",($t - floor($t)) * 1000000);
    $d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );

    return $d->format("H:i:s.u"); // note at point on "u"
}
