<?php
    require_once 'src/konta_bankowe.php';

    echo "Założenie konta osobistego:\n";
    $konto_osobiste = new KontoOsobiste("1234567890", 1000.00, "Jan Kowalski");
    echo $konto_osobiste->daneKonta() . "\n";
    $konto_osobiste->wplata(500.00);
    $konto_osobiste->wyplata(1000.00);

    echo "\nZałożenie konta firmowego:\n";
    $konto_firmowe = new KontoFirmowe("0987654321", 3000.00, "Firma XYZ", 1000.00);
    echo $konto_firmowe->daneKonta() . "\n";
    $konto_firmowe->wplata(1000.00);
    $konto_firmowe->wyplata(4500.00);
    
    echo"\nPrzelew z konta firmowego na konto osobiste:\n";
    $konto_firmowe->przelew($konto_osobiste, 600.00);

    echo "\nPrzelew z konta osobistego na konto firmowe:\n";
    $konto_osobiste->przelew($konto_firmowe, 300.00);
    
    echo"\nPrzelew z konta firmowego na konto osobiste:\n";
    $konto_firmowe->przelew($konto_osobiste, 600.00);

    echo "\nZałożenie konta oszczędnościowego:\n";
    $konto_oszczednosciowe = new KontoOszczednosciowe("1122334455", 5000.00, "Anna Nowak", 2.5);
    echo $konto_oszczednosciowe->daneKonta() . "\n";
    $konto_oszczednosciowe->naliczOprocentowanie();

    echo "\nStan kont:\n";
    echo $konto_osobiste->daneKonta() . "\n";
    echo $konto_firmowe->daneKonta() . "\n";
    echo $konto_oszczednosciowe->daneKonta() . "\n";
