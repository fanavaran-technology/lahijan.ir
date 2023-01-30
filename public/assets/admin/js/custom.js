
// custom image upload
function readUrl(input) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = (e) => {
            let imgData = e.target.result;
            let imgName = input.files[0].name;
            input.setAttribute("data-title", imgName);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function openCard(element){
    cardBody = element.nextElementSibling;

    icon = element.querySelector('.card-dropdown-button');

    if (icon.classList.contains('caret-up')) {
        icon.style.transform = "rotate(360deg)"
        icon.classList.remove('caret-up')
        cardBody.classList.add('d-none')
    }
    else {
        icon.style.transform = "rotate(-180deg)"
        icon.classList.add('caret-up')
        cardBody.classList.remove('d-none')
    }
}

function copyToSlug(element) {
    let str = element.value.replace(/[^a-z0-9ا-ی]+/g, '-');
    str = str.replace(/^-+|-+$/g, '');

    document.querySelector('.slug-box').innerHTML= str
}

function renderEditor(key)
{
    let editor_config = {
        path_absolute : "/",
        selector: key,
        relative_urls: false,
        file_picker_types: 'file image media',
        plugins: 'link directionality image code table fullscreen',
        language : 'fa' ,
        toolbar: [
            {name: 'styles', items: [ 'styleselect' ]},
            {name: 'formatting', items: [ 'bold', 'italic','underline']},
            {name: 'alignment', items: [ 'alignright', 'aligncenter', 'alignleft', 'alignjustify' , "format"  ,"link" ]},
            {name: 'indentation', items: [ 'outdent', 'indent' ]},
            {name: 'image' , items: ['image']},
            {name: 'table' , items: ['table']},
            {name: 'direction', items: [ 'rtl', 'ltr' ]},
            {name: 'history', items: [ 'undo', 'redo' ]},
            {name: 'fullscreen', items: [ "fullscreen" ]},
        ],
        file_picker_callback : function(callback, value, meta) {
          let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
          let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
    
          let cmsURL = editor_config.path_absolute + 'filemanager?editor=' + meta.fieldname;
          if (meta.filetype == 'image') {
            cmsURL = cmsURL + "&type=Images";
          } else {
            cmsURL = cmsURL + "&type=Files";
          }
    
          tinyMCE.activeEditor.windowManager.openUrl({
            url : cmsURL,
            title : 'انتخاب فایل',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no",
            onMessage: (api, message) => {
              callback(message.content);
            }
          });
        }
      };
    
    tinymce.init(editor_config);
}

function successToast(message) {
  console.log('hi');
    new Notify({
      status: 'success',
      title: 'موفقیت آمیز ',
      text: message,
      effect: 'slide',
      speed: 300,
      customClass: null,
      customIcon: null,
      showIcon: true,
      showCloseButton: true,
      autoclose: true,
      autotimeout: 3000,
      gap: 20,
      speed: 700,
      distance: 20,
      type: 1,
      position: 'left top'
  })
} 