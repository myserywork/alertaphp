<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot de Análise de Risco</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">
            <h2>Alerta Saúde</h2>
        </div>
        <div id="chat" class="chat-messages"></div>
        <div class="chat-input">
            <button id="voice-toggle" onclick="toggleVoice()">Voz: Off</button>
            <button id="btn-nao" onclick="sendResponse('não')">Não</button>
            <button id="btn-sim" onclick="sendResponse('sim')">Sim</button>
        </div>
        <div id="risk-bar" class="risk-bar">
            <div id="risk-progress" class="risk-progress"></div>
            <span id="risk-level">Nenhum</span>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
