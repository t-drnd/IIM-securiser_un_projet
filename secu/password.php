<?php

$plainPassword = "123";

$hashedPassword = password_hash(
    password: $plainPassword,
    algo: PASSWORD_BCRYPT,
    options: []
);

echo '<p>'. $plainPassword .' devient '. $hashedPassword . '</p>';

if(password_verify(password:'123', hash: $hashedPassword))
{
    echo'<p>Les mots de passe correspondent</p>';
}
else{
    echo '<p>Mauvais mot de passe</p>';
}