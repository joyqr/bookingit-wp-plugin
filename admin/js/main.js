(function ($) {
    function copyToClipBoard(event) {
        var text = event.data.text;
        var input = document.createElement('input');

        input.setAttribute('value', text);
        document.body.appendChild(input);
        input.select();

        var result = document.execCommand('copy');
        document.body.removeChild(input);

        return result;
    }

    var copyToClipboardBtn = $('#bi-copy-shortcode');
    var shortcodeInput = $('#bi-shortcode');

    copyToClipboardBtn.on('click', {text: shortcodeInput[0].value}, copyToClipBoard);
}(jQuery));
