# criptografia-payload
Utilizando PHP + Libsodium para criptografar um payload utilizando par de chaves (easy mode)

Importante ter os modulos do LibSodium instalados

`(root@server) /usr/home/staffproapps# pkg info -a | grep sodium`

![Captura de Tela 2021-03-30 às 11 47 52](https://user-images.githubusercontent.com/19311085/113008903-d8c17b00-914d-11eb-8693-e44da3872d79.png)


como utilizar:

`(root@server) /usr/home/staffproapps# php /usr/local/www/api/CriptografiaPayload.php '{"meu_payload": "com_text_planosss"}'`

![Captura de Tela 2021-03-30 às 11 48 02](https://user-images.githubusercontent.com/19311085/113008865-ce9f7c80-914d-11eb-84fa-28c5384c2024.png)
