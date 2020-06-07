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