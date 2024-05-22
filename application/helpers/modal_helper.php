<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function renderModal($viewPath, $scripts = array(), $buttonText = 'Open Modal', $buttonClasses = 'btn btn-primary', $linkUrl = null, $minModalWidth = '50%', $minModalHeight = '50%', $params = array()) {
    $CI =& get_instance();
    $CI->load->helper('url');

    // Gerar IDs exclusivos para o modal e botão
    $modalId = 'modal_' . uniqid();
    $buttonId = 'modal_button_' . uniqid();
    $closeButtonId = 'modal_close_button_' . uniqid();

    // Gerar classes exclusivas para o modal e botão
    $modalClass = 'modal_' . uniqid();
    $buttonClass = 'modal_button_' . uniqid();
    $modalContentClass = 'modal_content_' . uniqid();
    $modalShowClass = 'modal_show_' . uniqid();
    $modalCloseClass = 'modal_close_' . uniqid();
    $iframeClass = 'modal_iframe_' . uniqid();

    // Carregar o conteúdo da view ou criar o iframe
    if ($linkUrl !== null) {
        $modalContent = '<iframe src="' . $linkUrl . '" frameborder="0" class="' . $iframeClass . '"></iframe>';
    } else {
        $modalContent = $CI->load->view($viewPath, $params, true);
    }

    // Gerar o código HTML completo para o modal
    $modalHtml = '
        <style>
            /* Estilos para o modal */
            .' . $modalClass . ' {
                position: fixed;
                z-index: 9999;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                display: none;
                align-items: center;
                justify-content: center;
            }

            .' . $modalClass . '.' . $modalShowClass . ' {
                display: flex;
            }

            .' . $modalContentClass . ' {
                background-color: #fff;
                padding: 20px;
                border: 1px solid #888;
                min-width: ' . $minModalWidth . ';
                min-height: ' . $minModalHeight . ';
                max-width: 90%;
                max-height: 80%;
                overflow: auto;
                box-sizing: border-box;
            }

            .' . $modalCloseClass . ' {
                position: absolute;
                top: 10px;
                right: 10px;
                font-size: 24px;
                font-weight: bold;
                cursor: pointer;
            }

            .' . $iframeClass . ' {
                width: 100%;
                height: 100%;
                border: none;
            }
        </style>
        <button id="' . $buttonId . '" class="' . $buttonClasses . ' ' . $buttonClass . '">' . $buttonText . '</button>
        <div id="' . $modalId . '" class="' . $modalClass . '">
            <div class="' . $modalContentClass . '">
                <span id="' . $closeButtonId . '" class="' . $modalCloseClass . '">&times;</span>
                ' . $modalContent . '
            </div>
        </div>
        <script>
            (function() {
                var modalId = "' . $modalId . '";
                var modalClass = "' . $modalClass . '";
                var modalShowClass = "' . $modalShowClass . '";
                var modalContentClass = "' . $modalContentClass . '";
                var modalCloseClass = "' . $modalCloseClass . '";
                var closeButtonId = "' . $closeButtonId . '";
                var iframeClass = "' . $iframeClass . '";
                var buttonId = "' . $buttonId . '";

                var showModalFn = function() {
                    var modal = document.getElementById(modalId);
                    var modalContent = modal.querySelector("." + modalContentClass);
                    modal.classList.add(modalShowClass);
                };

                var hideModalFn = function() {
                    var modal = document.getElementById(modalId);
                    modal.classList.remove(modalShowClass);
                };

                var closeButton = document.getElementById(closeButtonId);
                var triggerButton = document.getElementById(buttonId);
                var modal = document.getElementById(modalId);

                closeButton.addEventListener("click", hideModalFn);
                window.addEventListener("click", function(event) {
                    if (event.target === modal) {
                        hideModalFn();
                    }
                });

                triggerButton.addEventListener("click", showModalFn);

                // Ajustar tamanho do modal
                var adjustModalSizeFn = function() {
                    var modalContent = document.querySelector("#" + modalId + " ." + modalContentClass);
                    var windowWidth = window.innerWidth;
                    var windowHeight = window.innerHeight;
                    var modalContentWidth = modalContent.offsetWidth;
                    var modalContentHeight = modalContent.offsetHeight;

                    var minWidthPercent = parseInt("' . $minModalWidth . '", 10);
                    var minHeightPercent = parseInt("' . $minModalHeight . '", 10);
                    var maxWidthPercent = 90;
                    var maxHeightPercent = 80;

                    var modalWidth = Math.min(modalContentWidth, windowWidth * (maxWidthPercent / 100));
                    var modalHeight = Math.min(modalContentHeight, windowHeight * (maxHeightPercent / 100));

                    modalContent.style.width = Math.max(modalWidth, windowWidth * (minWidthPercent / 100)) + "px";
                    modalContent.style.height = Math.max(modalHeight, windowHeight * (minHeightPercent / 100)) + "px";
                };

                window.addEventListener("resize", adjustModalSizeFn);
                adjustModalSizeFn();

                // Carregar scripts adicionais
                var scripts = ' . json_encode($scripts) . ';
                if (Array.isArray(scripts)) {
                    scripts.forEach(function(script) {
                        var scriptElement = document.createElement("script");
                        scriptElement.src = script;
                        scriptElement.id = "script_" + Math.random().toString(36).substr(2, 9);
                        document.body.appendChild(scriptElement);
                    });
                }
            })();
        </script>
    ';

    return $modalHtml;
}
