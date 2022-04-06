// Displays image after using file input
const image_input = document.querySelector("#image_input");
image_input.addEventListener("change", function() {
   const reader = new FileReader();
   reader.addEventListener("load", () => {
     const uploaded_image = reader.result;
     document.querySelector("#display_image").style.backgroundImage = `url(${uploaded_image})`;
});
   reader.readAsDataURL(this.files[0]);
});

function validate() {
    var loopret = false;
    var finalret = true;
    var eles;
    for (var i=0; i<arguments.length; i++) {
        eles = document.querySelectorAll('input[name='+arguments[i]+']');
        loopret = false;
        for (var ele of eles) {
            console.log(ele.type);
            if (ele.type == "text") {
                console.log("hi");
                console.log(ele.value);
                if (ele.value !== "") {
                    loopret = true;
                }
            }
            if (ele.type == "radio")
                if (ele.checked) {
                    loopret = true;
                }
            }
        finalret = finalret && loopret;
    }
    if (!finalret) {
        alert("Please make sure all required fields are filled out before submitting");
    }
    return finalret;
}