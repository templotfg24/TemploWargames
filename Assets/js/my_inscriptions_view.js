// my_inscriptions_view.js

function showDeleteModal(inscriptionId) {
    $('#confirmDelete').data('inscription-id', inscriptionId);
    $('#deleteConfirmationModal').modal('show');
  }
  
  $('#confirmDelete').click(function() {
    var inscriptionId = $(this).data('inscription-id');
    $.post('ProfileController.php?action=deleteInscription', { id: inscriptionId }, function(response) {
      $('#deleteConfirmationModal').modal('hide');
      location.reload();
    });
  });
  
  function toggleDetails(inscriptionId) {
    $('#inscription-' + inscriptionId).toggle();
  }
  