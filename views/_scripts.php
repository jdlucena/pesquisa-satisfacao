
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/form-validation.js"></script>
  <script src="assets/js/iziToast.min.js"></script>
  <script src="assets/js/jquery.dataTables.js"></script>
  
  <script>
    // Ativar todos tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // Configurações do Datatables
    $(document).ready(function() {
      $('#example').DataTable({
        "order": [[ 1, "asc" ]],
        "paging":   false,
        "pageLength": 200,
        "language": {
            "lengthMenu": "",
            "zeroRecords": "Nada encontrado",
            "info": "Exibindo página _PAGE_ de _PAGES_",
            "infoEmpty": "Sem registros disponíveis",
            "infoFiltered": "(Filtrado de um total de _MAX_ registros)",
            "sSearch": "Pesquisar",
            "paginate": {
              "next": "Próximo",
              "previous": "Anterior"
            }
        }
      });
    });
  </script>


  