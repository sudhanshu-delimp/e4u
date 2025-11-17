/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup','Font','FontSize' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph','maxlength' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		//{ name: 'basicstyles', items: [ 'Font','FontSize','Bold','Italic','Underline','Strike','Subscript','Superscript'] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];

	//config.removeButtons = 'Cut,Copy,Paste,Undo,Redo,Anchor,Underline,Strike,Subscript,Superscript,Unlink,Link,About,Outdent,Indent';

	// Dialog windows are also simplified.
	
	config.removeDialogTabs = 'link:advanced';
	config.format_tags = 'p;h1;h2;pre;div';
	//config.extraPlugins = 'font';

	//config.extraPlugins = 'maxlength';
	
	//config.extraPlugins = ‘wordcount’; 

	// config.wordcount = {

	// 	// Whether or not you want to show the Paragraphs Count
	// 	showParagraphs: false,

	// 	// Whether or not you want to show the Word Count
	// 	showWordCount: true,

	// 	// Whether or not you want to show the Char Count
	// 	showCharCount: true,

	// 	// Whether or not you want to count Spaces as Chars
	// 	countSpacesAsChars: false,

	// 	// Whether or not to include Html chars in the Char Count
	// 	countHTML: false,

	// 	// Whether or not to include Line Breaks in the Char Count
	// 	countLineBreaks: false,

	// 	// Maximum allowed Word Count, -1 is default for unlimited
	// 	// NOTE - This is where you configure Max Word Count
	// 	maxWordCount: -1,

	// 	// Maximum allowed Char Count, -1 is default for unlimited
	// 	maxCharCount: 20,

	// 	// Maximum allowed Paragraphs Count, -1 is default for unlimited
	// 	maxParagraphs: 1,

	// 	// How long to show the 'paste' warning, 0 is default for not auto-closing the notification
	// 	pasteWarningDuration: 0,


	// 	// Add filter to add or remove element before counting (see CKEDITOR.htmlParser.filter), Default value : null (no filter)
	// 	filter: new CKEDITOR.htmlParser.filter({
	// 		elements: {
	// 			div: function( element ) {
	// 				if(element.attributes.class == 'mediaembed') {
	// 					return false;
	// 				}
	// 			}
	// 		}
	// 	})
	// };

};



