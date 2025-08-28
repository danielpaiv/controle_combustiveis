<?php
        session_start();
        include_once('conexao.php');
        
         if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
        unset($_SESSION['nome']);
        unset($_SESSION['senha']);
        header('Location: index.php');
        exit();  // Importante adicionar o exit() após o redirecionamento
    }
         // Consultar os produtos no estoque
        $sql_estoque = "SELECT id, produto, valor FROM estoque";
        $result_estoque = $conn->query($sql_estoque);

         
?>
<!DOCTYPE html> <!-- Declara o tipo do documento como HTML5 -->
<html lang="en"> <!-- Início do documento HTML, idioma definido como inglês -->
<head> <!-- Cabeçalho do documento -->
    <meta charset="UTF-8"> <!-- Define a codificação de caracteres como UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsividade para dispositivos móveis -->
    <title>CADASTRO DE ESTOQUE</title> <!-- Título da página exibido na aba do navegador -->
</head>
<style> /* Início do bloco de estilos CSS */
    body {
        background-color: #191970; /* Cor de fundo da página */
        font-family: Arial, sans-serif; /* Fonte padrão da página */
    }
    h2 {
        color: #ffffff; /* Cor do texto do título */
        text-align: center; /* Centraliza o título */
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
    }
    button {
        background-color: #7f62c4; /* Cor de fundo do botão */
        border: none; /* Remove a borda do botão */
        padding: 10px 20px; /* Espaçamento interno do botão */
        cursor: pointer; /* Cursor de mão ao passar por cima */
        border-radius: 5px; /* Bordas arredondadas */
    }
    button:hover {
        background-color: #080be4; /* Cor de fundo ao passar o mouse */
    }
    .box {
        background-color: #f9f9f9;  /* Cor de fundo da caixa */
        padding: 20px;/* Espaçamento interno da caixa */
        border-radius: 5px;/* Estilo do campo arredondada */
        box-shadow: 0 2px 5px rgba(0,0,0,.1);/* Sombra para dar profundidade*/
        margin: 20px auto;/* Espaçamento automático para centralizar a caixa*/
        max-width: 400px;/* Largura máxima da caixa */
        text-align: center; /* Centraliza o conteúdo dentro da caixa */
    }
    #produto, #valor, #quantidade, #data_venda {/* Define estilos para os campos de entrada*/
        width: 50%;/* Define a largura do campo de entrada*/
        padding: 5px;/* Campo de entrada para o nome*/
        margin: 5px 0;/* Margem entre os campos*/
        border: 1px solid #ccc;/* Borda do campo de entrada*/
        border-radius: 4px;/* Estilo do campo arredondada */
        text-align: center;/* Alinha o texto ao centro*/    
    }
    button[type="submit"], button[type="button"] {
        margin-top: 10px; /* Espaçamento acima dos botões */
    }
    a {
        color: #000000ff; /* Cor do link */
        text-decoration: none; /* Remove o sublinhado do link */
    }
</style>
<body> 
    <h2>Dados do Produto</h2> <!-- Título principal da página -->

    <header> <!-- Início do cabeçalho -->
        <button><a href="sair.php">SAIR</a></button> <!-- Botão com link para outra página -->
        <button><a href="vendas.php">PLANILHA</a></button> <!-- Botão com link para outra página -->

    </header> <!-- Fim do cabeçalho -->
    <div class="box">
        <form id="myForm" method="POST" action="processar_produtos.php"> <!-- Formulário para cadastro de produtos -->

            <!--<label for="filtroProduto">Filtrar Produto:</label autofocus>
            <input type="text" id="filtroProduto" placeholder="Buscar produto..." autofocus>  Campo de entrada para filtro de produtos -->
            <select name="produto" id="produto" required> <!-- Campo de seleção para produtos -->
                <option value="">Selecione</option>
                <?php
                
                // Verifica se a consulta retornou resultados
                 if ($result_estoque->num_rows > 0) {
                        while($row = $result_estoque->fetch_assoc()) {// Itera sobre os resultados

                            echo "<option value='" . $row['produto'] . "' data-valor='" . $row['valor'] . "'>" . $row['produto'] . "</option>";

                        }
                        }
                     else {
                        echo "<option value=''>Nenhum produto encontrado</option>";
                    }
                ?>
            <br><br><br><br><br>


            

            <label for="valor">VALOR LITRO:</label>
            <input type="number" id="valor" name="valor" step="0.01" readonly> <!-- Campo de entrada para valor, somente leitura -->
            <br><br>

            <label for="valor">ESTOQUE FISICO:</label>
            <input type="number" id="valor" name="valor" step="0.01" > <!-- Campo de entrada para valor, somente leitura -->
            <br><br>

            <label for="quantidade">ESTOQUE SISTEMA:</label>
            <input type="number" id="quantidade" name="quantidade" required>
            <br><br>

            <label for="data_venda">DATA:</label>
            <input type="date" id="data_venda" name="data_venda" required>
            <br><br>

            <button type="submit">Enviar</button>
            <button type="button" id="clearButton">Limpar</button> <!-- Botão para limpar os dados -->
            
        </form>
    </div>

            <script>
                const form = document.getElementById('myForm');// Obtém o formulário pelo ID
                const clearButton = document.getElementById('clearButton');// Obtém o botão de limpar pelo ID
                // Adiciona um evento para quando o DOM estiver completamente carregado
                window.addEventListener("DOMContentLoaded",() => {// Adiciona um evento para quando o DOM estiver completamente carregado
                    form.addEventListener('submit', (event) => {

                        
                    });
                    clearButton.addEventListener('click', (event) => {// Adiciona um evento para o botão de limpar
                        localStorage.removeItem('produto'); // Remove o produto do localStorage
                        localStorage.removeItem('valor'); // Remove o valor do localStorage 
                        localStorage.removeItem('quantidade'); // Remove a quantidade do localStorage
                        //localStorage.removeItem('data_venda'); // Remove a data da venda do localStorage
                        // Exibe uma mensagem de sucesso
                        //alert('Dados removidos do localStorage.'); // Exibe uma mensagem de sucesso
                        form.reset(); // Reseta o formulário
                        document.getElementById('produto').focus(); // Foca no campo de produto
                    });

                    
                });
               
                
            </script>

            <script>
                document.getElementById("produto").addEventListener("change", function() {// Adiciona um evento de mudança ao campo de seleção
                    var selectedOption = this.options[this.selectedIndex];// Obtém a opção selecionada

                    var valor = selectedOption.getAttribute("data-valor");// Obtém o atributo data-valor da opção selecionada
                    //var telefone = selectedOption.getAttribute("data-telefone");// Obtém o atributo data-telefone da opção selecionada

                    document.getElementById("valor").value = valor || "";// Define o valor do campo CPF com o valor do atributo data-cpf ou vazio se não houver
                    //document.getElementById("telefone").value = telefone || "";// Define o valor do campo telefone com o valor do atributo data-telefone ou vazio se não houver
            });
            </script>
            <script>
                document.getElementById("filtroProduto").addEventListener("keyup", function() {
                    var filtro = this.value.toLowerCase();
                    var select = document.getElementById("produto");
                    var options = select.options;

                    for (var i = 0; i < options.length; i++) {
                        var texto = options[i].text.toLowerCase();
                        options[i].style.display = texto.includes(filtro) ? "" : "none";
                    }
                });
            </script>

</body> <!-- Fim do corpo da página -->
</html> <!-- Fim do documento HTML -->