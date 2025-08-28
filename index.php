
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTROLE DE COMBUSTIVEIS</title>
</head>
<style>
    body {
        background-image: linear-gradient(to right, #191970, #035570ff);
        font-family: Arial, sans-serif;
        
        
    }

    
    .box{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(255, 255, 255, 0.88);
            padding: 35px;
            border-radius: 15px;
            width: 20%;
            color: rgb(15, 15, 15);
        }
        .inputbox{
            position: relative;
           
        }
        .inputUser{
            background: none;
            padding: 5px;
            border: none;
            border-bottom: 1px solid rgb(11, 11, 11);
            outline: none;
            color: rgb(8, 8, 8);
            font-size: 15px;
            width: 100%;
            letter-spacing: 5px; 
        }
        .labelInput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5px;
            color: rgb(3, 3, 3);
        }
        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -20px;
            font-size: 15px;
            color: dodgerblue;
        }
        .button{
            background-color: rgba(7, 36, 163, 1);
            padding: 15px;
            border-radius: 15px;
            position: absolute;
            
        }
        .inputsubmit
        {
            background-image: linear-gradient(to right,rgb(173, 220, 20), rgb(43, 43, 18));
            width: 50%;
            border: none;
            padding: 10px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 10px;
        }
        .inputsubmit:hover
        {
            background-image: linear-gradient(to right,rgb(43, 43, 18), rgb(173, 220, 20));
        }
        h2 {
            color: white;
            font-size: 30px;
            margin-top: 20px;
        }
        p {
            color: white;
            font-size: 18px;
            margin-top: 10px;
        }
</style>
<body>
    <center><h2>Login</h2></center>
    <center><p>Por favor, insira suas credenciais para acessar o sistema.</p></center>

        <div class="box">
            <form action="teste_login.php" method="post">

                <div class="inputbox">
                     <input type="text" id="nome" name="nome" class="inputUser" required autofocus>
                    <label for="nome" class="labelInput"> Usuário</label>
                   
                </div>
                <br><br>

                <div class="inputbox">
                    <input type="password" id="senha" name="senha" class="inputUser" required>
                    <label for="senha" class="labelInput">Senha</label>
                    
                </div>
                <br><br>

                <input class="inputsubmit" type="submit"  name="submit" value="Enviar">
            </form>
        </div>
    
    
</body>
</html>