tinymce.init({
    selector:'textarea',
    height: 500,
    plugins: [
    'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
    'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
    'table emoticons template paste help codesample'
    ],

    image_title : true,
    automatic_uploads: true,
    images_upload_url : 'upload/post-image',
    file_picker_types: 'image',

    file_picker_callback: function (cv, value, meta){
    let input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/!*');
    input.onchange = function(){
    let file = this.files[0];
    let reader = new FileReader();
    reader.readAsDataURL(file);
    render.onload = function(){
    let id = 'blobid'+(new Date()).getTime();
    let blobCache = tinymce.activeEditor.editorUpload.blobCache;
    let base64 = reader.result.split(',')[1];
    let blobInfo = blobCache.create(id, file, base64);
    blobCache.add(blobInfo);
    cb(blobInfo.blobUri(), {title:file.name});
};
};
    input.click();
},
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
    'bullist numlist outdent indent | link image | print preview media fullpage | ' +
    'forecolor backcolor emoticons | help | codesample',
    menu: {
    favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | spellchecker | emoticons'}
},
    menubar: 'favs file edit view insert format tools table help'
});
    tinymce.activeEditor.execCommand('mceCodeEditor');
