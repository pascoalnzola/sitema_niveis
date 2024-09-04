<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Dois Fatores</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #e0f7fa;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 350px;
}

h2 {
    margin-bottom: 25px;
    color: #0277bd;
}

p {
    margin-bottom: 20px;
    color: #01579b;
}

input[type="text"] {
    width: 100%;
    padding: 12px;
    margin: 15px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

button {
    background-color: #0277bd;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
}

button:hover {
    background-color: #01579b;
}

#message {
    margin-top: 20px;
    font-size: 15px;
}


</style>
<body>
    <div class="container">
        <h2>Verificação de Dois Fatores</h2>
        <p>Insira o código que foi enviado para seu e-mail.</p>
        <form id="verificationForm">
            <input type="text" id="code" placeholder="Digite o código" required>
            <button type="submit">Verificar</button>
        </form>
        <p id="message"></p>
    </div>
    <script src="script.js"></script>
</body>
<script>
    document.getElementById('verificationForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Impede o envio do formulário

    const userCode = document.getElementById('code').value;
    const correctCode = '123456'; // Suponha que este seja o código correto enviado por e-mail

    const messageElement = document.getElementById('message');

    if (userCode === correctCode) {
        messageElement.style.color = 'green';
        messageElement.textContent = 'Verificação bem-sucedida!';
    } else {
        messageElement.style.color = 'red';
        messageElement.textContent = 'Código incorreto. Tente novamente.';
    }
});
</script>
</html>
