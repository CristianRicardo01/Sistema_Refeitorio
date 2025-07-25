<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Relatório PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>

<body>
    <h2>Relatório de Lançamentos</h2>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Matrícula</th>
                <th>Tipo</th>
                <th>Data</th>
                <th>Registrado em</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($registros as $registro): ?>
                <tr>
                    <td><?= $registro['nome'] ?></td>
                    <td><?= $registro['matricula'] ?></td>
                    <td><?= $registro['tipo'] ?></td>
                    <td><?= date('d/m/Y', strtotime($registro['data'])) ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($registro['created_at'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>