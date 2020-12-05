
// $('#form_add_personnel').submit(function (event) {
//     event.preventDefault();
//     var form = $(this)[0];
//     var formData  = new FormData(form);ssssssssss
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//   $.ajax({
//     url:'/registre',
//     method:"POST",
//     data:{
//       logo:formData
//     },
//     cache:false,
//     processData:false,
//     success:function(response){
//      alert(response.message);

//     }
//   });
// })


// (function() {
//     'use strict';
//     window.addEventListener('load', function() {
//       // Get the forms we want to add validation styles to
//       var forms = document.getElementsByClassName('needs-validation');
//       // Loop over them and prevent submission
//       var validation = Array.prototype.filter.call(forms, function(form) {
//         form.addEventListener('submit', function(event) {
//           if (form.checkValidity() === false) {
//             event.preventDefault();
//             event.stopPropagation();
//           }
//           form.classList.add('was-validated');
//         }, false);
//       });
//     }, false);
//   })();
//   (function() {
//     'use strict';
//     window.addEventListener('load', function() {
//       // Get the forms we want to add validation styles to
//       var forms = document.getElementsByClassName('needs-validation_registration');
//       // Loop over them and prevent submission
//       var validation = Array.prototype.filter.call(forms, function(form) {
//         form.addEventListener('submit', function(event) {
//           if (form.checkValidity() === false) {
//             event.preventDefault();
//             event.stopPropagation();
//           }
//           form.classList.add('was-validated');
//         }, false);
//       });
//     }, false);
//   })();
$('#situation').html("<option value='Célibataire'>Célibataire</option><option value='Marié'>Marié</option></option><option value='Veuve'>Veuve</option>");
$('#sexe').change(function (){
  switch (this.value) {
    case "Masculin": $('#situation').html("<option value='Célibataire'>Célibataire</option><option value='Mariée'>Mariée</option></option><option value='Veuf'>Veuf</option>");
      break;
    case "Feminin": $('#situation').html("<option value='Célibataire'>Célibataire</option><option value='Marié'>Marié</option></option><option value='Veuve'>Veuve</option>");
      break;
    default:
      $('#situation').html("");
      break;
  }
})

// (function() {
//   'use strict';
//   window.addEventListener('load', function() {
//     // Get the forms we want to add validation styles to
//     var forms = document.getElementsByClassName('needs-validation');
//     // Loop over them and prevent submission
//     var validation = Array.prototype.filter.call(forms, function(form) {
//       form.addEventListener('submit', function(event) {
//         if (form.checkValidity() === false) {
//           event.preventDefault();
//           event.stopPropagation();
//         }
//         form.classList.add('was-validated');
//       }, false);
//     });
//   }, false);
// })();