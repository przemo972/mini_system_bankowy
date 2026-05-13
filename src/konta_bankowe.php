<?php

abstract class Konto {
    protected string $wlasciciel;
    protected string $numerKonta;
    protected float $saldo;
    
    public function __construct(string $numerKonta, float $saldo, string $wlasciciel) {
        $this->numerKonta = $numerKonta;
        $this->saldo = $saldo;
        $this->wlasciciel = $wlasciciel;
    }

    public function numerKonta() {
        return $this->numerKonta;
    }

    public function saldo() {
        return $this->saldo;
    }

    public function wlasciciel() {
        return $this->wlasciciel;
    }

    public function daneKonta() {
        return "Właściciel: " . $this->wlasciciel . ", Numer konta: " . $this->numerKonta . ", Saldo: " . $this->saldo . " zł";
    }

    public function wplata(float $kwota) {
        if ($kwota > 0) {
            $this->saldo += $kwota;
            echo "Numer konta: " . $this->numerKonta . ", Wpłacono: " . $kwota . " zł. Nowe saldo: " . $this->saldo . " zł.\n";
        } else {
            echo "Kwota wpłaty musi być większa od zera.\n";
        }
    }

    public function wyplata(float $kwota) {
        if ($kwota > 0 && $kwota <= $this->saldo) {
            $this->saldo -= $kwota;
            echo "Numer konta: " . $this->numerKonta . ", Wypłacono: " . $kwota . " zł. Nowe saldo: " . $this->saldo . " zł.\n";
        } else {
            echo "Nie można wypłacić tej kwoty. Sprawdź saldo lub wprowadź poprawną kwotę.\n";
        }
    }
    
    public function przelew(Konto $kontoDocelowe, float $kwota) {
        if ($kwota > 0 && $kwota <= $this->saldo) {
            $this->wyplata($kwota);
            $kontoDocelowe->wplata($kwota);
            echo "Przelew z konta " . $this->numerKonta . " na konto " . $kontoDocelowe->numerKonta() . " został wykonany. Kwota: " . $kwota . " zł.\n";
        } else {
            echo "Nie można wykonać przelewu. Sprawdź saldo lub wprowadź poprawną kwotę.\n";
        }
    }
}

class KontoOsobiste extends Konto {

}

class KontoFirmowe extends Konto {
    private float $debet;

    public function __construct(string $numerKonta, float $saldo, string $wlasciciel, float $debet) {
        parent::__construct($numerKonta, $saldo, $wlasciciel);
        $this->debet = $debet;
    }

    public function wyplata(float $kwota) {
        if ($kwota > 0 && $kwota <= ($this->saldo + $this->debet)) {
            $this->saldo -= $kwota;
            echo "Numer konta: " . $this->numerKonta . ", Wypłacono: " . $kwota . " zł. Nowe saldo: " . $this->saldo . " zł.\n";
        } else {
            echo "Nie można wypłacić tej kwoty. Sprawdź saldo, debet lub wprowadź poprawną kwotę.\n";
        }
    }
    
    public function przelew(Konto $kontoDocelowe, float $kwota) {
        if ($kwota > 0 && $kwota <= ($this->saldo + $this->debet)) {
            $this->wyplata($kwota);
            $kontoDocelowe->wplata($kwota);
            echo "Przelew z konta " . $this->numerKonta . " na konto " . $kontoDocelowe->numerKonta() . " został wykonany. Kwota: " . $kwota . " zł.\n";
        } else {
            echo "Nie można wykonać przelewu. Sprawdź saldo lub wprowadź poprawną kwotę.\n";
        }
    }
}

class KontoOszczednosciowe extends Konto {
    private float $oprocentowanie;

    public function __construct(string $numerKonta, float $saldo, string $wlasciciel, float $oprocentowanie) {
        parent::__construct($numerKonta, $saldo, $wlasciciel);
        $this->oprocentowanie = $oprocentowanie;
    }

    public function naliczOprocentowanie() {
        $odsetki = $this->saldo * ($this->oprocentowanie / 100);
        $this->saldo += $odsetki;
        echo "Oprocentowanie: " . $this->oprocentowanie . "%. Naliczono odsetki: " . $odsetki . " zł. Nowe saldo: " . $this->saldo . " zł.\n";
    }
}