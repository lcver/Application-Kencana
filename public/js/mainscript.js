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
            $(".roleWalikelas").attr("name","kencana_admin_mapelguru[]")
        }

        if($("#roleMatapelajaran").hasClass("d-none") == false)
        {
            $("#roleMatapelajaran").addClass("d-none");
        }

    } else if(r==2)
    {
        if($("#roleMatapelajaran").hasClass("d-none")){
            $("#roleMatapelajaran").removeClass("d-none")
            $(".roleMatapelajaran").attr("name","kencana_admin_mapelguru[]")
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