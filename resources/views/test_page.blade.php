<script src="{{ asset('assets/dashboard/vendor/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/dashboard/vendor/ckeditor/config.js') }}"></script>
<textarea id="user_message"></textarea>

<script>
    /*CKEDITOR.replace('user_message',
        {
            config.toolbarGroups = [
                {name: 'clipboard', groups: ['clipboard', 'undo']},
                {name: 'editing', groups: ['find', 'selection', 'spellchecker', 'editing']},
                {name: 'links', groups: ['links']},
                {name: 'insert', groups: ['insert']},
                {name: 'forms', groups: ['forms']},
                {name: 'tools', groups: ['tools']},
                {name: 'document', groups: ['mode', 'document', 'doctools']},
                {name: 'others', groups: ['others']},
                '/',
                {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
                {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']},
                {name: 'styles', groups: ['styles']},
                {name: 'colors', groups: ['colors']},
                {name: 'about', groups: ['about']}
            ];

    config.removeButtons = 'Underline,Subscript,Superscript,PasteText,PasteFromWord,Scayt,Anchor,Unlink,Image,Table,HorizontalRule,SpecialChar,Maximize,About,RemoveFormat,Strike';
    });*/

</script>
<script type="text/javascript">
    var toolbarGroups = [
        { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
        { name: 'forms', groups: [ 'forms' ] },
        '/',
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
        { name: 'links', groups: [ 'links' ] },
        { name: 'insert', groups: [ 'insert' ] },
        '/',
        { name: 'styles', groups: [ 'styles' ] },
        { name: 'colors', groups: [ 'colors' ] },
        { name: 'tools', groups: [ 'tools' ] },
        { name: 'others', groups: [ 'others' ] }
    ];


    CKEDITOR.replace( 'user_message',{
        toolbar:  [
            { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
            { name: 'editing', items: [ 'Scayt' ] },
            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
            { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
            { name: 'tools', items: [ 'Maximize' ] },
            { name: 'document', items: [ 'Source' ] },
            '/',
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
            { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
            { name: 'styles', items: [ 'Styles', 'Format' ] },
            { name: 'about', items: [ 'About' ] }
        ],
        removeButtons: 'Underline,Subscript,Superscript,PasteText,PasteFromWord,Scayt,Anchor,Unlink,Image,Table,HorizontalRule,SpecialChar,Maximize,About,RemoveFormat,Strike'

    });
</script>
