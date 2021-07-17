document.getElementById('input-file').addEventListener('change',function(e){
    let files = e.target.files;
    let show_image = document.getElementById('input-image')
    let reader = new FileReader()
        if (!files.length)
            return;
    reader.onload = (e) => {
        show_image.src = e.target.result;
    }
    reader.readAsDataURL(files[0])
})