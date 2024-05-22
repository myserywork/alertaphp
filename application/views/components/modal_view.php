<style>
/* Estilos para o botão */
#openModalButton {
    padding: 10px 20px;
}

/* Estilos para o modal */
#modalContainer {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    justify-content: center;
    align-items: center;
}

#modalCloseButton {
    align-self: flex-end;
    margin: 10px;
    padding: 5px 10px;
    background-color: #ddd;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

#modalContent {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    border: none;
}

#modalFrame {
    width: 100%;
    height: 100%;
    border: none;
}
</style>

<script>
function openModal(url, width, height) {
    var modalContainer = document.getElementById("modalContainer");
    var modalContent = document.getElementById("modalContent");
    var modalFrame = document.getElementById("modalFrame");
    modalFrame.src = url;
    modalContainer.style.display = "flex";
    modalContent.style.display = "block";
    modalContent.style.width = width;
    modalContent.style.height = height;
}

function closeModal() {
    var modalContainer = document.getElementById("modalContainer");
    var modalContent = document.getElementById("modalContent");
    var modalFrame = document.getElementById("modalFrame");
    modalFrame.src = "";
    modalContainer.style.display = "none";
    modalContent.style.display = "none";
    modalContent.style.width = "100%";
    modalContent.style.height = "100%";
}
</script>

<div id="modalContainer">
    <div id="modalContent">
        <button id="modalCloseButton" onclick="closeModal()">Fechar</button>
        <iframe id="modalFrame" frameborder="0"></iframe>
    </div>
</div>