<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de RPM Hospitalar</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for progress bars */
        .progress-bar {
            height: 10px;
            background-color: #ff5e5e;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background-color: #ff2d2d;
            border-radius: 5px;
            animation: progress-grow 2s ease-in-out forwards;
        }

        @keyframes progress-grow {
            0% {
                width: 0;
            }

            100% {
                width: 100%;
            }
        }

        /* Custom CSS for flashing red */
        .flashing-red {
            animation: flashing-red 1s ease-in-out infinite alternate;
        }

        @keyframes flashing-red {
            0% {
                background-color: #ff2d2d;
            }

            100% {
                background-color: #ff0000;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <header class="bg-white p-4 shadow-md">
        <div class="container mx-auto">
            <h1 class="text-3xl font-semibold text-green-700">Painel de RPM Hospitalar</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto mt-6 p-4">
        <!-- Start Button -->
        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg mb-4" style="display: none;"
            onclick="startAlerts()">
            Iniciar Alertas
        </button>

        <!-- Alert Container -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4"
            id="alertContainer">
            <!-- Alert Cards Will Be Displayed Here -->
        </div>
    </main>

    <!-- SweetAlert Modal Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Include Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Function to determine the background color based on risk level
        $(document).ready(function () {
            startAlerts();
        });

        function getBackgroundColor(risk) {
            if (risk >= 0 && risk <= 20) {
                return 'bg-green-100';
            } else if (risk >= 21 && risk <= 40) {
                return 'bg-yellow-100';
            } else if (risk >= 41 && risk <= 80) {
                return 'bg-red-100';
            } else if (risk >= 81 && risk <= 90) {
                return 'bg-red-100 flashing-red';
            } else {
                return 'bg-gray-100';
            }
        }

        // Function to describe the risk level
        function getRiskDescription(risk) {
            if (risk >= 0 && risk <= 20) {
                return 'Baixo Risco';
            } else if (risk >= 21 && risk <= 40) {
                return 'Médio Risco';
            } else if (risk >= 41 && risk <= 80) {
                return 'Alto Risco';
            } else if (risk >= 81 && risk <= 90) {
                return 'Risco Recorrente';
            } else {
                return 'N/A';
            }
        }

        // Function to open the SweetAlert modal for "Ir até o perfil"
        function openProfileModal(name) {
            Swal.fire({
                title: 'Plataforma de Demonstração',
                text: 'Funcionalidade desativada',
                icon: 'info',
                confirmButtonText: 'OK',
            });
        }

        // Function to play the alert sound
        function playAlertSound() {
            const alertSound = new Audio('https://beta.ifepbr.org.br/ring.mp3');
            alertSound.play();
        }

        // Function to add a new alert card
        function addAlertCard(type, location, message, age, comorbidities, risk, name, comorbidityGroup) {
            const alertContainer = document.getElementById('alertContainer');

            // Determine the background color based on risk level
            const backgroundColor = getBackgroundColor(risk);

            // Create a new alert card element
            const alertCard = document.createElement('div');
            alertCard.classList.add(backgroundColor, 'p-4', 'rounded-lg', 'shadow-md');

            // Map comorbidity groups to corresponding flags
            const comorbidityFlags = {
                'Cardiovascular': '❤️',
                'Respiratório': '🌬️',
                'Metabólico': '🩺',
                'Outros': '🚑',
            };

            // Get the risk description
            const riskDescription = getRiskDescription(risk);

            // Calculate the width for the progress bar
            const progressWidth = `${risk}%`;

            // Build the HTML for the new card
            alertCard.innerHTML = `
                <h2 class="text-lg font-semibold mb-2">${type}</h2>
                <p class="text-gray-600 text-xs mb-2">Localização: ${location}</p>
                <p class="text-gray-900 font-bold text-sm">${message}</p>
                <!-- Progress Bar for Risk -->
                <div class="mt-4 relative pt-1">
                    <div class="flex mb-2 items-center justify-between">
                        <div>
                            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full ${backgroundColor.replace('bg-', 'text')} text-white">
                                ${riskDescription}
                            </span>
                        </div>
                        <div class="text-right">
                            <span class="text-xs font-semibold inline-block ${backgroundColor.replace('bg-', 'text-')}">${risk}%</span>
                        </div>
                    </div>
                    <div class="relative pt-1">
                        <div class="flex mb-2 items-center justify-between">
                            <div class="text-sm">
                                <span class="font-semibold">Progresso:</span> ${risk}%
                            </div>
                        </div>
                        <div class="progress-bar">
                            <div class="progress" style="width:${progressWidth}"></div>
                        </div>
                    </div>
                </div>
                <!-- End Progress Bar for Risk -->
                <div class="mt-4 text-sm">
                    <p><span class="font-semibold">Nome do Paciente:</span> ${name}</p>
                    <p><span class="font-semibold">Idade:</span> ${age} anos</p>
                    <p><span class="font-semibold">Comorbidades:</span> ${comorbidities}</p>
                    <p><span class="font-semibold">Grupo de Comorbidade:</span> ${comorbidityGroup} ${comorbidityFlags[comorbidityGroup]}</p>
                </div>
                <div class="mt-2 flex justify-between items-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-sm text-xs" onclick="openProfileModal('${name}')">
                        <i class="fas fa-user"></i>
                    </button>
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded-sm text-xs" onclick="playAlertSound()">
                        <i class="fas fa-phone"></i>
                    </button>
                    <button class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-1 px-2 rounded-sm text-xs" onclick="followLocation()">
                        Seguir
                    </button>
                </div>
            `;

            // Add the new card to the container
            alertContainer.appendChild(alertCard);

            // Play the alert sound
            playAlertSound();
        }

        // Function to generate random alert data
        function generateRandomAlert() {
            const alertTypes = ['Alto Risco', 'Médio Risco', 'Risco Recorrente'];
            const locations = ['Quarto', 'Sala de Estar', 'Cozinha', 'Banheiro', 'Área Externa'];
            const comorbidityGroups = ['Cardiovascular', 'Respiratório', 'Metabólico', 'Outros'];

            const alert = {
                'type': alertTypes[Math.floor(Math.random() * alertTypes.length)],
                'location': locations[Math.floor(Math.random() * locations.length)],
                'message': generateRandomMessage(),
                'age': Math.floor(Math.random() * (80 - 30 + 1)) + 30, // Random age between 30 and 80
                'comorbidities': (Math.random() < 0.5) ? 'Sim' : 'Não', // Randomly assign comorbidities
                'risk': Math.floor(Math.random() * 101), // Random risk level between 0 and 100
                'name': generateRandomName(),
                'comorbidityGroup': comorbidityGroups[Math.floor(Math.random() * comorbidityGroups.length)]
            };

            return alert;
        }

        // Function to generate random alert messages
        function generateRandomMessage() {
            const messages = [
                'Pressão arterial acima do limite.',
                'Batimento cardíaco irregular detectado.',
                'Nível de oxigênio abaixo do normal.',
                'Lembrete para realizar o check-up.',
                'Lembrete para tomar medicamentos.',
                'Frequência respiratória anormal detectada.',
                'Temperatura corporal acima do normal.',
                'Atividade física detectada.',
            ];

            return messages[Math.floor(Math.random() * messages.length)];
        }

        // Function to generate random patient name
        function generateRandomName() {
            const names = [
                'Maria da Silva',
                'José Santos',
                'Ana Pereira',
                'João Oliveira',
                'Beatriz Souza',
                'Pedro Costa',
                'Carla Rodrigues',
                'Antônio Almeida',
                'Isabel Pereira',
                'Manuel Silva',
            ];

            return names[Math.floor(Math.random() * names.length)];
        }

        // Function to follow the location
        function followLocation() {
            Swal.fire({
                title: 'Seguir Localização',
                text: 'Funcionalidade desativada (modo de demonstração)',
                icon: 'info',
                confirmButtonText: 'OK',
            });
        }

        // Start the alerts when the button is clicked
        function startAlerts() {
            // Add a new alert every 5 seconds
            setInterval(() => {
                const newAlert = generateRandomAlert();
                addAlertCard(
                    newAlert.type,
                    newAlert.location,
                    newAlert.message,
                    newAlert.age,
                    newAlert.comorbidities,
                    newAlert.risk,
                    newAlert.name,
                    newAlert.comorbidityGroup
                );
            }, 4000);
        }
    </script>
</body>

</html>
