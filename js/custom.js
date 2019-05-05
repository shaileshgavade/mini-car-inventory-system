$(document).ready(function(){

//    $('.mdb-select').material_select();

    $("#addManufacturer").validate({
	rules: {
            name : {
                required : true
            }
        },
        messages: {
            name: 'Enter name'
        },
        errorPlacement: function(error, element) {
            error.insertAfter($(element));
        },
        success: function(element) {
            $("#" + element.attr("for")).parent().removeClass("error");
        },
        submitHandler: function(form) {
            var name = $('#manufacturerName').val();
            $.ajax({
                'url':'services/manufacturer.php',
                method: "POST",
                data: {
                    'name' : name,
                    'method' : 'create'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    switch(data.status) {
                        case 'success':
                            toastr.success(data.message);
                            break;
                        case 'error':
                            toastr.success(data.message);
                            break;
                        case 'duplicate':
                            toastr.info(data.message);
                            break;
                    }
                    $('#manufacturerName').val('');
                }
            });
        }
    });
    
    $.ajax({
        'url':'services/manufacturer.php',
        method: "POST",
        data: {
            'method' : 'getAll'
        },
        success: function(data) {
            data = JSON.parse(data);
            var mOptions = "<option>Select one</option>";
            for(i = 0; i < data.length; i++) {
                mOptions += "<option value='"+data[i].id+"'>"+ data[i].name +"</option>";
            }
            $('#manufacturers-options').html(mOptions);
        }
    });
  
    /**/
    var min = new Date().getFullYear(),
        max = min + 9,
        yearOptions = "<option>Select one</option>";
    for(i = min; i < max; i++) {
        yearOptions += "<option value='"+ i +"'>"+ i +"</option>";
    }
    $('#modelYears').html(yearOptions);
    /**/
  
    $("#addModel").validate({
	rules: {
            modelName : {
                required : true
            },
            modelManufacturer : {
                required : true
            },
            modelYear : {
                required : true
            },
            modelNumber : {
                required : true
            },
            modelColor : {
                required : true
            },
            modelNote : {
                required : true
            }
        },
        messages: {
            modelName:{
                required : 'Enter name'
            },
            modelManufacturer: {
                required : 'Select one'
            },
            modelYear: {
                required : 'Enter year'
            },
            modelNumber: {
                required : 'Enter number'
            },
            modelColor: {
                required : 'Enter color'
            },
            modelNote: {
                required : 'Enter note'
            }
        },
        errorPlacement: function(error, element) {
            error.insertAfter($(element));
        },
        success: function(element) {
            $("#" + element.attr("for")).parent().removeClass("error");
        },
        submitHandler: function(form) {
            var image1 = $('#modelImage1').prop('files')[0];
            var image2 = $('#modelImage2').prop('files')[0];
            var data = {
                name : $('#modelName').val(),
                registration_number : $('#modelNumber').val(),
                manufacturing_year : $('#modelYears').val(),
                color : $('#modelColor').val(),
                note : $('#modelNote').val(),
                manufaturer_id : $('#manufacturers-options').val(),
            }
            data.method = 'create';
            console.log(data);
            $.ajax({
                'url':'services/model.php',
                method: "POST",
                data: data,
//                processData: false,
//                contentType: false,
                success: function(data) {
                    data = JSON.parse(data);
                    switch(data.status) {
                        case 'success':
                            toastr.success(data.message);
                            break;
                        case 'error':
                            toastr.error(data.message);
                            break;
                    }
                }
            });
        }
    });

    dtTable = $('#inventory').DataTable({
        "ajax":
                {
                    "url": "services/inventory.php",
                    dataSrc: '',
                    "data": {
                        method: 'getAll'
                    }
                },
        rowId: 'id',
        "columns": [
            {"data": "id"},
            {"data": "model_name"},
            {"data": "manufacturer_name"},
//            {"data" : "count"}
        ]
    });

    $('#inventory tbody').on('click', 'tr', function () {
        var id = this.id;
        $.ajax({
            'url':'services/inventory.php',
            method: "GET",
            data: {
                'id' : id,
                'method' : 'get'
            },
            success: function(data) {
                data = JSON.parse(data);
                data = data[0];
                $('#model-details .modal-name').text(data.model_name);
                $('#model-details .manufacturer-name').text(data.manufacturer_name);
                $('#model-details .manufacturer-year').text(data.manufacturing_year);
                $('#model-details .registration-number').text(data.registration_number);
                $('#model-details .color').text(data.color);
                $('#model-details .note').text(data.note);
                $('#car-model-id').val(data.id);
                $('#basicExampleModal').modal('show');
            }
        });
    });

    $('#basicExampleModal').on('click', '#model-sold', function () {
        var id = $('#car-model-id').val();
        console.log(id);
        $.ajax({
            'url':'services/inventory.php',
            method: "POST",
            data: {
                'id' : id,
                'method' : 'sold'
            },
            success: function(data) {
                data = JSON.parse(data);
                switch(data.status) {
                    case 'success':
                        toastr.success(data.message);
                        break;
                    case 'error':
                        toastr.error(data.message);
                        break;
                }
                $('#basicExampleModal').modal('hide');
                dtTable.ajax.reload();
            }
        });
    });

});