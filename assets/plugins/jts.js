window.onload = function() {
    function addLink() {
        //Get the selected text and append the extra info
        var selection = window.getSelection(),
            pagelink = '<br /><br /> Sumber : ' + document.location.href,
            copytext = selection + pagelink,
            newdiv = document.createElement('div');

        //hide the newly created container
        newdiv.style.position = 'absolute';
        newdiv.style.background = '#fff';
        newdiv.style.left = '-99999px';

        //insert the container, fill it with the extended text, and define the new selection
        document.body.appendChild(newdiv);
        newdiv.innerHTML = copytext;
        selection.selectAllChildren(newdiv);

        window.setTimeout(function () {
            document.body.removeChild(newdiv);
        }, 100);
    }

    document.addEventListener('copy', addLink);
}
$(function() {
    $('.dropdown-menu').css('width','230px');
});
//
function validate_image_size(file_size, attribut) {    
    if(parseFloat(limit_size) < parseFloat(file_size)){
        alert('Maaf, Ukuran file '+max_upload_size_str);
        $(attribut).val('');
        return false;
    } else {
        return true;
    }
}