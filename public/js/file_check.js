
var fileOK = false;

// https://medium.com/the-everyday-developer/detect-file-mime-type-using-magic-numbers-and-javascript-16bc513d4e1e 
// using a const would mess up the javascript if it is being reloaded and redeclared
var MyFileSelector = document.getElementById('file-selector')
MyFileSelector.addEventListener('change', (event) => {
    const file = event.target.files[0]
    const filereader = new FileReader()
    
    filereader.onloadend = function(evt) {
        if (evt.target.readyState === FileReader.DONE) {
            const uint = new Uint8Array(evt.target.result)
            let bytes = []
            uint.forEach((byte) => {bytes.push(byte.toString(16))})
            const hex = bytes.join('').toUpperCase()
            var extension = file.type ? true : false
            // Decide if the files are accepted
            var acceptedTypes = $("#file-selector").data("types").split(",");
            // https://api.jquery.com/jquery.inarray/
            var accepted = $.inArray(hex, acceptedTypes)
            var magicNumber = (accepted > -1) ? true : false
            if (extension){
                if (magicNumber){
                    $("#file-description").html("File type is OK")
                    $("#file-description").css("color", "green")
                    fileOK = true
                }
                else{
                    $("#file-description").html("Please upload a suitable file!")
                    $("#file-description").css("color", "red")
                    fileOK = false
                }
            }
            else{
                $("#file-description").html("File has no extension!")
                $("#file-description").css("color", "red")
                fileOK = false
            }
        }
    }

    const blob = file.slice(0, 4);
    filereader.readAsArrayBuffer(blob);
})