function addtoform() {
    document.getElementById("dynamic_number").stepUp(1);
    var inc = document.getElementById("mylocation").childElementCount + 1;
    // if (inc == 1) {
    //     var node1 = document.createElement("div");
    //     node1.innerHTML = "<div class='form-group'><div class='row'><div class='col'><label for='attach_model'>Upload Test Attachment</label></div><div class='col'><input type='file' class='form-control-file' id='file3' name='file3'></div></div></div>";
    //     document.getElementById("mylocation").appendChild(node1);
    // }
    var node2 = document.createElement("div");
    node2.innerHTML =
        "<div><div class='form-label-group'><input type='text' id='input" + inc +
        "' name='input" + inc +
        "' class='form-control' placeholder='Input'><label for='input" + inc +
        "'>Input</label></div><div class='form-label-group'><input type='text' id='output" +
        inc + "' name='output" +
        inc + "' class='form-control' placeholder='Output'><label for='output" +
        inc +
        "'>Output</label></div><div class='custom-control custom-switch'> <input type='checkbox' class='custom-control-input' id='switch" +
        inc + "' name='switch" + inc + "'> <label class='custom-control-label' for='switch" +
        inc + "'>Hide Input&amp;Output</label></div><hr><div>";
    document.getElementById("mylocation").appendChild(node2);
}

function addtoform2() {
    document.getElementById("feature_number").stepUp(1);
    var inc2 = document.getElementById("mylocation2").childElementCount + 1;
    var node2 = document.createElement("div");

    node2.innerHTML =
        "<div class='form-group'><label for='input-select" +
        inc2 + "'>Choose Type</label><select id='input-select" + inc2 + "' name='input-select" +
        inc2 + "' class='form-control'><option value='if'>if statment</option><option value='if-else'>if --else</option><option value='elseif'>elseif</option><option value='switch'>switch</option><option value='while'>while</option></select></div><div class='form-group'> <label for='textarea" +
        inc2 + "'>Regular Expretions</label><textarea class='form-control' id='textarea" + inc2 + "' name='textarea" + inc2 + "' rows='3'></textarea></div><hr>";
    document.getElementById("mylocation2").appendChild(node2);
}