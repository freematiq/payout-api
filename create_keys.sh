cd ./keys
openssl rand -out random 1048576
openssl genrsa -out secret.key.pem -rand random 1024
openssl rsa -in secret.key.pem -pubout -outform DER -out public.key
openssl rsa -inform pem -in secret.key.pem -outform der -out secret.key
rm random
rm secret.key.pem

