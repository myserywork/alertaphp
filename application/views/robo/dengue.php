<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot de Análise de Risco de Dengue</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #e5ddd5;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 10px;
            box-sizing: border-box;
        }

        .chat-container {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 100%;
            max-height: 90vh;
        }

        .chat-header {
            background-color: #075e54;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-header img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .chat-messages {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            background-color: #dcf8c6;
        }

        .chat-message {
            max-width: 70%;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 10px;
            position: relative;
            display: flex;
            align-items: center;
            opacity: 0;
            animation: fadeIn 0.5s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        .chat-message.bot {
            align-self: flex-start;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .chat-message.user {
            align-self: flex-end;
            background-color: #fff;
            border: 1px solid #ddd;
            color: #000;
        }

        .chat-message.bot img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .response-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 10px 0;
        }

        .response-buttons button {
            padding: 10px 20px;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .response-buttons button#no-btn {
            background-color: #f44336;
        }

        .response-buttons button:hover {
            background-color: #3e8e41;
        }

        .response-buttons button#no-btn:hover {
            background-color: #e53935;
        }

        .questions-remaining {
            text-align: center;
            font-size: 0.85em;
            margin: 5px 0;
        }

        .risk-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #f9f9f9;
            border-top: 1px solid #ccc;
        }

        .risk-progress {
            height: 10px;
            width: 80%;
            background-color: #ccc;
            border-radius: 5px;
            overflow: hidden;
            transition: width 1s ease-in-out, background-color 1s ease-in-out;
        }

        .risk-progress div {
            height: 100%;
            transition: width 1s ease-in-out, background-color 1s ease-in-out;
        }

        #risk-level {
            width: 20%;
            text-align: right;
            font-weight: bold;
        }

        @media (max-width: 600px) {
            .chat-container {
                max-height: 80vh;
                border-radius: 0;
            }

            .chat-header {
                padding: 5px;
                font-size: 18px;
            }

            .chat-messages {
                padding: 10px;
            }

            .chat-message {
                padding: 8px;
            }

            .response-buttons {
                flex-direction: column;
                gap: 10px;
            }

            .response-buttons button {
                width: 100%;
                justify-content: center;
            }

            .risk-bar {
                flex-direction: column;
                align-items: flex-start;
            }

            #risk-level {
                width: 100%;
                text-align: left;
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="chat-container">
        <div class="chat-header">
            <img src="https://i.imgur.com/5hUrqgY.png" alt="Robô">
            Chatbot de Análise de Risco de Dengue
        </div>
        <div id="chat" class="chat-messages"></div>
        <div id="questions-remaining" class="questions-remaining"></div>
        <div id="response-buttons" class="response-buttons">
            <button id="yes-btn" onclick="sendResponse('sim')">
                <i class="fas fa-check"></i> Sim
            </button>
            <button id="no-btn" onclick="sendResponse('não')">
                <i class="fas fa-times"></i> Não
            </button>
        </div>
        <div id="risk-bar" class="risk-bar">
            <div class="risk-progress"><div id="risk-progress"></div></div>
            <span id="risk-level">Nenhum</span>
        </div>
    </div>

    <script>
        const questions = [
            "O paciente está apresentando febre?",
            "O paciente está apresentando náusea?",
            "O paciente vomitou?",
            "O paciente está apresentando manchas no corpo?",
            "O paciente está apresentando dor no corpo?",
            "O paciente está apresentando dor nas articulações?",
            "O paciente está apresentando dor de cabeça?",
            "O paciente está apresentando dor atrás dos olhos?",
            "O paciente está apresentando fraqueza?",
            "O paciente está apresentando dor de barriga?",
            "O paciente está apresentando vômitos que não melhoram?",
            "O paciente está inchado?",
            "O paciente está sentindo tontura ao se levantar?",
            "O paciente apresentou algum sangramento?",
            "O paciente está letárgico?",
            "O paciente está agitado?",
            "O paciente está urinando menos ou parou de urinar?",
            "O paciente está com a ponta dos dedos azulados?",
            "O paciente está sentindo falta de ar?",
            "O paciente possui idade > 65 anos ou < 2 anos?",
            "O paciente é portador de hipertensão arterial?",
            "O paciente é portador de insuficiência cardíaca ou alguma outra doença cardíaca?",
            "O paciente é portador de diabetes mellitus?",
            "O paciente é portador de doença pulmonar obstrutiva crônica/enfisema pulmonar?",
            "O paciente é portador de asma?",
            "O paciente é portador de alguma doença hematológica?",
            "O paciente é portador de doença renal crônica?",
            "O paciente é portador de úlcera péptica?",
            "O paciente é portador de alguma doença de fígado?",
            "O paciente é portador de alguma doença autoimune?"
        ];
        const riskLevels = ["Nenhum", "Baixo", "Médio", "Alto", "Urgente"];
        const riskColors = ["green", "yellow", "orange", "red", "darkred"];
        let currentRiskLevel = 0;
        let currentQuestionIndex = 0;
        let positiveResponses = 0;

        document.addEventListener("DOMContentLoaded", () => {
            displayMessage(questions[currentQuestionIndex], "bot");
            updateQuestionsRemaining();
        });

        function sendResponse(response) {
            displayMessage(response, "user");
            evaluateResponse(response);
        }

        function evaluateResponse(response) {
            if (response === "sim") {
                positiveResponses++;
                incrementRiskBar();
            }
            currentQuestionIndex++;
            if (currentQuestionIndex < questions.length) {
                displayMessage(questions[currentQuestionIndex], "bot");
                updateQuestionsRemaining();
            } else {
                displayFinalMessage();
                hideResponseButtons();
            }
        }

        function incrementRiskBar() {
            if (currentRiskLevel < 4) {
                currentRiskLevel++;
            }
            updateRiskBar();
        }

        function updateRiskBar() {
            const riskProgress = document.getElementById("risk-progress");
            riskProgress.style.width = (currentRiskLevel / 4) * 100 + "%";
            riskProgress.style.backgroundColor = riskColors[currentRiskLevel];
            document.getElementById("risk-level").innerText = riskLevels[currentRiskLevel];
        }

        function displayMessage(message, sender) {
            const chat = document.getElementById("chat");
            const messageElem = document.createElement("div");
            messageElem.className = `chat-message ${sender}`;
            if (sender === "bot") {
                const img = document.createElement("img");
                img.src = "https://i.imgur.com/5hUrqgY.png";
                messageElem.appendChild(img);
            }
            messageElem.appendChild(document.createTextNode(message));
            chat.appendChild(messageElem);
            chat.scrollTop = chat.scrollHeight;
        }

        function updateQuestionsRemaining() {
            const questionsRemaining = questions.length - currentQuestionIndex - 1;
            document.getElementById("questions-remaining").innerText = `Perguntas restantes: ${questionsRemaining}`;
        }

        function displayFinalMessage() {
            let finalMessage = "Análise concluída. ";
            if (positiveResponses >= 3) {
                finalMessage += "Há suspeita de dengue. Procure atendimento médico.";
            } else if (positiveResponses === 1) {
                finalMessage += "Há uma suspeita inicial de dengue. Continue monitorando os sintomas.";
            } else {
                finalMessage += "Não há suspeita de dengue.";
            }
            displayMessage(finalMessage, "bot");
        }

        function hideResponseButtons() {
            document.getElementById("response-buttons").style.display = "none";
        }
    </script>
</body>
</html>
