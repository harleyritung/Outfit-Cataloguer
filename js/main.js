// Displays image after using file input
const image_input = document.querySelector("#image_input");
image_input.addEventListener("change", function() {
   const reader = new FileReader();
   reader.addEventListener("load", () => {
     const uploaded_image = reader.result;
     // alert if img larger than 2mb
     if (this.files[0].size > 2097152) {
        alert("Error: Uploaded image cannot be greater than 2MB. Please select another image.");
    }
    // else display img
    else {
     document.querySelector("#display_image").style.backgroundImage = `url(${uploaded_image})`;
    }
});
   reader.readAsDataURL(this.files[0]);
});

// check all required fields have been filled out
function validate() {
    var loopret = false;
    var finalret = true;
    var eles;
    for (var i=0; i<arguments.length; i++) {
        // get all elements in arguments
        eles = document.querySelectorAll('input[name='+arguments[i]+']');
        loopret = false;
        for (var ele of eles) {
            // if input is type text
            if (ele.type == "text") {
                if (ele.value !== "") {
                    loopret = true;
                }
            }
            // if input is a radio button
            if (ele.type == "radio")
                if (ele.checked) {
                    loopret = true;
                }
            }
        finalret = finalret && loopret;
    }

    // allows button submit if finalret is true, else triggers alert
    if (!finalret) {
        alert("Please make sure all required fields are filled out before submitting");
    }
    return finalret;
}