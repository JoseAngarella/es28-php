<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $camerieri = ["Marco", "Luigi", "Anna", "Sara", "Giovanni"];
        $cameriere_assegnato = $camerieri[array_rand($camerieri)];

        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $tavolo = $_POST['tavolo'];
        $orario = $_POST['orario'];
        $note = $_POST['note'];
        $antipasto = isset($_POST['antipasto']);
        $primo = isset($_POST['primo']);
        $secondo = isset($_POST['secondo']);
        $parcheggio = $_POST['parcheggio'];

        $prezzo_totale = 0;
        $messaggio_errore = "";
        $data_ora = date("d-m-Y H:i");

        if (!$antipasto && !$primo && !$secondo) {
            $messaggio_errore = "Errore: Non hai selezionato nessun pasto.";
        } elseif ($antipasto && !$primo && !$secondo) {
            $messaggio_errore = "Errore: Non è possibile ordinare solo l'antipasto.";
        } else {
            if ($antipasto) $prezzo_totale += 5;
            if ($primo) $prezzo_totale += 6;
            if ($secondo) $prezzo_totale += 7;

            if ($primo && $secondo && !$antipasto) {
                $prezzo_totale *= 0.9; // sconto del 10%
            } elseif ($antipasto && $primo && $secondo) {
                $prezzo_totale *= 0.85; // sconto del 15%
            }

            if ($parcheggio == "non custodito") {
                $prezzo_totale += 3;
            } elseif ($parcheggio == "custodito") {
                $prezzo_totale += 5;
            }
        }

        if ($messaggio_errore) {
            echo "<h1>$messaggio_errore</h1>";
            echo "<p>Data e Ora Prenotazione: $data_ora</p>";
            echo '<a href="prenotazione.html">Torna alla prenotazione</a>';
        } else {
            echo "<h1>Resoconto Prenotazione</h1>";
            echo "<table border='1'>
                    <tr><th>Nome</th><td>$nome</td></tr>
                    <tr><th>Cognome</th><td>$cognome</td></tr>
                    <tr><th>Numero Tavolo</th><td>$tavolo</td></tr>
                    <tr><th>Orario</th><td>$orario</td></tr>
                    <tr><th>Note</th><td>$note</td></tr>
                    <tr><th>Cameriere Assegnato</th><td>$cameriere_assegnato</td></tr>
                    <tr><th>Prezzo Totale</th><td>" . number_format($prezzo_totale, 2) . "€</td></tr>
                    <tr><th>Data e Ora Prenotazione</th><td>$data_ora</td></tr>
                </table>";
        }
    ?>
</body>
</html>