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
            if (ele.type == "text" || "email" || "password") {
                if (ele.value !== "") {
                    loopret = true;
                }
            }
            // if input is a radio button
            if (ele.type == "radio") {
                if (ele.checked) {
                    loopret = true;
                }
            }
        finalret = finalret && loopret;
        }
    }

    // allows button submit if finalret is true, else triggers alert
    if (!finalret) {
        alert("Please make sure all required fields are filled out before submitting");
    }
    return finalret;
}