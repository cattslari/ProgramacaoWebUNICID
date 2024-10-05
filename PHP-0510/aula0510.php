<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Dados</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffe6f2; /* fundo rosa claro */
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .form-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            margin: auto;
        }
        h1 {
            text-align: center;
            color: #e91e63; /* rosa escuro */
        }
        label {
            margin-top: 10px;
            display: block;
            font-weight: bold;
            color: #d81b60; /* rosa */
        }
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #d81b60; /* rosa */
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #e91e63; /* rosa */
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #c2185b; /* rosa escuro no hover */
        }
        .result {
            margin-top: 20px;
            font-weight: bold;
            padding: 10px;
            background-color: #f8bbd0; /* rosa muito claro */
            border: 1px solid #f48fb1; /* rosa claro */
            border-radius: 4px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Preencha os dados</h1>
        <form action="" method="POST">
            <label for="quantidade">Quantidade de pessoas:</label>
            <input type="number" id="quantidade" name="quantidade" required>

            <label for="consumo">Consumo:</label>
            <input type="number" id="consumo" name="consumo" step="0.01">

            <label for="combustivel">Valor do combustível:</label>
            <input type="number" id="combustivel" name="combustivel" step="0.01" required>

            <label for="aluguel">Aluguel:</label>
            <input type="number" id="aluguel" name="aluguel" step="0.01" required>

            <button type="submit">Calcular</button>
        </form>

        <?php
        session_start(); // Inicia a sessão

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $quantidade = intval($_POST['quantidade']);
            $consumo = floatval($_POST['consumo']);
            $combustivel = floatval($_POST['combustivel']);
            $aluguel = floatval($_POST['aluguel']);

            if ($quantidade <= 0) {
                echo "<div class='result'>A quantidade de pessoas deve ser maior que zero.</div>";
            } else {
                $total = $consumo * $combustivel + $aluguel;
                $valorPorPessoa = $total / $quantidade;

                // Armazenar resultado na sessão
                $_SESSION['resultado'] = [
                    'total' => $total,
                    'valorPorPessoa' => $valorPorPessoa
                ];

                echo "<div class='result'>O valor total é: R$ " . number_format($total, 2, ',', '.') . "<br>";
                echo "O valor por pessoa é: R$ " . number_format($valorPorPessoa, 2, ',', '.') . "</div>";
            }
        }

        // Limpar o resultado ao atualizar
        if (isset($_SESSION['resultado'])) {
            unset($_SESSION['resultado']);
        }
        ?>
    </div>
</body>
</html>
