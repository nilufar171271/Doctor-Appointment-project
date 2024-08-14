
var baseURL = $('body').data('baseurl');


$('.add_new_medicine').click(function(){

    newMedicineItemAdd();


});


$('.add_new_test').click(function(){

    newTestItemAdd();


});


$("body").on("click", ".delete_master", function () {
    $(this).closest(".master_attach_place").remove();
    return false;
});


function newMedicineItemAdd(){
    var i=0;

    $(".add_medicine_place").append("<div class='master_attach_place'><div class='row'><div class='span5'><input type='text' name='med_name[]'' class='form-control custom-control' placeholder='Medicine Name' required></div><div class='span3'> <input type='text' name='med_taking_time[]'' class='form-control custom-control' placeholder='Time' required></div> <div class='span3'><input type='text' name='med_taking_dura[]'' class='form-control custom-control' placeholder='Duration' required></div><div class='span1'><button class='btn btn-danger delete_master' id=''>x</button></div></div></div>");


}


function newTestItemAdd(){
    var i=0;

    $(".add_test_place").append("<div class='master_attach_place'><div class='row'><div class='span4'><input type='text' name='test_name[]' class='form-control custom-control' placeholder='Test Name' required></div><div class='span7'><input type='text' name='description[]'' class='form-control custom-control' placeholder='Description' required></div> <div class='span1'><button class='btn btn-danger delete_master' id=''>x</button></div></div></div>");


}




$('#patient_id').change(function() {
//    var appointment_id=($(this).find(':selected').data('appointment'));
    var appointment_id=$('#patient_id option:selected').data('appointment');
    var patient_id=$('#patient_id').val();
    if(patient_id==""){
        $('.reset').val('');
        return false;
    }else{



        $.ajax({
            type: "POST",
            url: "../controller/patientInfoGet.php",
            data: 'id='+patient_id,
            cache:  false,
            dataType: 'json',
            success: function(response){



                $('#age').val(response['age']);
                $('#gender').val(response['gender']);
                $('#mobile').val(response['mobile']);

                $('#appointment_id').val(appointment_id);




            }

        });

    }

    return false;

});
