function addtoform() {
    var inc = document.getElementById("mylocation").childElementCount + 1;
    document.getElementById("mylocation").innerHTML +=
        "<div><div class='form-label-group'><input type='text' id='input" + inc +
        "' name='input" + inc +
        "' class='form-control' placeholder='Input'><label for='input" + inc +
        "'>Input</label></div><div class='form-label-group'><input type='text' id='output" +
        inc + "' name='output" +
        inc + "' class='form-control' placeholder='Output'><label for='output" +
        inc +
        "'>Output</label></div><div class='custom-control custom-switch'> <input type='checkbox' class='custom-control-input' id='switch" +
        inc + "' name='switch" + inc+ "'> <label class='custom-control-label' for='switch" +
        inc + "'>Hide Input&amp;Output</label></div><hr><div>";



}
$('#summernote').summernote({
    placeholder: 'Descraption',
    tabsize: 10,
    height: 300,
    toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
    ]
});

function addtoform2() {
    var inc2 = document.getElementById("mylocation2").childElementCount + 1;
    document.getElementById("mylocation2").innerHTML +=
        " <div><div class='form-group'><label for='input-select" + inc2 + "'>Choose Type</label><select id='input-select" + inc2 + "' name='input-select" + inc2 + "' class='form-control'><option value='if'>if statment</option><option value='if-else'>if --else</option><option value='elseif'>elseif</option><option value='switch'>switch</option><option value='while'>while</option></select></div><div class='form-group'> <label for='textarea" + inc2 + "'>Regular Expretions</label><textarea class='form-control' id='textarea"+inc2+"' name='textarea"+inc2+"' rows='3'></textarea></div><hr><div>";


}