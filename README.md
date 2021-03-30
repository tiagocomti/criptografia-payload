# criptografia-payload
Utilizando PHP + Libsodium para criptografar um payload utilizando par de chaves (easy mode)

Importante ter os modulos do LibSodium instalados

(root@server) /usr/home/staffproapps# pkg info -a | grep sodium
libsodium-1.0.18               Library to build higher-level cryptographic tools
php73-sodium-7.3.18            The sodium shared extension for php

como utilizar:

(root@server) /usr/home/staffproapps# php /usr/local/www/api/CriptografiaPayload.php '{"meu_payload": "com_text_planosss"}'
Inicio: 11:46:01.563199
Chaves:
Array
(
    [privateKey] => 0fb910bfc031861afc71d6d29aa9d88820d12277f867e9a40fb4bea7cdebfbdb
    [publicKey] => c0195e25cad8b1756918e76b781a1519ecf7b392c6ddf5a9029282532d3dfc36
    [parChaves] => 0fb910bfc031861afc71d6d29aa9d88820d12277f867e9a40fb4bea7cdebfbdb4213bdd3ad30c664a73f999aa126f5777801ac115b9acb11312969d925720e3e
)

Payload Criptografado:
8b955b6cbe55e06290e7ca84ca97c00e3a287ce8004960effc8113aae5b1c03b4b2fe8eb7b81eae598fb91a27a7f4cdb5bbfa9371e2277ef6e4a85ac46dd03b1167513c83fb9d42e9d37b2d977759c80403202f4
Payload Descriptografado:
{"meu_payload": "com_text_planosss"}

Final: 11:46:01.564023(root@server) /usr/home/staffproapps# 
