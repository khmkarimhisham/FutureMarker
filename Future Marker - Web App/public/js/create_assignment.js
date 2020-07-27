function addtoform() {

    var node1 = document.createElement("div");
    node1.innerHTML =
        "<div class='text-right'>" +
        "<a onclick='removeElement(this)'><div class='fa fa-times'></div></a>" +
        "</div>" +
        "<div class='form-label-group'>" +
        "<label for='DynamicInput'>Input</label>" +
        "<input type='text' id='DynamicInput' name='DynamicInput[]' class='form-control' placeholder='Enter your inputs separated by space'>" +
        "</div>" +
        "<div class='form-label-group'>" +
        "<label for='DynamicOutput'>Output</label>" +
        "<input type='text' id='DynamicOutput' name='DynamicOutput[]' class='form-control' placeholder='Enter your output' required>" +
        "</div>" +
        "<div>" +
        "<input type='checkbox' id='DynamicHidden' name='DynamicHidden[]' value='true' onchange ='isHidden(this)'> &nbsp;" +
        "<input type='hidden' id='DynamicHidden2' name='DynamicHidden[]' value='false'>" +
        "<label for='DynamicHidden'>Hide Input & Output</label>" +
        "</div>" +
        "<hr>";

    document.getElementById("mylocation").appendChild(node1);
}

function isHidden(el) {

    if (el.checked) {
        el.nextElementSibling.disabled = true;

    } else {
        el.nextElementSibling.disabled = false;
    }
}


function addtoform2() {
    var node2 = document.createElement("div");

    node2.innerHTML =
        "<div class='text-right'>" +
        "<a onclick='removeElement(this)'><div class='fa fa-times'></div></a>" +
        "</div>" +
        "<div class='form-group'>" +
        "<div class='row'>" +
        "<div class='col'>" +
        "<label for='featureTest'>Choose Type</label>" +
        "<select id='featureTest' name='featureTest[]' class='form-control' onchange = 'changeRegex(this)' required>" +
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
        "<label for='repetition'>Repetition Count</label>" +
        "<input type='number' id='repetition' name='repetition[]' class='form-control' min='1' max='100' value='1' required>" +
        "</div>" +

        "</div>" +
        "<div class='form-group'>" +
        "<label for='regex'>Regular Expretions</label>" +
        "<textarea class='form-control' id='regex' name='regex[]' rows='3' required></textarea>" +
        "</div>" +
        "</div>" +
        "<hr>";

    document.getElementById("mylocation2").appendChild(node2);

}

function changeRegex(el) {
    if (el.value == "if statement") {
        el.parentNode.parentNode.parentNode.lastChild.lastChild.value = "if\\s*\\(.*\\)\\s*\\{[\\s\\S]*?\\}";
    } else if (el.value == "else statement") {
        el.parentNode.parentNode.parentNode.lastChild.lastChild.value = "if\\s*\\(.*\\)\\s*\\{[\\s\\S]*?\\}\\s*else\\s*\\{[\\s\\S]*?\\}";
    } else if (el.value == "else if statement") {
        el.parentNode.parentNode.parentNode.lastChild.lastChild.value = "else if\\s*\\(.*\\)\\s*\\{[\\s\\S]*?\\}";
    } else if (el.value == "while loop") {
        el.parentNode.parentNode.parentNode.lastChild.lastChild.value = "while\\s*\\(.*\\)\\s*\\{[\\s\\S]*?\\}";
    } else if (el.value == "for loop") {
        el.parentNode.parentNode.parentNode.lastChild.lastChild.value = "for\\s*\\(.*\\;.*\\;.*\\)\\s*\\{[\\s\\S]*?\\}";
    } else if (el.value == "switch statements") {
        el.parentNode.parentNode.parentNode.lastChild.lastChild.value = "switch\\s*\\(.*\\)\\s*\\{[\\s\\S]*?\\}";
    } else if (el.value == "Other") {
        el.parentNode.parentNode.parentNode.lastChild.lastChild.value = "";
    }
}

function checkMarks() {

    var compileDegree = parseInt(document.getElementById("compileDegree").value);
    var styleDegree = parseInt(document.getElementById("styleDegree").value);
    var dynamicTestDegree = parseInt(document.getElementById("dynamicTestDegree").value);
    var featureTestDegree = parseInt(document.getElementById("featureTestDegree").value);

    if (compileDegree + styleDegree + dynamicTestDegree + featureTestDegree != 100) {
        document.getElementById("compileDegree").setCustomValidity("The assignment's mark should be from 100");
    } else {
        document.getElementById("compileDegree").setCustomValidity("");
    }
}


function removeElement(e) {
    e.parentNode.parentNode.remove();
}
