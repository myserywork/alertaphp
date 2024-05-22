<button id="installButton" style="display: ;">Instalar</button>

<!-- Registro do Service Worker -->
<script>
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
      navigator.serviceWorker.register('<?= base_url("assets/service-worker.js"); ?>').then((registration) => {
        console.log('Service Worker registrado com sucesso:', registration);

        // Exibir o botão de instalação quando o Service Worker estiver pronto
        if (registration.installing || registration.waiting || registration.active) {
          document.getElementById('installButton').style.display = 'block';
        }

        // Verificar se o Service Worker está instalado ou pronto para instalar
        if (registration.waiting) {
          handleServiceWorkerStateChange(registration.waiting);
        }
        registration.addEventListener('updatefound', () => {
          handleServiceWorkerStateChange(registration.installing);
        });
      }).catch((error) => {
        console.log('Falha ao registrar o Service Worker:', error);
      });
    });
  }

  // Função para lidar com as mudanças de estado do Service Worker
  function handleServiceWorkerStateChange(worker) {
    worker.addEventListener('statechange', () => {
      if (worker.state === 'installed') {
        // Exibir o botão de instalação quando o Service Worker estiver instalado
        document.getElementById('installButton').style.display = 'block';
      }
    });
  }

  // Função para instalar o Service Worker
  function installServiceWorker() {
    if ('serviceWorker' in navigator && navigator.serviceWorker.controller) {
      navigator.serviceWorker.controller.postMessage({ action: 'skipWaiting' });
    }
  }
</script>