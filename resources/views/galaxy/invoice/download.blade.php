<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
        }
        .invoice-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #ddd;
        }
        .header, .footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: #ffffff;
        }
        .invoice-details, .client-details {
            margin: 20px 0;
        }
        .invoice-details h1, .client-details h2 {
            margin: 0;
            font-size: 18px;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .invoice-table th, .invoice-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .invoice-table th {
            background-color: #333;
            color: #ffffff;
        }
        .totals {
            float: right;
            width: 50%;
            margin-top: 20px;
            text-align: right;
        }
        .totals th, .totals td {
            padding: 10px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- En-tête -->
        <div class="header">
            <h1>Raphaël Voyance</h1>
            <p>1bis rue Benjamin Franklin, 66000, Perpignan</p>
            <p>Téléphone : 07 66 26 75 47 | Email : raphael-voyance@outlook.fr</p>
        </div>

        <!-- Détails de la facture -->
        <div class="invoice-details">
            <h1>Facture N° {{ $invoice->ref }}</h1>
            <p>Statut : {{ $invoice->status }}</p>
            <p>Date : {{ \Carbon\Carbon::parse($invoice->updated_at)->format('d/m/Y') }}</p>
        </div>

        <!-- Détails du client -->
        <div class="client-details">
            <h2>Client :</h2>
            <p>{{ $userName }}</p>
            <div>{!! $userAdress !!}</div>
            <p>Email : client@example.com</p>
        </div>

        <!-- Table de produits/services -->
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Produit / Service</th>
                    <th>Quantité</th>
                    <th>Prix Unitaire</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>1</td>
                        <td>{{ $IC->setAmountPriceForHuman($product->price) }}</td>
                        <td>{{ $IC->setAmountPriceForHuman($product->price) }}</td>
                    </tr>
                    
                @endforeach
            </tbody>
        </table>

        <!-- Totaux -->
        <table class="totals">
            <tr>
                <th>Sous-total</th>
                <td>{{ $subTotalPrice }}</td>
            </tr>
            <tr>
                <th>Total</th>
                <td>{{ $totalPrice }}</td>
            </tr>
        </table>

        <!-- Pied de page -->
        <div class="footer">
            <p>Merci pour votre confiance !</p>
            <p>Si vous avez des questions, n'hésitez pas à me contacter.</p>
        </div>
    </div>
</body>
</html>