<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Chatbot de Análise de Risco</title>
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
}

.chat-message.bot {
    align-self: flex-start;
    background-color: #fff;
    border: 1px solid #ddd;
}

.chat-message.bot img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-right: 10px;
}

.chat-message.bot.active {
    border: 2px solid #075e54;
}

.chat-message.bot::before {
    content: "";
    position: absolute;
    top: 10px;
    left: -10px;
    width: 0;
    height: 0;
    border: 10px solid transparent;
    border-right-color: #fff;
    border-left: 0;
    margin-top: -5px;
}

.chat-message.user {
    align-self: flex-end;
    background-color: #fff;
    border: 1px solid #ddd;
    color: #000;
}

.chat-message.user img {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    margin-left: 10px;
}

.chat-message.user div {
    margin-left: 5px;
}

.chat-message.user::before {
    content: "";
    position: absolute;
    top: 10px;
    right: -10px;
    width: 0;
    height: 0;
    border: 10px solid transparent;
    border-left-color: #fff;
    border-right: 0;
    margin-top: -5px;
}

.typing-indicator {
    align-self: flex-start;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 20px;
    margin-bottom: 10px;
}

.typing-indicator span {
    display: inline-block;
    width: 8px;
    height: 8px;
    margin: 0 2px;
    background-color: #ccc;
    border-radius: 50%;
    animation: typing 1s infinite;
}

.typing-indicator span:nth-child(2) {
    animation-delay: 0.2s;
}

.typing-indicator span:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes typing {
    0%, 60%, 100% {
        transform: translateY(0);
        opacity: 0.2;
    }
    30% {
        transform: translateY(-5px);
        opacity: 1;
    }
}

.chat-input {
    display: flex;
    justify-content: space-between;
    padding: 10px;
    background-color: #f9f9f9;
    border-top: 1px solid #ccc;
}

.chat-input input {
    flex-grow: 1;
    padding: 5px 10px;
    border-radius: 20px;
    border: 1px solid #ccc;
    outline: none;
    font-size: 16px;
    transition: all 0.3s ease;
    width: 50px; /* Start with a small width */
}

.chat-input input:focus {
    width: calc(100% - 70px); /* Expand to fill the space when focused */
    padding: 10px;
}

.chat-input button {
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    margin-left: 10px;
    background-color: #075e54;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chat-input button i {
    margin-right: 5px;
}

#listen-toggle {
    background-color: #f9f9f9;
    color: #333;
    border: 1px solid #ccc;
    border-radius: 20px;
}

#listen-toggle.active {
    background-color: #075e54;
    color: white;
}

#record-btn {
    background-color: #075e54;
    color: white;
    border: none;
    border-radius: 20px;
    padding: 10px 20px;
    cursor: pointer;
    margin-left: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
}

#record-btn.active {
    background-color: #d32f2f;
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

.response-buttons {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
    display: none; /* Initially hidden */
    padding-bottom: 20px; /* Padding for bottom */
}

.response-buttons button {
    padding: 10px 20px;
    border-radius: 20px;
    border: 1px solid #ccc;
    cursor: pointer;
    display: flex;
    align-items: center;
}

.response-buttons #yes-btn {
    background-color: #4CAF50;
    color: white;
}

.response-buttons #no-btn {
    background-color: #f44336;
    color: white;
}

.response-buttons i {
    margin-right: 10px;
}

.questions-remaining {
    text-align: center;
    margin-top: -10px;
    font-size: 0.85em;
    margin-bottom: 10px;
}

.auth-popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.auth-popup-content {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    width: 300px;
}

.auth-popup-content h2 {
    margin-bottom: 20px;
    color: #075e54;
}

.auth-popup-content input {
    width: 80%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 20px;
    border: 1px solid #ccc;
    outline: none;
    font-size: 16px;
}

.auth-popup-content button {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    background-color: #075e54;
    color: white;
}

