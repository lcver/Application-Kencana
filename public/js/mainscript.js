function layoutRoleGuru()
{
    /**
     * 1 - Walikelas
     * 2 - Matapelajaran
     */
    var r = $("#selectRoleGuru").val();
    if(r==1)
    {
        if($("#roleWalikelas").hasClass("d-none")){
            $("#roleWalikelas").removeClass("d-none")
            $(".mapelWalikelas").attr("name","kencana_admin_mapelguru[]");
            $(".kelasWalikelas").attr("name","kencana_admin_kelasguru[]");
        }

        if($("#roleMatapelajaran").hasClass("d-none") == false)
        {
            $("#roleMatapelajaran").addClass("d-none");
        }

    } else if(r==2)
    {
        if($("#roleMatapelajaran").hasClass("d-none")){
            $("#roleMatapelajaran").removeClass("d-none")
            $(".mapelMatapelajaran").attr("name","kencana_admin_mapelguru[]");
            $(".kelasMatapelajaran").attr("name","kencana_admin_kelasguru[]");
        }
            
        if($("#roleWalikelas").hasClass("d-none") == false){
            $("#roleWalikelas").addClass("d-none");
        }
    } else {
        if($("#roleWalikelas").hasClass("d-none") == false){
            $("#roleWalikelas").addClass("d-none");
        }
        if($("#roleMatapelajaran").hasClass("d-none") == false)
        {
            $("#roleMatapelajaran").addClass("d-none");
        }
    }

    var mp = $("#roleMatapelajaran").hasClass("d-none");
    var wl = $("#roleWalikelas").hasClass("d-none");

    console.log("mp :"+mp+"| wl :"+wl);
}

function updateStatusSoal(id){
    console.log("test");
    var data = {id:id}
    $.ajax({
        type: "POST",
        url: "status_soal",
        data: data
    });
}

$(".kencana_soalview").on('click', function(e) {
    var idTarget = $(this).attr('data-target-id');
    $("#soalview").load('view_soal/'+idTarget);
});

// Hapus Soal
$(".elenka_delete_button").on("click", function(e) {
    var idTarget = $(this).attr('data-target-id');
    $("#elenka_delete_confirm").attr('data-target-id',idTarget);
});
$("#elenka_delete_confirm").on("click", function (e) {
    var idTarget = $(this).attr('data-target-id');
    $.ajax({
        type: "POST",
        url: "delete_soal",
        data: {id:idTarget},
        success: function(){
            location.reload()
        }
    });
});

// disclaimer siswa

if($("#claim-terms").prop('checked'))
{
    $("#start-btn").removeAttr("disabled");
}else {
    $("#start-btn").attr("disabled","disabled");
}