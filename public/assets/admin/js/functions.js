function initFileInput(selector, options)
{
    FilePond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginFileValidateType,
        FilePondPluginImageCrop,
    );
    const upload_input = document.querySelector(selector);
    const pond = FilePond.create(upload_input ,options);

    pond.setOptions(fa_IR)

    document.querySelector('.filepond--credits').remove()
}