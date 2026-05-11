<?php
    require_once 'src/konta_bankowe.php';

    $konto_osobiste = new KontoOsobiste("1234567890", 1000.00, "Jan Kowalski");
    echo $konto_osobiste->daneKonta() . "\n";
    $konto_osobiste->wplata(500.00);
    $konto_osobiste->wyplata(200.00);
