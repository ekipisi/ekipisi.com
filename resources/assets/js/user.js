// Most options demonstrate the non-default behavior
var simplemde = new SimpleMDE({
    element: document.getElementById("simplemde"),
    hideIcons: ["guide", "fullscreen", "side-by-side", "preview"],
    parsingConfig: {
        allowAtxHeaderWithoutSpace: true,
        strikethrough: false,
        underscoresBreakWords: true,
    },
    promptURLs: true,
    spellChecker: false,
    tabSize: 4,
    //toolbar: ["bold", "italic", "heading", "|", "quote"],
});

$('input[name="fielduploader"]').fileuploader({
    addMore: true
});