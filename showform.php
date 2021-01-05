<?php

for ($i = 1; $i < $_POST['maxday']; $i++) {
    echo $_POST['priceroom' . $i] . "<br>";
}
