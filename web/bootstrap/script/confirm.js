/*
 $(document).ready(function () {
 $(document).on('click', '#delete', function (e) {
 var id = $(this).data('id');
 SwalDelete(id);
 e.preventDefault();
 });
 });

 function SwalDelete(id) {
 readData();

 swal({
 title: "Are you sure?",
 text: "But you will still be able to retrieve this file.",
 type: "warning",
 showCancelButton: true,
 confirmButtonColor: "#DD6B55",
 confirmButtonText: "Yes, delete it!",
 cancelButtonText: "No, cancel please!",
 closeOnConfirm: false,
 closeOnCancel: false,
 showLoaderOnConfirm: true,

 preConfirm: function () {
 return new Promise(function (resolve) {
 $.ajax({
 url: 'SimController.php',
 type: 'POST',
 data: 'delete='+id,
 dataType: 'json'
 })
 .done(function (response) {
 swal('Deleted !',response.type, response.message);
 })
 .fail(function () {
 swal('Somthing went rong with ajax', 'error');
 });
 });
 },
 allowOutSideClick:false
 });
 }

 function readData() {
 $('#list').load('SimController.php');
 }
 */