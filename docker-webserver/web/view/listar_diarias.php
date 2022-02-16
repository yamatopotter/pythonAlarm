<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <h1>Lista de Diarias</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Tempo de Atendimento</th>
                    <th scope="col">Nome Diarista</th>
                    <th scope="col">Nome Cliente</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($diarias as $diaria):?>
                    <tr>
                        <th scope="row"><?= $diaria->data ?></th>
                        <td><?= $diaria->tempo ?></td>
                        <td><?= $diaria->diarista->nome ?></td>
                        <td><?= $diaria->cliente->nomeCompleto ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>