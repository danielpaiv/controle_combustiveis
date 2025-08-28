<?php

include_once 'conexao.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendas</title>
</head>
<style>
    body {
        background-color: #191970; /* Cor de fundo da página */
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    table {
        background-color: #c4bdbdff;
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #234432;
        padding: 8px;
    }

    th {
        background-color: #000000ff; /* Cor de fundo do cabeçalho da tabela */
        color: #ffffffff; /* Cor do texto do cabeçalho */
        text-align: left;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
     header {
        display: flex; /* Usa flexbox para o layout do header */
        justify-content: space-around; /* Espaçamento igual entre os itens */
        background-color: #4CAF50; /* Cor de fundo do header */
        padding: 10px; /* Espaçamento interno do header */
    }
    header a {
        color: white; /* Cor do texto dos links */
        text-decoration: none; /* Remove sublinhado dos links */
        font-weight: bold; /* Deixa o texto em negrito */
    }
    header p {
        margin: 0; /* Remove a margem dos parágrafos no header */
    } button {
        background-color: #7f62c4; /* Cor de fundo do botão */
        border: none; /* Remove a borda do botão */
        padding: 10px 20px; /* Espaçamento interno do botão */
        cursor: pointer; /* Cursor de mão ao passar por cima */
        border-radius: 5px; /* Bordas arredondadas */
    }
    button:hover {
        background-color: #080be4; /* Cor de fundo ao passar o mouse */
    }
</style>
<body>
     <header>
        <button><a href="sair.php">SAIR</a></button> <!-- Botão com link para outra página -->
        <button><a href="produtos.php">VOLTAR</a></button> <!-- Botão com link para outra página -->

    </header> 
    <BR></BR>
    <table id="vendas">
    <thead>
        <tr>
            <th>ID</th>
            <th>Produto</th>
            <th>ESTOQUE FÍSICO</th>
            <th>ESTOQUE SISTEMA</th>
            <th>DIFERENÇA</th> <!-- Nova coluna -->
            <th>Data da Venda</th>
        </tr>
    </thead>
    <tbody>
        <?php
            // Consulta para obter os dados das vendas
            $query = "SELECT * FROM vendas ORDER BY id DESC";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Erro na consulta: " . mysqli_error($conn));
            }

            while ($userdata = mysqli_fetch_assoc($result)) {
                // Calcula a diferença
                $diferenca = $userdata['valor'] - $userdata['quantidade'];

                echo "<tr>";
                echo "<td>" . $userdata['id'] . "</td>";
                echo "<td>" . $userdata['produto'] . "</td>";
                echo "<td>" . $userdata['valor'] . "</td>";
                echo "<td>" . $userdata['quantidade'] . "</td>";
                echo "<td>" . $diferenca . "</td>"; // Mostra a diferença
                echo "<td>" . $userdata['data_venda'] . "</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>
        <script>
           document.addEventListener("DOMContentLoaded", function() {
               const vendasTable = document.getElementById('vendas');
               const quantidadeTable = document.getElementById('quantidade');
               // Verifica se as tabelas de vendas e quantidade existem
                let totalValor = 0;// Inicializa a variável totalValor
                let totalQuantidade = 0;// Inicializa a variável totalQuantidade

                const table = document.getElementById('vendas').getElementsByTagName('tbody')[0];// Obtém o corpo da tabela de vendas

                for (let i = 0; i < table.rows.length; i++) {// Percorre cada linha da tabela

                    totalValor += parseFloat(table.rows[i].cells[2].textContent) || 0; // Soma os valores da coluna "Valor"
                    totalQuantidade += parseInt(table.rows[i].cells[3].textContent, 10) || 0; // Soma os valores da coluna "Quantidade"
                }
                const totalRow = document.createElement('tr');// Cria uma nova linha para os totais
                // Adiciona células para os totais
                totalRow.innerHTML = `  
                    <td colspan="2" style="font-weight:bold; background-color: #f5f5f5;">Totais</td> <!-- Define o estilo da célula de totais -->
                    <td style="font-weight:bold;background-color: #f5f5f5;">${totalValor.toFixed(2)}</td> <!-- Formata o total de valor com duas casas decimais -->
                    <td style="font-weight:bold;background-color: #f5f5f5;">${totalQuantidade}</td> <!-- Exibe o total de quantidade -->
                    <td></td>
                `;
                table.appendChild(totalRow);// Adiciona a linha de totais ao corpo da tabela
            });
            
        </script>
</body>
</html>
