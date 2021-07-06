let codeM = document.getElementById('codeM');
let coderoute = document.getElementById('coderoute').value;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
codeM.addEventListener("change", function (e) {
    e.preventDefault();
    let search = codeM.value;

    $.ajax({
        type: 'GET',
        url: coderoute,
        data: {search:search},
        success: function (data) {

            if (data.valueOf() === false) {
                document.getElementById('codeM').classList.remove("is-valid");
                document.getElementById('codeM').classList.add("is-invalid");
            }
            if(data.valueOf() === true) {

                document.getElementById('codeM').classList.remove("is-invalid");
                document.getElementById('codeM').classList.add("is-valid");

            }


        }
    });
});
