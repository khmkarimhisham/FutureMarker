function addtoform() {
    document.getElementById("dynamic_number").stepUp(1);
    var inc = document.getElementById("mylocation").childElementCount + 1;

    var node1 = document.createElement("div");
    node1.innerHTML =
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
    document.getElementById("mylocation").appendChild(node1);
}

function addtoform2() {
    document.getElementById("feature_number").stepUp(1);
    var inc2 = document.getElementById("mylocation2").childElementCount + 1;
    var node2 = document.createElement("div");

    node2.innerHTML =
        "<div class='form-group'>" +
        "<div class='row'>" +
        "<div class='col'>" +
        "<label for='input-select" + inc2 + "'>Choose Type</label>" +
        "<select id='input-select" + inc2 + "' name='input-select" + inc2 + "' class='form-control' required>" +
        "<option value='' disabled selected>Select the feature</option>" +
        "<option value='if statement'>if statement</option>" +
        "<option value='else statement'>else statement</option>" +
        "<option value='else if statement'>else if statement</option>" +
        "<option value='while loop'>While Loop</option>" +
        "<option value='for loop'>For Loop</option>" +
        "<option value='switch statements'>Switch Statement</option>" +
        "<option value='Other'>Other</option>" +
        "</select>" +
        "</div>" +

        "<div class='col'>" +
        "<label for='repetition" + inc2 + "'>Repetition Count</label>" +
        "<input type='number' id='repetition" + inc2 + "' name='repetition" + inc2 + "' class='form-control' value='1' required>" +
        "</div>" +

        "</div>" +
        "</div>" +
        "<div class='form-group'>" +
        "<label for='textarea" + inc2 + "'>Regular Expretions</label>" +
        "<textarea class='form-control' id='textarea" + inc2 + "' name='textarea" + inc2 + "' rows='3'>" +
        "</textarea>" +
        "</div><hr>";
    document.getElementById("mylocation2").appendChild(node2);
    $("#input-select" + inc2).change(function () {
        $("#textarea" + inc2).val(function () {
            if ($("#input-select" + inc2).val() == "if statement") {
                return "if\\s*\\(.*\\)\\s*\\{[\\s\\S]*?\\}";
            } else if ($("#input-select" + inc2).val() == "else statement") {
                return "if\\s*\\(.*\\)\\s*\\{[\\s\\S]*?\\}\\s*else\\s*\\{[\\s\\S]*?\\}";
            } else if ($("#input-select" + inc2).val() == "else if statement") {
                return "else if\\s*\\(.*\\)\\s*\\{[\\s\\S]*?\\}";
            } else if ($("#input-select" + inc2).val() == "while loop") {
                return "while\\s*\\(.*\\)\\s*\\{[\\s\\S]*?\\}";
            } else if ($("#input-select" + inc2).val() == "for loop") {
                return "for\\s*\\(.*\\;.*\\;.*\\)\\s*\\{[\\s\\S]*?\\}";
            } else if ($("#input-select" + inc2).val() == "switch statements") {
                return "switch\\s*\\(.*\\)\\s*\\{[\\s\\S]*?\\}";
            } else if ($("#input-select" + inc2).val() == "Other") {
                return "";
            }
        });
    });
}