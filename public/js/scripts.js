/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

function editModalShow(uuid,jenis,model,deskripsi,harga)
{
    const form = document.getElementById('editForm');
    form.action = `/project/setting/${uuid}`
    
    //const formData = new FormData(document.getElementById("editForm")).action= "/project/update";
    //$('#editForm').attr("action", `/project/setting/${uuid}`) ;
    const  jenisField=document.getElementById('editJenisProyek').value = jenis
    const  modelField=document.getElementById('editModelProyek').value = model;
    const deskripsiField = document.getElementById('editDeskripsiProyek').value = deskripsi;
    const hargaField=document.getElementById('editHargaProyek').value = harga
    // $("#modelProyek").val(model);
    // $("#harga").val(harga);
}

function updateStatus(id)
{
    const formData = new FormData();
    formData.append('uuid', id);
    formData.append('_method','POST');
    formData.append('_action','')
    
}
