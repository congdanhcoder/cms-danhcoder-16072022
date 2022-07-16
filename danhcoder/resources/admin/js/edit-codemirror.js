var editor = CodeMirror.fromTextArea(
    document.getElementById('editor'), {
    mode: "xml",
    theme: "dracula",
    lineNumbers: true,
    autoCloseTags: true
}
);