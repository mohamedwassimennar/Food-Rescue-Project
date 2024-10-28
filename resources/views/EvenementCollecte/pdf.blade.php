<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements de Collecte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        .header {
            border: 1px solid #000;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
            background-color: #f9f9f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Liste des Événements de Collecte</h1>
    
    <!-- Cadre d'informations professionnelles -->
    <div class="header">
        <h2>Détails Professionnels</h2>
        <p>Nom de l'Organisation : FOODRESCUE</p>
        <p>Date : {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        <p>Contact : contact@FOODRESCUE.com</p>
        <p>Téléphone : +216 99 999 999</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Date</th>
                <th>Lieu</th>
                <th>Type de nourriture</th>
                <th>Organisateur</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evenements as $evenement)
                <tr>
                    <td>{{ $evenement->nom }}</td>
                    <td>{{ \Carbon\Carbon::parse($evenement->date)->format('d/m/Y') }}</td>
                    <td>{{ $evenement->lieu }}</td>
                    <td>{{ $evenement->type_nourriture }}</td>
                    <td>{{ $evenement->organisateur }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
