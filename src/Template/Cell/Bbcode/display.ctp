<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    editor = CKEDITOR.replace( 'editor1' );
    editor.addCommand("mySimpleCommand", { // create named command
    exec: function(edt) {
        alert(edt.getData());
    }
});

editor.ui.addButton('SuperButton', { // add new button and bind our command
    label: "Click me",
    command: 'mySimpleCommand',
    toolbar: 'insert',
    icon: 'https://avatars1.githubusercontent.com/u/5500999?v=2&s=16'
});
</script>
