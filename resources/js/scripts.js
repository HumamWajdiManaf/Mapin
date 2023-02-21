/*!
    * Start Bootstrap - SB Admin v7.0.5 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2022 Start Bootstrap
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

function toast_alert(title,text,type='primary',autohide='true'){
	$('#liveToast').attr('data-bs-autohide',autohide);
	$('#liveToast #message-title').html(title);
	$('#liveToast #message-text').html(text);
	$('#liveToast #message-type').attr('class','toast-header text-white bg-'+type);
	var toast = new bootstrap.Toast($('#liveToast'));
	toast.show();
}

function confirm_alert(title,text,icon='question') {
	event.preventDefault();
	var urlToRedirect = event.currentTarget.getAttribute('href');
	Swal.fire({
	  title: title,
	  text: text,
	  icon: icon,
	  buttonsStyling: true,
	  showCancelButton: true,
	  cancelButtonColor: '#6c757d',
	  cancelButtonText: 'Tidak',
	  confirmButtonColor: '#dc3545',
	  confirmButtonText: 'Iya',
	}).then((result) => {
	  if (result.isConfirmed) {
		window.location.href = urlToRedirect;
	  }
	});
}