.loading-indicator {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.loading-indicator div {
    width: 8px;
    height: 8px;
    background-color: #075e54;
    border-radius: 50%;
    animation: loading 1s infinite;
}

.loading-indicator div:nth-child(2) {
    animation-delay: 0.2s;
}

.loading-indicator div:nth-child(3) {
    animation-delay: 0.4s;
}

@keyframes loading {
    0%, 60%, 100% {
        transform: translateY(0);
        opacity: 0.2;
    }
    30% {
        transform: translateY(-5px);
        opacity: 1;
    }
}

.listening-indicator {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #fff3e6;
    padding: 10px;
    border-radius: 20px;
    color: #333;
    font-weight: bold;
    text-align: center;
    margin-bottom: 10px;
}

.audio-toggle-label {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 18px;
    cursor: pointer;
}

.audio-toggle-label i {
    font-size: 24px;
    color: #075e54;
}

@media (max-width: 600px) {
    .chat-container {
        width: 100%;
        height: 100vh;
        border-radius: 0;
    }

    .chat-input {
        padding: 5px;
    }

    .chat-input input {
        padding: 8px;
        font-size: 14px;
    }

    .chat-input button {
        padding: 8px 16px;
        font-size: 14px;
    }

    .chat-messages {
        padding: 10px;
    }

    .chat-header {
        padding: 5px;
        font-size: 18px;
    }

    .response-buttons {
        gap: 10px;
        flex-direction: row; /* Display buttons side by side */
    }

    .response-buttons button {
        width: auto;
        flex-grow: 1; /* Make buttons grow to fill space */
        justify-content: center;
    }
}

    </style>
</head>

<body>
    <div class="auth-popup" id="auth-popup">
        <div class="auth-popup-content">
            <h2>Autenticação</h2>
            <input id="cpf-input" type="text" placeholder="CPF" maxlength="14" oninput="formatCPF(event)" value="<?= $cpf; ?>">
            <input id="pin-input" type="password" placeholder="PIN" maxlength="4" oninput="formatPIN(event)" value="<?= $pin; ?>">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="audio-toggle">
                <label class="form-check-label audio-toggle-label" for="audio-toggle">
                    <i class="fas fa-volume-up"></i> Ativar modo de áudio
                </label>
            </div>
            <button onclick="authenticate()">Entrar</button>
            <div class="loading-indicator" id="loading-indicator" style="display:none;">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>

    <div class="chat-container" style="display:none;">
        <div class="chat-header">
            <img id="disease-image" src="https://via.placeholder.com/30" alt="Doença">
            Alerta Saúde
        </div>
        <div id="chat" class="chat-messages"></div>
        <div class="chat-input">
            <button id="listen-toggle" onclick="toggleListen()"><i class="fas fa-headphones"></i> Ouvir: Off</button>
            <input id="user-input" type="text" placeholder="Digite sua resposta aqui..." onkeypress="handleKeyPress(event)">
            <button id="send-btn" onclick="sendInput()"><i class="fas fa-paper-plane"></i> Enviar</button>
            <button id="record-btn" onmousedown="startRecording()" onmouseup="stopRecording()" ontouchstart="startRecording()" ontouchend="stopRecording()"><i class="fas fa-microphone"></i></button>
        </div>
        <div id="risk-bar" class="risk-bar">
            <div class="risk-progress"><div id="risk-progress"></div></div>
            <span id="risk-level">Nenhum</span>
        </div>
        <div id="response-buttons" class="response-buttons">
            <button id="yes-btn"><i class="fas fa-check"></i> Sim</button>
            <button id="no-btn"><i class="fas fa-times"></i> Não</button>
        </div>
        <div id="questions-remaining" class="questions-remaining"></div>
    </div>

    <script>
        let patientData = null;
        let currentDiseaseIndex = 0;
        let currentSymptomIndex = 0;
        const riskLevels = { "baixo": 1, "medio": 2, "alto": 3, "urgente": 4 };
        let currentRiskLevel = 0;
        let useListen = false;
        let responses = []; // Array para armazenar respostas
        let recognition;
        let awaitingNextQuestion = false; // Flag to check if awaiting next question

        document.addEventListener("DOMContentLoaded", () => {
            requestPermissions();
        });

        function requestPermissions() {
            navigator.mediaDevices.getUserMedia({ audio: true })
                .then(stream => {
                    console.log("Permissão de áudio concedida.");
                })
                .catch(error => {
                    console.error("Erro ao solicitar permissão de áudio:", error);
                    alert("Por favor, conceda permissão de áudio para usar a função de voz.");
                });
        }

        function formatCPF(event) {
            let input = event.target;
            input.value = input.value.replace(/\D/g, "")
                .replace(/(\d{3})(\d)/, "$1.$2")
                .replace(/(\d{3})(\d)/, "$1.$2")
                .replace(/(\d{3})(\d{1,2})$/, "$1-$2");
        }

        function formatPIN(event) {
            let input = event.target;
            input.value = input.value.replace(/\D/g, "").substring(0, 4);
        }

        function authenticate() {
            let cpf = document.getElementById("cpf-input").value;
            let pin = document.getElementById("pin-input").value;
            let audioToggle = document.getElementById("audio-toggle").checked;

            if (validateCPF(cpf) && validatePIN(pin)) {
                document.getElementById("loading-indicator").style.display = "flex";

                fetch(`https://moriarty.com.br/alertasaude/paciente/login?cpf=${cpf}&pin=${pin}`)
                    .then(response => response.json())
                    .then(data => {
                        patientData = data;
                        if (!data.nome) {
                            alert("Paciente não encontrado. Verifique as credenciais e tente novamente.");
                            document.getElementById("loading-indicator").style.display = "none";
                            return;
                        }
                        useListen = audioToggle; // Set useListen based on the checkbox
                        document.getElementById("auth-popup").style.display = "none";
                        document.querySelector(".chat-container").style.display = "flex";
                        introduceLiz();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById("loading-indicator").style.display = "none";
                        alert("Erro na autenticação. Tente novamente.");
                    });
            } else {
                alert("CPF ou PIN inválido. Tente novamente.");
            }
        }

        function validateCPF(cpf) {
            return /^\d{3}\.\d{3}\.\d{3}-\d{2}$/.test(cpf);
        }

        function validatePIN(pin) {
            return /^\d{4}$/.test(pin);
        }

        function introduceLiz() {
            let introductionText = `Olá ${patientData.nome}, tudo bem? Sou a <b>LIZ</b>, sua assistente virtual de saúde. Vamos começar a avaliação?`;
            displayMessage(introductionText, "bot");
            if (useListen) playAudio(stripHTML(introductionText), () => {
                setTimeout(() => {
                    updateDiseaseInfo();
                      setTimeout(() => {
                          nextQuestion();
                      }, 2000);
                }, 2000);
            });
        }

        function nextQuestion() {
            awaitingNextQuestion = false;
            if (currentDiseaseIndex < patientData.doencasCronicas.length) {
                let disease = patientData.doencasCronicas[currentDiseaseIndex];
                let symptom = disease.sintomas[currentSymptomIndex];
                if (symptom) {
                    displayLoadingIndicator();
                           setTimeout(() => {
                        removeLoadingIndicator();
                        displayMessage(symptom.pergunta, "bot", true);
                        if (useListen) playAudio(stripHTML(symptom.pergunta), showResponseButtons);
                    }, 2000);
                } else {
                    displayRecommendation();
                }
            } else {
                displayMessage("Análise concluída. Obrigado!", "bot");
                sendResponsesToPlatform(true);
            }
        }

        function displayRecommendation() {
            let disease = patientData.doencasCronicas[currentDiseaseIndex];
            let recommendation = "";
            const riskText = ['Nenhum', 'Baixo', 'Médio', 'Alto', 'Urgente'];

            switch (currentRiskLevel) {
                case 1:
                    recommendation = disease.recomendacoes_leve;
                    break;
                case 2:
                    recommendation = disease.recomendacoes_medio;
                    break;
                case 3:
                    recommendation = disease.recomendacoes_alto;
                    break;
                case 4:
                    recommendation = disease.recomendacoes_urgentissimo;
                    break;
            }

            displayMessage(`Recomendações para <b>${disease.nome}</b> no nível de risco <b>${riskText[currentRiskLevel]}</b>: ${recommendation}`, "bot");
            if (useListen) playAudio(stripHTML(`Recomendações para ${disease.nome} no nível de risco ${riskText[currentRiskLevel]}: ${recommendation}`), () => {
                sendResponsesToPlatform(false);
                currentDiseaseIndex++;
                currentSymptomIndex = 0;
                currentRiskLevel = 0;
                resetRiskBar();
            });
        }

        function resetRiskBar() {
            document.getElementById("risk-progress").style.width = "0%";
            document.getElementById("risk-progress").style.backgroundColor = "green";
            document.getElementById("risk-level").innerText = "Nenhum";
        }

        function sendInput() {
            let userInput = document.getElementById("user-input").value.trim();
            if (!userInput) return;

            displayMessage(userInput, "user");
            sendResponse(userInput);
            document.getElementById("user-input").value = "";
        }

        function sendResponse(response) {
            if (awaitingNextQuestion) return; // Prevent overlapping responses

            let disease = patientData.doencasCronicas[currentDiseaseIndex];
            let symptom = disease.sintomas[currentSymptomIndex];

            responses.push({ symptom: symptom.pergunta, userResponse: response });

            if (response.toLowerCase() === 'sim') {
                let riskIncrease = riskLevels[symptom.risco];
                if (riskIncrease > currentRiskLevel) {
                    currentRiskLevel = riskIncrease;
                } else {
                    incrementRiskBar();
                }
            }

            updateRiskBar();
            displayMessage(response, "user");
            currentSymptomIndex++;
            updateQuestionsRemaining();

            awaitingNextQuestion = true;
            setTimeout(nextQuestion, 2000); // Wait for 2 seconds before moving to the next question
        }

        function incrementRiskBar() {
            let riskBar = document.getElementById("risk-progress");
            let currentWidth = parseFloat(riskBar.style.width);
            let newWidth = currentWidth + 5; // Incrementa 5% da barra
            riskBar.style.width = newWidth + "%";
        }

        function updateRiskBar() {
            const riskText = ['Nenhum', 'Baixo', 'Médio', 'Alto', 'Urgente'];
            const riskColors = ['green', 'yellow', 'orange', 'red', 'darkred'];

            let riskBar = document.getElementById("risk-progress");
            riskBar.style.width = (currentRiskLevel / 4) * 100 + "%";
            riskBar.style.backgroundColor = riskColors[currentRiskLevel - 1];
            document.getElementById("risk-level").innerText = riskText[currentRiskLevel];
        }

        function displayMessage(message, sender, active = false) {
            let chat = document.getElementById("chat");
            let messageElem = document.createElement("div");
            messageElem.className = `chat-message ${sender}`;
            if (active) messageElem.classList.add("active");

            if (sender === "bot") {
                let img = document.createElement("img");
                img.src = "https://i.imgur.com/5hUrqgY.png";
                messageElem.appendChild(img);
            } else if (sender === "user" && patientData && patientData.foto) {
                let img = document.createElement("img");
                img.src = `<?= base_url('assets/uploads/files/'); ?>${patientData.foto}`;
                messageElem.appendChild(img);
            }

            let textElem = document.createElement("div");
            textElem.innerHTML = message;
            messageElem.appendChild(textElem);
            chat.appendChild(messageElem);
            chat.scrollTop = chat.scrollHeight;

            if (sender === "bot" && active) {
                displayLoadingIndicator();
                setTimeout(() => {
                    removeLoadingIndicator();
                    removeActiveClass();
                    showResponseButtons();
                }, 2000);
            }
        }

        function displayLoadingIndicator() {
            let chat = document.getElementById("chat");
            let typingIndicator = document.createElement("div");
            typingIndicator.className = "typing-indicator";
            typingIndicator.id = "typing-indicator";
            typingIndicator.innerHTML = "<span></span><span></span><span></span>";
            chat.appendChild(typingIndicator);
            chat.scrollTop = chat.scrollHeight;
        }

        function removeLoadingIndicator() {
            let typingIndicator = document.getElementById("typing-indicator");
            if (typingIndicator) {
                typingIndicator.parentNode.removeChild(typingIndicator);
            }
        }

        function handleKeyPress(event) {
            if (event.key === 'Enter') {
                sendInput();
            }
        }

        function toggleListen() {
            useListen = !useListen;
            let listenToggleBtn = document.getElementById("listen-toggle");
            listenToggleBtn.innerText = `Ouvir: ${useListen ? 'On' : 'Off'}`;
            listenToggleBtn.classList.toggle('active');
            listenToggleBtn.innerHTML = `<i class="fas fa-headphones${useListen ? '' : '-slash'}"></i> Ouvir: ${useListen ? 'On' : 'Off'}`;
        }

        function startRecording() {
            if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
                const SpeechRecognition = window.webkitSpeechRecognition || window.SpeechRecognition;
                recognition = new SpeechRecognition();
                recognition.continuous = true;
                recognition.interimResults = false;
                recognition.lang = "pt-BR";

                recognition.onstart = function () {
                    displayListeningIndicator();
                    document.getElementById("record-btn").classList.add("active");
                    console.log("Gravação iniciada. Fale 'sim' ou 'não'.");
                };

                recognition.onresult = function (event) {
                    const voiceResult = event.results[0][0].transcript.toLowerCase();
                    if (voiceResult.includes("sim") || voiceResult.includes("não")) {
                        sendResponse(voiceResult.includes("sim") ? 'sim' : 'não');
                    } else {
                        displayMessage("<b>Não consegui entender. Por favor, diga 'sim' ou 'não'.</b>", "bot");
                    }
                    stopRecording(); // Stop recording after result is processed
                };

                recognition.onerror = function (event) {
                    console.error("Erro no reconhecimento de voz:", event.error);
                    stopRecording(); // Stop recording on error
                };

                recognition.start();
            } else {
                console.warn("Reconhecimento de voz não é suportado neste navegador.");
            }
        }

        function stopRecording() {
            if (recognition) {
                recognition.stop();
                console.log("Gravação encerrada.");
                removeListeningIndicator();
                document.getElementById("record-btn").classList.remove("active");
            }
        }

        function showResponseButtons() {
            let responseButtons = document.getElementById("response-buttons");
            responseButtons.style.display = "flex";

            document.getElementById("yes-btn").onclick = () => sendResponse('sim');
            document.getElementById("no-btn").onclick = () => sendResponse('não');

            updateQuestionsRemaining();
        }

        function removeResponseButtons() {
            let responseButtons = document.getElementById("response-buttons");
            responseButtons.style.display = "none";
        }

        function hideResponseButtons() {
            let responseButtons = document.getElementById("response-buttons");
            responseButtons.style.display = "none";
        }

        function updateQuestionsRemaining() {
            let questionsRemaining = document.getElementById("questions-remaining");
            let disease = patientData.doencasCronicas[currentDiseaseIndex];
            questionsRemaining.innerHTML = `<sub>Perguntas restantes para esta doença: ${disease.sintomas.length - currentSymptomIndex}</sub>`;
        }

        function sendResponsesToPlatform(final = false) {
            let jsonPayload = {
                patient: patientData,
                responses: responses
            };

            fetch('<?= base_url('robo/relatorio'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(jsonPayload)
            })
                .then(response => {
                    if (response.ok) {
                        displayMessage('<b>As respostas foram enviadas com sucesso para a plataforma!</b>', 'bot');
                        if (final) {
                            const finalMessage = `<b>Agradeço todas as informações.</b><br><br>Nossa equipe médica já está avaliando os sintomas informados e em seguida entraremos em contato por telefone, orientando e sugerindo os procedimentos que deverão ser tomados.<br><br><b>Aguarde nosso contato. Muito obrigada. Se cuide. Um abraço da Liz!</b>`;
                            displayMessage(finalMessage, "bot");
                            if (useListen) playAudio(stripHTML(finalMessage));
                        } else {
                            const nextDiseaseMessage = `Vamos iniciar a análise da próxima doença em breve.`;
                            displayMessage(nextDiseaseMessage, "bot");
                            if (useListen) playAudio(stripHTML(nextDiseaseMessage), () => {
                                setTimeout(() => {
                                    updateDiseaseInfo();
                                    nextQuestion();
                                }, 2000);
                            });
                        }
                    } else {
                        displayMessage('<b>Houve um problema ao enviar as respostas para a plataforma.</b>', 'bot');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    displayMessage('<b>Erro ao enviar as respostas para a plataforma. Tente novamente mais tarde.</b>', 'bot');
                });
        }

        function removeActiveClass() {
            let activeElem = document.querySelector(".chat-message.active");
            if (activeElem) {
                activeElem.classList.remove("active");
            }
        }

        // Atualiza a imagem e a informação da doença atual
        function updateDiseaseInfo() {
            if (currentDiseaseIndex < patientData.doencasCronicas.length) {
                let disease = patientData.doencasCronicas[currentDiseaseIndex];
                document.getElementById("disease-image").src = `<?= base_url('assets/uploads/files/'); ?>${disease.foto}`;
                let diseaseMessage = `Iniciando análise da doença: <b>${disease.nome}</b>`;
                displayMessage(diseaseMessage, "bot");
                if (useListen) playAudio(stripHTML(diseaseMessage));
            }
        }

        function displayListeningIndicator() {
            let chat = document.getElementById("chat");
            let listeningIndicator = document.createElement("div");
            listeningIndicator.className = "listening-indicator";
            listeningIndicator.id = "listening-indicator";
            listeningIndicator.innerText = "Estou ouvindo...";
            chat.appendChild(listeningIndicator);
            chat.scrollTop = chat.scrollHeight;
        }

        function removeListeningIndicator() {
            let listeningIndicator = document.getElementById("listening-indicator");
            if (listeningIndicator) {
                listeningIndicator.parentNode.removeChild(listeningIndicator);
            }
        }

        // Function to strip HTML tags from a string
        function stripHTML(html) {
            let doc = new DOMParser().parseFromString(html, 'text/html');
            return doc.body.textContent || "";
        }

        // Function to play audio with a delay to avoid overlapping
        function playAudio(audioString, callback) {
            const audio = new Audio("https://moriarty.com.br/alerta/api/audio?text=" + encodeURIComponent(audioString));
            audio.play();
            audio.onended = () => {
                if (callback) callback();
            };
        }
        
        document.addEventListener("DOMContentLoaded", () => {
    const userInput = document.getElementById("user-input");
    const chatInput = document.querySelector(".chat-input");

    // Expande o campo de texto quando clicado
    userInput.addEventListener("focus", () => {
        userInput.style.width = "calc(100% - 70px)";
        userInput.style.padding = "10px";
    });

    // Contrai o campo de texto quando clicado fora
    document.addEventListener("click", (event) => {
        if (!chatInput.contains(event.target)) {
            userInput.style.width = "50px";
            userInput.style.padding = "5px 10px";
        }
    });
});

    </script>
</body>
</html>
