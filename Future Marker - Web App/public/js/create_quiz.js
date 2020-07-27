function addtoform() {
    // var c = document.getElementById("mylocation").childElementCount;

    var node1 = document.createElement("div");
    node1.innerHTML =
        "<div class='text-right'>" +
        "<a onclick='removeElement(this)'><div class='fa fa-times'></div></a>" +
        "</div>" +
        "<div class='form-label-group mt-3'>" +
        "<label for='question'>Question</label>" +
        "<input type='text' id='question' name='question[]' class='form-control' placeholder='Question' required>" +
        "</div>" +
        "<div class='form-label-group mt-3'>" +
        "<label for='answer1'>Answer 1</label>" +
        "<input type='text' id='answer1' name='answer1[]' class='form-control' placeholder='Answer' required>" +
        "</div>" +
        "<div class='form-label-group mt-3'>" +
        "<label for='answer2'>Answer 2</label>" +
        "<input type='text' id='answer2' name='answer2[]' class='form-control' placeholder='Answer' required>" +
        "</div>" +
        "<div class='form-label-group mt-3'>" +
        "<label for='answer3'>Answer 3</label>" +
        "<input type='text' id='answer3' name='answer3[]' class='form-control' placeholder='Answer'>" +
        "</div>" +
        "<div class='form-label-group mt-3'>" +
        "<label for='answer4'>Answer 4</label>" +
        "<input type='text' id='answer4' name='answer4[]' class='form-control' placeholder='Answer'>" +
        "</div>" +
        "<div class='form-group mt-3'>" +
        "<label for='model_answer'>Model Answer</label>" +
        "<select class='form-control' name='model_answer[]' id='model_answer'>" +
        "<option value='1'>Answer 1</option>" +
        "<option value='2'>Answer 2</option>" +
        "<option value='3'>Answer 3</option>" +
        "<option value='4'>Answer 4</option>" +
        "</select>" +
        "</div>" +

        "<hr class='my-5'>";

    document.getElementById("mylocation").appendChild(node1);
}


function removeElement(e) {
    e.parentNode.parentNode.remove();
}