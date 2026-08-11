const mmRoot = $('#manage-route');
const endpoint = {
    csrf_token: mmRoot.data('csrf-token'),
    success_image: mmRoot.data('success-info'),
    error_image: mmRoot.data('error-warning'),
    stagename_store: mmRoot.data('stagename-store'),
    stagename_delete: mmRoot.data('stagename-delete'),
    stage_names: mmRoot.data('stage-names'),
    additional_store: mmRoot.data('additional-store'),
    additional_delete: mmRoot.data('additional-delete'),
    address: mmRoot.data('address') || [],
    title: mmRoot.data('title') || [],
    narrations: mmRoot.data('narrations') || [],
    update_default_additional: mmRoot.data('update-default-additional'),
};





$(function () {

const defaultEscortName = endpoint.stage_names?.default_escort_name || '';
const stageNames = endpoint.stage_names?.escorts_names;
console.log(endpoint.stage_names, 'stageNames....');




    const modules = {

        stageName: {
            listId: '#stageNameList',
            inputId: '#stage_name',
            sortRadio: 'sortedByStageNames',
            saveBtn: '.save_stage_name_button',
            deleteClass: '.delete_stage_name',
            storeUrl: endpoint.stagename_store,
            deleteUrl: endpoint.stagename_delete,
            extraData: { type: 'name' },
            updateDefaultUrl: endpoint.update_default_additional,
               data: stageNames && stageNames.length > 0 ? stageNames.map(item => ({
                id: null,
                value: item,
                is_default: item === defaultEscortName ? 1 : 0
            })) : [],
        },
        address: {
            listId: '#stageAddress',
            inputId: '#st_address',
            sortRadio: 'sortedByStageAddress',
            saveBtn: '.save_address_button',
            deleteClass: '.delete_address',
            storeUrl: endpoint.additional_store,
            deleteUrl: endpoint.additional_delete,
            extraData: { type: 'address' },
            updateDefaultUrl: endpoint.update_default_additional,
            data: Object.values(endpoint.address || {}).map(item => {
                return {
                    id: item.id,
                    value: item.short_desc,
                    is_default: item.make_default || 0
                };

            }),
            isTextarea: false
        },
        title: {
            listId: '#stageTitleList',
            inputId: '#who_title',
            sortRadio: 'sortedByStageTitle',
            saveBtn: '.save_title_button',
            deleteClass: '.delete_title',
            storeUrl: endpoint.additional_store,
            deleteUrl: endpoint.additional_delete,
            updateDefaultUrl: endpoint.update_default_additional,
            extraData: { type: 'title' },
            data: Object.values(endpoint.title || {}).map(item => {
                return {
                    id: item.id,
                    value: item.short_desc,
                    is_default: item.make_default || 0
                };

            }),
            isTextarea: false
        },
        narration: {
            listId: '#stageNarration',
            inputId: '#who_narration_textarea',
            sortRadio: 'sortedByNarration',
            saveBtn: '.save_narration_button',
            deleteClass: '.delete_narration',
            storeUrl: endpoint.additional_store,
            deleteUrl: endpoint.additional_delete,
            extraData: { type: 'narration' },
            updateDefaultUrl: endpoint.update_default_additional,
            data: Object.values(endpoint.narrations || {}).map(item => {
                return {
                    id: item.id,
                    value: item.short_desc,
                    is_default: item.make_default || 0
                };

            }),
            isTextarea: false, // this is textarea 
            isCkeditor: true,
        }
    }

   // console.log(endpoint.stage_names.escorts_names, 'endpoint.narrations....');



    function stageCard(item, deleteClass) {
        const value = item?.value || '';
        return `
        <li class="stage-card ${item.is_default == 1 ? 'default-card' : ''}" data-id="${item.id}">
            <a href="javascript:void(0)">${value}</a>
            <div class="close ml-2 text-white stage-close">
                <span aria-hidden="true" class="${deleteClass.replace('.', '')}"  data-id="${item.id}"  data-name="${item.value}"> × </span>
                
            </div>
            <div class="hover-action">
                <button type="button" class="default-toggle-btn" data-id="${item.id}" data-type="${deleteClass}" data-value="${item.value}"> ${item.is_default == 1 ? 'Remove from Default' : 'Add to Default'} </button>
            </div>
            <span class="make_default">${item.is_default == 1 ? '<span>Default</span>' : ''}</span>
        </li>
    `;
    }




    //Short
    function getSortedNames(names, sortType) {
        let sorted = [...names];
        if (sortType == 'alalphabetically') {
            sorted.sort((a, b) =>
                a.value.localeCompare(b.value)
            );
        } else if (sortType == 'random') {
            for (let i = sorted.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [sorted[i], sorted[j]] =
                    [sorted[j], sorted[i]];
            }
        }

        return sorted;
    }

    function renderList(mod) {
        const sortType = $(`input[name="${mod.sortRadio}"]:checked`).val();
        const ul = $(mod.listId);
        ul.empty();
        getSortedNames(mod.data, sortType).forEach(function (item) {
            ul.append(stageCard(item, mod.deleteClass));
        });
    }

    //init
    Object.values(modules).forEach(mod => renderList(mod));



    //SORT RADIO CHANGE 
    Object.values(modules).forEach(function (mod) {
        $(`input[name="${mod.sortRadio}"]`).on('change', function () {
            renderList(mod);
        });
    });



    // GENERIC SAVE 💫

    function initSave(mod) {
        $(document).on('click', mod.saveBtn, function () {

            const $input = $(mod.inputId);
            const $error = $input.next('.error-message');


            $error.text('');
            $input.removeClass('is-invalid');



            let value = '';
            if (mod.isCkeditor) {
                const editorInstance = CKEDITOR.instances[mod.inputId.replace('#', '')];
                value = editorInstance ? editorInstance.getData().trim() : '';

                const plainText = value.replace(/<[^>]*>/g, '').trim();
                if (!plainText) {
                    //showAlert('warning', 'Warning', 'Please enter a value.');
                    $('#who_narration_textarea-error').text('Please enter a value.');
                    return;
                }

            } else {
                value = $(mod.inputId).val().trim();
                if (!value) {
                    //showAlert('warning', 'Warning', 'Please enter a value.');
                    $error.text('Please enter a value.');
                    $input.addClass('is-invalid');
                   // $('#emojiBtn').addClass('is-invalid');

                    return;
                }
            }

            if (!value) {
                showAlert('warning', 'Warning', 'Please enter a value.');
            }

            $.ajax({
                url: mod.storeUrl,
                method: 'POST',
                dataType: 'json',
                data: Object.assign({
                    _token: endpoint.csrf_token,
                    value: value,
                    type: mod.extraData.type
                }, mod.extraData),
                success: function (res) {
                    if (res.status == true) {
                        mod.data.push({
                            id: res.id,
                            value: getShortDesc(value),
                            is_default: 0
                        });
                      
                        renderList(mod);
                        $(mod.inputId).val('');
                        CKEDITOR.instances['who_narration_textarea'].setData('');
                        showAlert('success', 'Saved', 'Added successfully!');
                    } else {
                        showAlert('error', 'Error', res.message || 'Something went wrong.');
                    }

                },
                error: function (xhr) {
                    showAlert('error', 'Error', getErrorMsg(xhr));
                }
            });
        });
    }



    // GENERIC DELETE
    function initDelete(mod) {
        $(document).on('click', mod.deleteClass, function () {
            const name = $(this).data('name');
            const $liElem = $(this).closest('li');
            $.ajax({
                url: mod.deleteUrl,
                method: 'POST',
                dataType: 'json',
                data: Object.assign({
                    _token: endpoint.csrf_token,
                    data: name,
                    type: mod.extraData.type

                }),
                success: function (res) {
                    if (res.status == true) {
                        mod.data = mod.data.filter(n => n != name);
                        $liElem.remove();
                        showAlert('success', 'Removed', 'Removed successfully!');
                    } else {
                        showAlert('error', 'Error', res.message || 'Something went wrong.');
                    }
                },
                error: function (xhr) {
                    showAlert('error', 'Error', getErrorMsg(xhr));
                }
            });


        });
    }

    // for all save/delete
    Object.values(modules).forEach(function (mod) {
        initSave(mod);
        initDelete(mod);
        initDefault(mod);
    });

    //for error message
    function getErrorMsg(xhr) {
        try {
            var json = xhr.responseJSON || JSON.parse(xhr.responseText);
            return (json && json.message) ? json.message : 'Something went wrong.';
        } catch (e) {
            return 'Something went wrong.';
        }
    }
    
    function getShortDesc(value) {
        // Check if value contains HTML tags
        const hasHtml = /<[^>]*>/g.test(value);
        if (hasHtml) {
            let plainText = value.replace(/<[^>]*>/g, '');
            // remove extra spaces/new lines/tabs
            plainText = plainText.replace(/\s+/g, ' ').trim();
            return plainText.split(' ').slice(0, 5).join(' ');
        }
        // Plain text condition
        return value.split(' ').slice(0, 5).join(' ');
    }

    initCkEditor('who_narration_textarea');

    function initCkEditor(textarea, charLimit = 2500) {
        // Remove # if passed
        textarea = textarea.replace('#', '');

        // Destroy old instance if exists
        if (CKEDITOR.instances[textarea]) {
            CKEDITOR.instances[textarea].destroy(true);
        }

        // Create editor
        let editor = CKEDITOR.replace(textarea, {

            extraPlugins: 'emoji',

            toolbarGroups: [
                { name: 'clipboard', groups: ['clipboard', 'undo'] },
                { name: 'editing', groups: ['find', 'selection'] },
                { name: 'links', groups: ['links'] },
                { name: 'insert', groups: ['insert'] },
                { name: 'tools', groups: ['tools'] },
                { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
                { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align'] },
                { name: 'styles', groups: ['styles'] },
                { name: 'colors', groups: ['colors'] }
            ],

            removeButtons:
                'Underline,Subscript,Superscript,PasteText,PasteFromWord,' +
                'Anchor,Unlink,Image,Table,HorizontalRule,SpecialChar,' +
                'Maximize,About,RemoveFormat,Strike'
        });

        // Allowed keys
        const allowedKeys = [8, 46, 37, 38, 39, 40];

        // Character limit on typing
        editor.on('key', function (event) {

            let content = editor.getData().replace(/<[^>]*>/g, '');
            let keyCode = event.data.keyCode;

            if (content.length >= charLimit &&
                !allowedKeys.includes(keyCode)) {

                event.cancel();
            }
        });

        // Character limit on paste
        editor.on('paste', function (event) {

            let content = editor.getData().replace(/<[^>]*>/g, '');

            if (content.length >= charLimit) {
                event.cancel();
            }
        });

        return editor;
    }

    // Open / Close Picker
    $('#emojiBtn').on('click', function (e) {

        e.stopPropagation();

        $('#emojiPicker').toggle();

    });

    // Add Emoji
    document.querySelector('#emojiPicker')
        .addEventListener('emoji-click', event => {

            let emoji = event.detail.unicode;

            $('#who_title').val(
                $('#who_title').val() + emoji
            );

            $('#who_title').focus();

        });

    // Close Outside Click
    $(document).on('click', function (e) {

        if (!$(e.target).closest('#emojiPicker, #emojiBtn').length) {

            $('#emojiPicker').hide();

        }

    });


    function initDefault(mod) {

        $(document).on('click', `${mod.listId} .default-toggle-btn`, function () {

            let button = $(this);
            let card = button.closest('.stage-card');
            let id = button.data('id');
            let type = button.data('type');
            let value = button.data('value');

            let alreadyDefault = card.hasClass('default-card');

            // Reset all cards
            $(mod.listId)
                .find('.stage-card')
                .removeClass('default-card');

            $(mod.listId)
                .find('.default-toggle-btn')
                .text('Add to Default');

            $(mod.listId)
                .find('.make_default')
                .html('');

            // Set selected card as default
            if (!alreadyDefault) {
                card.addClass('default-card');
                button.text('Remove from Default');

                card.find('.make_default')
                    .html('<span>Default</span>');
            }

            // Update local data
            mod.data.forEach(item => {
                item.is_default = 0;

                if (item.id == id && !alreadyDefault) {
                    item.is_default = 1;
                }
            });

            $.ajax({
                url: mod.updateDefaultUrl,
                method: 'POST',
                data: {
                    _token: endpoint.csrf_token,
                    id: id,
                    type: type,
                    alreadyDefault: alreadyDefault,
                    value: value
                },
                success: function (res) {
                    console.log(res);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });

        });

    }

});