let inputsearch = document.getElementById('searchadvpay');
let routesearch = document.getElementById('routeSearch').value;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
inputsearch.addEventListener("keyup", function (e) {
    e.preventDefault();
    let search = inputsearch.value;

    $.ajax({
        type:'POST',
        url:routesearch,
        data:{search:search},
        success:function(data){
            let len = data.length;
            if (len === 0)
            {
                document.getElementById("advpayTable").innerHTML = '<td colspan="5"><div class="alert alert-warning"> Pas de resultats</div></td>';
            }else
                {
                    var workeradvpay = '<tr>';
                    for (let i= 0; i< len; i++){
                        workeradvpay += '<td>' + data[i].id_worker + '</td>';
                        workeradvpay += '<td>' + data[i].name + '</td>';
                        workeradvpay += '<td>' + data[i].family_name + '</td>';
                        workeradvpay += '<td>' + data[i].advance_pay + '</td>';
                        workeradvpay += '<td>' + data[i].advance_date + '</td>';
                        workeradvpay += '</tr>';
                    }
                    document.getElementById("advpayTable").innerHTML = workeradvpay;
                }

        }
    });
});
