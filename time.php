<?php
    date_default_timezone_set('Asia/Calcutta');
    $date = date('m/d/Y h:i:s a', time());
    echo($date);
    echo(gettype($date));
?>