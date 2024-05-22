<script>
    (function() {
        var modal = document.getElementById("<?= $modalId ?>");
        var closeButton = modal.querySelector(".modal-close");
        var triggerButtons = document.querySelectorAll('[data-modal-id="<?= $modalId ?>"]');

        function showModal() {
            modal.classList.add("modal-show");
        }

        function hideModal() {
            modal.classList.remove("modal-show");
        }

        closeButton.addEventListener("click", hideModal);
        window.addEventListener("click", function(event) {
            if (event.target === modal) {
                hideModal();
            }
        });

        triggerButtons.forEach(function(button) {
            button.addEventListener("click", showModal);
        });
    })();
</script>