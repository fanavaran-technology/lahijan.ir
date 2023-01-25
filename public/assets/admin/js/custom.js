
// custom image upload
function readUrl(input) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = (e) => {
            let imgData = e.target.result;
            let imgName = input.files[0].name;
            input.setAttribute("data-title", imgName);
            console.log(e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function openCard(element){
    console.log(element);
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

    document.querySelector('input[name=slug]').value = str

}